<?php

require_once 'dbConnect.php';
require_once 'utils.php';

function update($data) {

  assert_array_fields($data, 'codigo', 'codigoVenta', 'dni', 'apellido', 'nombre');

  $coleccion = get_mongo_collection();
    $filtro = [
        'codigo' => $data["codigo"],
        'vendidos.codigoVenta' => $data["codigoVenta"]
    ];
    $updateDoc = [
        '$set' => [
          'vendidos.$.dni' => $data['dni'],
          'vendidos.$.apellido' => $data['apellido'],
          'vendidos.$.nombre' => $data['nombre']
        ]
    ];

    $updateResult = $coleccion->updateOne($filtro, $updateDoc);
    $modifiedCount = $updateResult->getModifiedCount();

    if ($modifiedCount <= 0) {
      die(format_error("No se han realizado cambios o no se pudo modificar la compra. Compruebe que los datos sean correctos"));
    }

    $result = @array(
      "estado" =>  true,
      "codigo" => $data['codigo'],
      "codigoVenta" => $data['codigoVenta'],
      'dni' => $data['dni'],
      'apellido' => $data['apellido'],
      'nombre' => $data['nombre']
    );
    echo json_encode($result, JSON_PRETTY_PRINT);

}
 ?>
