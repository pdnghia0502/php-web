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
$ct = new cart();
if(isset($_GET['confirmid'])){
	$Id = $_GET['confirmid'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$shifted_confirm = $ct->shifted_confirm($Id,$time,$price);
}
?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
			<div class="heading">
				<h3>Chi tiết đơn hàng đã đặt</h3>
			</div>
			<div class="clear"></div>
		</div>
			<div class="cartpage">
				<table class="tblone">
					<tr>
						<th width="10%">ID</th>
						<th width="15%">Tên sản phẩm</th>
						<th width="10%">Ảnh</th>
						<th width="10%">Giá</th>
						<th width="5%">Số lượng</th>
						<th width="15%">Ngày lập</th>
						<th width="10%">Trạng thái</th>
						<th width="10%">Hành động</th>
					</tr>
					<?php
					$customer_Id = Session::get('customer_Id');
					$get_cart_ordered = $ct->get_cart_ordered($customer_Id);
					$i=0;
					$qty = 0;
					if($get_cart_ordered){

						while($result = $get_cart_ordered->fetch_assoc()){
							$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['productName'] ?></td>
						<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
						<td><?php echo $result['price'].' '.'VNĐ' ?></td>
						<td>
								<?php echo $result['quantity'] ?>
						</td>
						<td><?php echo $fm->formatDate($result['date_order'])?></td>
					    <td>
					    	<?php
                             if($result['status']=='0'){
                             	echo 'Đang xử lí';
                             }elseif($result['status']=='1'){
							?>
							<span>Đang vận chuyển</span>
							<?php
                            }else{
								echo 'Đã nhận hàng';
							}
					    	?>
					    </td>
					    <?php
					    if($result['status']=='0'){	
					    ?>
							<td><?php echo '---';?></td>
						<?php
						}elseif($result['status']=='1'){
						?>
							<td>
								<a href="
								?confirmid=<?php echo $customer_Id ?>
								&price=<?php echo $result['price'] ?>
								&time=<?php echo $result['date_order'] ?>
								">Đã nhận hàng</a>
							</td>
						<?php
						}
						else{
						?>
				  			<td><?php echo'Đã nhận hàng'; ?></td>
						<?php 
						?>
					</tr>
		        	<?php
		              
		        	}
				}
		        }
		            ?>	
					</table>	
			</div>
				<div class="shopping">
					<div class="shopleft">
						<a href="index.php"> <img src="images/shop.png" alt="" /></a>
					</div>
				</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
include_once("inc/footer.php");
?>
