<?php
include_once ("lib/session.php");
Session::init();
?>

<style>
	#dc_mega-menu-orange ul li.mega:hover ul {
  		display: block;
  		position: absolute;
  		top: 100%;
  		left: 0;
  		z-index: 9999;
  		width: 100%;
  		background: #fff;
	}

	#dc_mega-menu-orange ul li.mega:hover ul li {
  		display: inline-block;
  		width: 40%;
  		padding: 10px;
  		text-align: center;
  		border-right: 1px solid #ccc;
  		box-sizing: border-box;
	}

	#dc_mega-menu-orange ul li.mega:hover ul li:nth-child(6n) {
  		border-right: none;
	}

	#dc_mega-menu-orange ul li.mega:hover ul li a {
  		color: #333;
  		text-decoration: none;
  		font-size: 14px;
	}

	#dc_mega-menu-orange ul li.mega:hover ul li a:hover {
  		color: #ff6600;
	}
</style>

<?php
include_once ("lib/database.php");
include_once ("helpers/format.php");

spl_autoload_register(function ($className) {
        include_once'classes/'.$className.'.php';
    });
$db = new Database();
$fm = new Format();
$ct = new cart();
$cat = new category();
$cs = new customer();
$product = new product();
?>

<!DOCTYPE HTML>
<head>
<title>Smart Phone Store</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img style="width: 100px;"src="images/logochayco.png" alt="" /></a>
			</div>
			<div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="GET">
				    	<input type="text" name="keyword" value="" placeholder="Nhập tên sản phẩm">
              			<input type="submit" name="search" value="Tìm kiếm">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Giỏ hàng</span>
							<span class="no_product">
                 				<?php
                  				$check_cart = $ct->check_cart();
                  				if($check_cart){
                  					$sum = Session::get("sum");
                  					$qty = Session::get("qty");
                  					echo $sum.''.'đ';
                  				}else{
                  					echo '(trống)';
                				}
                				?>
							</span>
						</a>
					</div>
			    </div>
			<?php
            if(isset($_GET['customer_Id'])){
            	$delCart = $ct -> del_all_data_cart();
            	Session::destroy();
            }
			      ?>
		   <div class="login">
       		<?php
        		$login_check = Session::get('customer_login');
        		if($login_check == false){
        			echo '<a href="login.php">Đăng nhập</a></div>';
        		}else{
         			echo '<a href="?customer_Id='.Session::get('customer_Id').'">Đăng xuất</a></div>';
        		}
       		?>
	<div class="clear"></div>
	</div>
	<div class="clear"></div>
 	</div>
	<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Trang chủ</a></li>
	  <li class="mega">
      <a href="#">Danh mục sản phẩm</a>
      <ul>
	  	<li><a href="products.php">Tất cả sản phẩm</a></li>
        <li><a href="productbycat.php?catId=8">Magic Keyboard</a></li>
        <li><a href="productbycat.php?catId=7">Accessories</a></li>
        <li><a href="productbycat.php?catId=6">HomePod</a></li>
        <li><a href="productbycat.php?catId=5">AirPods</a></li>
		<li><a href="productbycat.php?catId=4">MacBook</a></li>
        <li><a href="productbycat.php?catId=3">iPad</a></li>
		<li><a href="productbycat.php?catId=2">iPhone</a></li>
      </ul>
    </li>
	<?php
	$check_cart = $ct -> check_cart();
	if($check_cart==true){
    	echo '<li><a href="cart.php">Giỏ hàng</a></li>';
	}else{
       echo '';
	}
	?>
    <?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
    	echo '';
    }else{
      echo '<li><a href="orderdetails.php">Đơn hàng đã đặt</a> </li>';
      echo '<li><a href="profile.php">Thông tin cá nhân</a> </li>';
    }
    ?>
	  <li><a href="contact.php">Liên lạc</a></li>
	  <div class="clear"></div>
	</ul>
</div>