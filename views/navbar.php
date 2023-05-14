<?php

if (!empty($_GET['q'])) {
  $keywords = $_GET['q'];

  $movies = array_filter($movies, function ($movie) use ($keywords) {
    return stristr($movie['title'], $keywords) || stristr($movie['description'], $keywords);

  });

}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Movie</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <?php if (isset($_COOKIE["auth"])): ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Hello,
            <?php echo $_COOKIE["auth"]["username"]; ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        

        <?php if (getUSer($_COOKIE["auth"]["username"])["role"] == "admin"): ?>
          <li class="nav-item">
            <a class="nav-link" style="color: green;" href="_panel.php">Admin panel</a>
          </li>

          
        <?php endif; ?>

      <?php else: ?>

        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>

        <?php endif; ?>


      </li>


    </ul>

    <form class="form-inline my-2 my-lg-0" action="index.php" method="GET">
      <input class="form-control mr-sm-2" name="q" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>