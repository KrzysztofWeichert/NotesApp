<?php

declare(strict_types=1);

namespace App;

use App\Controller\NoteController;
use App\Request;
use Exception;
use Error;

require_once realpath('vendor/autoload.php');

$db_config = require_once('config/config.php');

try{
$request = new Request($_GET, $_POST);
(new NoteController($request, $db_config))->run();
} catch (Error|Exception $e){
  echo '<h1>An error happend :(</h1>';
  echo 'We got an error. Try again later.';
}