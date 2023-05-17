<?php
$countsF = countMovies();

$counts = mysqli_fetch_assoc($countsF);

?>

<h2>Popular Movies </h2>
<!-- <p> Movies count :

    <?php //echo $counts["count"]; ?>
    
</p> -->