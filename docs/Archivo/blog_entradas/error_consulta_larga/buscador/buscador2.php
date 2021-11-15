<?php
// http://localhost/Proyecto/codefuncode/blog_entradas/error_consulta_larga/buscador/buscador2.php
$GLOBALS['conexion'] = "conn.php";

$idmarca  = 1;
$idmodelo = 2;

$consulta =
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
      imagenes.nombre_directorio ,
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
      WHERE anuncio.idmarca={$idmarca}
         AND anuncio.idmodelo={$idmodelo}";

busca_anuncio($consulta);
function busca_anuncio($consulta)
{
   header('Content-Type: application/json; charset=utf-8');
   // $idmarca =
   //    json_decode($_GET['idmarca']);
   // $idmodelo =
   //    json_decode($_GET['idmodelo']);

   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt   = $conn->query($consulta);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($result);

   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
   $conn = null;

}
