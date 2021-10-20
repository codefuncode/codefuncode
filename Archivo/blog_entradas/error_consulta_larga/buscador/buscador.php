<?php

// http://localhost/Proyecto/codefuncode/blog_entradas/error_consulta_larga/buscador/buscador.php
$GLOBALS['conexion'] = "conn.php";
busca_anuncio();

function busca_anuncio()
{
   $idmarca  = 1;
   $idmodelo = 2;

   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->exec('SET CHARACTER SET UTF8');
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->execute('SET CHARACTER SET UTF8');
      $stmt = $conn->prepare(
         "SELECT
         anuncio.idanuncio,
         anuncio.nombre,
         anuncio.pagado,
         -- anuncio.direccion,
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
         -- anuncio.imagen,
         anuncio.full_lablel,
         anuncio.idpueblo,
         pueblo.nombre as nombre_pueblo,
         anuncio.precio,
         anuncio.mejoroferta
         FROM
         anuncio,
         categoria,
         marca,
         modelo,
         clasificacion,
         condicion,
         transmission,
         pueblo
         WHERE anuncio.idmarca=:idmarca
         AND anuncio.idmodelo=:idmodelo
         AND categoria.idcategoria=anuncio.idcategoria
         AND marca.idmarca=anuncio.idmarca
         AND modelo.idmodelo=anuncio.idmodelo
         AND clasificacion.idclasificacion=anuncio.idclasificacion
         AND condicion.idcondicion=anuncio.idcondicion
         AND transmission.idtransmission=anuncio.idtransmission
         AND pueblo.idpueblo=anuncio.idpueblo"
         // GROUP BY anuncio.idanuncio"
      );
      $stmt->bindParam(':idmarca', $idmarca);
      $stmt->bindParam(':idmodelo', $idmodelo);

      if ($stmt->execute()) {

         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
         // $result = $stmt->fetchAll();

         for ($i = 0; $i < count($result); $i++) {

            $imagenes_encontradas = buscaImagenes_anuncio($result[$i]['idanuncio']);

            array_push($result[$i], $imagenes_encontradas);

         }

         echo json_encode($result);

      } else {
         $result = array(
            "resultado" => "error");
         echo json_encode($result);
      }

   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
   $conn = null;

}

function buscaImagenes_anuncio($id)
{

   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $conn->prepare("SELECT * FROM imagenes WHERE idanuncio=:idanuncio");
      $stmt->bindParam(':idanuncio', $id);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $result;

   } catch (PDOException $e) {
      // NOTA
      // Retorna falso , sin embargo no esta controlada
      // la acción y retorna falso, sera error grave
      // return false;
      echo "Error: " . $e->getMessage();
   }
   $conn = null;
}
