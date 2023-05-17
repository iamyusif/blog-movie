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

function createNewMovie(string $title, string $description, string $image, string $url, int $category, int $active = 1) // create movie in db.json file
{
    include "dbs.php";

    $query = "INSERT INTO movies (title, description, image, url, category_id, active) VALUES (?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($conections, $query);

    mysqli_stmt_bind_param($result, "ssssii", $title, $description, $image, $url, $category, $active);
    mysqli_stmt_execute($result);
    mysqli_stmt_close($conections);
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

function editMovie(int $id, string $title, string $description, string $image, string $url, int $active)
{

    include "dbs.php";

    $query = "UPDATE movies SET title = '$title', description = '$description', image = '$image', url = '$url',active = '$active' WHERE id = $id";

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

    $query = "SELECT * FROM movies";

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


function clearMovieCategories(int $id)
{
    include "dbs.php";

    $query = "DELETE FROM movies_category WHERE movies_id = $id";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);

    return $results;
}

function addMovieArrayCategories(int $id, array $categories)
{
    include "dbs.php";

    $query = "";

    foreach ($categories as $catID) {
        $query .= "INSERT INTO movies_category (movies_id, category_id) VALUES ($id, $catID);";

    }

    $results = mysqli_multi_query($conections, $query);

    echo mysqli_error($conections);

    return $results;


}


function getCategoriesByMovieId(int $id)
{

    include "dbs.php";

    $query = "SELECT c.name from movies_category mc inner join categories c on mc.category_id = c.id WHERE mc.movies_id = $id";

    $results = mysqli_query($conections, $query);

    mysqli_close($conections);

    return $results;
}


function getCategoriesByChexBoxId($id)
{

    include "dbs.php";

    $query = "SELECT c.id,c.name from movies_category mc inner join categories c on mc.category_id = c.id WHERE mc.movies_id = $id";

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


function getMoviesFromCategory($id)
{
    include "dbs.php";

    $query = "SELECT * FROM movies_category mc inner join movies m on mc.movies_id = m.id WHERE mc.category_id = $id";

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


function searchMoviesKeywords($q) // search movies
{
    include "dbs.php";

    $query = "SELECT * FROM movies WHERE title LIKE '%$q%'";

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