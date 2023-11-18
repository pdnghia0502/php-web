<?php
include_once ("inc/header.php");
//include_once ("inc/slider.php");
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
	.box_left {
    width: 50%;
    border: 1px solid gray;
    float: left;
    padding: 10px;
}
    .box_right {
    width: 45%;
    border: 1px solid gray;
    float: right;
    padding: 10px;
}
    a.a_order {
    	background: gray;
    	padding: 7px 20px;
    	color: #fff;
    	font-size: 21px;
    }
</style>
<form action="" method="post">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    		<h3>Thanh toán tiền mặt</h3>
    		</div>
    		<div class="clear"></div>
    		<div class="box_left">
    			<div class="cartpage">
			    	<?php
               if(isset($update_quantity_cart)){
               	echo $update_quantity_cart;
               }
			    	?>
			    	<?php
               if(isset($delcart)){
               	echo $delcart;
               }
			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="15%">Sản phẩm</th>
								<th width="20%">Đơn giá</th>
								<th width="15%">Số lượng</th>
								<th width="20%">Thành tiền</th>
								
							</tr>
							<?php
							$get_product_cart = $ct->get_product_cart();
							$subtotal = 0;
							$qty = 0;
							$I = 0;
							if($get_product_cart){
								
								while($result = $get_product_cart->fetch_assoc()){
									$I++;
							?>
							<tr>
								<td><?php echo $I; ?></td>
								<td><?php echo $result['productName'] ?></td>
								
								<td><?php echo $result['price'].' '.'VNĐ' ?></td>
								<td>
										
										<?php echo $result['quantity'] ?>
										
								</td>
								<td><?php
								$total = $result['price'] * $result['quantity'];
								echo $total.' '.'VNĐ';

								 ?></td>
								
							</tr>
							
		              <?php
		              $subtotal += $total;
		              $qty = $qty + $result['quantity'];
		           }
		        }
		              ?>
							
						</table>
						<?php
                  			$check_cart = $ct->check_cart();
                  			if($check_cart){
                  
                 		?>
						<table style="float:right;text-align:left;margin: 5px;" width="50%">
							<tr>
								<th>Tổng tiền hàng : </th>
								<td><?php

                         	echo $subtotal.' '.'VNĐ';
                         	Session::set('sum', $subtotal);
                         	Session::set('qty', $qty);
							    ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%( <?php echo $vat = $subtotal * 0.1 .'VNĐ '; ?>)</td>
							</tr>
							<tr>
								<th>Tổng thanh toán :</th>
								<td>
									<?php 
                                		$vat = $subtotal * 0.1;
                                		$gtotal = $subtotal + $vat;
                                		echo $gtotal.' '.'VNĐ';
								    ?>
								</td>
							</tr>
							
					   </table>
					   <?php
                   }else{
                   	echo 'Giỏ của bạn đang trống! Vui lòng mua sắm ngay bây giờ';
                   }


					   ?>
					</div>
    		</div>
    		<div class="box_right">
    			<table class="tblone">
    			<?php
    			$Id = Session::get('customer_Id');
                 $get_customers = $cs -> show_customers($Id);
                 	if($get_customers){
                 		while($result = $get_customers->fetch_assoc()){
                 	
    			?>
    			<tr>
    				<td>Tên</td>
    				<td>:</td>
    				<td><?php echo $result['name'] ?></td>
    			</tr>
    			<tr>
    				<td>Số điện thoại</td>
    				<td>:</td>
    				<td><?php echo $result['phone'] ?></td>
    			</tr>
    			<tr>
    				<td>Email</td>
    				<td>:</td>
    				<td><?php echo $result['email'] ?></td>
    			</tr>
    			<tr>
    				<td>Địa chỉ</td>
    				<td>:</td>
    				<td><?php echo $result['address'] ?></td>
    			</tr>
    			<tr>
    				<td colspan="3"><a href="editprofile.php">Chỉnh sửa thông tin</a></td>
    			</tr>
    			<?php
                }
            }
    			?>
    		</table>
    		</div>
 		</div>
 	</div>
 	<center><a href="?orderId=order" class="a_order">Đặt hàng</a></center><br>
</div>

	<?php
include_once("inc/footer.php");
?>