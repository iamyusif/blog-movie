<?php
require "libs/vars.php";
require "libs/func.php";


$name = "";
$name_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // validate name

    $input_name = trim($_POST["name"]);

    if (empty($input_name)) {

        $name_err = "Please enter a name.";

    } else {

        $name = formControlInjection($input_name);

    }


    // Check input errors before inserting in database

    if (empty($name_err)) {

        // Prepare an insert statement

        $result = createCategories($name);

        if ($result) {

            header("location: catg.php");

            exit();

        } else {

            echo "Something went wrong. Please try again later.";

        }

    }



}

?>

<?php require "views/_header.php"; ?>
<?php require "views/navbar.php"; ?>

<div class="container my-3">
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <form action="catg_create.php" method="POST">
                            <label for="name">name</label>
                            <input type="text" name="name" id="name"
                                class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $name; ?>">
                            <div class="invalid-feedback">
                                <?php echo $name_err; ?>
                            </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Add</button>


                </div>



            </div>

            <?php require "views/_footer.php"; ?>