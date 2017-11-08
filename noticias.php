<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">
<!--        <link rel="stylesheet" type="text/css" href="assets/gritter/css/jquery.gritter.css" />-->
        <!--external css-->
        <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
        <style>
            th, td {
                text-align: center; 
            }
            .modal-open {
                overflow-y: hidden;
            }
            html {
                min-height: 101%;
            }
            #modal-dialog-interna{
                overflow-y: initial !important
            }
            #modal-body-interna{
                max-height: 420px;
                overflow-y: auto;
            }
            .noscroll { position: fixed; overflow-y:scroll }
        </style>
    </head>
    <body>
        <section class="panel" >
            <div class="revenue-head9">
                <span><h3><b>Notícias:</b></h3></span>
            </div>
            <div class="flat-carousal">
                <div id="owl-demo" class="owl-carousel owl-theme" style="height: 420px">
                    <?php
                    include '../conn.php';
                    mysqli_select_db($conn, "noticias") or die(mysqli_error($conn));
                    $query = "SELECT * FROM tb_noticias WHERE ativada=true ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);

                    while ($obj = mysqli_fetch_object($result)) {
//                        echo "<script>alert('$obj->usuario');</script>";
                        $usuario1 = explode('@', $obj->usuario)[1];
                        $usuario = explode('.', $usuario1)[0];
                        $fonte = strtoupper($usuario);
                        $id = $obj->id;
                        (int) $tamanho = $obj->tamanho_imagem;
                        $foto = $obj->nome_imagem;
                        if ($obj->endereco == "Notícia Interna") {
                            $endereco = "<a href ='#modalNoticiaInterna' data-toggle='modal' class='endereco-noticia-interna' id='$id' >"; #modalNoticiaInterna";
                        } else
                            $endereco = "<a href ='$obj->endereco' target = '_blank' class='enderecoNoticia'>";
                        echo ""
                        . "<center>"
                        . "	<div class = 'text-center' >"
                        . "	     $endereco<br>"
                        . "	     $obj->espacos"
                        . "	         <center><img src='Imagens/$foto' style='max-width: $tamanho%;' class=''></center>"
                        . "	         <br>"
                        . "	         <h1 style='margin-bottom: 5px'>$obj->titulo</h1><p style=' text-align: center; font-size: 90%; font-style: italic'>Fonte: $fonte</p>"
                        . "	     </a>"
                        . "	</div>"
                        . "</center>";
                    }
                    ?>
                </div>
            </div>
        </section>

        <div id="modalNoticiaInterna" class="modal fade top-modal-without-space" role="dialog" style="">                                              
            <div id="modal-dialog-interna" class="modal-dialog">                                                                      
                <div class="modal-content">                                                                 
                    <div class="modal-header">                                                              
                        <button type="button" class="close" data-dismiss="modal">&times;</button>           
                        <h4 class="modal-title">Notícia</h4>                                           
                    </div>  
                    <div id="modal-body-interna" class="modal-body" style="padding: 40px">                                                         
                        <center> <h3 id="tituloNoticiaInterna"></h3><br>
                            <img id="imgNoticiaInterna" class = "img-responsive" style="width: 80%;"/><br>
                            <p id="textoNoticiaInterna"></p></center>
                    </div>                                                                              
                    <div class="modal-footer">                                                          
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>   
                    </div>
                </div>                                                                                      
            </div>                                                                                          
        </div>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
        <script type="text/javascript" src="assets/gritter/js/jquery.gritter.js"></script>
        <script src="js/respond.min.js" ></script>
        <script type="text/javascript" src="js/jquery.pulsate.min.js"></script>
<!--        <script src="js/common-scripts.js"></script>-->
        <!-- js placed at the end of the document so the pages load faster -->
<!--        <script src="js/jquery.js"></script>-->
<!--        <script src="js/bootstrap.min.js"></script>-->
        <script src="js/owl.carousel.js" ></script>
        <!--script for this page only (MODAL)-->
        <script src="js/gritter.js" type="text/javascript"></script>
<!--        <script src="js/pulstate.js" type="text/javascript"></script>-->
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


            $(document).on('click', '.endereco-noticia-interna', function () {
                var user_id = $(this).attr("id");
                var fd = new FormData();
                fd.append("tipo_de_requisicao", "buscarPorId");
                fd.append("id", user_id);
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState === 4) {
                        if (xmlhttp.status === 200) {
                            var data = JSON.parse(xmlhttp.responseText);
                            $("#tituloNoticiaInterna").html(data.titulo);
                            $("#textoNoticiaInterna").html(data.texto);
                            $("#imgNoticiaInterna").attr("src", "Imagens/" + data.nome_imagem);
                        } else {
                            alert('Desculpe, houve um erro no servidor.\n Código do erro: ' + xmlhttp.status);
                        }
                    }
                };
                xmlhttp.open("POST", "FuncoesNoticias.php", true);
                xmlhttp.send(fd);
            });

        </script>
    </body>
</html>