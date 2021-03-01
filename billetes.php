<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

require_once __DIR__ . '/vendor/autoload.php';
require_once 'utils.php';

$request = json_decode(file_get_contents('php://input'), true);

try {
  switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":      // create
      require 'buy.php';
      insert($request);
      break;
    case "GET":       // read / search
      require 'read.php';
      read($_GET);
      break;
    case "PUT":       // update
      require 'update.php';
      update($request);
      break;
    case "DELETE":    // delete
      require 'delete.php';
      delete($request);
      break;
    default:
      die(format_error("Invalid request type"));
  }
} catch (Exception $e ) {
  die(format_error("No se pudo completar la consulta" . $e));
}