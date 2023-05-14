<?php

require "libs/vars.php";

require "libs/func.php";


$id = $_GET["id"];

if (deleteMovie($id)) {

    $_SESSION["message"] = "$id deleted successfully.";
    $_SESSION["message_type"] = "danger";
    header("Location: admin.php");
} else {
    $_SESSION["message"] = "$id could not be deleted.";
    $_SESSION["message_type"] = "danger";

}


header("Location: admin.php");

?>