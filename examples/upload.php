<?php 
// php -S localhost:8000 upload.php
require __DIR__.'/../vendor/autoload.php';

// erreur taille ini pas ok

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Lepidosteus\Phupload\Uploader;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploader = Uploader::create()->required(true)->size('10k', '10M')->extension('jpg')->mime('image/jpeg');
//    $uploader = Uploader::createJpeg($maxsize)->required(true)->size('1M', '10M')->extension('jpg')->mime('image/jpeg');

    $upload = $uploader->validate('myfile');
    
    if ($upload->has_errors()) {
        $errors = $upload->errors();
        foreach ($errors as $error) {
            echo '<div>'.htmlentities($error).'</div>';
        }
    } elseif ($upload->has_file()) {
        $file = $upload->file();
        echo '<div>File sent: '.htmlentities($file->mime().' : '.$file->size_pretty().' : '.$file->extension().' : '.$file->name()).'</div>';

        if ($file->move('/mnt/c/Code/phupload/examples/', 'te/sst.jpg')) {
            echo "<div>File moved</div>";
        }
    }
}

?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile" />
    <input type="submit" />
</form>
