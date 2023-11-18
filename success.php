<?php
include_once ("inc/header.php");
?>
<?php
if(isset($_GET['orderId']) && $_GET['orderId']=='order'){
        $customer_Id = Session::get('customer_Id');
        $insertOrder = $ct->insertOrder($customer_Id);
        $delCart = $ct -> del_all_data_cart();
        header('Location:success.php');
    }
?>
<style type="text/css">
	h2.success_order{
		text-align: center;
		color: red;
	}
   p.success_note{
      text-align: center;
      padding: 8px;
      font-size: 17px;
   }
</style>
<form action="" method="post">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<h2 class="success_order">Đặt hàng thành công</h2>
         <?php
           $customer_Id = Session::get('customer_Id');
           $get_amount = $ct -> getAmountPrice($customer_Id);
           if($get_amount){
            $amount = 0;
            while($result = $get_amount -> fetch_assoc()){
               $price = $result['price'];
               $amount += $price;
            }
         }
         ?>
    	    <p class="success_note">Tổng số tiền bạn phải thanh toán là: 
            <?php 
            $vat = $amount * 0.1;
            $total = $vat + $amount;
            echo $total. 'VND'
            ?> 
            bao gồm cả thuế VAT
          </p>
          <p class="success_note">Chúng tôi sẽ liên lạc với bạn vào thời gian sớm nhất. Hãy theo dõi chi tiết đơn hàng của bạn <a href="orderdetails.php">tại đây</a></p>
 		</div>
 	</div>
</div>
<?php
include_once("inc/footer.php");
?>