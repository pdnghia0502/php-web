<?php
include_once("inc/header.php");
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Tất cả sản phẩm bán chạy</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $getproduct_featured_all = $product->getproduct_featured_all();
            if ($getproduct_featured_all) {
                $counter = 0;

                while ($result_all = $getproduct_featured_all->fetch_assoc()) {
                    $counter++;
                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?proId=<?php echo $result_all['productId'] ?>"><img
                        src="admin/uploads/<?php echo $result_all['image'] ?>" alt=""/></a>
                        <h2><?php echo $result_all['productName'] ?></h2>
                        <p><span class="price"><?php echo $result_all['price'] . " " . "VND" ?></span></p>
                        <div class="button"><span><a
                        href="details.php?proId=<?php echo $result_all['productId'] ?>"
                        class="details">Chi tiết</a></span></div>
                    </div>

                    <?php
					$product_count = $product->get_productfeatured_count();
                    if ($counter % 4 == 0) {
                        echo '<div class="clear"></div>';
                        if ($counter != $product_count) {
                            echo '<div class="section group">';
                        }
                    }
                }
            }
            ?>
        </div>
        <div class="">
            <style>
                .pagination {
                    margin-top: 10px;
                    text-align: center;
                }

                .pagination a {
                    display: inline-block;
                    padding: 5px 10px;
                    margin: 0 5px;
                    background-color: #f2f2f2;
                    border: 1px solid #ccc;
                    color: #333;
                    text-decoration: none;
                    border-radius: 3px;
                }

                .pagination a:hover {
                    background-color: #ddd;
                }

                .pagination a.active {
                    background-color: #007bff;
                    color: #fff;
                }
            </style>
            <?php
            $sp_tungtrang = 8;
            $product_button = ceil($product_count / $sp_tungtrang);
            $current_page = isset($_GET['trang']) ? $_GET['trang'] : 1;
            echo '<div class="pagination">';
            for ($i = 1; $i <= $product_button; $i++) {
                $active_class = ($i == $current_page) ? 'active' : '';
                echo '<a href="feaproducts.php?trang=' . $i . '" class="' . $active_class . '">' . $i . '</a>';
            }
            echo '</div>';
            ?>
            </div>
        </div>
    </div>
</div>
<?php
include_once("inc/footer.php");
?>
