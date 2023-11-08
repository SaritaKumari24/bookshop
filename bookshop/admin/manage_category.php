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
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Insert category Details</h5>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="cat_title">category title</label>
                                        <input type="text" name="cat_title" placeholder="enter your title"
                                            id="cat_title" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" name="create_category" value="Insert category"
                                            class="btn btn-primary w-100">
                                    </div>

                                </form>
                                <?php
                    if(isset($_POST['create_category'])){
                        $cat_title=$_POST['cat_title'];

                        $query=mysqli_query($connect ,"insert into categories (cat_title) value ('$cat_title')");

                        if($query){
                            echo "<script>window.open('manage_category.php','_self')</script>";
                        }
                        else{
                            echo "<script>alert('failled')</script>";

                        }
                        
                    }
                    ?>
                            </div>

                        </div>
                    </div>
                    <div class="col-9">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Title</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                    $callingCategory=mysqli_query($connect, "select * from categories");
                    while($data=mysqli_fetch_array($callingCategory)):

                    ?>
                                <tr>
                                    <td><?=$data['cat_id'];?></td>
                                    <td><?=$data['cat_title'];?></td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="manage_category.php?c_id=<?=$data['cat_id'];?>"
                                                class="btn btn-danger">X</a>
                                            <a href="edit_category.php?c_id=<?=$data['cat_id'];?>" class="btn btn-info">Edit</a>
                                            <a href="" class="btn btn-success">view</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>


<?php
if(isset($_GET['c_id'])){
    $id=$_GET['c_id'];
    $q=mysqli_query($connect, "delete from categories where cat_id='$id'");
    if($q){
        echo "<script>window.open('manage_category.php','_self')</script>";
    }
    else{
        echo "<script>alert('delete failed')</script>";
    }
}


?>