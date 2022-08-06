<?php
require 'admin/connectDB.php';

$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$search = '';
if (isset($_GET['search_product'])) {
    $search = $_GET['search_product'];
}

$sql_total_products = "select count(*) from products
where product_name like '%$search%'";
$arr_total_products = mysqli_query($connect_db, $sql_total_products);
$total_products = mysqli_fetch_array($arr_total_products)['count(*)'];

$number_of_products_per_page = 8;
$number_of_pages = ceil($total_products / $number_of_products_per_page);
$number_of_page_to_pass = $number_of_products_per_page * ($page - 1);

$sql = "select * from products
where product_name like '%$search%'
limit $number_of_products_per_page
offset $number_of_page_to_pass";
$result = mysqli_query($connect_db, $sql);
?>

<div class="container">
    <div class="product-list">
        <!-- search bar  -->
        <div class="container_search">
            <form>
                <div class="input-group">
                    <input type="text" name="search_product" placeholder="Tìm kiếm sản phẩm..." value="<?php echo $search ?>">
                    <label for="search"><i class="fas fa-search"></i></label>
                </div>
            </form>
        </div>

        <div class="row">
            <?php foreach ($result as $each) { ?>
                <div class="col-md-3 col-sm-6">
                    <div class="white-box" style="margin-bottom: 10px;">
                        <div class="product-img">
                            <img src="admin/products/products_images/<?php echo $each['image'] ?>">
                        </div>
                        <div class="product-bottom">
                            <div class="product-name"><?php echo $each['product_name'] ?></div>
                            <div class="price">
                                <span class="rupee-icon">VNĐ</span> <?php echo $each['price'] ?>
                            </div>
                            <a href="product_details.php?id=<?php echo $each['product_id'] ?>">
                                Xem chi tiết >>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- pagination -->
<ul id=" list-page" class="pagination modal-1">
    <li class="page-number">
        <?php if ($page > 1) { ?>
            <a href="?page=<?php echo $page - 1 ?>&search_product=<?php echo $search ?>" class="prev">&laquo</a>
        <?php } else { ?>
            <a href="" class="prev">&laquo;</a>
        <?php } ?>
    </li>
    <?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
        <li class="page-number">
            <a href="?page=<?php echo $i ?>&search_product=<?php echo $search ?>">
                <?php echo $i ?>
            </a>
        </li>
    <?php } ?>
    <li class="page-number">
        <?php if ($page < $number_of_pages) { ?>
            <a href="?page=<?php echo $page + 1 ?>&search_product=<?php echo $search ?>" class="next">&raquo;</a>
        <?php } else { ?>
            <a href="" class="next">&raquo;</a>
        <?php } ?>
    </li>
</ul>