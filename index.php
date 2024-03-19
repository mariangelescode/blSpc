<?php
    session_start();
    require('../../../c0nf1g.php');
    include('../../../_scr/funciones.php');
    fnclick(128);
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="_content/_css/styles.css">
    <title>Intranet</title>
    <?php echo fnCss() ?>
</head>
<body>
    <div id="topbar">
        <?php echo fnTopBar() ?>
    </div>
    <div class="container">
        <div id="sideBar" data-margen="oculto">
            <?php echo fnSidebar() ?>
        </div>
        <div class="wokspace">
<!-------------------------------------------------------------------------------------------->
            <div class="div-regres-class">
                <div class="div-reg-class">
                    <div id="div-bloqusu-id" class="div-bloqusu-class">
                    <div id="div-tit-bloqusu-id" class="div-tit-bloqusu-class">
                        <span class="span-tit-bloqusu-class">Bloqueo de Usuarios</span>
                    </div>
                    <div id="div-num-bloqusu-id" class="div-num-bloqusu-class">
                        <span>¿Cuántos usuarios vas a bloquear?</span>
                        <input type="number" id="inp-num-bloqusu-id" class="inp-num-bloqusu-class" min="1" max="20" value="0">
                    </div>
                    <div id="div-form-bloqusu-id" class="div-form-bloqusu-class">
                        <span>SAP</span>
                        <span>Fecha de Desbloqueo</span>
                        <span>Motivo</span>
                    </div>
                    <form id="form-bloqusu-id" class="form-bloqusu-class">
                        <div id="div-tabCol_id" class="div-tabCol_class"></div>
                        <div  id="div-inpSav_id" class="div-inpSav_class">
                            <input id="btn-savbloqusu-id" class="btn-savbloqusu-class" type="submit" name="submitEnviar" value="Guardar">
                        </div>
                    </form>
                </div>
                </div>
                <div class="div-res-class">
                    <div class="divTitRes" onclick="showLisBlo()">
                        <span>Bloqueos Vigentes</span>
                    </div>
                    <div id="div-ConAntRes-id" class="divConAntRes">
                        <table id="tab-lisBlo-id" class="tab-lisBlo-class"></table>
                    </div>
                    <div class="divTitRes" onclick="showLisAntBlo()">
                        <span>Anteriores Bloqueos</span>
                    </div>
                    <div class="divConAntRes">
                        <table id="tab-lisAntBlo-id" class="tab-lisAntBlo-class"></table>
                    </div>
                </div>
                
            </div>
            
<!-------------------------------------------------------------------------------------------->
        </div><!-- fin worksapace -->
        <input type="hidden" id="cpCenter" value="<?php echo $_SESSION['centroid'];?>">
        <input type="hidden" id="cpUser" value="<?php echo $_SESSION['usuario'];?>">
    </div>
    <?php echo  fnJs(); ?>
	<script src="./_content/_js/dom.js"></script>
	<script src="./_content/_js/get_petitions.js"></script>
	<script src="./_content/_js/send_action.js"></script>
	<script src="./_content/_js/manipulate_data.js"></script>
</body>

</html>