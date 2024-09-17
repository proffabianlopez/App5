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
                                                <h4>Perfil de Usuario</h4>
                                                <p><b>Fecha de Registro del Perfil: </b>Fecha de Registro</p>
                                                <p><b>Última Actualización del Perfil: </b>Última Fecha de Actualización</p>
                                                <hr />
                                                <form role="form" name="edit" method="post">
                                                    <div class="form-group">
                                                        <label for="fname">Nombre de Usuario</label>
                                                        <input type="text" name="fname" class="form-control" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Dirección</label>
                                                        <textarea name="address" class="form-control"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">Ciudad</label>
                                                        <input type="text" name="city" class="form-control" required="required" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender">Género</label>
                                                        <select name="gender" class="form-control" required="required">
                                                            <option value="male">Masculino</option>
                                                            <option value="female">Femenino</option>
                                                            <option value="other">Otro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="uemail">Email de Usuario</label>
                                                        <input type="email" name="uemail" class="form-control" readonly="readonly" value="">
                                                        <a href="change-emaild.php">Actualizar tu correo electrónico</a>
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
