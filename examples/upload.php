<?php 
// php -S localhost:8000 upload.php
require __DIR__.'/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Lepidosteus\Phupload\Upload;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload = \Lepidosteus\Phupload\Upload::create()->required(true)->size('1M', '10M')->extension('jpg')->mime('image/jpeg');
/*
    if ($upload->validate('myfile')) {
        $file = $upload->file();
        echo '<div>File sent: '.htmlentities($file->mime().' : '.$file->size_pretty().' : '.$file->extension().' : '.$file->name()).'</div>'
    } else {
        $errors = $upload->errors();
        foreach ($errors as $error) {
            echo '<div>'.htmlentities($error).'</div>'
        }
    }
*/
}

?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile" />
    <input type="submit" />
</form>
