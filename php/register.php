<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $name = $cpf = $address = $bthDate = "";
$username_err = $password_err = $confirm_password_err = $name_err = $cpf_err = $address_err = $bthDate_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
	// Validate username
	if(empty(trim($_POST["username"]))){
		$username_err = "Por favor insira um email.";
	} elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', trim($_POST["username"]))){
		$username_err = "Por favor insira um email válido.";
	} else{
		// Prepare a select statement
		$sql = "SELECT id FROM users WHERE email = ?";
		
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
					$username_err = "Este email já está cadastrado.";
				} else{
					$username = trim($_POST["username"]);
				}
			} else{
				echo "Oops! Parece que algo deu errado. Tente novamente mais tarde.";
			}

			// Close statement
			mysqli_stmt_close($stmt);
		}
	}
	
	// Validate password
	if(empty(trim($_POST["password"]))){
		$password_err = "Por favor insira uma senha.";     
	} elseif(strlen(trim($_POST["password"])) < 6 || strlen(trim($_POST["password"])) > 40){
		$password_err = "A senha precisa ser maior que 6 caracteres e menor que 40.";
	} else{
		$password = trim($_POST["password"]);
	}
	
	// Validate confirm password
	if(empty(trim($_POST["confirm_password"]))){
		$confirm_password_err = "Por favor confirme sua senha.";     
	} else{
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($password_err) && ($password != $confirm_password)){
			$confirm_password_err = "As senhas não são iguais.";
		}
	}
	// Validate name
	if(empty(trim($_POST["name"]))){
		$name_err = "Por favor insira um nome.";     
	} else{
		$name = trim($_POST["name"]);
	}
	// Validate cpf
	if(empty(trim($_POST["cpf"]))){
		$cpf_err = "Por favor insira um CPF.";     
	} else{
		$cpf = trim($_POST["cpf"]);
	}
	
	// Validate address
	if(empty(trim($_POST["address"]))){
		$address_err = "Por favor insira um endereço.";     
	} else{
		$address = trim($_POST["address"]);
	}

	// Validate bthDate
	if(empty(trim($_POST["bthDate"]))){
		$bthDate_err = "Por favor insira uma data de Nascimento.";     
	} else{
		$bthDate = trim($_POST["bthDate"]);
	}
	// Check input errors before inserting in database
	if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err) && empty($cpf_err) && empty($address_err) && empty($bthDate_err)){
		
		// Prepare an insert statement
		$sql = "INSERT INTO users (email, senha, nome, cpf, endereco, bthDate) VALUES (?, ?, ?, ?, ?, ?)";
		
		if($stmt = mysqli_prepare($link, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_name, $param_cpf, $param_address, $param_bthDate);
			
			// Set parameters
			$param_username = $username;
			$param_name = $name;
			$param_cpf = $cpf; 
			$param_address = $address; 
			$param_bthDate = $bthDate;
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
		<title>Cadastro - Mortam</title>
		<link rel="icon" type="image/png" href="../assets/favicon.png">
		<!--! CSS styling injections -->
			<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
			<link href="../assets/css/bootstrap-utilities.min.css" rel="stylesheet">
			<link href="../assets/css/ecm.css" rel="stylesheet">
		<!--! JS styling injections -->
			<script src="../assets/js/bootstrap.bundle.min.js"></script>
			<script src="https://kit.fontawesome.com/c53fad1440.js" crossorigin="anonymous"></script>
	</head>
	<body class="d-flex flex-column h-100 text-dark"> <!--? Content -->
		<main class="flex-shrink-0"> <!--? Navbar start -->
			<nav class="navbar navbar-expand-lg green-background">
				<div class="container-fluid shadow">
					<a class="navbar-brand" href="../"><img src="../assets/favicon.png" style="max-width: 50px; border-radius: 10px" class="ms-3"></a>
					<a class="nav-link text-light merriweather fs-5 lh-lg float-start" aria-current="page" href="../">Início</a>
					<div class="col-md-1 ms-1 btn-group mt-n1 mb-2 pt-2 pe-2 float-end">
						<button class="btn btn-primary float-end george fw-bolder" onclick="location.href ='../carrinho'"><i class="fas fa-shopping-cart me-2"></i>Carrinho</button>
					</div>
				</div>
			</nav> <!-- ? Navbar end -->
		<!--! Main content start */ -->
			<div id="content" class="container-md mt-0 flex-shrink-0 px-0 text-dark mx-auto mt-4"> 
				<?php 
					if(!empty($login_err)){
						echo '<div class="alert alert-danger h-fc">' . $login_err . '</div>';
					}        
				?>
				<div>
				<h3 class="container-md text-center george top-fix">Cadastre-se</h3>
					<h5 class="container-fluid text-center george">Por favor preencha este formulario para criar uma conta.</h5>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="container-sm row">
						<div class="form-group m-auto col-md-4"> <!--! Email input div -->
							<h6 class="container-fluid george p-0 mt-5 mb-fix">Email</h6>
							<input 
								type="text" 
								name="username" 
								class="border-top-0 border-end-0 border-start-0 border-bottom-1 border-black fs-4 rounded-0 form-control shadow-none george fs-5
									<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" 
								value="<?php echo $username; ?>"
								>
							<span class="invalid-feedback"><?php echo $username_err; ?></span>
						</div>    
						<div class="form-group m-auto col-md-4"> <!-- Name input div -->
							<h6 class="container-fluid george p-0 mt-5 mb-fix">Nome completo</h6>
							<input 
								type="text" 
								name="name" 
								class="border-top-0 border-end-0 border-start-0 border-bottom-1 border-black fs-4 rounded-0 form-control shadow-none george fs-5
									<?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" 
								value="<?php echo $name; ?>"
								>
							<span class="invalid-feedback"><?php echo $name_err; ?></span>
						</div>    
						<div class="form-group m-auto col-md-4"> <!-- CPF Input div -->
							<h6 class="container-fluid george p-0 mt-5 mb-fix">CPF</h6>
							<input 
								type="text" 
								name="cpf"
								class="border-top-0 border-end-0 border-start-0 border-bottom-1 border-black fs-4 rounded-0 form-control shadow-none george fs-5
									<?php echo (!empty($cpf_err)) ? 'is-invalid' : ''; ?>" 
								value="<?php echo $cpf; ?>"
								>
							<span class="invalid-feedback"><?php echo $cpf_err; ?></span>
						</div>   
						<div class="form-group m-auto col-md-4"> <!-- Endereço Input div -->
							<h6 class="container-fluid george p-0 mt-5 mb-fix">Endereço</h6>
							<input 
								type="text" 
								name="address" 
								class="shadow-none george border-top-0 border-end-0 border-start-0 border-bottom-1 border-black fs-4 rounded-0 form-control george fs-5 
									<?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" 
								value="<?php echo $address; ?>">
							<span class="invalid-feedback"><?php echo $address_err; ?></span>
						</div>
						<div class="form-group m-auto col-md-4"> <!-- Senha Input div -->
							<h6 class="container-fluid george p-0 mt-5 mb-fix">Senha</h6>
							<input 
								type="password" 
								name="password" 
								class="shadow-none border-top-0 border-end-0 border-start-0 border-bottom-1 border-black fs-4 rounded-0 form-control george fs-5 
									<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" 
								value="<?php echo $password; ?>">
							<span class="invalid-feedback"><?php echo $password_err; ?></span>
						</div>
						<div class="form-group m-auto col-md-4">
							<h6 class="container-fluid george p-0 mt-5 mb-fix">Confirme a senha</h6>
							<input 
								type="password" 
								name="confirm_password" 
								class="shadow-none border-top-0 border-end-0 border-start-0 border-bottom-1 border-black fs-4 rounded-0 form-control george fs-5 
									<?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" 
								value="<?php echo $confirm_password; ?>">
							<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
						</div>
						<div class="form-group m-auto col-md-4"> <!-- Nascimento Input div -->
							<h6 class="container-fluid george p-0 mt-5 mb-fix">Data de Nascimento</h6>
							<input 
								type="date" 
								data-date-format="dd-mm-yyyy"
								name="bthDate" 
								max="<?php echo "".date('Y-m-d', strtotime('-18 years'));?>"
								min="<?php echo "".date('Y-m-d', strtotime('-90 years'));?>"
								class="shadow-none border-top-0 border-end-0 border-start-0 border-bottom-1 border-black fs-4 rounded-0 form-control george fs-5 p-0 
									<?php echo (!empty($bthDate_err)) ? 'is-invalid' : ''; ?>" 
								value="<?php echo $bthDate; ?>">
							<span class="invalid-feedback"><?php echo $bthDate_err; ?></span>
						</div>
						<div class="form-group text-center george  m-auto mt-5">
							<input type="submit" class="btn btn-primary" value="Submit">
							<input type="reset" class="btn btn-secondary ml-2" value="Reset">
						</div>
						<p class="george pt-2 text-center mt-2">Já possui uma conta? <a href="../login">Faça login</a>.</p>
					</form> 
				</div>
			</div>
		</main> 
		<!--! Content ends here -->
		<footer class="footer mt-auto py-3 green-background mb-0">
			<div class="container text-center merriweather">
				<span class="text-light text-center">Informações da loja.</span>
			</div>
		</footer>
	</body>
</html>