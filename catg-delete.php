<?php

require "libs/vars.php";

require "libs/func.php";


$id = $_GET["id"];

if (deleteCategory($id)) {

   echo "Success";
} else {
    echo "Error";
}

header("Location: catg.php");

?>