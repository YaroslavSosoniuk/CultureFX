<?php
$dir    = 'name_of_dir';
$dirs_with_files = scandir($dir);
foreach ($dirs_with_files as $dir_or_file){
    if ($dir_or_file != "." && $dir_or_file != "..") {
        if (is_dir($dir . '/' . $dir_or_file)) $dirs[] = $dir_or_file;
        else if (is_file($dir . '/' . $dir_or_file)) $files[] = $dir_or_file;
    }
}
var_dump($dirs_with_files);
echo '<br>';
var_dump($dirs);
echo '<br>';
var_dump($files);

