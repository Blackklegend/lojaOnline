<?php 
  include('../php/config.php');

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $lgnAds = "location.href='../php/logout.php'";
    $btnTxt = "Logout";
  } else {
    $lgnAds = "location.href='../login'";
    $btnTxt = "Login";
  }
  $total = 0;

  $request_method = strtoupper(getenv('REQUEST_METHOD'));
  
  if($request_method == 'POST'){
      $toppop = $_POST['toppop'];
      $toPop = array_search($toppop, $_SESSION['cart']);
      if(isset($toPop))
        unset($_SESSION['cart'][$toPop]);
  }
?>
<!DOCTYPE html>
<html class="h-100" lang="pt-br">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Mortam</title>
      <link rel="icon" type="image/png" href="../assets/favicon.png">
      <!--* Injecting CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/bootstrap-utilities.min.css" rel="stylesheet">
        <link href="../assets/css/ecm.css" rel="stylesheet">
      <!--* Injecting JS scripts-->
        <!--** Style JS scripts -->
          <script src="../assets/js/bootstrap.bundle.min.js"></script>
          <script src="https://kit.fontawesome.com/c53fad1440.js" crossorigin="anonymous"></script>
          <script>
            function submit() {
              $("form").submit();
            }
          </script>
    </head>
    
    <body class="d-flex flex-column h-100 text-dark">
      <!--! Declaration of the main content -->
      <main class="flex-shrink-0">
        <!--* Navbar -->
        <nav class="navbar navbar-expand-lg green-background">
          <div class="container-fluid shadow">
            <a class="navbar-brand" href="../"><img src="../assets/favicon.png" style="max-width: 50px; border-radius: 10px" class="ms-3"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>
            <!--* navbar items -->
            <form class="collapse navbar-collapse" id="navbarSupportedContent" action="../produtos/index.php" method="GET">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link text-light george fs-5 lh-lg" aria-current="page" href="../">Início</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-light george fs-5 lh-lg" href="../produtos?category=Todos">Produtos</a>
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
            <form class="ms-1 btn-group container-fluid" action="../produtos/pesquisa.php" method="GET">
              <input 
                class="form-control border-0 louis d-inline rounded-0 rounded-start " 
                name="search" 
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" 
                type="search" placeholder="Pesquisar" aria-label="Search">
              <button 
                class="btn search-btn fw-light text-dark border-0 bg-white" 
                type="submit">
                  <i class="fas fa-search"></i>
              </button>
            </form>
            <div class="col-1 ms-1 btn-group mt-n1 mb-2 pt-2 container-fluid pe-2 btn-fix">
              <button class="btn btn-primary float-end george fw-bolder" onclick="<?php echo $lgnAds?>"><?php echo $btnTxt ?></button>
            </div> 
          </div>
        </nav>  <!--! Navbar end, content start -->
        <div class="container-sm mt-5 p-3">
          <h1 class="text-dark george fw-light border-bottom border-light w-75">Carrinho</h1>
          <div class="my-3">&nbsp;</div> <!--? Espaçador -->
          <div class="container-sm row mt-3"> <!--* Itens do carrinho -->
            <div class="col-sm-9 ">
              <div class="my-3">&nbsp;</div> <!--? Espaçador -->
              <div class="my-2">&nbsp;</div> <!--? Espaçador -->
              <div class="shadow-lg" id="cart"> <!--! Itens do carrinho -->
                <?php
                  if(empty($_SESSION['cart'])) {
                    echo '<p class="george pt-3 fs-5 cart-container text-center">Nenhum produto no carrinho</p>';
                  }
                  else {
                    foreach ($_SESSION['cart'] as $value) {
                      $ctsql = "SELECT * FROM produtos WHERE ID = '$value'";
                      $ser=$link->query($ctsql);
                      while($row=$ser->fetch_assoc()){
                        echo '
                          <div class="row p-3">
                            <img class="col-sm-2" src="'.$row['imagePath'].'">
                            <a class="d-inline col-sm-7 text-decoration-none" href="../produto.php?produto='.$row['ID'].'">
                              <p class="d-inline louis fs-4 mt-3 fw-bold">'.$row['nome'].'</p>
                            </a>
                            <div class="d-inline louis fs-5 col-sm-3 mt-5">
                              <form method="post" class="d-inline" onclick="submit()">
                                <i class="fas fa-minus-circle"></i>
                                <input type="hidden" name=toppop value='.$row['ID'].'>
                              </form>
                              <p class="d-inline ps-5">R$ '.$row['preco'].'</p>
                            </div>
                          </div>';
                      }
                    }
                  }
                ?>
                </div> <!--! Fim dos itens do carrinho -->
              <div class="my-3">&nbsp;</div> <!--? Espaçador -->
            </div>
            <div class="col-sm-3"> <!--* Fim dos itens; Começo Finalização -->
              <h3 class="george text-dark container-fluid pe-0 float-end text-end">Resumo</h3>
              <div class="ms-3 border-bottom border-light p-0 pt-4">
                <?php
                  if(isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $value) {
                      $ctsql = "SELECT * FROM produtos WHERE ID = '$value'";
                      $ser=$link->query($ctsql);
                      while($row=$ser->fetch_assoc()){
                        $total = $total + (float)$row['preco'];
                      }
                    }
                  }
                  echo'
                    <h5 class="float-start me-3">Total: </h5><h5 class="float-end">R$ '.strval($total).'</h5>
                    <h6>&nbsp;</h6>';
                ?>
              </div>
              <div class="">&nbsp;</div> <!--? Espaçador -->
              <button class="ms-3 w-fix-chromium w-fix-firefox btn btn-outline-secondary float-end container-fluid george fs-5 fw-bold text-dark">Comprar</button> 
            </div>
          </div>
        </div>
      </main> <!--! Fim do conteúdo -->
      <footer class="footer mt-auto py-3 green-background">
        <div class="container text-center">
          <span class="text-light text-center">Informações da loja.</span>
        </div>
      </footer>
  </body>
</html> 