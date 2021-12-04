<?php 
  include('./php/config.php');
  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $lgnAds = "location.href='./php/logout.php'";
    $btnTxt = "Logout";
  } else {
    $lgnAds = "location.href='./login'";
    $btnTxt = "Login";
  }

  $id=$_GET["produto"];
  $request_method = strtoupper(getenv('REQUEST_METHOD'));
  if($request_method == 'POST'){
    session_start();
    array_push($_SESSION["cart"], $id);
    header("location: ./carrinho");
  }
?>

<!DOCTYPE html>
<html class="h-100" lang="pt-br">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Mortam</title>
      <link rel="icon" type="image/png" href="/assets/favicon.png">
      <!--* Injecting CSS -->
        <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="./assets/css/bootstrap-utilities.min.css" rel="stylesheet">
        <link href="./assets/css/ecm.css" rel="stylesheet">
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
            <a class="navbar-brand" href="#"><img src="./assets/favicon.png" style="max-width: 50px; border-radius: 10px" class="ms-3"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>
            <!--* navbar items -->
            <form class="collapse navbar-collapse" id="navbarSupportedContent" action="./produtos/index.php" method="GET">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link text-light george fs-5 lh-lg" aria-current="page" href="./index.php">Início</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-light george fs-5 lh-lg" href="./produtos">Produtos</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-light george fs-5 lh-lg" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categorias
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                    <li><input type="submit" name="category" value="Capas" class="dropdown-item"></li>
                    <li><input type="submit" name="category" value="Películas" class="dropdown-item"></li>
                    <li><input type="submit" name="category" value="Fones" class="dropdown-item"></li>
                    <li><input type="submit" name="category" value="Carregadores" class="dropdown-item"></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><input type="submit" name="category" value="Todos" class="dropdown-item"></li>
                  </ul>
                </li>
              </ul> 
            </form>
            <form class="ms-1 btn-group container-fluid" action="./produtos/pesquisa.php" method="GET">
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
              <button class="btn btn-primary" onclick="location.href='./carrinho'"><i class="fas fa-shopping-cart"></i></button>
              <button class="btn btn-primary float-end george fw-bolder" onclick="<?php echo $lgnAds?>"><?php echo $btnTxt ?></button>
            </div> 
          </div>
        </nav> 
        <div id="content" class="container-fluid mt-0 flex-shrink-0">
          <div class="container mt-3">
            <div class="border row mb-5">
            <?php 
                $id=$_GET["produto"];
                $ctsql = "SELECT * FROM produtos WHERE ID = '$id'";
                $ser=$link->query($ctsql);
                while($row=$ser->fetch_assoc()){
                  echo '
                    <div class="col-md-6 text-center">
                      <img src="'.$row['imagePath'].'" class="w-75">
                    </div>
                
                    <div class="row col-md-6">
                      <div class="col-md-12 mt-2">
                        <div class="fw-bold fs-2 mt-3 ms-3">'.$row['nome'].'</div>
                      </div>
                      <div class="col-lg-12 mx-3 mt-3 fs-4">
                        R$ '.$row['preco'].'
                      </div>
                      <div class="col-md-12 mt-2"></div>
                      <form method="post">
                        <input type="submit" Value="Comprar"class="btn btn-outline-warning float-end ms-3 fs-4 text-dark george fw-bolder w-100">
                      </form>
                      <div class="col-md-12 mt-2"></div><div class="col-md-12 mt-2"></div>
                    </div>
                  </div>
                  <div class="border row mb-5">
                    <h1 class="fs-3 fw-bold louis">Descrição</h1>
                    <h5 class="george ps-4 mt-2">'.$row['descricao'].'</h5>
                  </div>
                  ';
              }
            ?>
          </div>
        </div>
    </main>  
    <footer class="footer mt-auto py-3 green-background">
      <div class="container text-center">
        <span class="text-light text-center merriweather">Informações da loja.</span>
      </div>
    </footer>
  </body>
</html>