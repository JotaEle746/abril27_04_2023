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

    <title>Añadir colegiado</title>

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
                <li class="active">
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
                if ($_SESSION['permission'] == 1):
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

            <?php
                if (isset($mysqli, $_POST['submit'])) :
                    $dni                 = mysqli_real_escape_string($mysqli, $_POST['dni']);
                    $cip                 = mysqli_real_escape_string($mysqli, $_POST['cip']);
                    $name                = strtoupper(mysqli_real_escape_string($mysqli, $_POST['fname']));
                    $paterno             = strtoupper(mysqli_real_escape_string($mysqli, $_POST['paterno']));
                    $materno             = strtoupper(mysqli_real_escape_string($mysqli, $_POST['materno']));
                    $capitulo            = mysqli_real_escape_string($mysqli, $_POST['selectDepartamento']);
                    $especialidad        = mysqli_real_escape_string($mysqli, $_POST['selectProvincia']);
                    $fecha_incorporacion = mysqli_real_escape_string($mysqli, $_POST['fecha_incorporacion']);
                    $fechaultimopago     = mysqli_real_escape_string($mysqli, $_POST['fechaultimopago']);

                    $joined = date("d M Y");

                    $sql_dni = "SELECT * FROM employees WHERE dni = '$dni'";
                    $res_dni = mysqli_query($mysqli, $sql_dni);

                    if (mysqli_num_rows($res_dni) > 0) :
            ?>

            <div class="alert alert-danger samuel animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Error! </strong>                
                <?php echo 'El número de DNI ya se encuentra registrado'; ?>
            </div>

            <?php
                    else :
                        $query2  = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '{$_SESSION['username']}'");
                        $row     = mysqli_fetch_array($query2);
                        $id_user = $row['id'];

                        $sql     = "INSERT INTO employees (dni, cip, name, paterno, materno, joined, capitulo, especialidad, id_user, fecha_incorporacion, fechaultimopago, special_case) 
                                    VALUES ('$dni', '$cip', '$name', '$paterno', '$materno', '$joined', '$capitulo', '$especialidad', '$id_user', '$fecha_incorporacion', '$fechaultimopago', '1')";
                        $results = mysqli_query($mysqli, $sql);

                        if ($results == 1) :
            ?>

            <div class="alert alert-success strover animated bounce" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Exitosamente! </strong>
                <?php echo 'Nuevo colegiado agregado correctamente'; ?>
            </div>

            <?php
                        else :
            ?>

            <div class="alert alert-danger samuel animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Error! </strong>
                <?php echo 'OOPS algo salió mal'; ?>
            </div>

            <?php
                        endif;
                    endif;
                endif;
            ?>

            <div class="panel panel-default sammacmedia">
                <div class="panel-heading">Buscar colegiado</div>
                <div class="panel-body" style="display: flex; justify-content: center; align-items: center;">
                    <form class="form-inline my-2 my-lg-0" action="a_employees.php" method="get">
                        <div class="row form-group">
                            <input class="form-control mr-sm-2" type="text" placeholder="DNI o Código CIP" name="search_dni" id="search_dni">
                            <input class="btn btn-success my-2 my-sm-0 button-search" value="Buscar" type="submit"/>
                        </div>
                    </form>
                </div>
            </div>

            <?php
                if (isset($_GET['search_dni'])):
                     if(strlen($_GET['search_dni']) == 8){
                        $value_dni = mysqli_real_escape_string($mysqli, $_GET['search_dni']);    
                        $sql_search = "SELECT * FROM colegiadosni WHERE dni = '$value_dni'";
                    } else if(strlen($_GET['search_dni']) < 8) {
                        $value_cip = mysqli_real_escape_string($mysqli, $_GET['search_dni']);    
                        $sql_search = "SELECT * FROM colegiadosni WHERE cip = '$value_cip'";
                    }
                    
                    $res_search = mysqli_query($mysqli, $sql_search);
                    
                    if (mysqli_num_rows($res_search) > 0) :
                        $row = mysqli_fetch_array($res_search);
            ?>
            
            <div class="panel panel-default sammacmedia">
                <div class="panel-heading">Agregar nuevo colegiado</div>
                <div class="panel-body">
                    <form method="post" action="a_employees.php" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>DNI <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="dni" required maxlength="8" value="<?php echo $row['dni']; ?>" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label>Código CIP</label>
                                <input type="text" class="form-control" name="cip" minlength="4" maxlength="7" value="<?php if(!is_null($row['cip'])) : echo "{$row['cip']}"; endif; ?>" <?php if(!is_null($row['cip'])) : echo "readonly"; endif; ?> >
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-4">
                                <label>Nombres <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="fname" required value="<?php echo $row['name']; ?>" readonly>
                            </div>
                            <div class="col-lg-4">
                                <label>Apellido Paterno <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="paterno" required value="<?php echo $row['paterno']; ?>" readonly>
                            </div>
                            <div class="col-lg-4">
                                <label>Apellido Materno <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="materno" required value="<?php echo $row['materno']; ?>" readonly>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Fecha de incorporación</label>
                                <input type="text" class="form-control" name="fecha_incorporacion" value="<?php if(!is_null($row['fecha_incorporacion'])) : echo "{$row['fecha_incorporacion']}"; endif; ?>"  placeholder="AAAA-MM-DD" <?php if(!is_null($row['fecha_incorporacion'])) : echo "readonly"; else: echo "required"; endif; ?> >
                            </div>
                            <div class="col-lg-6">
                                <label>Fecha del último pago</label>
                                <input type="text" class="form-control" name="fechaultimopago" value="<?php echo $row['fechaultimopago']; ?>" placeholder="AAAA-MM-DD">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Capítulo</label>
                                <select name="selectDepartamento" onchange="cambia()" class="form-control">
                                    <option value="<?php echo $row['capitulo']; ?>"> <?php echo $row['capitulo']; ?> </option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Especialidad</label>
                                <select class="form-control" name="selectProvincia">
                                    <option value="<?php echo $row['especialidad']; ?>"> <?php echo $row['especialidad']; ?> </option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-suc btn-block"><span
                                        class="fa fa-plus"></span> Agregar</button>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php
                else:
            ?>

            <!-- PARTE 2 -->
            <div class="alert alert-danger samuel animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Error! </strong>                
                <?php echo 'No se encontró el número de DNI o Código CIP'; ?>
            </div>

            <div class="panel panel-default sammacmedia">
                <div class="panel-heading">Agregar nuevo colegiado</div>
                <div class="panel-body">
                    <form method="post" action="a_employees.php" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>DNI <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="dni" required maxlength="8" value="">
                            </div>
                            <div class="col-lg-6">
                                <label>Código CIP</label>
                                <input type="text" class="form-control" name="cip" minlength="4" maxlength="7" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-4">
                                <label>Nombres <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="fname" required>
                            </div>
                            <div class="col-lg-4">
                                <label>Apellido Paterno <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="paterno" required>
                            </div>
                            <div class="col-lg-4">
                                <label>Apellido Materno <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="materno" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Fecha de incorporación</label>
                                <input type="text" class="form-control" name="fecha_incorporacion" placeholder="AAAA-MM-DD" required>
                            </div>
                            <div class="col-lg-6">
                                <label>Fecha del último pago</label>
                                <input type="text" class="form-control" name="fechaultimopago" placeholder="AAAA-MM-DD" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Capítulo</label>
                                <select name="selectDepartamento" onchange="cambia()" class="form-control">
                                    <option value="NINGUNO">NINGUNO</option>
                                    <option value="GEOLOGOS">GEOLOGOS</option>
                                    <option value="CIVILES">CIVILES</option>
                                    <option value="SISTEMAS">SISTEMAS</option>
                                    <option value="METALURGISTAS">METALURGISTAS</option>
                                    <option value="AMBIENTAL_Y_FORESTAL">AMBIENTAL Y FORESTAL</option>
                                    <option value="AGRICOLAS">AGRICOLAS</option>
                                    <option value="ECONOMISTAS">ECONOMISTAS</option>
                                    <option value="QUIMICOS">QUIMICOS</option>
                                    <option value="AGRONOMIA">AGRONOMÍA</option>
                                    <option value="MECANICOS_Y_ELECTRICISTAS">MECANICOS Y ELECTRICISTAS</option>
                                    <option value="ELECTRONICOS">ELECTRONICOS</option>
                                    <option value="MINAS">MINAS</option>
                                    <option value="AGROINDUSTRIALES">AGROINDUSTRIALES</option>
                                    <option value="ESTADISTICOS">ESTADISTICOS</option>
                                    <option value="TOPOGRAFOS">TOPOGRAFOS</option>
                                    <option value="PESQUEROS">PESQUEROS</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Especialidad</label>
                                <select class="form-control" name="selectProvincia">
                                    <option>NINGUNO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-suc btn-block"><span
                                        class="fa fa-plus"></span> Agregar</button>
                            </div>
                            <div class="col-md-6">
                                <button type="reset" class="btn btn-dan btn-block"><span class="fa fa-times"></span>
                                    Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php
                    endif;
                else :
            ?>

            <div class="panel panel-default sammacmedia">
                <div class="panel-heading">Agregar nuevo colegiado</div>
                <div class="panel-body">
                    <form method="post" action="a_employees.php" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>DNI <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="dni" required maxlength="8" value="<?php //echo $row['dni'] ?>">
                            </div>
                            <div class="col-lg-6">
                                <label>Código CIP</label>
                                <input type="text" class="form-control" name="cip" minlength="4" maxlength="7" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-4">
                                <label>Nombres <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="fname" required>
                            </div>
                            <div class="col-lg-4">
                                <label>Apellido Paterno <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="paterno" required>
                            </div>
                            <div class="col-lg-4">
                                <label>Apellido Materno <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="materno" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Fecha de incorporación</label>
                                <input type="text" class="form-control" name="fecha_incorporacion" placeholder="AAAA-MM-DD" required>

                            </div>
                            <div class="col-lg-6">
                                <label>Fecha del último pago</label>
                                <input type="text" class="form-control" name="fechaultimopago" placeholder="AAAA-MM-DD" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Capítulo</label>
                                <select name="selectDepartamento" onchange="cambia()" class="form-control">
                                    <option value="NINGUNO">NINGUNO</option>
                                    <option value="GEOLOGOS">GEOLOGOS</option>
                                    <option value="CIVILES">CIVILES</option>
                                    <option value="SISTEMAS">SISTEMAS</option>
                                    <option value="METALURGISTAS">METALURGISTAS</option>
                                    <option value="AMBIENTAL_Y_FORESTAL">AMBIENTAL Y FORESTAL</option>
                                    <option value="AGRICOLAS">AGRICOLAS</option>
                                    <option value="ECONOMISTAS">ECONOMISTAS</option>
                                    <option value="QUIMICOS">QUIMICOS</option>
                                    <option value="AGRONOMIA">AGRONOMÍA</option>
                                    <option value="MECANICOS_Y_ELECTRICISTAS">MECANICOS Y ELECTRICISTAS</option>
                                    <option value="ELECTRONICOS">ELECTRONICOS</option>
                                    <option value="MINAS">MINAS</option>
                                    <option value="AGROINDUSTRIALES">AGROINDUSTRIALES</option>
                                    <option value="ESTADISTICOS">ESTADISTICOS</option>
                                    <option value="TOPOGRAFOS">TOPOGRAFOS</option>
                                    <option value="PESQUEROS">PESQUEROS</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Especialidad</label>
                                <select class="form-control" name="selectProvincia">
                                    <option>NINGUNO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-suc btn-block"><span
                                        class="fa fa-plus"></span> Agregar</button>
                            </div>
                            <div class="col-md-6">
                                <button type="reset" class="btn btn-dan btn-block"><span class="fa fa-times"></span>
                                    Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php
                endif;
            ?>
            
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
    <script src="./assets/js/cap_esp.js"></script>
    <script>
        var search_dni = $('#search_dni').val();
        $.ajax({
            data: {
                "search_dni": search_dni
            },
            url: 'a_employees.php',
            type: "get"
        });
    </script>
</body>

</html>