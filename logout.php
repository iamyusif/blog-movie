<?php 

setcookie("auth[username]","", time() - (60*60)); // auth yazma sebebimiz cookie
setcookie("auth[name]","", time() - (60*60));

header("Location: login.php");

?>