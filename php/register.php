<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: ../login");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
        <title>Login</title>
        <!--! CSS styling injections -->
            <link href="../styles/css/bootstrap.min.css" rel="stylesheet">
            <link href="../styles/css/bootstrap-utilities.min.css" rel="stylesheet">
            <link href="../styles/css/ecm.css" rel="stylesheet">
        <!--! JS styling injections -->
            <script src="../styles/js/bootstrap.bundle.min.js"></script>
            <script src="https://kit.fontawesome.com/c53fad1440.js" crossorigin="anonymous"></script>
    </head>
    <body class="d-flex flex-column h-100 night-mode text-dark"> <!--? Content -->
          <main class="flex-shrink-0"> <!--? Navbar start -->
            <nav class="navbar navbar-expand-lg green-background">
                <div class="container-fluid shadow">
                    <a class="navbar-brand" href="#">logo</a>
                    <a class="nav-link text-light merriweather fs-5 lh-lg float-start" aria-current="page" href="../">Início</a>
                    <div class="col-md-1 ms-1 btn-group mt-n1 mb-2 pt-2 pe-2 float-end">
                        <button class="btn btn-primary float-end george fw-bolder" onclick="location.href ='../carrinho'"><i class="fas fa-shopping-cart me-2"></i>Carrinho</button>
                    </div>
                </div>
            </nav> <!--? Navbar end -->
        <!--! Main content start -->
            <div id="content" class="container-md mt-0 flex-shrink-0 px-0 text-light mx-auto mt-4"> 
                <?php 
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger h-fc">' . $login_err . '</div>';
                    }        
                ?>
                <div class="login-container">
                <h3 class="container-fluid text-center george top-fix">Cadastre-se</h3>
                    <h5 class="container-fluid text-center george">Por favor preencha este formulario para criar uma conta.</h5>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-container">
                        <div class="form-group m-auto w-fix">
                            <h6 class="container-fluid george p-0 mt-5 mb-fix">Email</h6>
                            <input type="text" name="username" class="border-top-0 border-end-0 border-start-0 border-bottom-1 border-white night-mode text-light fs-4 rounded-0 form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>    
                        <div class="form-group m-auto w-fix">
                            <h6 class="container-fluid george p-0 mt-5 mb-fix">Senha</h6>
                            <input type="password" name="password" class="border-top-0 border-end-0 border-start-0 border-bottom-1 border-white night-mode text-light fs-4 rounded-0 form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group m-auto w-fix">
                            <h6 class="container-fluid george p-0 mt-5 mb-fix">Confirme a senha</h6>
                            <input type="password" name="confirm_password" class="border-top-0 border-end-0 border-start-0 border-bottom-1 border-white night-mode text-light fs-4 rounded-0 form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group text-center george w-fix m-auto mt-4">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                        </div>
                        <p class="george pt-2 text-center">Já possui uma conta? <a href="../login">Faça login</a>.</p>
                    </form>
                </div>
            </div>
          </main> 
        <!--! Content ends here -->
        <footer class="footer mt-auto py-3 green-background">
            <div class="container text-center merriweather">
                <span class="text-dark text-center">Informações da loja.</span>
            </div>
        </footer>
    </body>
</html>