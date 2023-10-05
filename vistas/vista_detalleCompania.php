<?php 
  include('../secciones/detalleCompania.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title> <?php echo $empresa[1];?> </title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style.php">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/index.js"></script>
</head>

    <div id="detalle" class="container-fluid" style="padding-bottom:0em;">
    </div>

    <script>
     setInterval(function(){
         fetch('./detalleDeVista.php?idc=<?php echo $idCompania;?>')
         .then(function(response) {
           return response.text();
         })
         .then(function(text) {
           document.getElementById("detalle").innerHTML = text;
         });
     },1000);
 </script>

<?php include('./pie.php');?>