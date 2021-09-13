<?php

// header('Content-Type: application/json');
$GLOBALS['conexion'] = "conn.php";

include $GLOBALS['conexion'];

$idmarca  = 1;
$idmodelo = 2;

// $idmarca =
//    intval(json_decode($_GET['idmarca']));
// $idmodelo =
//    intval(json_decode($_GET['idmodelo']));

// echo "{$idmarca}, {$idmodelo}";
$sql =
   "SELECT
      anuncio.idanuncio,
      anuncio.nombre,
      anuncio.pagado,
      anuncio.telefono,
      anuncio.email,
      anuncio.idcategoria,
      categoria.nombre as nombre_categoria,
      anuncio.idmarca,
      marca.nombre as nombre_marca,
      anuncio.idmodelo,
      modelo.nombre as nombre_modelo,
      anuncio.year,
      anuncio.idclasificacion,
      clasificacion.nombre as nombre_clasificacion,
      anuncio.idcondicion,
      condicion.nombre as nombre_condicion,
      anuncio.idtransmission,
      transmission.nombre as nombre_trasmission,
      anuncio.licencia,
      anuncio.multas,
      anuncio.millage,
      anuncio.descripcion,
      anuncio.full_lablel,
      anuncio.idpueblo,
      pueblo.nombre as nombre_pueblo,
      anuncio.precio,
      anuncio.mejoroferta,
      imagenes.descripcion_imagen,
      imagenes.nombre_directorio,
      imagenes.ruta_imagen
      FROM anuncio
      JOIN categoria ON categoria.idcategoria=anuncio.idcategoria
      JOIN marca ON marca.idmarca=anuncio.idmarca
      JOIN modelo ON modelo.idmodelo=anuncio.idmodelo
      JOIN clasificacion ON clasificacion.idclasificacion=anuncio.idclasificacion
      JOIN condicion ON condicion.idcondicion=anuncio.idcondicion
      JOIN transmission ON transmission.idtransmission=anuncio.idtransmission
      JOIN pueblo ON pueblo.idpueblo=anuncio.idpueblo
      JOIN imagenes ON imagenes.idanuncio=anuncio.idanuncio
         AND imagenes.numero_imagen=1
      WHERE anuncio.idmarca= {$idmarca}
         AND anuncio.idmodelo= {$idmodelo}";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if ($result = $conn->query($sql)) {

   // var_dump($result->fetch_all(MYSQLI_ASSOC));
   // echo "<br/>===============<br/>";
   // echo "<br/>===============<br/>";
   $respuesta = $result->fetch_all(MYSQLI_ASSOC);

   echo json_encode(var_dump($respuesta));
   // echo "<br/>===============<br/>";
   // echo json_encode(var_dump($respuesta));
   // echo "<br/>===============<br/>";
   // echo json_encode($result->fetch_all(MYSQLI_ASSOC));
   // echo $respuesta;
} else {
   $respuesta = array("resultado" => "error");

   echo json_encode($respuesta);
}

// $stmt->close();
$conn->close();
