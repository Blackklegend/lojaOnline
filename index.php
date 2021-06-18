<!DOCTYPE html>
<html class="h-100" lang="pt-br">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Loja Virtual</title>
      <!--* Injecting CSS -->
        <link href="./styles/css/bootstrap.min.css" rel="stylesheet">
        <link href="./styles/css/bootstrap-utilities.min.css" rel="stylesheet">
        <link href="./styles/css/ecm.css" rel="stylesheet">
      <!--* Injecting JS scripts-->
        <!--** Style JS scripts -->
          <script src="./styles/js/bootstrap.bundle.min.js"></script>
          <script src="https://kit.fontawesome.com/c53fad1440.js" crossorigin="anonymous"></script>
        <!--** Functionality scripts -->
          <script src="./js/dynamicListing.js"></script> 
          <?php 
            include("./php/conexao.php")
          ?>
    </head>
    
    <body class="d-flex flex-column h-100 night-mode text-dark">
      <!--! Declaration of the main content -->
      <main class="flex-shrink-0">
        <!--* Navbar -->
        <nav class="navbar navbar-expand-lg green-background">
          <div class="container-fluid shadow">
            <a class="navbar-brand" href="#">logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>
            <!--* navbar items -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link text-light george fs-5 lh-lg" aria-current="page" href="#">Início</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-light george fs-5 lh-lg" href="./produtos">Produtos</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-light george fs-5 lh-lg" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categorias
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Capas</a></li>
                    <li><a class="dropdown-item" href="#">Películas</a></li>
                    <li><a class="dropdown-item" href="#">Fones</a></li>
                    <li><a class="dropdown-item" href="#">Carregadores</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="./produtos/">Todos</a></li>
                  </ul>
                </li>
              </ul> 
              <form class="d-flex">
                <input class="form-control me-2 border-0 louis" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn search-btn fw-light text-light" type="submit"><i class="fas fa-search"></i></button> 
              </form>
            </div>
            <div class="col-md-1 ms-1 btn-group mt-n1 mb-2 pt-2 container-fluid pe-2">
              <button class="btn btn-primary"><i class="fas fa-shopping-cart"></i></button>
              <button class="btn btn-primary float-end george fw-bolder" onclick="location.href ='./login'">Login</button>
            </div> 
          </div>
          
        </nav> 
      <div id="content" class="container-fluid mt-0 flex-shrink-0 px-0"> <!--* Start of the content section -->
        <div id="carouselExampleCaptions" class="carousel slide px-0" data-bs-ride="carousel"> <!--? Carousel section -->
          <div class="carousel-indicators"> <!--? Carousel content -->
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active carousel-item-start">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#555" dy=".3em">First slide</text></svg>
              <div class="carousel-caption d-none d-md-block">
                <h5>Primeira promoção</h5>
                <p>Carrossel com promoções.</p>
              </div>
            </div>
            <div class="carousel-item carousel-item-next carousel-item-start">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text></svg>
              <div class="carousel-caption d-none d-md-block">
                <h5>Segunda promoção</h5>
                <p>Carrossel com promoções.</p>
              </div>
            </div>
            <div class="carousel-item">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Third slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#555"></rect><text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text></svg>
              <div class="carousel-caption d-none d-md-block">
                <h5>Terceira Promoção</h5>
                <p>Carrossel com promoções.</p>
              </div>
            </div>
          </div> <!--? Carrossel Content end, carousel buttons start -->
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div> <!--? Carrossel ends here -->
        <div class="container-sm mt-3"> <!--? Products starts here -->
          <div class="mx-0 row h-100 px-0">
            <div class="col-sm-12 row my-2">
              <div class="col-sm-2 p-0 ps-4"><img class="w-100" src="http://placehold.it/200?text=produto"><div class="fs-5 fw-bold text-success text-center">Preço produto</div></div>
              <div class="col-sm-2 p-0 ps-4"><img class="w-100" src="http://placehold.it/200?text=produto"><div class="fs-5 fw-bold text-success text-center">Preço produto</div></div>
              <div class="col-sm-2 p-0 ps-4"><img class="w-100" src="http://placehold.it/200?text=produto"><div class="fs-5 fw-bold text-success text-center">Preço produto</div></div>
              <div class="col-sm-2 p-0 ps-4"><img class="w-100" src="http://placehold.it/200?text=produto"><div class="fs-5 fw-bold text-success text-center">Preço produto</div></div>
              <div class="col-sm-2 p-0 ps-4"><img class="w-100" src="http://placehold.it/200?text=produto"><div class="fs-5 fw-bold text-success text-center">Preço produto</div></div>
              <div class="col-sm-2 p-0 ps-4"><img class="w-100" src="http://placehold.it/200?text=produto"><div class="fs-5 fw-bold text-success text-center">Preço produto</div></div>
              <div class="col-sm-2 p-0 ps-4"><img class="w-100" src="http://placehold.it/200?text=produto"><div class="fs-5 fw-bold text-success text-center">Preço produto</div></div>
              <div class="col-sm-2 p-0 ps-4"><img class="w-100" src="http://placehold.it/200?text=produto"><div class="fs-5 fw-bold text-success text-center">Preço produto</div></div>
            </div>
          </div>
        </div>
      </div>
      </main>  <!--* Content end, footer start -->
      <footer class="footer mt-auto py-3 green-background">
        <div class="container text-center">
          <span class="text-light text-center">Informações da loja.</span>
        </div>
      </footer>
    </body>
</html>