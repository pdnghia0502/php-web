<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once("../classes/brand.php");?>
<?php include_once("../classes/category.php");?>
<?php include_once("../classes/product.php");?>
<?php
$pd = new product();
if(!isset($_GET['productId']) || $_GET['productId']==NULL){
        echo "<script>window.location = 'productlist.php</script>";
    }
  else{
        $Id = $_GET['productId'];
  }
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit'])) {

    $updateProduct = $pd -> update_product($_POST,$_FILES, $Id);

}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block"> 
        <?php
            if (isset($updateProduct)){
                echo $updateProduct;
            }
            ?> 
            <?php
            $get_product_by_Id = $pd->getproductbyId($Id);
            if($get_product_by_Id){
                while($result_product = $get_product_by_Id->fetch_assoc()){
                ?>              
                <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Tên sản phẩm</label>
                        </td>
                        <td>
                            <input type="text" name="productName" value="<?php echo $result_product['productName'] ?>" class="medium" />
                        </td>
                    </tr>
				    <tr>
                        <td>
                            <label>Loại</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                            <option>-----Lựa chọn loại-----</option>
                            <?php
                                $cat = new category();
                                $catlist = $cat -> show_category();
                                if($catlist){
                                while($result = $catlist -> fetch_assoc()){
                            ?>

                            <option 
                            <?php
                                if($result['catId']==$result_product['catId']){ echo 'selected';     }
                            ?>

                            value="<?php echo $result['catId']?>"><?php echo $result['catName']?></option>
                        <?php
                    }
                        }
                        ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>-----Lựa chọn thương hiệu-----</option>

                           <?php
                             $brand = new brand();
                             $brandlist = $brand -> show_brand();
                             if($brandlist){
                                while($result = $brandlist -> fetch_assoc()){
                            ?>

                            <option
                            <?php
                            if($result['brandId']==$result_product['brandId']){ echo 'selected';     }

                            ?>

                             
                             value="<?php echo $result['brandId']?>"><?php echo $result['brandName']?></option>
                        <?php
                    }
                        }
                        ?>
                            
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce"><?php echo $result_product['product_desc'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input name="price" value="<?php echo $result_product['price'] ?>" type="text" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Thêm ảnh</label>
                    </td>
                    <td>
                    	<img src="uploads/<?php echo $result_product['image'] ?>" width="90"><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Trạng thái</label>
                    </td>
                        <td>
                            <select id="select" name="type">
                            <option>----Chọn trạng thái----</option>
                            <?php
                            if($result_product['type']==1){
                                ?>
                                <option selected value="1">Bán chạy</option>
                                <option value="0">Bình thường</option>
                                <?php
                            }else{
                                ?>
                                <option value="1">Bán chạy</option>
                                <option selected value="0">Bình thường</option>
                                <?php
                            }
                                ?>
                            </select>
                        </td>
                    </tr>

				    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Cập nhật" />
                        </td>
                    </tr>
                </table>
                </form>
                <?php
        }
        }

            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include_once 'inc/footer.php';?>


