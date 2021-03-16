<?php
$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/frdms/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/frdms/public/storage';
symlink($targetFolder,$linkFolder);
echo $_SERVER['DOCUMENT_ROOT'];
?>

<!-- add to top of app blade to create symlink in laravel -->