<?php
// http://localhost/Proyecto/codefuncode/blog_entradas/error_consulta_larga/buscador/buscador4.php
$GLOBALS['conexion'] = "conn.php";
busca_anuncio();
function busca_anuncio()
{
   $idmarca  = 1;
   $idmodelo = 2;

   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->exec('SET CHARACTER SET UTF8');
      $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

      $sql = "SELECT * FROM anuncio  WHERE anuncio.idmarca={$idmarca}
         AND anuncio.idmodelo={$idmodelo}";
      $stmt   = $conn->query($sql);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      for ($i = 0; $i < count($result); $i++) {

         $result[$i] += ["nombre_categoria" => nombre_categoria($result[$i]["idcategoria"])];
         $result[$i] += ["nombre_marca" => nombre_marca($result[$i]["idmarca"])];
         $result[$i] += ["nombre_modelo" => nombre_modelo($result[$i]["idmodelo"])];
         $result[$i] += ["nombre_clasificacion" => nombre_clasificacion($result[$i]["idclasificacion"])];
         $result[$i] += ["nombre_condicion" => nombre_condicion($result[$i]["idcondicion"])];
         $result[$i] += ["nombre_transmision" => nombre_transmision($result[$i]["idtransmission"])];
         $result[$i] += ["nombre_pueblo" => nombre_pueblo($result[$i]["idpueblo"])];
         $result[$i] = buscaImagenes_anuncio($result[$i], $result[$i]["idanuncio"]);
         // array_push($result[$i], buscaImagenes_anuncio($result[$i]["idanuncio"]));

      }
      echo json_encode($result);

   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
   $conn = null;

}

function buscaImagenes_anuncio($registro, $id)
{

   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->exec('SET CHARACTER SET UTF8');
      $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

      $sql  = "SELECT * FROM imagenes WHERE idanuncio={$id} AND numero_imagen=1";
      $stmt = $conn->query($sql);
      // $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $registro += ["descripcion_imagen" => $result[0]["descripcion_imagen"]];
      $registro += ["nombre_directorio" => $result[0]["nombre_directorio"]];
      $registro += ["ruta_imagen" => $result[0]["ruta_imagen"]];

      return $registro;

      // descripcion_imagen
      // idanuncio
      // idimagen
      // nombre_directorio
      // numero_imagen
      // ruta_imagen

   } catch (PDOException $e) {
      // NOTA
      // Retorna falso , sin embargo no esta controlada
      // la acción y retorna falso, sera error grave
      // return false;
      echo "Error: " . $e->getMessage();
   }
   $conn = null;
}

function nombre_pueblo($idpueblo)
{
   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->exec('SET CHARACTER SET UTF8');
      $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

      $sql    = "SELECT nombre as nombre_pueblo FROM pueblo  WHERE idpueblo={$idpueblo}";
      $stmt   = $conn->query($sql);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      // echo "<br/>";
      // echo "<br/>";
      // var_dump($result);

      return $result["nombre_pueblo"];
      // echo json_encode($result);

   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }

   $conn = null;
}

function nombre_transmision($idtransmission)
{
   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->exec('SET CHARACTER SET UTF8');
      // $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

      $sql    = "SELECT nombre as nombre_trasmission FROM transmission  WHERE idtransmission={$idtransmission}";
      $stmt   = $conn->query($sql);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      // echo "<br/>";
      // echo "<br/>";
      // var_dump($result);

      // return $result;
      return $result["nombre_trasmission"];
      // echo json_encode($result);

   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }

   $conn = null;
}
function nombre_condicion($idcondicion)
{
   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->exec('SET CHARACTER SET UTF8');
      $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

      $sql    = "SELECT nombre as nombre_condicion FROM condicion  WHERE idcondicion={$idcondicion}";
      $stmt   = $conn->query($sql);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      // echo "<br/>";
      // echo "<br/>";
      // var_dump($result);

      // return $result;
      return $result["nombre_condicion"];
      // echo json_encode($result);

   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }

   $conn = null;
}

function nombre_clasificacion($idclasificacion)
{
   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->exec('SET CHARACTER SET UTF8');
      $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

      $sql    = "SELECT nombre as nombre_clasificacion FROM clasificacion  WHERE idclasificacion={$idclasificacion}";
      $stmt   = $conn->query($sql);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      // echo "<br/>";
      // echo "<br/>";
      // var_dump($result);

      // return $result;
      return $result["nombre_clasificacion"];
      // echo json_encode($result);

   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }

   $conn = null;
}
function nombre_modelo($idmodelo)
{
   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->exec('SET CHARACTER SET UTF8');
      $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

      $sql    = "SELECT nombre as nombre_modelo FROM modelo  WHERE idmodelo={$idmodelo}";
      $stmt   = $conn->query($sql);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      // echo "<br/>";
      // echo "<br/>";
      // var_dump($result);

      // return $result;
      return $result["nombre_modelo"];
      // echo json_encode($result);

   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }

   $conn = null;
}

function nombre_categoria($idcategoria)
{

   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->exec('SET CHARACTER SET UTF8');
      $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

      $sql    = "SELECT nombre as nombre_categoria FROM categoria  WHERE idcategoria={$idcategoria}";
      $stmt   = $conn->query($sql);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      // echo "<br/>";
      // echo "<br/>";
      // var_dump($result);

      return $result["nombre_categoria"];
      // echo json_encode($result);

   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }

   $conn = null;
}

function nombre_marca($idmarca)
{
   include $GLOBALS['conexion'];
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->exec('SET CHARACTER SET UTF8');
      $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

      $sql    = "SELECT nombre as nombre_marca FROM marca  WHERE idmarca={$idmarca}";
      $stmt   = $conn->query($sql);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      // echo "<br/>";
      // echo "<br/>";
      // var_dump($result);

      // return $result;
      return $result["nombre_marca"];
      // echo json_encode($result);

   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }

   $conn = null;
}
