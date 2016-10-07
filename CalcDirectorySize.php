<?php 
function CalcDirectorySize($DirectoryPath) {
 
    // I reccomend using a normalize_path function here
    // to make sure $DirectoryPath contains an ending slash
    // (-> http://www.jonasjohn.de/snippets/php/normalize-path.htm)
 
    // To display a good looking size you can use a readable_filesize
    // function.
    // (-> http://www.jonasjohn.de/snippets/php/readable-filesize.htm)
 
    $Size = 0;
 
    $Dir = opendir($DirectoryPath);
 
    if (!$Dir)
        return -1;
 
    while (($File = readdir($Dir)) !== false) {
 
        // Skip file pointers
        if ($File[0] == '.') continue; 
 
        // Go recursive down, or add the file size
        if (is_dir($DirectoryPath . $File))            
            $Size += CalcDirectorySize($DirectoryPath . $File . DIRECTORY_SEPARATOR);
        else 
            $Size += filesize($DirectoryPath . $File);        
    }
 
    closedir($Dir);
 
    return $Size;
}