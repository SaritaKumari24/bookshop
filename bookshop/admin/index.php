<?php include_once "../connect.php" ;
if(!isset($_SESSION['admin'])){
    echo "<script>window.open('../login.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>
<body class="bg-secondary">
   
<?php include_once "admin_header.php" ?>
    <!-- Your admin content goes here -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
            <?php include_once "sidebaar.php" ?>

            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-4">
                        <div class="card bg-danger text-white ">
                            <div class="card-body">
                                <h2>
                                    <?php 
                                    echo $countBooks=mysqli_num_rows(mysqli_query($connect,"select * from books")); ?>

                                    +</h2>
                                <h4>Toatal books</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-success text-white ">
                            <div class="card-body">
                                <h2>
                                <?php 
                                    echo $countCategory=mysqli_num_rows(mysqli_query($connect,"select * from categories")); ?>
                                    +</h2>
                                <h4>Toatal category</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-warning text-black ">
                            <div class="card-body">
                                <h2>
                                <?php 
                                    echo $countUsers=mysqli_num_rows(mysqli_query($connect,"select * from accounts")); ?>    
                                +</h2>
                                <h4>Toatal users</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
