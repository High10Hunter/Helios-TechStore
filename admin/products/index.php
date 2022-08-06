<?php
require '../check_admin_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial=scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="../css_files/index_interface.css">
    <link rel="stylesheet" href="../css_files/pagination.css">
    <link rel="stylesheet" href="../css_files/search_bar.css">
    <link rel="stylesheet" href="../css_files/notification.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="sort_products.css">
    <link class="cssdeck" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="../js_files/index_interface.js"></script>

</head>

<body>
    <?php
    include '../menu.php';
    require '../connectDB.php';

    $page = 1;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    $search = '';
    if (isset($_GET['search_product'])) {
        $search = $_GET['search_product'];
    }

    $sort_products = -1;
    if (isset($_GET['sort_manufacturers'])) {
        $sort_products = $_GET['sort_manufacturers'];
    } else if (isset($_GET['sort_types'])) {
        $sort_products = $_GET['sort_types'];
    }

    if ($sort_products != -1 && $sort_products == $_GET['sort_manufacturers']) {
        if ($sort_products == -1) {
            header('location:index.php');
            exit;
        }

        $sql_total_products = "select count(*) from products
        where 
        manufacturer_id = '$sort_products'";
        $arr_total_products = mysqli_query($connect_db, $sql_total_products);
        $total_products = mysqli_fetch_array($arr_total_products)['count(*)'];

        $number_of_products_per_page = 2;
        $number_of_pages = ceil($total_products / $number_of_products_per_page);
        $number_of_page_to_pass = $number_of_products_per_page * ($page - 1);

        $sql = "select products.*, 
        manufacturers.manufacturer_name as manufacturer_name
        from products
        join manufacturers on products.manufacturer_id = manufacturers.manufacturer_id
        where products.manufacturer_id = '$sort_products'
        limit $number_of_products_per_page
        offset $number_of_page_to_pass";
        $result = mysqli_query($connect_db, $sql);
    } else if ($sort_products != -1 && $sort_products == $_GET['sort_types']) {
        if ($sort_products == -1) {
            header('location:index.php');
            exit;
        }

        $sql_total_products = "select count(*) from products
        where 
        type_id = '$sort_products'";
        $arr_total_products = mysqli_query($connect_db, $sql_total_products);
        $total_products = mysqli_fetch_array($arr_total_products)['count(*)'];

        $number_of_products_per_page = 2;
        $number_of_pages = ceil($total_products / $number_of_products_per_page);
        $number_of_page_to_pass = $number_of_products_per_page * ($page - 1);

        $sql = "select 
        products.*,
        manufacturers.manufacturer_name as manufacturer_name 
        from products
        join types on products.type_id = types.type_id
        join manufacturers on products.manufacturer_id = manufacturers.manufacturer_id
        where products.type_id = '$sort_products'
        limit $number_of_products_per_page
        offset $number_of_page_to_pass";
        $result = mysqli_query($connect_db, $sql);
    } else if ($sort_products == -1) {
        $sql_total_products = "select count(*) from products
        where 
        product_name like '%$search%'";
        $arr_total_products = mysqli_query($connect_db, $sql_total_products);
        $total_products = mysqli_fetch_array($arr_total_products)['count(*)'];

        $number_of_products_per_page = 2;
        $number_of_pages = ceil($total_products / $number_of_products_per_page);
        $number_of_page_to_pass = $number_of_products_per_page * ($page - 1);

        $sql = "select 
            products.*, 
            manufacturers.manufacturer_name as manufacturer_name
            from products
            join manufacturers on products.manufacturer_id = manufacturers.manufacturer_id
            where product_name like '%$search%'
            limit $number_of_products_per_page
            offset $number_of_page_to_pass";
        $result = mysqli_query($connect_db, $sql);
    }
    ?>

    <div id='center' class="main center">
        <br>
        <h1>Quản lý sản phẩm</h1>
        <div class="container">
            <button class="btn" style="font-size: medium;">
                <a href="insert_form.php" style="color: white; text-decoration:none">
                    Thêm sản phẩm
                </a>
            </button>
            <button class="btn" style="font-size: medium;">
                <a href="insert_type_form.php" style="color: white; text-decoration:none">
                    Thêm thể loại
                </a>
            </button>

            <?php
            $sql_manufacturers = "select * from manufacturers";
            $manufacturers = mysqli_query($connect_db, $sql_manufacturers);
            ?>
            <form method="GET" style="position:relative; left: 1150px">
                <div style="color: black; font-size:large">Lọc theo nhà sản xuất</div>
                <div class="select">
                    <select name="sort_manufacturers">
                        <?php foreach ($manufacturers as $each_manufacturer) { ?>
                            <option <?php if ($sort_products == $each_manufacturer['manufacturer_id']) { ?> selected <?php } ?> value="<?php echo $each_manufacturer['manufacturer_id'] ?>">
                                <?php echo $each_manufacturer['manufacturer_name'] ?>
                            </option>
                        <?php } ?>
                        <option value="-1" <?php if ($sort_products == -1 || isset($_GET['sort_types'])) { ?> selected <?php } ?>>
                            Không
                        </option>
                    </select>
                </div>
                <button class="sort-btn" type="submit" style="background: darkcyan;
                width: 130px;
                margin: 10px;
                height: 40px;
                color: #fff;
                font-size:medium;
                font-family:'Lato', sans-serif;
                font-weight:500;
                border-radius: 5px;
                padding: 10px 25px;
  ">Tìm</button>
            </form>

            <?php
            $sql_types = "select * from types";
            $types = mysqli_query($connect_db, $sql_types);
            ?>
            <form method="GET" style="position:relative; left: 1150px">
                <div style="color: black; font-size:large">Lọc theo thể loại</div>
                <div class="select">
                    <select name="sort_types">
                        <?php foreach ($types as $each_type) { ?>
                            <option <?php if ($sort_products == $each_type['type_id']) { ?> selected <?php } ?> value="<?php echo $each_type['type_id'] ?>">
                                <?php echo $each_type['type_name'] ?>
                            </option>
                        <?php } ?>
                        <option value="-1" <?php if ($sort_products == -1 || isset($_GET['sort_manufacturers'])) { ?> selected <?php } ?>>
                            Không
                        </option>
                    </select>
                </div>
                <button class="sort-btn" type="submit" style="background: darkcyan;
                width: 130px;
                margin: 10px;
                height: 40px;
                color: #fff;
                font-size:medium;
                font-family:'Lato', sans-serif;
                font-weight:500;
                border-radius: 5px;
                padding: 10px 25px;
  ">Tìm</button>
            </form>

            <div id=" div1">
                <form>
                    <div class="wrap">
                        <div class="search">
                            <input type="text" name="search_product" value="<?php echo $search ?>" class="searchTerm" placeholder="Tìm kiếm sản phẩm">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <section class="section-grid">
                    <div class="grid-prod">
                        <?php foreach ($result as $each) : ?>
                            <div class="prod-grid">
                                <img src=" products_images/<?php echo $each['image'] ?>">
                                <h3><?php echo $each['product_name'] ?></h3>
                                <div style="text-align:center; font-size:20px">Giá: <?php echo $each['price'] ?> VNĐ</div>
                                <div style="text-align:center;font-size:20px">Nhà sản xuất: <?php echo $each['manufacturer_name'] ?></div>
                                <p><?php echo $each['description'] ?></p>

                                <div style="position: relative; left: 95px;">
                                    <a href="update_form.php?id=<?php echo $each['product_id'] ?>">
                                        <button class="btn" style="font-size: medium;"> Cập nhật</button>
                                    </a>
                                    <a href=" delete.php?id=<?php echo $each['product_id'] ?>">
                                        <button class="btn" style="font-size: medium;"> Xoá</button>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </section>

                <!-- pagination -->
                <?php if (isset($_GET['sort_manufacturers'])) { ?>
                    <ul id=" list-page" class="pagination modal-1">
                        <li class="page-number">
                            <?php if ($page > 1) { ?>
                                <a href="?page=<?php echo $page - 1 ?>&amp;search_product=<?php echo $search ?>&amp;sort_manufacturers=<?php echo $sort_products ?>" class="prev">&laquo</a>
                            <?php } else { ?>
                                <a href="" class="prev">&laquo;</a>
                            <?php } ?>
                        </li>
                        <?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
                            <li class="page-number">
                                <a href="?page=<?php echo $i ?>&amp;search_product=<?php echo $search ?>&amp;sort_manufacturers=<?php echo $sort_products ?>">
                                    <?php echo $i ?>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="page-number">
                            <?php if ($page < $number_of_pages) { ?>
                                <a href="?page=<?php echo $page + 1 ?>&amp;search_product=<?php echo $search ?>&amp;sort_manufacturers=<?php echo $sort_products ?>" class="next">&raquo;</a>
                            <?php } else { ?>
                                <a href="" class="next">&raquo;</a>
                            <?php } ?>
                        </li>
                    </ul>
                <?php } else if (isset($_GET['sort_types'])) { ?>
                    <ul id=" list-page" class="pagination modal-1">
                        <li class="page-number">
                            <?php if ($page > 1) { ?>
                                <a href="?page=<?php echo $page - 1 ?>&amp;search_product=<?php echo $search ?>&amp;sort_types=<?php echo $sort_products ?>" class="prev">&laquo</a>
                            <?php } else { ?>
                                <a href="" class="prev">&laquo;</a>
                            <?php } ?>
                        </li>
                        <?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
                            <li class="page-number">
                                <a href="?page=<?php echo $i ?>&amp;search_product=<?php echo $search ?>&amp;sort_types=<?php echo $sort_products ?>">
                                    <?php echo $i ?>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="page-number">
                            <?php if ($page < $number_of_pages) { ?>
                                <a href="?page=<?php echo $page + 1 ?>&amp;search_product=<?php echo $search ?>&amp;sort_types=<?php echo $sort_products ?>" class="next">&raquo;</a>
                            <?php } else { ?>
                                <a href="" class="next">&raquo;</a>
                            <?php } ?>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul id=" list-page" class="pagination modal-1">
                        <li class="page-number">
                            <?php if ($page > 1) { ?>
                                <a href="?page=<?php echo $page - 1 ?>&amp;search_product=<?php echo $search ?>" class="prev">&laquo</a>
                            <?php } else { ?>
                                <a href="" class="prev">&laquo;</a>
                            <?php } ?>
                        </li>
                        <?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
                            <li class="page-number">
                                <a href="?page=<?php echo $i ?>&amp;search_product=<?php echo $search ?>">
                                    <?php echo $i ?>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="page-number">
                            <?php if ($page < $number_of_pages) { ?>
                                <a href="?page=<?php echo $page + 1 ?>&amp;search_product=<?php echo $search ?>" class="next">&raquo;</a>
                            <?php } else { ?>
                                <a href="" class="next">&raquo;</a>
                            <?php } ?>
                        </li>
                    </ul>
                <?php } ?>

            </div>
        </div>
    </div>


</body>

</html>