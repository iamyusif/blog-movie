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
                            <th style="width: 10px" class="text-center">Id</th>
                            <th style="width: 10px;" class="text-center">Name</th>
                            <th style="width: 10px;" class="text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <a href="catg_create.php" class="btn btn-sm btn-success">Add new category</a> <br><br>
                    <?php $results = getCategories(); while($category = mysqli_fetch_assoc($results)): ?>
                                <tr>
                                <td class="text-center">
                                <?php echo $category["id"]; ?>
                                </td>
                                <td class="text-center">
                                <?php echo $category["name"]; ?>
                                </td>
                                <td class="text-center">
                                    <a href="catg-edit.php?id=<?php echo $category["id"]; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="catg-delete.php?id=<?php echo $category["id"]; ?>" class="btn btn-sm btn-danger">Delete</a>


                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>

    </div>
    <?php require "views/_footer.php"; ?>