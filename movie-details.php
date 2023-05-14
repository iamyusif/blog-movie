<?php

require "libs/vars.php";

require "libs/func.php";


if (!isset($_GET["id"]) or !is_numeric($_GET["id"])) {
    header("location: 404.php");

}

$results = getMovieById($_GET["id"]);

$movie = mysqli_fetch_assoc($results);

if (!$movie["active"]) {
    header("location: 404.php");
}

?>

<?php require "views/_header.php"; ?>
<?php require "views/navbar.php"; ?>
<div class="container my-3">
    <div class="row">
        <div class="col-12">
        <div class="card p-1">
  <div class="row g-0">
    <div class="col-md-3">
      <img src="<?php echo $movie["image"]; ?>" class="img-fluid" alt="<?php echo $movie["title"]; ?>">
    </div>
    <div class="col-md-9">
      <div class="card-body">
            <h5 class="card-title"><?php echo $movie["title"]; ?></h5>
            <p class="card-text"><?php echo $movie["description"]; ?></p>
            <p class="card-text"><small class="text-muted">Last updated </small></p>
      </div>
    </div>
  </div>
</div>
      </div>

    </div>
    <?php require "views/_footer.php"; ?>