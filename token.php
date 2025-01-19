<?php
include_once 'config/init-1.php';


    if ($ref=@$_GET['q']) {
        if ($_POST["cgis"] == "123456") {
            header("location:dash.php");
        } else if ($_POST['pso'] == "345126") {
            header("location:dash.php?r=2");
        } else if ($_POST["cso"] == "613245") {
            header("location:dash.php?r=3");
        } else if ($_POST["pas"] == "162543") {
            header("location:dash.php?r=4");
        } else {
            header("location:$ref?w=Wrong Passcode");
        }
    } else {
        header("location:welcome.php");
    }
?>