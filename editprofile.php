<?php
include_once ("inc/header.php");
//include_once ("inc/slider.php");
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
    	header('Location:login.php');
    }
    ?>
<?php
  $Id = Session::get('customer_Id');
  if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['save'])) {

    $UpdateCustomers = $cs -> update_customers($_POST, $Id);

}
?>
<div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    		<div class="heading">
    		<h3>Cập nhật thông tin khách hàng</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    		<form action="" method="post">
    		<table class="tblone">
    			<tr>
    				<td colspan="2">
    					<?php
    					if (isset($UpdateCustomers)) {
    						echo '<td colspan="3">'.$UpdateCustomers.'</td>';
    					}
    					?>
    				</td>
    			</tr>
    			<?php
    			$Id = Session::get('customer_Id');
                 $get_customers = $cs -> show_customers($Id);
                 	if($get_customers){
                 	while($result = $get_customers->fetch_assoc()){
                 	
    			?>
    			<tr>
    				<td>Tên</td>
    				<td>:</td>
    				<td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
    				
    			</tr>
    			<tr>
    				<td>Số điện thoại</td>
    				<td>:</td>
    				<td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
    			</tr>
    			<tr>
    				<td>Email</td>
    				<td>:</td>
    				<td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
    			</tr>
    			<tr>
    				<td>Địa chỉ</td>
    				<td>:</td>
    				<td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
    			</tr>
    			<tr>
    				<td colspan="3"><input type="submit" name="save" value="Lưu" class="grey"></td>
    			</tr>
    			
    			<?php
                }
            }
    			?>
    		</table>
    	</form>
		</div>
 	</div>
</div>
<?php
include_once("inc/footer.php");
?>
