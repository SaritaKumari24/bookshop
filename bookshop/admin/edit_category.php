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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>

<body class="bg-secondary">

    <?php include_once "admin_header.php" ?>
    <!-- Your admin content goes here -->
    <div class="container-fluid flex-row mt-5">
        <div class="row">
            <div class="col-3">
                <?php include_once "sidebaar.php" ?>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-10 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h5>Insert category Details 
                                    <a href="manage_category.php" class="btn btn-danger float-end">Back</a>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php
                                if(isset($_GET['c_id'])){
                                     $cat_id=$_GET['c_id'];
                                     $cat_title=$_GET['cat_title'];
                                }
                                ?>
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="cat_title"><?=$data['cat_title'];?></label>
                                        <input type="text" name="cat_title" placeholder="enter your title"
                                            id="cat_title" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" name="update_category" value="Update category"
                                            class="btn btn-primary w-100">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>