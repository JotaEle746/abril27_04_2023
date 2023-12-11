<?php
    require_once('includes/session.php');
    require_once('includes/conn.php');
    date_default_timezone_set('America/Lima');

    $fecha_actual = date("Y-m-d H:i:s");
    $fecha_entrega_completa = '2022-12-22 00:00:00';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Buscar colegiado</title>

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
                <li class="active">
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

            <?php
                if(isset($mysqli, $_POST['submit'])) :
                    $dni               = $_POST['dni'];
                    $query_user        = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '{$_SESSION['username']}'");
                    $row               = mysqli_fetch_array($query_user);
                    $id_user_entrega   = $row['id'];
                    $lugar_entrega     = $row['lugar_entrega'];
                    $fechahora_entrega = date("Y-m-d H:i:s");

                    //$query_employees = mysqli_query($mysqli, "SELECT * FROM employees WHERE dni = '$dni'");
                    $query_employees = mysqli_query($mysqli2, "SELECT c.id, e.fecha_incorporacion, c.situacion FROM colegiados c join colegiado_especialidades e ON c.id = e.id_colegiado WHERE dni = '$dni' AND e.id = ( SELECT MIN(id) FROM colegiado_especialidades WHERE id_colegiado = c.id
                      )");
                    $row_employees   = mysqli_fetch_array($query_employees);

                    if($fecha_actual < $fecha_entrega_completa) {
                        if($row_employees['situacion'] == 0) {
                            $query_update = "UPDATE employees SET situacion = '1', lugar_entrega = '$lugar_entrega', fechahora_entrega = '$fechahora_entrega', id_user_entrega = '$id_user_entrega' WHERE dni = '$dni'";
                            $res = mysqli_query($mysqli, $query_update);
                        } else if($row_employees['situacion'] == 1) {
                            if($row_employees['fecha_incorporacion'] < '2022-04-01'){
                                $query_update = "UPDATE colegiados SET situacion = '2', lugar_entrega = '$lugar_entrega', fechahora_entrega = '$fechahora_entrega', id_user_entrega = '$id_user_entrega' WHERE dni = '$dni'";
                                $res = mysqli_query($mysqli, $query_update);
                            }
                        }
                    }else if($fecha_actual >= $fecha_entrega_completa) {
                        if($row_employees['situacion'] == 0){
                            if($row_employees['fecha_incorporacion'] >= '2023-04-01'){
                                $query_update = "UPDATE colegiados SET situacion = '1', lugar_entrega = '$lugar_entrega', fechahora_entrega = '$fechahora_entrega', id_user_entrega = '$id_user_entrega' WHERE dni = '$dni'";
                                $res = mysqli_query($mysqli2, $query_update);
                            }else {
                                $query_update = "UPDATE colegiados SET situacion = '3', lugar_entrega = '$lugar_entrega', fechahora_entrega = '$fechahora_entrega', id_user_entrega = '$id_user_entrega' WHERE dni = '$dni'";
                                $res = mysqli_query($mysqli2, $query_update);
                            }
                        }else if($row_employees['situacion'] == 1) {
                            if($row_employees['fecha_incorporacion'] < '2022-04-01'){
                                $query_update = "UPDATE employees SET situacion = '2', lugar_entrega = '$lugar_entrega', fechahora_entrega = '$fechahora_entrega', id_user_entrega = '$id_user_entrega' WHERE dni = '$dni'";
                                $res = mysqli_query($mysqli, $query_update);    
                            }
                        }
                    }

                    if($res == 1):
                
            ?>

            <div class="alert alert-warning sammac animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Exitosamente </strong><?php echo 'El registro de entrega fue satisfactorio'; ?>
            </div>

            <?php
                    else:
            ?>

            <div class="alert alert-danger samuel animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Error! </strong><?php echo 'Ocurrio algo inesperado'; ?>
            </div>

            <?php
                    endif;
                endif;
            ?>


            <div class="panel panel-default sammacmedia">
                <div class="panel-heading">Buscar colegiado</div>
                <div class="panel-body" style="display: flex; justify-content: center; align-items: center;">
                    <form class="form-inline my-2 my-lg-0" action="all_employees.php" method="get">
                        <div class="row form-group">
                            <input class="form-control" type="text" placeholder="DNI o Código CIP" name="search_dni" id="search_dni" required>
                            <input class="btn btn-success my-2 my-sm-0" value="Buscar" type="submit"/>
                        </div>
                    </form>
                </div>
            </div>

            

            <?php
                if (isset($_GET['search_dni'])):
                    if(strlen($_GET['search_dni']) == 8){
                        $value_dni = mysqli_real_escape_string($mysqli2, $_GET['search_dni']);    
                        $sql_search = "SELECT c.dni, c.codigo_cip as cip, c.nombres as name, c.paterno, c.materno, c.fecha_ultimo_pago as fechaultimopago, e.fecha_incorporacion as fecha_incorporacion, es.nombre as especialidad, cap.nombre as capitulo, c.situacion, c.lugar_entrega, c.fechahora_entrega FROM colegiados c join colegiado_especialidades e ON c.id = e.id_colegiado join especialidades es ON es.id = e.id_especialidad join capitulos cap ON cap.id = es.id_capitulo WHERE c.dni = '$value_dni' AND e.id = (
                            SELECT MIN(id)
                            FROM colegiado_especialidades
                            WHERE id_colegiado = c.id
                          )";
                    } else if(strlen($_GET['search_dni']) < 8) {
                        $value_cip = mysqli_real_escape_string($mysqli2, $_GET['search_dni']);    
                        $sql_search = "SELECT * FROM colegiados WHERE codigo_cip = '$value_cip'";
                    }
                    /* 
                    if(strlen($_GET['search_dni']) == 8){
                        $value_dni = mysqli_real_escape_string($mysqli2, $_GET['search_dni']);    
                        $sql_search = "SELECT * FROM colegiados WHERE dni = '$value_dni'";
                    } else if(strlen($_GET['search_dni']) < 8) {
                        $value_cip = mysqli_real_escape_string($mysqli2, $_GET['search_dni']);    
                        $sql_search = "SELECT * FROM colegiados WHERE codigo_cip = '$value_cip'";
                    } */

                    $res_search = mysqli_query($mysqli2, $sql_search);       
                    
                    if (mysqli_num_rows($res_search) > 0) :
                        $row = mysqli_fetch_array($res_search);
            ?>

            <?php
                        if($row['situacion'] == 0) :
                            if($row['fecha_incorporacion'] >= '2023-04-01'):

            ?>

            <div style="background-color: #00C853 !important;
                border-radius: 0.3rem;
                padding-block: .3rem;
                padding-inline: 1rem;
                margin-bottom: 20px;
                text-align: center;">
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 400;">Entrega parcial disponible</p>
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 400;">Incorporación despues de la fecha 01/04/2023</p>
            </div>

            <?php
                            else:
            ?>

            <div style="background-color: #00C853 !important;
                border-radius: 0.3rem;
                padding-block: .3rem;
                padding-inline: 1rem;
                margin-bottom: 20px;
                text-align: center;">
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 400;">Entrega disponible</p>
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 400;"></p>
            </div>

            <?php
                            endif;
                        elseif($row['situacion'] == 1) :
                            if($row['fecha_incorporacion'] >= '2022-04-01'):
            ?>

            <div style="background-color: #B00020 !important;
                border-radius: 0.3rem;
                padding-block: .3rem;
                padding-inline: 1rem;
                margin-bottom: 20px;
                text-align: center;">
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 500;">La entrega ya fue realizada en <span><?php echo $row['lugar_entrega']; ?></span></p>
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 500;">La fecha y hora de entrega fueron: <span><?php echo $row['fechahora_entrega']; ?></span></p>
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 500;">AL SER UN COLEGIADO NUEVO, SOLO LE CORRESPONDE UNA ENTREGA PARCIAL</p>
            </div>

            <?php
                            else:
            ?>

            <div style="background-color: #FFC107 !important;
                border-radius: 0.3rem;
                padding-block: .3rem;
                padding-inline: 1rem;
                margin-bottom: 20px;
                text-align: center;">
                <p style="color: #212121 !important; margin: 5px; font-weight: 500;">La entrega ya fue realizada en <span><?php echo $row['lugar_entrega']; ?></span></p>
                <p style="color: #212121 !important; margin: 5px; font-weight: 500;">La fecha y hora de entrega fueron: <span><?php echo $row['fechahora_entrega']; ?></span></p>
                <p style="color: #212121 !important; margin: 5px; font-weight: 500;"></p>
            </div>

            <?php
                            endif;
                        elseif($row['situacion'] == 2):
            ?>

            <div style="background-color: #B00020 !important;
                border-radius: 0.3rem;
                padding-block: .3rem;
                padding-inline: 1rem;
                margin-bottom: 20px;
                text-align: center;">
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 500;">La entrega ya fue realizada en <span><?php echo $row['lugar_entrega']; ?></span></p>
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 500;">La fecha y hora de entrega fueron: <span><?php echo $row['fechahora_entrega']; ?></span></p>
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 500;"></p>
            </div>

            <?php
                        elseif($row['situacion'] == 3):
            ?>

            <div style="background-color: #B00020 !important;
                border-radius: 0.3rem;
                padding-block: .3rem;
                padding-inline: 1rem;
                margin-bottom: 20px;
                text-align: center;">
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 500;">La entrega ya fue realizada: <span><?php echo $row['lugar_entrega']; ?></span></p>
                <p style="color: #FFFFFF !important; margin: 5px; font-weight: 500;">La fecha y hora de entrega fueron: <span><?php echo $row['fechahora_entrega']; ?></span></p>
            </div>

            <?php
                        endif;
            ?>

            <div class="panel panel-default sammacmedia">
                <div class="panel-heading">Datos del colegiado</div>
                <div class="panel-body">
                    <form method="post" action="all_employees.php" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>DNI <span style="font-weight: 400; color: red;">(*)</span></label>
                                <input type="text" class="form-control" name="dni" required maxlength="8" value="<?php echo $row['dni']; ?>" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label>Código CIP</label>
                                <input type="text" class="form-control" name="cip" minlength="4" maxlength="7" value="<?php echo $row['cip']; ?>" readonly>
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
                                <input type="text" class="form-control" name="fecha_incorporacion" value="<?php echo $row['fecha_incorporacion']; ?>" readonly placeholder="AAAA-MM-DD">
                            </div>
                            <div class="col-lg-6">
                                <label>Fecha del último pago</label>
                                <input type="text" class="form-control" name="fechaultimopago" value="<?php echo $row['fechaultimopago']; ?>" placeholder="AAAA-MM-DD" readonly>
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

                        <?php
                            if ($fecha_actual < $fecha_entrega_completa) {
                                if ($row['situacion'] == 0) {
                                    if($row['fecha_incorporacion'] >= '2023-04-01'){
                        ?>

                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-suc btn-block"><span
                                        class="fa fa-plus"></span> Registrar entrega parcial</button>
                            </div>
                        </div>

                        <?php
                                    }
                                    else {
                        ?>

                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-suc btn-block"><span
                                        class="fa fa-plus"></span> Registrar primera entrega</button>
                            </div>
                        </div>

                        <?php
                                    }
                                } else if($row['situacion'] == 1) {
                                    if($row['fecha_incorporacion'] >= '2022-04-01'){
                        ?>

                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Lugar de entrega</label>
                                <input type="text" class="form-control" name="lugar_entrega" value="<?php echo $row['lugar_entrega']; ?>" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label>Fecha y hora de entrega</label>
                                <input type="text" class="form-control" name="fechahora_entrega" value="<?php echo $row['fechahora_entrega']; ?>" readonly>
                            </div>
                        </div>

                        <?php
                                    }
                                    else{
                        ?>

                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Lugar de entrega</label>
                                <input type="text" class="form-control" name="lugar_entrega" value="<?php echo $row['lugar_entrega']; ?>" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label>Fecha y hora de entrega</label>
                                <input type="text" class="form-control" name="fechahora_entrega" value="<?php echo $row['fechahora_entrega']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-suc btn-block"><span
                                        class="fa fa-plus"></span> Registrar segunda entrega</button>
                            </div>
                        </div>

                        <?php
                                    }
                                }
                            } 
                            else if($fecha_actual >= $fecha_entrega_completa) {
                                if($row['situacion'] == 0){
                                    if($row['fecha_incorporacion'] >= '2023-04-01'){
                        ?>

                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-suc btn-block"><span
                                        class="fa fa-plus"></span> Registrar entrega parcial</button>
                            </div>
                        </div>

                        <?php
                                    } 
                                    else {
                        ?>

                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-suc btn-block"><span
                                        class="fa fa-plus"></span> Registrar entrega completa</button>
                            </div>
                        </div>

                        <?php
                                    }
                                } 
                                else if($row['situacion'] == 1) {
                                    if($row['fecha_incorporacion'] >= '2022-04-01') {
                        ?>

                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Lugar de entrega</label>
                                <input type="text" class="form-control" name="lugar_entrega" value="<?php echo $row['lugar_entrega']; ?>" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label>Fecha y hora de entrega</label>
                                <input type="text" class="form-control" name="fechahora_entrega" value="<?php echo $row['fechahora_entrega']; ?>" readonly>
                            </div>
                        </div>

                        <?php
                                    }
                                    else {
                        ?>

                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Lugar de entrega</label>
                                <input type="text" class="form-control" name="lugar_entrega" value="<?php echo $row['lugar_entrega']; ?>" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label>Fecha y hora de entrega</label>
                                <input type="text" class="form-control" name="fechahora_entrega" value="<?php echo $row['fechahora_entrega']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-suc btn-block"><span
                                        class="fa fa-plus"></span> Registrar segunda entrega</button>
                            </div>
                        </div>

                        <?php
                                    }
                                } else if($row['situacion'] == 2 or $row['situacion'] == 3) {
                        ?>

                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label>Lugar de entrega</label>
                                <input type="text" class="form-control" name="lugar_entrega" value="<?php echo $row['lugar_entrega']; ?>" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label>Fecha y hora de entrega</label>
                                <input type="text" class="form-control" name="fechahora_entrega" value="<?php echo $row['fechahora_entrega']; ?>" readonly>
                            </div>
                        </div>

                        <?php
                                } 
                            }
                        ?>

                    </form>
                </div>
            </div>

            <?php
                    else:
            ?>

            <div class="alert alert-danger samuel animated shake" id="sams1">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong> Error! </strong><?php echo 'No se encontraron datos del DNI o Código CIP'; ?>
            </div>

            <?php
                    endif;
                endif;
            ?>

        </div>

    </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="vendors/datatables/datatables.min.js"></script>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable({
                serverSide: true,
                ajax: '/all_employess.php'
            })
        });
    </script>
    <script>
        var search_dni = $('#search_dni').val();
        $.ajax({
            data: {
                "search_dni": search_dni
            },
            url: 'all_employees.php',
            type: "get"
        });
    </script>
</body>

</html>