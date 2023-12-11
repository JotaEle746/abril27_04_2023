<?php
    require_once('includes/session.php');
    require_once('includes/conn.php');
    require_once('check.php');
    date_default_timezone_set('America/Lima');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/animate.css">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sammacmedia">
            <div class="sidebar-header">
                <h3>CIP Eventos</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="fa fa-th"></i>
                        Dashboard
                    </a>
                </li>
                <?php
                if ($_SESSION['permission'] == 1):
                ?>
                <li>
                    <a href="a_employees.php">
                        <i class="fa fa-plus"></i>
                        Añadir colegiado
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="all_employees.php">
                        <i class="fa fa-table"></i>
                        Buscar colegiado
                    </a>
                </li>
                <?php
                    if ($_SESSION['permission'] == 1) :
                ?>
                <li>
                    <a href="a_users.php">
                        <i class="fa fa-user"></i>
                        Añadir Usuarios
                    </a>
                </li>
                <li>
                    <a href="v_users.php">
                        <i class="fa fa-table"></i>
                        Ver Usuarios
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="settings.php">
                        <i class="fa fa-cog"></i>
                        Ajustes
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fa fa-power-off"></i>
                        Cerrar sesión
                    </a>
                </li>
            </ul>
        </nav>

        <div id="content" style="width: 100%;">
            <nav class="navbar navbar-default sammacmedia">
                <div class="container-fluid">
                    <div class="navbar-header" id="sams">
                        <button type="button" id="sidebarCollapse" id="makota"
                            class="btn btn-sam animated tada navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                            <span>Menú</span>
                        </button>
                    </div>
                </div>
            </nav>

            <div class="line"></div>

            <div class="row">
                <div class="col-lg-6 col-md-6 ">
                    <div class="panel panel sammac sammacmedia">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $users; ?></div>
                                    <div>Número total de usuarios</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel strover sammacmedia">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-link fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $colegiados; ?></div>
                                    <div>Número total de colegiados registrados</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 ">
                    <div class="panel panel samuel sammacmedia">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $cantidad_entregada; ?></div>
                                    <div>Número total de canastas entregadas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
        $('sams').on('click', function() {
            $('makota').addClass('animated tada');
        });
    </script>
</body>

</html>