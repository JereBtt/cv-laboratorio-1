<?php
// Conexion a la base de datos
require_once('db.php');

// Funcion para ver si las tablas existes si no las crea con datos por defecto
function verificarYCrear($_conexionDB)
{
    // Verificamos si existe la tabla 
    $result = $_conexionDB->query("SHOW TABLES LIKE 'datos'");
    if ($result->num_rows == 0) {
        // Crear tabla datos
        $_sentenciaSQL = "CREATE TABLE datos (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(255) NOT NULL DEFAULT 'Tu Nombre',
            puesto VARCHAR(255) NOT NULL DEFAULT 'Tu Puesto',
            perfil TEXT NOT NULL DEFAULT 'Describe tu perfil profesional aquí',
            foto VARCHAR(255) DEFAULT 'https://via.placeholder.com/200x200',
            email VARCHAR(255) NOT NULL DEFAULT 'tu@email.com',
            telefono VARCHAR(50) DEFAULT '+54 XXX XXX XXXX',
            ubicacion VARCHAR(255) DEFAULT 'Tu Ciudad, Argentina',
            publicaciones TEXT,
            logros TEXT,
            docencia TEXT,
            mostrar_publicaciones TINYINT(1) DEFAULT 0,
            mostrar_logros TINYINT(1) DEFAULT 0,
            mostrar_docencia TINYINT(1) DEFAULT 0
        )";
        $_conexionDB->query($_sentenciaSQL);

        // Insertar datos por defecto

        $_conexionDB->query("INSERT INTO datos (id) VALUES (1)");
    }

    // Verificar si existe la tabla experiencia
    $result = $_conexionDB->query("SHOW TABLES LIKE 'experiencia'");
    if ($result->num_rows == 0) {
        $_sentenciaSQL = "CREATE TABLE experiencia (
            id INT PRIMARY KEY AUTO_INCREMENT,
            empresa VARCHAR(255) NOT NULL,
            puesto VARCHAR(255) NOT NULL,
            fecha_inicio VARCHAR(50) NOT NULL,
            fecha_fin VARCHAR(50) NOT NULL,
            proyecto VARCHAR(255) NOT NULL,
            tecnologias TEXT,
            descripcion TEXT NOT NULL
        )";
        $_conexionDB->query($_sentenciaSQL);
    }

    // Verificar si existe la tabla educacion
    $result = $_conexionDB->query("SHOW TABLES LIKE 'educacion'");
    if ($result->num_rows == 0) {
        $_sentenciaSQL = "CREATE TABLE educacion (
            id INT PRIMARY KEY AUTO_INCREMENT,
            institucion VARCHAR(255) NOT NULL,
            titulo VARCHAR(255) NOT NULL,
            fecha_inicio VARCHAR(50) NOT NULL,
            fecha_fin VARCHAR(50) NOT NULL,
            descripcion TEXT
        )";
        $_conexionDB->query($_sentenciaSQL);
    }

    // Verificar si existe la tabla habilidades
    $result = $_conexionDB->query("SHOW TABLES LIKE 'habilidades'");
    if ($result->num_rows == 0) {
        $_sentenciaSQL = "CREATE TABLE habilidades (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(255) NOT NULL,
            nivel INT NOT NULL CHECK (nivel >= 0 AND nivel <= 100)
        )";
        $_conexionDB->query($_sentenciaSQL);
    }

    // Verificar si existe la tabla usuarios
    $result = $_conexionDB->query("SHOW TABLES LIKE 'usuarios'");
    if ($result->num_rows == 0) {
        $_sentenciaSQL = "CREATE TABLE usuarios (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL
        )";
        $_conexionDB->query($_sentenciaSQL);

        // Crear usuario por defecto: admin / admin123
        $password_hash = password_hash('admin123', PASSWORD_DEFAULT);
        $_conexionDB->query("INSERT INTO usuarios (username, password) VALUES ('admin', '$password_hash')");
    }
}
// Llamamos a la funcion verificar y crear tablas si no existe
verificarYCrear($_conexionDB);

// Consulta para obtener los datos del CV
$sql = "SELECT * FROM datos WHERE id = 1";
$result = $_conexionDB->query($sql);

if (!$result) {
    die("Error en la consulta: " . $_conexionDB->error);
}


$_SQLdatos = $result->fetch_assoc();
if (!$_SQLdatos) {
    // Si no existe el registro, crearlo
    $_conexionDB->query("INSERT INTO datos (id) VALUES (1)");
    $result = $_conexionDB->query($sql);
    $_SQLdatos = $result->fetch_assoc();
}

// Consulta para obtener experiencias laborales
$_sentenciaSQL_exp = "SELECT * FROM experiencia ORDER BY fecha_fin DESC";
$_SQLexperiencias = $_conexionDB->query($_sentenciaSQL_exp);

