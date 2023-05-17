<?php
require "libs/vars.php";
require "libs/func.php";


$title = $description = $image = $url = $category = "";

$title_err = $description_err = $image_err = $url_err = $category_err = "";

$categories = getCategories();




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // validate title

    $input_title = trim($_POST["title"]);

    if (empty($input_title)) {

        $title_err = "Please enter a title.";

    } else {

        $title = formControlInjection($input_title);

    }

    // validate description

    $input_description = trim($_POST["description"]);

    if (empty($input_description)) {

        $description_err = "Please enter a description.";

    } else if (strlen($input_description) < 10) {

        $description_err = "Description must be at least 10 characters.";

    } else {

        $description = formControlInjection($input_description);

    }


    // validate image


    $input_image = trim($_POST["image"]);

    if (empty($input_image)) {

        $image_err = "Please enter a image.";

    } else {

        $image = formControlInjection($input_image);

    }

    // validate url


    $input_url = trim($_POST["url"]);

    if (empty($input_url)) {

        $url_err = "Please enter a url.";

    } else {

        $url = formControlInjection($input_url);

    }

    // validate category

    $select_category = $_POST["category"];

    if ($select_category == "0") {

        $category_err = "kategori seçmelisiniz.";

    } else {
        $category = $_POST["category"];
    }




    if (empty($title_err) && empty($description_err) && empty($image_err) && empty($url_err) && empty($category_err)) {

        if (createNewMovie($title, $description, $image, $url, $category)) {

            $_SESSION["message"] = "$title created successfully.Will be published after approval.";
            $_SESSION["message_type"] = "success";

            header("Location: admin.php");

        } else {

            $_SESSION["message"] = "Error creating $title. Please try again.";
            $_SESSION["message_type"] = "danger";


        }
    }


}

?>

<?php require "views/_header.php"; ?>
<?php require "views/navbar.php"; ?>

<div class="container my-3">

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="create.php" method="POST">
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title"
                            class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $title; ?>">
                        <div class="invalid-feedback">
                            <?php echo $title_err; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="content">Description</label>
                        <textarea name="description" id="description"
                            class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                        <div class="invalid-feedback">
                            <?php echo $description_err; ?>
                        </div>
                    </div>

                    <div class="mb-3">

                        <label for="image">Photo Url</label>
                        <input type="text" name="image" id="image"
                            class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $image; ?>">
                        <div class="invalid-feedback">
                            <?php echo $image_err; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="url">Url</label>
                        <input type="text" name="url" id="url"
                            class="form-control <?php echo (!empty($url_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $url; ?>">
                        <div class="invalid-feedback">
                            <?php echo $url_err; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category">Category</label>
                        <select name="category" id="category"
                            class="form-control <?php echo (!empty($category_err)) ? 'is-invalid' : ''; ?>">
                            <option value="0">Select a category</option>
                           <?php foreach ($categories  as $c) {
                                    echo "<option value='{$c["id"]}'> {$c["name"]} </option>";
                                }?>
                        </select>
                        <span class="invalid-feedback"><?php echo $category_err; ?></span>
                        <script type="text/javascript">
                            document.getElementById('category').value = "<?php echo $category; ?>";
                        </script>
                    </div>


                    <div class="mb-3">
                        <input type="submit" value="Create" class="btn btn-success">
                        <a href="admin.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>





<?php require "views/_footer.php"; ?>