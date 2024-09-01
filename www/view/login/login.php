<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de salud| Iniciar sesión</title>
    <link rel="stylesheet" href="../../public/css/login.css">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center mb-3 text-lg">
                                <div class="sidebar-brand d-flex align-items-center justify-content-center">
                                    <div class="sidebar-brand-icon rotate-n-15">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <div class="sidebar-brand-text mx-3">Iniciar sesion</div>
                                </div>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group">
                                    <input type="email" id="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" id="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Contraseña" name="password" required>
                                </div>
                                <hr>
                                <button class="btn btn-primary btn-user btn-block" type="submit" name="send">
                                    Ingresar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>