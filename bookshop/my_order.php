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
</head>

<body>
    <?php
include_once "header.php";



?>

    <div class="container p-5">
        <?php
                $user_id=$getUser['user_id'];

 $order=mysqli_query($connect,"select * from orders LEFT JOIN coupon on orders.coupon_id = coupon.c_id where user_id='$user_id' and is_ordered='1'");
 $count_myOrder=mysqli_num_rows($order);
        ?>
    <h1>My Order(<?=$count_myOrder;?>)</h1>
        <div class="row">
            <?php
        //calling orders and order items here
       
        while($myOrder=mysqli_fetch_array($order)):

?>

            <div class="col-12">
               
                <div class="row">

                    <div class="col-12 shadow mb-2">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <span>Order id: <?= $myOrder['order_id'];?></span>
                                <?= ($myOrder['coupon_id']) ? "<span>Coupon:" . $myOrder['coupon_code']. "</span>": null; ?>
                                
                            </div>
                            <div class="card-body d-flex flex-column gap-5">
                                <!-- start items -->
                                <?php
                                    if($count_myOrder>0):
                                        $myOrderId=$myOrder['order_id'];

                                       //getting order item
                                        $myOrderItems=mysqli_query($connect, "select * from order_items JOIN books ON order_items.book_id=books.id where order_id='$myOrderId'");
                                        $count_order_items=mysqli_num_rows($myOrderItems);
                                        $total_amount=$total_discount_amount=0;
                                        while($order_item=mysqli_fetch_array($myOrderItems)):
                                            $price=$order_item['qty'] * $order_item['price'];
                                        $discount_price=$order_item['qty'] * $order_item['discount_price'];
                 
            
        ?>
                                <div class="row ">
                                    <div class="col-1">
                                        <img src="images/<?=$order_item['cover_image'];?>" alt="" class="w-100">
                                    </div>
                                    <div class="col-10">
                                        <h2 class="h6 text-truncate"><?=$order_item['title'];?></h2>
                                        <h4>
                                            <span class="text-success">₹<?=$order_item['discount_price'];?></span>
                                            ₹<del class="text-muted small"><?=$order_item['price'];?></del>
                                        </h4>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">

                                                <span class="btn ">Qty:<?=$order_item['qty'];?></span>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                $total_amount +=$price;
                                $total_discount_amount +=$discount_price;
                                 endwhile; 
                                 $amount_before_tax=$total_amount-$total_discount_amount;
                                 $tax=$total_discount_amount * 0.18;
                                 $coupon_amount= $myOrder['coupon_amount'];
                                 $total_payable_amount=$total_discount_amount+$tax;
                                 if($myOrder['coupon_id']){
                                      $total_payable_amount=$total_payable_amount-$coupon_amount;
                                 }
                                 else{
                                      $total_payable_amount;
                                 }
                                 
                                 endif; ?>
                                <!--end items-->

                            </div>
                            <div class="card-footer">
                                <h6>Total Amount: Rs.<?=$total_payable_amount;?>/-</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>

            <!-- <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2> Sorry your cart is empty...</h2>
                        <a href="index.php" class="btn btn-dark">Shop now</a>
                    </div>
                </div>

            </div> -->
        </div>

    </div>




</body>

</html>