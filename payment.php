<?php
include_once ("inc/header.php");
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
    	header('Location:login.php');
    }
    ?>
<style>
   h3.payment{
      text-align: center;
      font-size: 20px;
      font-weight: bold;
      text-decoration: underline;
   }
   .wrapper_method{
      text-align: center;
      width: 550px;
      margin: 0 auto;
      border: 1px solid #666;
      padding: 20px;
      background: cornsilk;
   }
   .wrapper_method a{
      padding: 8px;
      background: red;
      color: white;
   }
   .wrapper_method h3{
      margin-bottom: 20px;
   }

</style>
<div class="main">
   <div class="content">
    	<div class="section group">
    		<div class="content_top">
    		<div class="heading">
    		<h3>Phương thức thanh toán</h3>
    		</div>
    		<div class="clear"></div>
            <div class="wrapper_method">
               <h3 class="payment">Chọn phương thức thanh toán của bạn</h3>
               <a class="payment_href" href="offlinepayment.php">Tiền Mặt</a>
               <a class="payment_href" href="#">Chuyển Khoản</a><br><br><br>
               <a style="background: gray;" href="cart.php"> << Quay lại</a>
           </div>
    	</div>
 	</div>
</div>
</div>
<?php
include_once("inc/footer.php");
?>
