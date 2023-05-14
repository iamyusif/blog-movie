<?php
require "views/navbar.php";
require "libs/vars.php";
require "libs/func.php";
require "views/_header.php";


if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = getUser($username);

    if (!is_null($user) and $username == $user["username"] and $password == $user["password"]) {

        setcookie("auth[username]", $user["username"], time() + (60 * 60)); // auth yazma sebebimiz cookie
        setcookie("auth[name]", $user["name"], time() + (60 * 60));

      
        header("Location: index.php");
    } else {
        echo '<div class="alert alert-danger text-center" role="alert">
            Username or password is wrong!
          </div>';
    }
}

?>
<div class="container my-3">
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <form action="login.php" method="POST">

                        <div class="mb-3">

                            <label for="username">Login</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>

                        <div class="mb-3">

                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <button type="submit" name="login" class="btn btn-primary">Login ol</button>

                    </form>


                </div>

            </div>
        </div>
        <?php require "views/_footer.php"; ?>