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
            <div class="col-4 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Choose payment method</h3>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="" class="list-group-item list-group-item-action disabled" style="cursor: none;">Wallets</a>
                            <a href="" class="list-group-item list-group-item-action disabled" style="cursor: none">Payment Gateway</a>
                            <a href="make_payment.php?type=cod" class="list-group-item list-group-item-action fw-bold">Cash On Delivary (COD)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
   
</body>
</html>
<?php
if(isset($_GET['type'])){
    $type=$_GET['type'];
    if($type == 'cod'){
        //update order record
        if($myOrder['address_id'] != NULL){
            $order_id=$myOrder['order_id'];
            $query=mysqli_query($connect,"update orders SET is_ordered='1' where user_id='$user_id' AND order_id='$order_id'");
            
            echo "<script>window.open('order_done.php','_self')</script>";


        }
        else{
            echo "<script>alert('please select address select first')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";

        }
    }
}
?>