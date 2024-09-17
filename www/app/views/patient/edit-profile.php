<!DOCTYPE html>
<html lang="es">

<head>
    <title>Usuario | Editar Perfil</title>
    <?php include('../include/head.php'); ?>
</head>

<body>
    <div id="app">
        <?php include('../include/sidebar_patient.php'); ?>
        <div class="app-content">
            <?php include('../include/header.php'); ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Usuario | Editar Perfil</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Usuario</span></li>
                                <li class="active"><span>Editar Perfil</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: green; font-size:18px;"></h5>
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Editar Perfil</h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Perfil de Usuario</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4>Dirección</h4>
                                                    </div>
                                                </div>
                                                <hr />
                                                <form role="form" name="edit" method="post">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="fname">Apellido</label>
                                                                        <input type="text" name="fname" class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="fname">Nombre</label>
                                                                        <input type="text" name="fname" class="form-control" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fname">DNI</label>
                                                                <input type="number" name="fname" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="date">Fecha de nacimiento</label>
                                                                <input type="date" name="date" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fname">Num. Teléfono</label>
                                                                <input type="text" name="fname" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="city">Calle</label>
                                                                <input type="text" name="city" class="form-control" required="required" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fname">Barrio</label>
                                                                <input type="text" name="fname" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nhome">Número</label>
                                                                <input type="number" name="nhome" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="floorhome">Piso</label>
                                                                <input type="number" name="floorhome" class="form-control" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Actualizar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('../include/footer.php'); ?>
            <?php include('../include/setting.php'); ?>
        </div>
    </div>
    <?php include('../include/script.php'); ?>
</body>

</html>