<?php 
    include('../conexion/database.php');

    header('Content-type: text/css');
    
    
    $db=new Database();
    $queryEmpresa=$db->connect()->prepare('SELECT * FROM empresa');
    $queryEmpresa->execute();
    $empresa=$queryEmpresa->fetch(PDO::FETCH_NUM);
    ?>
.bg{
    background-image:url("<?php echo $empresa[4];?>");
}
.bg-template{
    background-image:url("<?php echo $empresa[5];?>");
}