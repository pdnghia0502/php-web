<?php
include_once ("inc/header.php");
?>
<?php
if(!isset($_GET['catId']) || $_GET['catId']==NULL){
        echo "<script>window.location = '404.php'</script>";
    }
  else{
        $Id = $_GET['catId'];
  }
 
?>


 <div class="main">
    <div class="content">
    	<?php
            $name_cat = $cat -> get_name_by_cat($Id);
            if($name_cat){
            	while($result_name = $name_cat->fetch_assoc()){            
	      		?>
    			<div class="content_top">
    			<div class="heading">
    			<h3>Kiểu loại : <?php echo $result_name['catName'] ?> </h3>
    			</div>
    			<div class="clear"></div>
    			</div>
    			<?php
        	}
        }
			?>
	    <div class="section group">
	      	<?php
            $productbycat = $cat -> get_product_by_cat($Id);
            if($productbycat){
             	while($result = $productbycat->fetch_assoc()){
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proId=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					<h2><?php echo $result['productName'] ?></h2>
					<p><span class="price"><?php echo $result['price'].' '.'VND' ?></span></p>
				    <div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Chi Tiết</a></span></div>
				</div>
			<?php
        	}
        }else{
        	echo 'Loại sản phẩm chưa có hàng';
        }
			?>
		</div>

	
    </div>
 </div>
<?php
include_once("inc/footer.php");
?>
