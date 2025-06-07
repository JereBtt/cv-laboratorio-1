<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <header>

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
                                <img src="" alt="Foto del perfil">
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
                                                <div class="text-center">
                                                    <a href="#" class="btn btn-primary">Go somewhere</a>
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
                                                <div class="text-center">
                                                    <a href="#" class="btn btn-primary">Go somewhere</a>
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
                                                <div class="text-center">
                                                    <a href="#" class="btn btn-primary">Go somewhere</a>
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

</html>