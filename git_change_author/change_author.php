<?php 
shell_exec('sh ./change_author.sh');
shell_exec("git push --force --tags origin 'refs/heads/*'");
echo "Done";