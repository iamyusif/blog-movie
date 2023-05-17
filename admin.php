<?php

require "libs/vars.php";

require "libs/func.php";



?>

<?php require "views/_header.php"; ?>
<?php require "views/_message.php"; ?>

<?php require "views/navbar.php"; ?>
<div class="container my-3">
    <div class="row">

            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50px" class="text-center">Image</th>
                            <th style="width: 130px;" class="text-center">Title</th>
                            <th style="width: 130px;" class="text-center">Url</th>
                            <th style="width: 130px;" class="text-center">Category</th>
                            <th style="width: 30px;" class="text-center">Active</th>
                            <th style="width: 150px;" class="text-center">Actions</th>

                        </tr>
                    </thead>
                    <tbody>

                    <a href="create.php" class="btn btn-sm btn-success">Add new movie</a> <br><br>

                        <?php $results = getMovies(); while ($movie = mysqli_fetch_assoc($results)) : ?>
                            <tr>
                                <td class="text-center"><img src="<?php echo $movie["image"]; ?>" width="75px"></td>
                                <td class="text-center">
                                    <?php echo $movie["title"]; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $movie["url"]; ?>
                                </td>
                                <td class="text-center">

                                    <?php 

                                    $result = getCategoriesByMovieId($movie["id"]);

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($category = mysqli_fetch_assoc($result)) {
                                            echo "<li>" . $category["name"] . "</li>";
                                        }
                                        
                                       
                                    } else {
                                        echo "<li>No category</li>";
                                    }

                                    echo "<ul>";

                                    
                                    ?>
                                    
                                <?php if ($movie["active"]): ?>

                                    <td class="text-center"><i class="fa-solid fa-check"></i></td>
                                <?php else: ?>
                                    <td class="text-center"><i class="fa-solid fa-xmark"></i></td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <a href="admin-edit.php?id=<?php echo $movie["id"]; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="admin-delete.php?id=<?php echo $movie["id"]; ?>" class="btn btn-sm btn-danger">Delete</a>


                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
    </div>
    <?php require "views/_footer.php"; ?>