<?php
    include_once './conexion/database.php';
    
    $message="";
    session_start();

    $db=new Database();
    $queryEmpresa=$db->connect()->prepare('SELECT * FROM empresa');
    $queryEmpresa->execute();
    $empresa=$queryEmpresa->fetch(PDO::FETCH_NUM);
    
    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
    }

    if(isset($_SESSION['rol'])){
      header('location:./vistas/template.php');
    }

    if(isset($_POST['rut']) && isset($_POST['clave'])){
     
      $rut=$_POST['rut'];
      $clave=$_POST['clave'];
      
      $query=$db->connect()->prepare('SELECT * FROM usuarios WHERE rut=:rut AND clave=:clave');
      $query->execute(['rut'=>$rut,'clave'=>$clave]);
      $row=$query->fetch(PDO::FETCH_NUM);
      if($row==true){
          $rut=$row[0];
          $nombre=$row[1];
          $rol=$row[8];
          $compania=$row[9];
          $_SESSION['rol']=$rol;
          $_SESSION['rut']=$rut;
          $_SESSION['user']=$nombre;
          $_SESSION['userCompany']=$compania;

          header('location:./vistas/template.php');
      }else{
          $message="Rut o clave inválidos.";
      }
    }

?>
<!doctype html>
<html lang="es">

  <head>
    <title> <?php echo $empresa[1];?> </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"      
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="./css/style.php"/>
  </head>

  <body>
    <header></header>
    <main style="margin-top:2em;">
      <div class="container">
        <div class="bg p-0 m-0"></div>
        <div class="row justify-content-center mt-5" >
          <div class="col-sm-10 col-md-5">
            <div class="card bg-ligth">
              <div class="card-body m-auto">
                <div class="row text-center">
                  <div class="col">
                    <img src=" <?php echo substr($empresa[3],1);?> " class="logo_card" alt="" />
                  </div>
                </div>
                <h4 class="card-title text-center"> <?php echo $empresa[1];?> </h4>
                <p
                  class="card-text text-center bg-danger text-white"
                  style="border-radius: 20px"
                >
                  Acceso a la web
                </p>
                <form action="" method="post"> 
                  <div class="mb-3 row justify-content-center">
                    <label
                      for=""
                      class="col-sm-1 col-md-3 col-form-label"
                      >Rut:</label
                    >
                    <div class="col col-md-6">
                      <input
                        type="text"
                        class="form-control"
                        name="rut"
                        id="rut"
                        placeholder="Ingrese Rut:"
                      />
                        <div class="text-danger" style="font-size:0.8em">
                            Sin puntos, ni guión
                        </div>
                    </div>
                  </div>
                  <div class="mb-3 row justify-content-center">
                    <label
                      for=""
                      class="col-sm-4 col-md-3 col-form-label"
                      >Clave:</label
                    >
                    <div class="col col-md-6">
                      <input
                        type="password"
                        class="form-control"
                        name="clave"
                        id="pass"
                        placeholder="Clave de usuario"
                      />
                    </div>
                  </div>
                  <div class="mb-3 row justify-content-center">
                    <div class="col col-md-8 text-center">
                      <div
                        class="btn-group"
                        role="group"
                        aria-label="Button group name"
                      >
                        <a href="#" id="acceso"
                          ><button
                            type="submit"
                            class="btn btn-primary m-1"
                          >
                            Ingresar
                          </button></a
                        >
                      </div>
                      <div class="alert alert-light" role="alert">
                      <?php echo $message; ?>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="mt-0 fixed-bottom bg-dark py-1">
    <!-- place footer here -->
    <div class="container">
    <div class="row justify-content-around">
      <div class="col-12 col-md-5 text-center footer-col">
        <!-- <img src="<?php echo $empresa[3];?>" class="logo_footer" alt=""> -->
        <span class="text-warning fw-bold" style="font-size:0.8em;"><?php echo $empresa[1];?></span>
      </div>
      <div class="col-12 col-md-5 text-center my-auto footer-col">
        <h6 class="text-white text-center" style="font-size:0.8em;">Copyrigth 2023 - <span class="text-success fw-bold"> by <span class="text-warning">DXA Solutions</span> </span></h6>
      </div>
    </div>
    </div>
  </footer>
    <!-- Bootstrap JavaScript Libraries -->       
    
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
      integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>