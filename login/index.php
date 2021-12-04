<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../");
    exit;
}
 
// Include config file
require_once "../php/config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
$request_method = strtoupper(getenv('REQUEST_METHOD'));
if($request_method == 'POST'){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor insira o email.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor insira a senha.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, senha FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: ../");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Senha errada.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Email inválido.";
                }
            } else{
                echo "Oops! Algo deu errado, tente novamente mais tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html class="h-100" lang="pt-br">
    <head>
        <meta charset="utf-8"> <!--* Site information -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Mortam</title>
        <link rel="icon" type="image/png" href="/assets/favicon.png">
        <!--! CSS styling injections -->
            <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="../assets/css/bootstrap-utilities.min.css" rel="stylesheet">
            <link href="../assets/css/ecm.css" rel="stylesheet">
        <!--! JS styling injections -->
            <script src="../assets/js/bootstrap.bundle.min.js"></script>
            <script src="https://kit.fontawesome.com/c53fad1440.js" crossorigin="anonymous"></script>
    </head>
    <body class="d-flex flex-column h-100 night-mode"> <!--? Content -->
          <main class="flex-shrink-0"> <!--? Navbar start -->
            <nav class="navbar navbar-expand-lg green-background">
                <div class="container-fluid shadow">
                    <a class="navbar-brand" href="../"><img src="../assets/favicon.png" style="max-width: 50px; border-radius: 10px" class="ms-3"></a>
                    <a class="nav-link text-white merriweather fs-5 lh-lg float-start" aria-current="page" href="../">Início</a>
                    <div class="col-md-1 ms-1 btn-group mt-n1 mb-2 pt-2 pe-2 float-end">
                        <button class="btn btn-primary float-end george fw-bolder" onclick="location.href ='../carrinho'"><i class="fas fa-shopping-cart me-2"></i>Carrinho</button>
                    </div>
                </div>
            </nav> <!--? Navbar end -->
        <!--! Main content start -->
            <div id="content" class="container-md mt-0 flex-shrink-0 px-0 text-dark mx-auto mt-4"> 
                <?php 
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger h-fc">' . $login_err . '</div>';
                    }        
                ?>
                <div class="row login-container mx-0">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="shadow-md p-4 col-sm-6 d-flex row mx-auto"> <!--? Login container -->
                        <div class="d-flex align-self-center mx-auto row form-group">
                            <h3 class="container-fluid px-0 george text-left">E-mail</h3>
                            <input type="text" name="username" class="border-top-0 border-end-0 border-start-0 border-bottom-1 border-black night-mode text-dark fs-4 <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="endereço@dominio.com">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="d-flex row h-fc mx-auto form-group">
                            <h3 class="container-fluid px-0 george text-left">Senha</h3>
                            <input type="password" name="password" class="border-top-0 border-end-0 border-start-0 border-bottom-1 border-black night-mode text-dark fs-4 <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            <input type="submit" class="btn btn-success h-fc george fs-2 mt-2 shadow-sm w-50 m-auto mt-2" value="Login">
                        </div> <!--? Login end -->
                    </form>
                    <div class="col-sm-6 d-flex justify-content-center align-self-center btn-group btn-group-vertical h-fc"> <!--? Sign up start -->
                        <h3 class="align-self-center text-center h-fc d-inline-block george border-bottom border-black pb-2">Ainda não é cadastrado?</h3>
                        <button class="m-auto w-50 btn btn-primary fs-2 george rounded-3" onclick="location.href='../php/register.php'">Cadastre-se</button>
                    </div>
                </div class="row">
            </div>
          </main> 
        <!--! Content ends here -->
        <footer class="footer mt-auto py-3 green-background">
            <div class="container text-center merriweather">
                <span class="text-white text-center">Informações da loja.</span>
            </div>
        </footer>
    </body>
</html>