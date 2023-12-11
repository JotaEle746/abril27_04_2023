<?php 
    require_once('includes/session.php');
    require_once('includes/conn.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Ver usuarios</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="vendors/datatables/datatables.min.css">
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
                <li class="active">
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

            <div class="panel panel-default sammacmedia">
                <div class="panel-heading">Todos los usuarios</div>
                <div class="panel-body">
                    <table class="table table-striped thead-dark table-bordered table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Nombre de usuario</th>
                                <th>N° de celular</th>
                                <th>Lugar de entrega</th>
                                <th>Nivel de acceso</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <?php
                            $query = mysqli_query($mysqli, "SELECT * FROM users");                    
                            while ($row = mysqli_fetch_array($query)) :
                        ?>

                        <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['surname'];?></td>
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php echo $row['lugar_entrega'];?></td>
                            <td><?php echo $row['permission'];?></td>
                            <td>
                                <a href="v_users.php?idx=<?php echo $row['id']; ?>" data-toggle="modal"
                                    class="btn btn-danger"><span class="fa fa-times"></span> Eliminar</a>
                            </td>
                        </tr>
                        <?php
                            endwhile;
                            
                            if (isset($_GET['idx']) && is_numeric($_GET['idx'])) :
                                $id = $_GET['idx'];

                                if ($stmt = $mysqli->prepare("DELETE FROM users WHERE id = ? LIMIT 1")) :
                                    $stmt->bind_param("i", $id);
                                    $stmt->execute();
                                    $stmt->close();
                        ?>
                        <div class="alert alert-success strover" id="sams1">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong> Successfully!
                            </strong><?php echo'Record Successfully deleted please refresh this page';?>
                        </div>

                        <?php
                                else:
                        ?>

                        <div class="alert alert-danger samuel" id="sams1">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong> Error! </strong><?php echo'OOPS Inténtalo de nuevo, algo salió mal';?>
                        </div>

                        <?php
                                endif;
                                $mysqli->close();
                            //else:
                            endif;
                        ?>
                    </table>
                </div>
            </div>
            <div class="line"></div>
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
            $('#myTable').DataTable();
        });
    </script>

</body>

</html>