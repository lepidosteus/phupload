<?php 

require __DIR__.'/../vendor/autoload.php';

use Lepidosteus\Phupload\Path;

$p = new Path("relative/path");
var_dump($p->pathinfo());

$p = new Path("/absolute/path");
var_dump($p->pathinfo());

$p = new Path("/absolute/path/directory/");
var_dump($p->pathinfo());

$p = new Path("/////zefzfez///ezfe/cscs///adgg.eee.rgr");
var_dump($p->pathinfo());

