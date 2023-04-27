<?php 
session_start();
include_once('vendor/autoload.php');

use Jordan\Test\Dispatcher;

$content = new Dispatcher();
$content->dispatch();
