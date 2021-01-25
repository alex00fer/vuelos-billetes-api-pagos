<?php

require_once 'dbConnect.php';
require_once 'utils.php';

function delete($data) {
$coleccion = get_mongo_collection();
$filterDoc = [
  'codigo' => $data['codigo']
];


$updateDoc = [
  '$pull' => 
    ['vendidos' => 
      [
        'codigoVenta' => $data['codigoVenta']
      ]
    ]
];

$updateResult = $coleccion->updateOne($filterDoc,$updateDoc);
$updateResult = $coleccion->updateOne($filterDoc, ['$inc' => ['plazas_totales' => + 1]]);
}
 ?>
