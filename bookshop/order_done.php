<?php
include "connect.php";
if(!isset($_SESSION['account'])){

    echo "<script>window.open('login.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
include_once "header.php";
//calling orders and order items here
$user_id=$getUser['user_id'];
$order=mysqli_query($connect,"select * from orders LEFT JOIN coupon on orders.coupon_id = coupon.c_id where user_id='$user_id' and is_ordered='0'");
$myOrder=mysqli_fetch_array($order);
$count_myOrder=mysqli_num_rows($order);


?>


    <div class="container p-5">
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h2>
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/checked--v1.png"
                            alt="checked--v1" />
                    </h2>
                    <h1>Wow! Order placed Successfully</h1>
                    <p>Clicl here to see <a href="my_order.php" class="text-light">My order</a>Page To know more details</p>

                    <div class="d-flex justify-content-end">
                        <a href="my_order.php" class="btn btn-light">MY orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    
    


</body>

</html>