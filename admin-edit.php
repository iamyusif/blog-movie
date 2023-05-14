<?php
require "libs/vars.php";
require "libs/func.php";

$id = $_GET["id"];

$results = getMovieById($id);

$selectedMovie = mysqli_fetch_assoc($results);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $url = $_POST["url"];
    $active = isset($_POST["active"]) ? 1 : 0;

    if (editMovie($id, $title, $description, $image, $url, $active)) {

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
    <div class="row">
        <div class="col-9">
            <?php if (isset($_COOKIE["auth"])): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <form method="POST">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="<?php echo $selectedMovie["title"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="content">Description</label>
                            <textarea name="description" id="description" class="form-control"
                                ?><?php echo $selectedMovie["description"]; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image">Photo Url</label>
                            <input type="text" name="image" id="image" class="form-control"
                                value="<?php echo $selectedMovie["image"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="url">Url</label>
                            <input type="text" name="url" id="url" class="form-control"
                                value="<?php echo $selectedMovie["url"]; ?>">
                        </div>

                    

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="active" id="active" <?php echo $selectedMovie["active"] ? "checked" : ""; ?>>
                            <label for="active" class="form-check-label">Publish</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">You are not authorized to view this page.</div>
            <?php endif; ?>
            <?php require "views/_footer.php"; ?>