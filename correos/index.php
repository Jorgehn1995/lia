<?php

$usuario="INEBCO";
$token="JALJDSLAJFLAJDFLJ";

$body = file_get_contents('action.php');

$body = str_replace("%%COLEGIO%%", $usuario, $body);
$body = str_replace("%%TOKEN%%", $token, $body);

$header = "From: Equipo de Registro GES <no-responder@GES.com> \r\n";
$header .= "Bcc: company@gmail.com \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/html";

//return $body;
//mail("jorgehn1995@gmail.com", "¡Bienvenido a GES!", $body, $header);
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="Sistema de desarrolo y gestion escolar">
        <meta name="author" content="Jorge Hernandez">

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <title>Pronto :: INEBCO.com</title>

        <link href="plugins/switchery/switchery.min.css" rel="stylesheet" />

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

        <script src="assets/js/modernizr.min.js"></script>

    </head>
    <body>

        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="home-wrapper">
                            <h1 class="home-text"><span class="rotate">Sitio en contruccion INEBCO.COM</span></h1>
                            <p class="m-t-30 text-muted">Lamentamos las molestias, siempre estamos intentando darte contenido de calidad,
                              por eso estamos reconstruyendo el sitio, pronto estaremos de vuelta.</p>

                            <!-- COUNTDOWN -->
                            <div class="row m-t-40">
                                <div class="col-sm-12 app-countdown">
                                    <div class="row">
                                        <div>
                                            <div>
                                                <span>0</span><span>days</span></div>
                                            <div><span>0</span><span>hours</span></div>
                                        </div>
                                        <div class="app-countdown-ms">
                                            <div><span>0</span><span>minutes</span></div>
                                            <div><span>0</span><span>seconds</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /COUNTDOWN -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->



        <!-- Plugins  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script><!-- Popper for Bootstrap --><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Custom main Js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!-- Countdown -->
        <script src="plugins/countdown/dest/jquery.countdown.min.js"></script>
        <script src="plugins/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>


        <script type="text/javascript">
            $(document).ready(function () {

                // Countdown
                // To change date, simply edit: var endDate = "January 17, 2017 20:39:00";
                $(function () {
                    var endDate = "January 2, 2018 00:01:00";
                    $('.app-countdown .row').countdown({
                        date: endDate,
                        render: function (data) {
                            $(this.el).html('<div><div><span class="text-primary">' + (parseInt(this.leadingZeros(data.years, 2) * 365) + parseInt(this.leadingZeros(data.days, 2))) + '</span><span><b>Dias</b></span></div><div><span class="text-primary">' + this.leadingZeros(data.hours, 2) + '</span><span><b>Horas</b></span></div></div><div class=""><div><span class="text-primary">' + this.leadingZeros(data.min, 2) + '</span><span><b>Minutos</b></span></div><div><span class="text-primary">' + this.leadingZeros(data.sec, 2) + '</span><span><b>Segundos</b></span></div></div>');
                        }
                    });
                });

                // Text rotate
                $(".home-text .rotate").textrotator({
                    animation: "fade",
                    speed: 2000
                });
            });

        </script>

    </body>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108547714-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-108547714-1');
</script>

</html>
