<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname (__FILE__));
include_once ($filepath. '/../classes/cart.php');
include_once ($filepath. '/../helpers/format.php');
?>

<?php
	$ct = new cart();
	if(isset($_GET['shiftid'])){
		$Id = $_GET['shiftid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted = $ct->shifted($Id,$time,$price);
	}
	if(isset($_GET['deleteid'])){
		$Id = $_GET['deleteid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$deleted = $ct->deleted($Id,$time,$price);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Đơn hàng</h2>
                <div class="block">  
					<?php
					if(isset($shifted)){
						echo $shifted;
					}
					if(isset($deleted)){
						echo $deleted;
					}
					?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Id đơn</th>
							<th>Ngày đặt hàng</th>
							<th>Sản phẩm</th>
							<th>Số lượng</th>
							<th>Giá</th>
							<th>ID khách hàng</th>
							<th>Thông tin</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$ct = new cart ();
						$fm = new format ();
						$get_inbox_cart = $ct->get_inbox_cart();
						if($get_inbox_cart){
							while($result = $get_inbox_cart->fetch_assoc()){
						?>
							<tr class="odd gradeX">
								<td><?php echo $result['Id']; ?></td>
								<td><?php echo $fm->formatDate($result['date_order']); ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><?php echo $result['quantity']; ?></td>
								<td><?php echo $result['price'].' '.'VNĐ'; ?></td>
								<td><?php echo $result['customer_Id']; ?></td>
								<td><a href="customer.php?customerid=<?php echo $result['customer_Id'] ?>">Thông tin khách hàng</a></td>
								<td>
									<?php
									if($result['status']==0){
									?>
									<a href="
										?shiftid=<?php echo $result['Id'] ?>
										&price=<?php echo $result['price'] ?>
										&time=<?php echo $result['date_order'] ?>
										">Xử lí</a>
									<?php
									}elseif($result['status']==1){
									?>
										<?php
										echo 'Đang vận chuyển...'
										?>
									<?php
									}elseif($result['status']==2){
										?>
									<a href="
										?deleteid=<?php echo $result['Id'] ?>
										&price=<?php echo $result['price'] ?>
										&time=<?php echo $result['date_order'] ?>
										">Xóa</a>
									<?php
									}
									?>
								</td>
							</tr>
							<?php
						}
						}
							?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include_once 'inc/footer.php';?>