<?php
// Iniciar sesión
session_start();

// Verificar si ya está logueado
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: editar.php");
    exit();
}

// Conexión a base de datos
require_once('db.php');

// Definir variables
$_nombreUsuario = $_contraseña = "";
$_nombreUsuario_err = $_contraseña_err = $login_err = "";

// Procesar formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validar usuario
    if (empty(trim($_POST["username"]))) {
        $_nombreUsuario_err = "Por favor ingrese su usuario.";
    } else {
        $_nombreUsuario = trim($_POST["username"]);
    }
    
    // Validar contraseña
    if (empty(trim($_POST["password"]))) {
        $_contraseña_err = "Por favor ingrese su contraseña.";
    } else {
        $_contraseña = trim($_POST["password"]);
    }

     // Validar credenciales
    if (empty($_nombreUsuario_err) && empty($_contraseña_err)) {

    // Consulta
    $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";


      if ($stmt = $_conexionDB->prepare($sql)) {

            // Vincular parámetros
            $stmt->bind_param("s", $param_nombreUsuario);
            
            // Establecer parámetros
            $param_nombreUsuario = $_nombreUsuario;

             // Ejecutar
            if ($stmt->execute()) {
                // Guardar resultado    
                $stmt->store_result();
                
                // Verificar usuario
                if ($stmt->num_rows == 1) { 

                    // Vincular variables de resultado
                    $stmt->bind_result($id, $_nombreUsuario, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($_contraseña, $hashed_password)) {
                                           
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $_nombreUsuario;                            
                    
                            header("location: editar.php");
                            exit();
                        } else {
                           
                            $login_err = "Usuario o contraseña incorrectos.";
                        }
                    }
                } else {

                    $login_err = "Usuario o contraseña incorrectos.";
                }
            } else {
                echo "¡Ups! Algo salió mal. Por favor, inténtalo más tarde.";
            }

          $stmt->close();
     }}

    $_conexionDB->close();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
        
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
   <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/componentes.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <main class="login-wrapper">
        <div class="card card-custom">
            <div class="card-title">Iniciar Sesión</div>
            <div class="card-body bg-light">
        <?php 
            if (!empty($login_err)) {
                echo '<div class="alert alert-danger text-center">' . $login_err . '</div>';
                }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" name="username" id="username" class="form-control <?php echo (!empty($_nombreUsuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($_nombreUsuario); ?>">
                    <span class="invalid-feedback"><?php echo $_nombreUsuario_err; ?></span>
                </div>   

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control <?php echo (!empty($_contraseña_err)) ? 'is-invalid' : ''; ?>" >
                    <span class="invalid-feedback"><?php echo $_contraseña_err; ?></span>
                </div>

                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-primary" value="Ingresar">
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>