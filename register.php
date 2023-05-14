<?php
require "views/navbar.php";
require "libs/vars.php";
require "libs/func.php";
require "views/_header.php";


if (isset($_POST["register"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    if (empty($name) or empty($email) or empty($username) or empty($password)) {
        echo '<div class="alert alert-danger text-center" role="alert">
            Please fill all fields!
          </div>';
        return;

    }

    if (getUser($username)) {
        echo '<div class="alert alert-danger text-center" role="alert">
            User already exists!
          </div>';
        return;
    }


    createUser($name, $email, $username, $password);

    $user = getUser($username);

    header("Location: login.php");


}

?>
<div class="container my-3">
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <form action="register.php" method="POST">

                        <div class="mb-3">

                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class="mb-3">

                            <label for="name">E-mail</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>



                        <div class="mb-3">

                            <label for="username">Name</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>

                        <div class="mb-3">

                            <label for="username">Login</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>

                        <div class="mb-3">

                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <button type="submit" name="register" class="btn btn-primary">Register</button>

                    </form>


                </div>

            </div>
        </div>
        <?php require "views/_footer.php"; ?>