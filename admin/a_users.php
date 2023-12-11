<?php 
    require_once('includes/session.php');
    require_once('includes/conn.php');
    date_default_timezone_set('America/Lima');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Añadir usuarios</title>

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
                <li class="active">
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
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header" id="sams">
                        <button type="button" id="sidebarCollapse" id="makota"
                            class="btn btn-sam animated tada navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                            <span>Menu</span>
                        </button>
                    </div>
                </div>
            </nav>

            <div class="line"></div>
            <?php
                if (isset($mysqli,$_POST['submit'])) :
                    $name          = strtoupper(mysqli_real_escape_string($mysqli, $_POST['name']));
                    $surname       = strtoupper(mysqli_real_escape_string($mysqli, $_POST['surname']));
                    $phone         = mysqli_real_escape_string($mysqli, $_POST['phone']); 
                    $username      = mysqli_real_escape_string($mysqli, $_POST['username']); 
                    $password      = mysqli_real_escape_string($mysqli, $_POST['password']);
                    $cpassword     = mysqli_real_escape_string($mysqli, $_POST['cpassword']);     
                    $permission    = mysqli_real_escape_string($mysqli, $_POST['permission']); 
                    $lugar_entrega = mysqli_real_escape_string($mysqli, $_POST['lugar_entrega']); 
                    $gender        = mysqli_real_escape_string($mysqli, $_POST['gender']);     
                    $joined        = date("d M Y");
                                                
                    if ($password != $cpassword) :
                        echo 'error';
                    
                    else: 
                        $password = md5($cpassword);
                        $sql_n    = "SELECT * FROM users WHERE phone ='$phone'";
                        $res_n    = mysqli_query($mysqli, $sql_n);    

                        if (mysqli_num_rows($res_n) > 0) :
            ?>

            <div class="alert alert-danger samuel animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Error! </strong><?php echo'Lo siento, el celular ya está asignado a alguien';?>
            </div>

            <?php    
                        else:

                            $sql     = "INSERT INTO users (name, surname, username, joined, permission, gender, phone, password, lugar_entrega) 
                                        VALUES ('$name','$surname','$username','$joined','$permission','$gender','$phone','$password','$lugar_entrega')";
                            $results = mysqli_query($mysqli,$sql);
                        
                            if ($results == 1) :
            ?>

            <div class="alert alert-success strover animated bounce" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Exitosamente! </strong><?php echo'Se creo la cuenta correctamente';?>
            </div>

            <?php 
                            else:
            ?>

            <div id="sams1" class="sufee-alert alert with-close alert-danger alert-dismissible fade show col-lg-12">
                <span class="badge badge-pill badge-danger"> Error! </span>
                Huy! Algo salió mal
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php    
                            endif;      
                        endif;
                    endif;
                endif;
            ?>
            <div class="panel panel-default sammacmedia">
                <div class="panel-heading">Añadir Usuarios</div>
                <div class="panel-body">
                    <form method="post" action="a_users.php">
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Nombres</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-lg-6">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" name="surname" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>N° de celular</label>
                                <input type="text" class="form-control" name="phone" required maxlength="9">
                            </div>
                            <div class="col-lg-6">
                                <label>Lugar de entrega</label>
                                <select class="form-control" name="lugar_entrega" required>
                                    <option>PUNO</option>
                                    <option>JULIACA</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Nivel de acceso</label>
                                <select class="form-control" name="permission">
                                    <option>1</option>
                                    <option>2</option>                                    
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Género</label>
                                <select class="form-control" name="gender">
                                    <option>F</option>
                                    <option>M</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Nombre de usuario</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="col-lg-3">
                                <label>Contraseña</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="col-lg-3">
                                <label>Confirmar contraseña</label>
                                <input type="password" class="form-control" name="cpassword">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-suc btn-block"><span
                                        class="fa fa-plus"></span> Crear usuario</button>
                            </div>
                            <div class="col-md-6">
                                <button type="reset" class="btn btn-dan btn-block"><span class="fa fa-times"></span>
                                    Limpiar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="line"></div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            window.setTimeout(function() {
                $("#sams1").fadeTo(1000, 0).slideUp(1000, function() {
                    $(this).remove();
                });
            }, 5000);

        });
    </script>

</body>

</html>