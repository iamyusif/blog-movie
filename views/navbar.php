<?php


?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
        <a href="index.php" class="navbar-brand">BlogApp</a>


  <div class="collapse navbar-collapse">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">

<a class="nav-link" href="moviesCategory.php">Movies</a>

</li>
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
          </li>

          

        <?php endif; ?>



    </ul>

    <form class="d-flex" action="index.php" method="GET">
                <input type="text" name="q" class="form-control me-2" placeholder="Search">
                <button class="btn btn-outline-light">Search</button>
            </form>
    </div>
  </div>
</nav>