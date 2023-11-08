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
                                <h5>Insert coupon Details</h5>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="coupon_code">Coupon code</label>
                                        <input type="text" name="coupon_code" placeholder="enter code" id="coupon_code"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="coupon_amount">Coupon Amount</label>
                                        <input type="text" name="coupon_amount" placeholder="enter code amount" id="coupon_amount"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" name="create_coupon" value="Insert coupon"
                                            class="btn btn-primary w-100">
                                    </div>

                                </form>
                                <?php
                    if(isset($_POST['create_coupon'])){
                        $coupon_code=$_POST['coupon_code'];
                        $coupon_amount=$_POST['coupon_amount'];

                        $query=mysqli_query($connect ,"insert into coupon (coupon_code,coupon_amount) value ('$coupon_code','$coupon_amount')");

                        if($query){
                            echo "<script>window.open('manage_coupons.php','_self')</script>";
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
                                    <th>Code</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                    $callingCoupon=mysqli_query($connect, "select * from coupon");
                    while($data=mysqli_fetch_array($callingCoupon)):

                    ?>
                                <tr>
                                    <td><?=$data['c_id'];?></td>
                                    <td><?=$data['coupon_code'];?></td>
                                    <td><?=$data['coupon_amount'];?></td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="manage_coupons.php?coupon_id=<?=$data['coupon_id'];?>"
                                                class="btn btn-danger">X</a>
                                            <a href="" class="btn btn-info">Edit</a>
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
if(isset($_GET['coupon_id'])){
    $id=$_GET['coupon_id'];
    $q=mysqli_query($connect, "delete from coupon where coupon_id='$id'");
    if($q){
        echo "<script>window.open('manage_coupons.php','_self')</script>";
    }
    else{
        echo "<script>alert('delete failed')</script>";
    }
}


?>