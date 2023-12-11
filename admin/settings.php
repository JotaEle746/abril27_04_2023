<?php 
    require_once('includes/session.php');
    require_once('includes/conn.php');
    $sqlE  = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '{$_SESSION['username']}'");
    $eprow = mysqli_fetch_array($sqlE);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Ajustes</title>

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
                <li>
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
                <li class="active">
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

            <?php
                if (isset($mysqli, $_POST['submit'])) :
                    $old_password1 = mysqli_real_escape_string($mysqli, $_POST['old_password']);
                    $password      = mysqli_real_escape_string($mysqli, $_POST['password']);
                    $cpassword     = mysqli_real_escape_string($mysqli, $_POST['cpassword']);
                    $old_password  = md5($old_password1);

                    if ($eprow['password'] != $old_password) :
            ?>

            <div class="alert alert-danger samuel animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Error! </strong><?php echo 'Ingrese la contraseña antigua correcta'; ?>
            </div>

            <?php
                    else :
                        if ($password != $cpassword) :
            ?>
            <div class="alert alert-danger samuel animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Error! </strong><?php echo 'La nueva contraseña y la confirmación de la contraseña no coinciden. Inténtalo de nuevo.'; ?>
            </div>

            <?php
                        else :
                            $password = md5($cpassword);
                            $sqliU    = "UPDATE users SET password='$password' WHERE username = '{$_SESSION['username']}'";
                            $res      = mysqli_query($mysqli, $sqliU);

                            if ($res == 1) :
            ?>

            <div class="alert alert-warning sammac animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Exitosamente </strong><?php echo 'Ha actualizado su contraseña con éxito'; ?>
            </div>

            <?php
                            endif;
                        endif;
                    endif;
                endif;

                if (isset($mysqli, $_POST['update'])) :
                    $name    = mysqli_real_escape_string($mysqli, $_POST['name']);
                    $surname = mysqli_real_escape_string($mysqli, $_POST['surname']);
                    $phone   = mysqli_real_escape_string($mysqli, $_POST['phone']);

                    $sqlTaru = "UPDATE users SET name = '$name', surname = '$surname', phone = '$phone' WHERE username = '{$_SESSION['username']}'";
                    $resTaru = mysqli_query($mysqli, $sqlTaru);

                    if ($resTaru == 1) :
            ?>
            <div class="alert alert-warning sammac animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Exitosamente </strong><?php echo 'Has actualizado tu perfil con éxito'; ?>
            </div>

            <?php
                    else :
            ?>

            <div class="alert alert-warning samuel animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Error! </strong><?php echo 'OOP algo salió mal, inténtalo de nuevo'; ?>
            </div>

            <?php
                    endif;
                endif;
            ?>

            <div class="line"></div>

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default sammacmedia">
                        <div class="panel-heading">Actualizar datos</div>
                        <div class="panel-body">
                            <form method="post" action="settings.php">
                                <div class="row form-group">
                                    <div class="col-lg-6">
                                        <label>Nombres</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $eprow['name']; ?>" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Apellidos</label>
                                        <input type="text" class="form-control" name="surname" value="<?php echo $eprow['surname']; ?>" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-6">
                                        <label>Lugar de entrega</label>
                                        <input type="text" class="form-control" value="<?php echo $eprow['lugar_entrega']; ?>" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>N° de celular</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="<?php echo $eprow['phone']; ?>" required maxlength="9">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-3">
                                        <label>Género</label>
                                        <input type="text" class="form-control" value="<?php echo $eprow['gender']; ?>"
                                            readonly>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Nivel de acceso</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $eprow['permission']; ?>" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Agregado el:</label>
                                        <input type="text" class="form-control" value="<?php echo $eprow['joined']; ?>"
                                            readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="update" class="btn btn-warning btn-block"><span
                                                class="fa fa-pencil"></span> Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default sammacmedia">
                        <div class="panel-heading">Cambiar contraseña</div>
                        <div class="panel-body">
                            <form method="post" action="settings.php">
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <label>Contraseña antigua</label>
                                        <input type="password" class="form-control" name="old_password" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <label>Nueva contraseña</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <label>Confirmar contraseña</label>
                                        <input type="password" class="form-control" name="cpassword" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-danger btn-block"><span
                                                class="fa fa-lock"></span> Cambiar contraseña</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="line"></div>            
        </div>
    </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
        $('sams').on('click', function () {
            $('makota').addClass('animated tada');
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            window.setTimeout(function () {
                $("#sams1").fadeTo(1000, 0).slideUp(1000, function () {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
</body>

</html>