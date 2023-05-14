<?php
require "libs/vars.php";
require "libs/func.php";

$id = $_GET["id"];

$results = getCategoryById($id);

$selectedName = mysqli_fetch_assoc($results);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];


    if (editCategory($id, $name)) {

        header("Location: catg.php");
        
    } else {
        echo "Error";
    }
}
?>
<?php require "views/_header.php"; ?>
<?php require "views/navbar.php"; ?>
<div class="container my-3">
    <div class="row">
        <div class="col-9">
            <?php if (isset($_COOKIE["auth"])): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <form method="POST">
                                <label for="name">name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="<?php echo $selectedName["name"]; ?>">
                        </div>
                      
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">You are not authorized to view this page.</div>
            <?php endif; ?>
            <?php require "views/_footer.php"; ?>