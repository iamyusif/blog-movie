<?php




if (isset($_GET["num"]) && is_numeric($_GET["num"])) {
    $results = getMoviesFromCategory($_GET["num"]);
} elseif (isset($_GET["q"])) {
    $results = searchMoviesKeywords($_GET["q"]);
} else {
    $results = getMovies();

}

?>

<?php if (mysqli_num_rows($results) > 0): ?>


    <?php while ($movie = mysqli_fetch_assoc($results)): ?>

        <?php if ($movie["active"]): ?>
            <div class="card mb-3">
                <div class="row">
                    <div class="col-3">
                        <img src="<?php echo $movie["image"]; ?>" class="card-img-top" alt="<?php echo $movie["title"]; ?>">
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="movie-details.php?id=<?php echo $movie["id"]; ?>">
                                    <?php echo $movie["title"]; ?>

                                </a>
                            </h5>
                            <p class="card-text">
                                <?php echo $movie["description"]; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php endwhile; ?>

<?php else: ?>
    <div class="alert alert-warning" role="alert">
        No movies found!
    </div>

<?php endif; ?>