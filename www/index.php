<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Sistema Médico Integral</title>
        <link href="/assets/css/styleindex.css" rel="stylesheet" type="text/css" media="all" />
        <link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/assets/css/responsiveslides.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="/assets/js/responsiveslides.min.js"></script>
        <script>
            $(function (){
                // Slideshow 1
                $("#slider1").responsiveSlides({
                    maxwidth: 1600,
                    speed: 600
                });
            });
        </script>
    </head>
    <body>
        <!--start-wrap-->
        <!--start-header-->
        <div class="header">
            <div class="wrap">
                <!--start-logo-->
                <div class="logo">
                    <a href="index.php" style="font-size: 30px;">Sistema Médico Integral</a>
                </div>
                <!--end-logo-->
                <!--start-top-nav-->
                <div class="top-nav">
                    <ul>
                        <li class="active"><a href="index.php">Inicio</a></li>
                        <li><a href="contact.php">Contacto</a></li>
                    </ul>
                </div>
                <div class="clear"> </div>
                <!--end-top-nav-->
            </div>
        </div>
        <!--end-header-->

        <div class="clear"> </div>

        <!--start-image-slider-->
        <div class="image-slider">
            <!-- Slideshow 1 -->
            <ul class="rslides" id="slider1">
                <li><img src="/assets/img/slider-image1.jpg" alt=""></li>
                <li><img src="/assets/img/slider-image2.jpg" alt=""></li>
                <li><img src="/assets/img/slider-image1.jpg" alt=""></li>
            </ul>
        </div>
        <!--End-image-slider-->

        <div class="clear"> </div>

        <div class="content-grids">
            <div class="wrap">
                <div class="section group">
                    <div class="listview_1_of_3 images_1_of_3">
                        <div class="listimg listimg_1_of_2">
                            <img src="/assets/img/grid-img3.png">
                        </div>
                        <div class="text list_1_of_2">
                            <h3>Paciente</h3>
                            <p>Registrarse & Reservar Turno</p>
                            <div class="button"><span><a href="../app/views/login.php">Click Aquí</a></span></div>
                        </div>
                    </div>
                    <div class="listview_1_of_3 images_1_of_3">
                        <div class="listimg listimg_1_of_2">
                            <img src="/assets/img/grid-img1.png">
                        </div>
                        <div class="text list_1_of_2">
                            <h3>Inicio de sesión-Médicos</h3>
                            <div class="button"><span><a href="../app/views/login.php">Click Aquí</a></span></div>
                        </div>
                    </div>
                    <div class="listview_1_of_3 images_1_of_3">
                        <div class="listimg listimg_1_of_2">
                            <img src="/assets/img/grid-img2.png">
                        </div>
                        <div class="text list_1_of_2">
                            <h3>Inicio de sesión-Admin</h3>
                            <div class="button"><span><a href="../app/views/login.php">Click Aquí</a></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clear"> </div>

        <div class="footer">
            <div class="wrap">
                <div class="footer-left">
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="contact.php">Contacto</a></li>
                    </ul>
                </div>
                <div class="clear"> </div>
            </div>
        </div>
        <!--end-wrap-->
    </body>
</html>
