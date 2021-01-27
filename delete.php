<?php

require_once 'dbConnect.php';
require_once 'utils.php';

function delete($data) {

  assert_array_fields($data, 'codigo', 'codigoVenta', 'dni');

  $coleccion = get_mongo_collection();
  $filterDoc = [
    'codigo' => $data['codigo']
  ];


  $updateDoc = [
    '$pull' => 
      ['vendidos' => 
        [
          'codigoVenta' => $data['codigoVenta'],
          'dni' => $data['dni'],
        ]
      ]
  ];

  $updateResult = $coleccion->updateOne($filterDoc,$updateDoc);

  $modifiedCount = $updateResult->getModifiedCount();

  if ($modifiedCount !== 1) {
    die(format_error("No se pudo borrar la compra. Compruebe que los datos sean correctos"));
  }

  // añadir plaza borrada
  $coleccion->updateOne($filterDoc, ['$inc' => ['plazas_disponibles' => $modifiedCount]]);

  $result = @array(
    "estado" =>  true,
    "codigo" => $data['codigo'],
    "codigoVenta" => $data['codigoVenta']
  );
  echo json_encode($result, JSON_PRETTY_PRINT);

}

 ?>
