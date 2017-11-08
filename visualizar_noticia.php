<?php
include ("validacao.php");
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Gerenciador de notícias</title>

        <!-- Bootstrap core CSS -->
        <link href="include/noticias-owl-carousel/css/bootstrap.min.css" rel="stylesheet">
        <link href="include/noticias-owl-carousel/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link rel="stylesheet" href="include/noticias-owl-carousel/css/owl.carousel.css" type="text/css">

        <!-- Custom styles for this template -->
        <link href="include/noticias-owl-carousel/css/style.css" rel="stylesheet">
        <link href="include/noticias-owl-carousel/css/style-responsive.css" rel="stylesheet" />
        <!--external css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

        <!-- jcrop -->
        <script src="include/JCrop/js/jquery.min.js"></script>
        <script src="include/JCrop/js/jquery.Jcrop.js"></script>
        <link rel="stylesheet" href="include/JCrop/css/jquery.Jcrop.css" type="text/css" />


    </head>

    <body>
        <?php
        if (!isset($_POST['titulo']) || !isset($_POST['endereco']) || !isset($_FILES) || !isset($_POST['x'])) {
            header("Location: cadastrar_noticia_externa.php");
            die();
        }
        include __DIR__ . '/vendor/autoload.php';

        use Gregwar\Image\Image;

include '../conn.php';
        mysqli_select_db($conn, "noticias") or die(mysqli_error($conn));



        $tmp_name = $_FILES['img']['tmp_name'];
        $extensao = $_FILES['img']['type'];

        $titulo = $_POST ["titulo"];
        $endereco = $_POST ["endereco"];
        $y = $_POST['y'];
        $x = $_POST['x'];
        $w = $_POST['w'];
        $h = $_POST['h'];



        switch ($extensao) {
            case "image/jpg":
                $newName = md5(microtime()) . ".jpg";
                $ext = "jpg";
                break;
            case "image/png":
                $newName = md5(microtime()) . ".png";
                $ext = "png";
                break;
            case "image/jpeg":
                $newName = md5(microtime()) . ".jpeg";
                $ext = "jpeg";
                break;
            default:
                echo "<script>alert('Arquivo inválido. Verifique o formato ou o tamanho do arquivo.');window.location='cadastrar_noticia_externa.php'</script>";
        }


        $filename = sprintf('%s/croped/%s', __DIR__, $newName);

        $imgCortada = Image::open($tmp_name)->crop($x, $y, $w, $h);
        $imgCortada->save($filename, $ext);

        $_SESSION['imagemTemp'] = $newName;
        ?>

        <section id="container" class="">
            <!--header start-->
            <header class="header blue-bg" style="background-color: #00cccc">

                <!--logo start-->
                <a href="index.php" class="logo" ><center>Gerenciamento de notícias</center></a>
                <!--logo end-->
                <div class="top-nav ">
                    <ul class="nav pull-right top-menu" style="margin-top: 7px">
                        <div class="btn-group">
                            <a href="logout.php">
                                <button id="editable-sample_new" class="btn green">
                                    Sair <i class="fa fa-reply-all"></i>
                                </button>
                            </a>
                        </div>
                    </ul>
                </div>
            </header>
            <!--header end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper site-min-height" style="margin-left: -110px">
                    <div class="row">
                        <section class="panel" style="background-color: #eeeaea">
                            <header class="panel-heading">
                                <i class="fa fa-check-square-o fa-1x"></i> <font size="3"><a href="#" id="voltar"><b>Voltar</b></a></font><br><br>
                            </header>
                            <div class="panel-body" style="background-color: #eeeaea">
                                <section class = "panel" style="position: relative;width:500px; left: 30px; right: auto;margin-left: auto;margin-right: auto">    
                                    <div class="revenue-head9">           
                                        <h3><b>Notícias:</b></h3>         
                                    </div>                                
                                    <div class = "flat-carousal">                         
                                        <div id="owl-demo" class="owl-carousel owl-theme" style="max-height: 420px;">    
                                            <div class = "text-center" style="text-align: center;">
                                                <a id="enderecomodal" href ="<?php echo $_POST['endereco']; ?>" target = "_blank"><br>
                                                    <center><img id="imgmodal" src ='<?php echo "$imgCortada"; ?>' class = "img-responsive" ></center><br>
                                                    <h1><?php echo $_POST['titulo']; ?></h1>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="modal-footer">
                                    <form method="POST" id="myFormEnviar">
                                        <center><b>Tem certeza que deseja enviar esta notícia?</b><br><br>
                                            <button id="btnVoltar" type="button" class="btn btn-default">Voltar</button>
                                            <input type="hidden" name="titulo" value="<?php echo $_POST['titulo']; ?>" />
                                            <input type="hidden" name="endereco" value="<?php echo $_POST['endereco']; ?>" />
                                            <input type="hidden" name="img" value="<?php echo $newName ?>" />
                                            <input type="hidden" name="tipo_de_requisicao" value="inserirExterna" />
                                            <button id="cadastrar" name="cadastrar" type = "submit" class = "btn btn-default">Enviar</button></center>
                                    </form>
                                </div> 
                            </div>
                        </section>
                    </div>
                    <!--page end-->
                </section>

                <!-- Form caso clique em enviar -->


                <!-- Form caso clique em voltar -->
                <form method="POST" id="myForm" action="cadastrar_noticia_externa.php">
                    <input type="hidden" name="titulo" value="<?php echo $_POST['titulo']; ?>" />
                    <input type="hidden" name="endereco" value="<?php echo $_POST['endereco']; ?>" />
                </form>

                <script>
                    $('#btnVoltar').click(function () {
                        document.getElementById("myForm").submit();
                    });

                    $('#voltar').click(function () {
                        document.getElementById("myForm").submit();
                    });


                    $("#myFormEnviar").submit(function (event) {
                        event.preventDefault();
                        var fd = new FormData(this);
                        xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                                window.location = 'index.php';
                            }
                        };
                        xmlhttp.open("POST", "FuncoesNoticias.php", true);
                        xmlhttp.send(fd);
                    });
                </script>

            </section>
            <!--main content end-->
            <!--footer start-->
            <footer class = "site-footer" style="height: 35px">
                <div class="text-center">
                    <a href="#" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
            <script src="include/noticias-owl-carousel/js/owl.carousel.js" ></script>
            <script>

                    //owl carousel

                    $(document).ready(function () {
                        $("#owl-demo").owlCarousel({
                            navigation: true,
                            slideSpeed: 600,
                            paginationSpeed: 600,
                            singleItem: true,
                            autoPlay: true

                        });
                    });
                    //custom select box

                    $(function () {
                        $('select.styled').customSelect();
                    });

            </script>
        </section>


    </body>
</html>