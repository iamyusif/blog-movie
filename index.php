

<?php 

require "libs/vars.php"; 

require "libs/func.php";



?>

<?php require "views/_header.php"; ?>
<?php require "views/navbar.php"; ?>
<div class="container my-3">
    <div class="row">
        <div class="col-3">
           <?php require "views/_menu.php"; ?>
        </div>
        <div class="col-9">
           <?php require "views/_title.php"; ?>
           <?php require "views/_movies.php"; ?>
        </div>
    </div>
    <?php require "views/_footer.php"; ?>