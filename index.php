<?php
include_once ("inc/header.php");
include_once ("inc/slider.php");
?>
<style>
	.heading1{
		display: flex;
        justify-content: center;
        margin-top: 6px;
	}
	.highlight-button{
    	display: inline-block;
    	padding: 10px 20px;
    	background: linear-gradient(to bottom, #414045 55%,#2f2e33 100%);
    	color: #fff;
		text-shadow: 1px 1px 1px #000;
    	text-decoration: none;
    	transition: background-color 0.1s ease;
		font: normal 20px Arial,sans-serif;
		position: relative;
	}
	.highlight-button:hover{
    	color: #FFF;
		
		background: -webkit-gradient(linear,left top,left bottom,from(#70389C),to(#602D8D));
		background: -moz-linear-gradient(top,#70389C,#602D8D);
		background: -o-linear-gradient(top,#70389C,#602D8D);
		background: -ms-linear-gradient(top,#70389C,#602D8D);
	}

	.highlight-button:active{
    	background-color: #fff;
	}
	
</style>
<div class="main">
    <div class="content">
    	<div class="content_top">
		<div class="heading">
    		<h3>Sản phẩm bán chạy</h3>
		</div>
    	<div class="clear"></div>
    	</div>
	      	<div class="section group">
	      	<?php
             	$product_featured = $product->getproduct_featured();
             	if($product_featured){
               	while($result = $product_featured->fetch_assoc()){
	      		?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proId=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					<h2><?php echo $result['productName'] ?></h2>
					<p><span class="price"><?php echo $result['price']." "."VND" ?></span></p>
					<div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
				}
            }
			?>
		</div>
			<div class="heading1">
				<h3>>>> <a href="feaproducts.php" class="highlight-button">Tất cả sản phẩm bán chạy</a> <<<</h3>
			</div>
			<div class="content_bottom">
    			<div class="heading">
    				<h3><a class="highlightbutton">Sản phẩm mới</a></h3>
				</div>
    			<div class="clear"></div>
    		</div>
			<div class="section group">
				<?php
             		$product_new = $product->getproduct_new();
             		if($product_new){
               			while($result_new = $product_new->fetch_assoc()){
	      			?>
						<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php?proId=<?php echo $result_new['productId'] ?>"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
						<h2><?php echo $result_new['productName'] ?></h2>
						<p><span class="price"><?php echo $result_new['price']." "."VND" ?></span></p>
					<div class="button"><span><a href="details.php?proId=<?php echo $result_new['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
				}
            }
			?>
		</div>
    </div>
</div>
<?php
include_once("inc/footer.php");
?>