// Consulta para obtener educación
$_sentenciaSQL_edu = "SELECT * FROM educacion ORDER BY fecha_fin DESC";
$_SQLeducacion = $_conexionDB->query($_sentenciaSQL_edu);

// Consulta para obtener habilidades
$_sentenciaSQL_hab = "SELECT * FROM habilidades ORDER BY nivel DESC";
$_SQLhabilidades = $_conexionDB->query($_sentenciaSQL_hab);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CV -<?php echo $_SQLdatos['nombre']; ?> </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/componentes.css">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-print-none">
            <div class="container">
                <a class="navbar-brand" href="index.php">CVC</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">
                                <i class="fas fa-user-lock"></i> Admin
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                </div>
                <div class="col-lg-10 colum">
                    <div class="row contenido">
                        <div class="col-lg-2">
                            <div class="imagen_persona">
                                <img src="<?php echo $_SQLdatos['foto']; ?>" alt="Foto de perfil" class="img-fluid rounded-circle perfil-img">
                            </div>
                            <div>
                                <h3> <?php echo $_SQLdatos['nombre'] ?> </h3>
                            </div>
                            <div class="conteiner_datos">
                                <p><?php echo $_SQLdatos['puesto'] ?></p>
                                <p><?php echo $_SQLdatos['email'] ?></p>
                                <p><?php echo $_SQLdatos['telefono'] ?></p>
                                <p><?php echo $_SQLdatos['ubicacion'] ?></p>
                                <h5>Perfil profecional</h5>
                                <p><?php echo $_SQLdatos['perfil'] ?></p>
                            </div>
                        </div>
                        <div class="col-lg-10 columna">
                            <div class="container_seccion">
                                <h3 class="titulo-seccion">Experiencia laboral</h3>
                                <div class="">
                                    <?php while ($_exp = $_SQLexperiencias->fetch_assoc()): ?>


                                        <div class="card m-4 tarjeta">
                                            <div class="card-header text-center">
                                                <h5 class="card-title titulo1"><?php echo $_exp['empresa']; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <h5 class="card-title text-body-secondary titulo2">Puesto: </h5>
                                                    <p class="card-text"><?php echo $_exp['puesto']; ?></p>
                                                </div>
                                                <div>
                                                    <h5 class="card-title text-body-secondary titulo2">Proyecto: </h5>
                                                    <p class="card-text"><?php echo $_exp['proyecto']; ?></p>
                                                </div>
                                                <div>
                                                    <h5 class="card-title text-body-secondary titulo2">Tecnologias: </h5>
                                                    <p class="card-text"><?php echo $_exp['tecnologias']; ?></p>
                                                </div>
                                                <div>
                                                    <h5 class="card-title text-body-secondary titulo2">Descripcion: </h5>
                                                    <p class="card-text"><?php echo $_exp['descripcion']; ?></p>
                                                </div>

                                            </div>
                                            <div class="card-footer text-body-secondary text-center">
                                                <?php echo $_exp['fecha_inicio'] . '-' . $_exp['fecha_fin']; ?>
                                            </div>
                                        </div>


                                    <?php endwhile; ?>
                                </div>
                            </div>
                            <div class="container_seccion">
                                <h3 class="titulo-seccion">Habilidades</h3>
                                <div class="">
                                    <?php while ($_hab = $_SQLhabilidades->fetch_assoc()): ?>


                                        <div class="card m-4 tarjeta">
                                            <div class="card-body">
                                                <div>
                                                    <h5 class="card-title text-body-secondary titulo2">Nombre: </h5>
                                                    <p class="card-text"><?php echo $_hab['nombre']; ?></p>
                                                </div>
                                                <div>
                                                    <h5 class="card-title text-body-secondary titulo2">Nivel: </h5>
                                                    <p class="card-text"><?php echo $_hab['nivel']; ?></p>
                                                </div>

                                            </div>
                                        </div>


                                    <?php endwhile; ?>
                                </div>
                            </div>
                            <div class="container_seccion">
                                <h3 class="titulo-seccion">Educación</h3>
                                <div class="">
                                    <?php while ($_edu = $_SQLeducacion->fetch_assoc()): ?>


                                        <div class="card m-4 tarjeta">
                                            <div class="card-header text-center">
                                                <h5 class="card-title titulo1"><?php echo $_edu['titulo']; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <h5 class="card-title text-body-secondary titulo2">Institucion: </h5>
                                                    <p class="card-text"><?php echo $_edu['institucion']; ?></p>
                                                </div>

                                                <div>
                                                    <h5 class="card-title text-body-secondary titulo2">Descripcion: </h5>
                                                    <p class="card-text"><?php echo $_edu['descripcion']; ?></p>
                                                </div>

                                            </div>
                                            <div class="card-footer text-body-secondary text-center">
                                                <?php echo $_edu['fecha_inicio'] . '-' . $_edu['fecha_fin']; ?>
                                            </div>
                                        </div>


                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                </div>
            </div>
        </div>

    </main>

    <footer>

    </footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>