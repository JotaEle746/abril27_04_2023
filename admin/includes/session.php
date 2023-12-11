<?php
    session_start();
    if(!$_SESSION['username']){
        header('Location:../index.php');
    }
    // } else {
    //     //header('Location:../index.php');
    // }
    
?>