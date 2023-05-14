<?php



// ----------------------USER SECTION START----------------------//

function getData() // get global data from db.json file 
{
    $myFile = fopen("db.json", "r") or die("Unable to open file!");
    $size = filesize("db.json");
    $result = json_decode(fread($myFile, $size), true);
    fclose($myFile);
    return $result;

}

function getUSer(string $username) // get user from db.json file 
{
    $users = getData()["users"];

    foreach ($users as $user) {
        if ($user["username"] == $username) {
            return $user;
        }
    }
    return null;
}

function createUser(string $name, string $email, string $username, string $password) // create user in db.json file 
{
    $users = getData()["users"];
    $users[] = [
        "id" => count($users) + 1,
        "name" => $name,
        "email" => $email,
        "username" => $username,
        "password" => $password,
        "role" => "user"
    ];

    $data = getData();
    $data["users"] = $users;

    $myFile = fopen("db.json", "w") or die("Unable to open file!");
    fwrite($myFile, json_encode($data, JSON_PRETTY_PRINT));
    fclose($myFile);


}

// ----------------------USER SECTION END----------------------//





// ----------------------MOVIE SECTION START----------------------//

function createNewMovie(string $title, string $description, string $image, string $url, int $active = 1) // create movie in db.json file
{
    include_once "dbs.php";

    $query = "INSERT INTO movies (title, description, image, url,active) VALUES (?, ?, ?, ?, ?)";

    $result = mysqli_prepare($conections, $query);

    mysqli_stmt_bind_param($result, "ssssi", $title, $description, $image, $url, $active);

    mysqli_stmt_execute($result);

    mysqli_stmt_close($result);

    return $result;

}

function getMovieById(int $id) // get movie by id from db.json file
{
    include "dbs.php";

    $query = "SELECT * FROM movies WHERE id = $id";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);
    return $results;
}

function editMovie(int $id, string $title, string $description, string $image, string $url, int $active) // edit movie in db.json file
{

    include "dbs.php";

    $query = "UPDATE movies SET title = '$title', description = '$description', image = '$image', url = '$url', active = '$active' WHERE id = $id";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);

    return $results;

}


function deleteMovie(int $id) // delete movie from db.json file
{
    include "dbs.php";

    $query = "DELETE FROM movies WHERE id = $id";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);

    return $results;


}


function getMovies()
{

    include "dbs.php";

    $query = "SELECT b.id, b.title, b.description, b.image, b.url, b.active, c.name from movies b INNER JOIN categories c ON b.category_id = c.id";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);

    return $results;
}


function countMovies(int $active = 1)
{
    include "dbs.php";

    
    $query = "SELECT COUNT(*) AS count FROM movies WHERE active = $active";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);

    return $results;
}




// ----------------------MOVIE SECTION END----------------------//






// ----------------------CATEGORY SECTION START----------------------//

function getCategories()
{

    include "dbs.php";

    $query = "SELECT * FROM categories";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);

    return $results;
}


function createCategories(string $name) // create category in db.json file
{
    include_once "dbs.php";

    $query = "INSERT INTO categories (name) VALUES (?)";

    $result = mysqli_prepare($conections, $query);

    mysqli_stmt_bind_param($result, "s", $name);

    mysqli_stmt_execute($result);

    mysqli_stmt_close($result);

    return $result;

}

function getCategoryById(int $id) // get category by id from db.json file
{
    include "dbs.php";

    $query = "SELECT * FROM categories WHERE id = $id";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);
    return $results;
}

function editCategory(int $id, string $name) // edit category in db.json file
{

    include "dbs.php";

    $query = "UPDATE categories SET name = '$name' WHERE id = $id";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);

    return $results;

}


function deleteCategory(int $id) // delete category from db.json file
{
    include "dbs.php";

    $query = "DELETE FROM categories WHERE id = $id";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);

    return $results;

}

// ----------------------CATEGORY SECTION END----------------------//





// ----------------------CONTROL SECTION START----------------------//


function formControlInjection($data) // form control injection
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    $data = htmlentities($data);
    return $data;

}

// ----------------------CONTROL SECTION END----------------------//






?>