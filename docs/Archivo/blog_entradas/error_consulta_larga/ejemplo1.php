<style>
   .cabecera_targeta p, .descripcion_targeta>p{
      padding: 0px !important;
      margin: 0px !important;
      }
</style>

<?php
include_once '../comp/head.php';
include_once '../comp/nav.php';

try {
   include "../conn/conn.php";
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $stmt = $conn->prepare("SELECT * FROM anuncio ORDER BY idanuncio DESC; ");
   $stmt->execute();
   $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

   ?>
   <style type="text/css">
   .targeta .w3-card-4{
   background-color: #d6eaf8;
   transform: scale(1);
   transition: transform 0.7s;
   }
   .targeta .w3-card-4:hover{
   transform: scale(1.06);
   }
   .targeta .w3-card-4 img{
   margin-top: 20px;
   height:150px;
   width:75%;
   }
</style>
<div class="w3-container">
   <div class="w3-row-padding w3-section w3-stretch">
<?php
for ($i = 0; $i < count($resultado); $i++) {

      genera_anuncio($resultado[$i]);
   }
   ?>
   </div>
</div>
<?php
} catch (PDOException $e) {

}

function genera_anuncio($anuncio)
{

   busca_imagenes_anuncio($anuncio["idanuncio"], $anuncio);

}

function busca_imagenes_anuncio($idanuncio, $anuncio)
{

   try {
      include "../conn/conn.php";
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM imagenes  WHERE idanuncio ='$idanuncio'");
      $stmt->execute();

      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (array_key_exists(0, $resultado) == 1) {
         $directorio    = $resultado[0]['nombre_directorio'];
         $nombre_imagen = $resultado[0]['ruta_imagen'];
         $ruta          = "{$directorio}/{$nombre_imagen}";
         $marca         = nombre_marca($anuncio['idmarca']);
         $modelo        = nombre_modelo($anuncio['idmodelo']);
         $transmission  = nombre_transmision($anuncio['idtransmission']);
         $clasificacion = nombre_clasificacion($anuncio['idclasificacion']);

         $condicion = nombre_condicion($anuncio['idcondicion']);

         ?>
<div class="w3-col s12 m4 l3 targeta">
   <div class="w3-container w3-center">
      <div class="w3-card-4">
         <h3 class="">
            <?=$marca;?>
         </h3>
         <img class="w3-round" src="<?=$ruta;?>"/>
         <ul class="w3-ul w3-small w3-left-align">
            <li>
               Marca:
               <span class="marca">
                  <?=$marca;?>
               </span>
            </li>
            <li>
               Modelo
               <span>
                  <?=$modelo;?>
               </span>
            </li>
            <li>
               Transmisión
               <span>
                  <?=$transmission;?>
               </span>
            </li>
            <li>
               Clasificación
               <span>
                  <?=$clasificacion;?>
               </span>
            </li>
            <li>
               Condición
               <span>
                  <?=$condicion;?>
               </span>
            </li>
         </ul>
         <button class="w3-btn w3-block w3-green">
            Button
         </button>
      </div>
   </div>
</div>

         <?php

      }
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
}

function nombre_marca($id)
{
   include "../conn/conn.php";
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT nombre FROM marca WHERE idmarca=$id");
      $stmt->execute();

      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $resultado[0]["nombre"];

   } catch (PDOException $e) {

   }
   $conn = null;

}
function nombre_modelo($id)
{
   include "../conn/conn.php";
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT nombre FROM modelo WHERE idmodelo=$id");
      $stmt->execute();

      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $resultado[0]["nombre"];

   } catch (PDOException $e) {

   }
   $conn = null;

}

function nombre_transmision($id)
{
   include "../conn/conn.php";
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->exec('set names utf8');
      $stmt = $conn->prepare("SELECT nombre FROM transmission WHERE idtransmission=$id");
      $stmt->execute();

      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $resultado[0]["nombre"];

   } catch (PDOException $e) {

   }
   $conn = null;

}

function nombre_clasificacion($id)
{
   include "../conn/conn.php";
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT nombre FROM clasificacion WHERE idclasificacion=$id");
      $stmt->execute();

      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $resultado[0]["nombre"];

   } catch (PDOException $e) {

   }
   $conn = null;

}

function nombre_condicion($id)
{
   $id = 1;
   include "../conn/conn.php";
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM condicion WHERE idcondicion=$id");
      $stmt->execute();

      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $resultado[0]["nombre"];

   } catch (PDOException $e) {

   }

   $conn = null;

}
