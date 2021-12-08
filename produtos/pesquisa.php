<?php 
  include('../php/config.php');
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $lgnAds = "location.href='../php/logout.php'";
    $btnTxt = "Logout";
  } else {
    $lgnAds = "location.href='../login'";
    $btnTxt = "Login";
  }
?>

<!DOCTYPE html>
<html class="h-100" lang="pt-br">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Mortam - Pesquisa</title>
      <link rel="icon" type="image/png" href="/assets/favicon.png">
      <!--* Injecting CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/bootstrap-utilities.min.css" rel="stylesheet">
        <link href="../assets/css/ecm.css" rel="stylesheet">
      <!--* Injecting JS scripts-->
        <!--** Style JS scripts -->
          <script src="./assets/js/bootstrap.bundle.min.js"></script>
          <script src="https://kit.fontawesome.com/c53fad1440.js" crossorigin="anonymous"></script>
    </head>
    
    <body class="d-flex flex-column h-100 text-dark">
      <!--! Declaration of the main content -->
      <main class="flex-shrink-0">
        <!--* Navbar -->
        <nav class="navbar navbar-expand-lg green-background">
          <div class="container-fluid shadow">
            <a class="navbar-brand" href="#"><img src="../assets/favicon.png" style="max-width: 50px; border-radius: 10px" class="ms-3"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>
            <!--* navbar items -->
            <form class="collapse navbar-collapse" id="navbarSupportedContent" method="GET">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link text-light george fs-5 lh-lg" aria-current="page" href="../">Início</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-light george fs-5 lh-lg" href="./index.php?category=Todos">Produtos</a>
                </li>
              </ul> 
            </form>
            <form class="ms-1 btn-group container-fluid" action="" method="GET">
              <input 
                class="form-control border-0 louis d-inline rounded-0 rounded-start " 
                name="search" 
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" 
                type="search" placeholder="Pesquisar" aria-label="Search">
              <button 
                class="btn search-btn fw-light text-dark border-0 bg-white " 
                type="submit">
                  <i class="fas fa-search"></i>
              </button>
            </form>
            <div class="col-1 ms-1 btn-group mt-n1 mb-2 pt-2 container-fluid pe-2 btn-fix">
              <button class="btn btn-primary" onclick="location.href='../carrinho'"><i class="fas fa-shopping-cart"></i></button>
              <button class="btn btn-primary float-end george fw-bolder" onclick="<?php echo $lgnAds?>"><?php echo $btnTxt ?></button>
            </div> 
          </div>
        </nav> 
      <div id="content" class="container-fluid mt-0 flex-shrink-0 px-0">
          <div class="container-sm mt-3">
            <div class="mx-0 row h-100 px-0">
              <div class="col-sm-12 row my-2">
              <?php
                $search_value=$_GET["search"];
                if($search_value == "")
                  $sql="SELECT * FROM produtos";
                else
                  $sql="SELECT * FROM produtos WHERE nome LIKE '%$search_value%'";
                $res=$link->query($sql);
                if($res->num_rows < 1) {
                  echo '<h1 class="text-dark mt-3">Não há produtos para mostrar</h1>';
                } else {
                  while($row=$res->fetch_assoc()){
                    echo '
                      <div class="col-sm-2 p-0 ps-4">
                        <a href="#"><img class="w-100" src="'.$row['imagePath'].'"></a>
                        <div class="fs-5 fw-bold text-success text-center">
                          <a href="#" class="text-decoration-none text-dark">
                            '.$row['nome'].'<p class="text-primary">R$'.$row['preco'].'</p>
                          </a>
                        </div>
                      </div>';
                    }
                  }
                ?>
                </div>
              </div>
            </div>
        </div>
      </div>
      </main>  
      <footer class="footer mt-auto py-3 green-background">
        <div class="container text-center merriweather">
          <span class="text-light text-center">Informações da loja.</span>
        </div>
      </footer>
    </body>
</html>