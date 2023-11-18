<?php
include_once ("inc/header.php");
?>
<?php
if(isset($_GET['cartId'])){
        $cartId = $_GET['cartId'];
        $delcart = $ct -> del_product_cart($cartId);
    }
if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])) {
	 $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $update_quantity_cart = $ct -> update_quantity_cart($quantity, $cartId);
    if($quantity<=0){
    	$delcart = $ct -> del_product_cart($cartId);
    }
}

?>

 <div class="main">
    <div class="content">
    	<div class="content_top">		
			<div class="heading">
			    <h3>Giỏ hàng của bạn</h3>
			</div>
			<div class="clear"></div>
		</div>
			<div class="section group">
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
								<th width="20%">Tên</th>
								<th width="10%">Ảnh</th>
								<th width="15%">Đơn giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Thành tiền</th>
								<th width="10%">Thao tác</th>
							</tr>
							<?php
							$get_product_cart = $ct->get_product_cart();
							$subtotal = 0;
							$qty = 0;
							if($get_product_cart){
								
								while($result = $get_product_cart->fetch_assoc()){
									
							?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['price'].' '.'VNĐ' ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php
								$total = $result['price'] * $result['quantity'];
								echo $total.' '.'VNĐ';

								 ?></td>
							<td><a onclick="return confirm('Bạn có muốn xóa?');" href="?cartId=<?php echo $result['cartId']?>">Xóa</a></td>
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
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tổng tiền hàng : </th>
								<td>
									<?php
                         				echo $subtotal.' '.'VNĐ';
                         				Session::set('sum', $subtotal);
                         				Session::set('qty', $qty);
							    	?>
								</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Tổng thanh toán:</th>
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
                   	echo 'Giỏ hàng của bạn đang trống! Hãy tiếp tục mua hàng';	
                   }


					   ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
				</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
include_once("inc/footer.php");
?>
