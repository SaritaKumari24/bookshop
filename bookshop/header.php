<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">Bookshop</a>

        <form action="" method="get" class="d-flex">
            <input type="search" name="search" class="form-control">
            <input type="submit" name="find" class="btn btn-danger">
        </form>
        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php
                if(isset($_SESSION['account'])):
                    $email=$_SESSION['account'];
                    $getUser=mysqli_query($connect, "select * from accounts where email='$email'");
                    $getUser=mysqli_fetch_array($getUser);
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><?=$getUser['name'];?></a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="cart.php"> Cart</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <?php else: ?>
                    <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                   </li>
                   <li class="nav-item">
                    <a class="nav-link" href="register.php">Create an account</a>
                   </li>
<?php endif; ?>
            </ul>
        </div>
    </div>
</nav>