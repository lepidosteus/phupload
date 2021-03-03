<?php 
// php -S localhost:8000 upload.php
require __DIR__.'/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Lepidosteus\Phupload\Uploader;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploader = Uploader::create()->required(true)->size('1M', '10M')->extension('jpg')->mime('image/jpeg');
//    $uploader = Uploader::createJpeg($maxsize)->required(true)->size('1M', '10M')->extension('jpg')->mime('image/jpeg');

    $upload = $uploader->validate('myfile');
    if ($upload->has_errors()) {
        $errors = $upload->errors();
        foreach ($errors as $error) {
            echo '<div>'.htmlentities($error).'</div>';
        }
    } else {
        $file = $upload->file();
        echo '<div>File sent: '.htmlentities($file->mime().' : '.$file->size_pretty().' : '.$file->extension().' : '.$file->name()).'</div>';
    }
}

?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile" />
    <input type="submit" />
</form>
