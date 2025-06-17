
<?php

// Conexion a la base de datos
require_once('db.php');

// Consulta para obtener los datos del CV
$sql = "SELECT * FROM datos WHERE id = 1";
$result = $_conexionDB->query($sql);
$_SQLdatos = $result->fetch_assoc();

// Consulta para obtener experiencias laborales
$_sentenciaSQL_exp = "SELECT * FROM experiencia";
$_SQLexperiencias = $_conexionDB->query($_sentenciaSQL_exp);

// Consulta para obtener educación
$_sentenciaSQL_edu = "SELECT * FROM educacion";
$_SQLeducacion = $_conexionDB->query($_sentenciaSQL_edu);

// Consulta para obtener habilidades
$_sentenciaSQL_hab = "SELECT * FROM habilidades";
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
     <?php
    require_once('header.php');
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                </div>
                <div class="col-lg-10 colum">
                    <div class="row">
                        <div class="col-lg-3 container_aside">
                            <div class="imagen_persona">
                                <img src="<?php echo $_SQLdatos['foto']; ?>" alt="Foto de perfil" class="img-fluid rounded-circle perfil-img">
                            </div>
                            <div>
                                <h3> <?php echo $_SQLdatos['nombre'] ." ". $_SQLdatos['apellido'] ?> </h3>
                            </div>
                           <div class="conteiner_datos">
                               <p class="mb-1 text-muted"><i class="bi bi-envelope"></i> <?php echo $_SQLdatos['correo']; ?></p>
                                <p class="mb-1 text-muted"><i class="bi bi-telephone"></i> <?php echo $_SQLdatos['celular']; ?></p>
                                <p class="mb-0 text-muted"><i class="bi bi-geo-alt"></i> <?php echo $_SQLdatos['calle'] . " " . $_SQLdatos['numero'] . ", " . $_SQLdatos['localidad']; ?></p>
                            </div>
                        </div>

                        <!--Experiencia -->
                        <div class="col-lg-9 columna">
                            <div class="container_seccion" id="experiencia">
                                                <h3 class="titulo-seccion">Experiencia laboral</h3>
                                <div class="">
                                    <?php while ($_exp = $_SQLexperiencias->fetch_assoc()): ?>


                                        <div class="card m-4 tarjeta">
                                            <div class="card-header text-center">
                                                <h5 class="card-title titulo1"><?php echo $_exp['empresa']; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <h5 class="text-body-secondary titulo2">Puesto: </h5>
                                                    <p class="card-text"><?php echo $_exp['puesto']; ?></p>
                                                </div>
                                                <div>
                                                    <h5 class="text-body-secondary titulo2">Tecnologias: </h5>
                                                    <p class="card-text"><?php echo $_exp['herramientas']; ?></p>
                                                </div>
                                                <div>
                                                    <h5 class="text-body-secondary titulo2">Descripcion: </h5>
                                                    <p class="card-text"><?php echo $_exp['descripcion']; ?></p>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                                        Editar
                                                    </button>

                                                    <!--ventana modal Editar Experiencia-->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Editar experiencia
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!--Trae el formulario cargado con los datos para editar-->
                                                                    <form>
                                                                        <div class="mb-3">
                                                                            <label for="recipient-name" class="col-form-label">Empresa</label>
                                                                            <input type="text" class="form-control" id="recipient-name" maxlength="50"
                                                                                value="<?php echo $_exp['empresa']; ?>" />
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="message-text" class="col-form-label">Puesto</label>
                                                                            <input type="text" class="form-control" id="recipient-name" maxlength="50"
                                                                                value="<?php echo $_exp['puesto']; ?>" />
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="message-text" class="col-form-label">Tecnologias</label>
                                                                            <input class="form-control" id="message-text" maxlength="80"
                                                                                value="<?php echo $_exp['herramientas']; ?>"></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="message-text" class="col-form-label">Descripcion</label>
                                                                            <input class="form-control" id="message-text" maxlength="80"
                                                                                value="<?php echo $_exp['descripcion']; ?>"></textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="recipient-name" class="col-form-label">Duracion</label>
                                                                            <input type="text" class="form-control" id="recipient-name" maxlength="20"
                                                                                value="<?php echo $_exp['duracion']; ?>" />
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                        Cancelar
                                                                    </button>
                                                                    <button type="button" class="btn btn-success boton" data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal3">
                                                                        Editar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="btn btn-danger boton" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal2">
                                                        Eliminar
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-footer text-body-secondary text-center">
                                                <?php echo $_exp['duracion']; ?>
                                            </div>
                                        </div>



                                    <?php endwhile; ?>
                                </div>
                            </div>
                            <div class="container_seccion" id="habilidades">
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
                                                    <h5 class="card-title text-body-secondary titulo2">Descripcion: </h5>
                                                    <p class="card-text"><?php echo $_hab['descripcion']; ?></p>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                                        Editar
                                                    </button>
                                                    <button type="button" class="btn btn-danger boton" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal2">
                                                        Eliminar
                                                    </button>
                                                </div>

                                            </div>
                                        </div>


                                    <?php endwhile; ?>
                                </div>
                            </div>
                            <div class="container_seccion" id="educacion">
                                <h3 class="titulo-seccion">Educación</h3>
                                <div class="">
                                    <?php while ($_edu = $_SQLeducacion->fetch_assoc()): ?>


                                        <div class="card m-4 tarjeta">
                                            <div class="card-header text-center">
                                                <h5 class="card-title titulo1"><?php echo $_edu['certificacion']; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <h5 class="card-title text-body-secondary titulo2">Institucion: </h5>
                                                    <p class="card-text"><?php echo $_edu['institucion']; ?></p>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                                        Editar
                                                    </button>
                                                    <button type="button" class="btn btn-danger boton" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal2">
                                                        Eliminar
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="card-footer text-body-secondary text-center">
                                                <?php echo $_edu['duracion']; ?>
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



        <!--ventana modal eliminar-->
        <section>
            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Eliminar
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estas seguro que deseas eliminar esta experiencia?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="button" class="btn btn-danger boton" data-bs-toggle="modal"
                                data-bs-target="#exampleModal4">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--ventana modal confirmacion de editado-->
        <section>
            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Experiencia editada
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Su experiencia se edito exitosamente!!!!
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-primary" id="btn-ok-modal" data-bs-dismiss="modal">OK</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--ventana modal confirmacion de eliminado-->
        <section>
            <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Experiencia eliminada
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Su experiencia se elimino exitosamente!!!!
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-primary" id="btn-ok-modal" data-bs-dismiss="modal">OK</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

             <!-- Modal de Confirmación para Cerrar Sesión -->
        <div class ="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" >
                        <h5 class="modal-title" id="logoutModalLabel">Cerrar sesión</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body ">¿Estás seguro de que deseas cerrar sesión?</div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
                    </div>
               </div>
            </div>
        </div>  
    </main>


    </main>

    <footer>

    </footer>












    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>










</body>



</html>