<?php
require "libs/vars.php";
require "libs/func.php";

$id = $_GET["id"];

$results = getMovieById($id);

$selectedMovie = mysqli_fetch_assoc($results);

$categories = getCategories();

$selectedCategories = getCategoriesByChexBoxId($id);



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $url = $_POST["url"];
    $categories = $_POST["categories"];
    $active = isset($_POST["active"]) ? 1 : 0;



    if (editMovie($id, $title, $description, $image, $url, $active)) {

        clearMovieCategories($id);

        if(count($categories) > 0) {
            addMovieArrayCategories($id, $categories);
        }

        $_SESSION["message"] = "$title edited successfully.";
        $_SESSION["message_type"] = "success";
        header("Location: admin.php");
    } else {
        $_SESSION["message"] = "$title could not be edited.";
        $_SESSION["message_type"] = "danger";

    }
}
?>
<?php require "views/_header.php"; ?>
<?php require "views/navbar.php"; ?>
<div class="container my-3">

    <div class="card">

        <div class="card-body">

        <form method="POST">
            <div class="row">

                <div class="col-9">

                    <div id="edit-form">

                        <div class="mb-3">
                            <label for="title" class="form-label">title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                value="<?php echo $selectedMovie["title"] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">description</label>
                            <textarea name="description" id="description"
                                class="form-control"><?php echo $selectedMovie["description"] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">image</label>
                            <input type="text" class="form-control" name="image" id="image"
                                value="<?php echo $selectedMovie["image"] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">url</label>
                            <input type="text" class="form-control" name="url" id="url"
                                value="<?php echo $selectedMovie["url"] ?>">
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="active" id="active" <?php echo $selectedMovie["active"] ? "checked" : ""; ?>>
                            <label for="active" class="form-check-label">Publish</label>
                        </div>

                        <input type="submit" value="Submit" class="btn btn-primary">


                    </div>

                </div>

                <div class="col-3">
                    <?php foreach ($categories as $c): ?>
                        <div class="form-check">
                        <label for="category_<?php echo $c["id"];?>"><?php echo $c["name"];?></label>
                        <input type="checkbox" id="category_<?php echo $c["id"];?>" name="categories[]" class="form-check-input" value="<?php echo $c["id"];?>"
                        

                        <?php

                        $isChecked = false;

                        foreach ($selectedCategories as $sc) {
                            if ($sc["id"] == $c["id"]) {
                                $isChecked = true;
                                
                            }
                        }

                        if ($isChecked) {
                            echo "checked";
                        }

                        ?>
                

                        >
                
                        </div>
                    <?php endforeach; ?>
                    

                </div>

            </div>
        </form>

        </div>
    </div>
</div>


<?php require "views/_footer.php"; ?>