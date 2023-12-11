<?php

    $sql1    = "SELECT count(id) As total FROM users";
    $result1 = mysqli_query($mysqli, $sql1);
    $values1 = mysqli_fetch_assoc($result1);
    $users   = $values1['total'];

    $sql2       = "SELECT count(id) As total2 FROM employees";
    $result2    = mysqli_query($mysqli, $sql2);
    $values2    = mysqli_fetch_assoc($result2);
    $colegiados = $values2['total2'];

    $sql3               = "SELECT COUNT(situacion) AS total3 FROM employees WHERE situacion = '1'";
    $result3            = mysqli_query($mysqli, $sql3);
    $values3            = mysqli_fetch_assoc($result3);
    $cantidad_entregada = $values3['total3'];
    
    $sql4               = "SELECT COUNT(situacion) AS total4 FROM employees WHERE situacion = '1' /* AND fecha_incorporacion >= '2022-04-01' */";
    $result4           = mysqli_query($mysqli, $sql4);
    $values4            = mysqli_fetch_assoc($result4);
    $cantidad_entregada = $values4['total4'];
?>