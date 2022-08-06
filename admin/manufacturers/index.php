<?php
require '../check_super_admin_login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial=scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
    <title>Quản lý nhà sản xuất</title>
    <link rel="stylesheet" href="../css_files/index_interface.css">
    <link rel="stylesheet" href="../css_files/notification.css">
    <link rel="stylesheet" href="../css_files/search_bar.css">
    <link rel="stylesheet" href="../css_files/pagination.css">
    <link rel="stylesheet" href="sidebar.css">
    <link class="cssdeck" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="js_files/index_interface.js"></script>
</head>

<body>
    <?php include '../menu.php' ?>

    <div id='center' class="main center">
        <br>
        <h1>Quản lý nhà sản xuất</h1>
        <div class="container">
            <button class=" btn" style="font-size: medium;">
                <a href="insert_form.php" style="color: white;text-decoration:none">
                    Thêm nhà sản xuất
                </a>
            </button>

            <?php
            require '../connectDB.php';

            $page = 1;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }

            $search = '';
            if (isset($_GET['search_manufacturer'])) {
                $search = $_GET['search_manufacturer'];
            }

            //pagination
            $sql_total_manufacturers = "select count(*) from manufacturers
        where
        manufacturer_name like '%$search%'";
            $arr_total_manufacturers = mysqli_query($connect_db, $sql_total_manufacturers);
            $total_manufacturers = mysqli_fetch_array($arr_total_manufacturers)['count(*)'];

            $number_of_manufacturers_per_page = 2;
            $number_of_pages = ceil($total_manufacturers / $number_of_manufacturers_per_page);
            $number_of_page_to_pass = $number_of_manufacturers_per_page * ($page - 1);

            //search manufacturer
            $sql = "select * from manufacturers
        where
        manufacturer_name like '%$search%'
        limit $number_of_manufacturers_per_page 
        offset $number_of_page_to_pass";
            $result = mysqli_query($connect_db, $sql);

            ?>
            <div id="div2">
                <form>
                    <div class="wrap">
                        <div class="search">
                            <input type="text" name="search_manufacturer" value="<?php echo $search ?>" class="searchTerm" placeholder="Tìm kiếm nhà sản xuất">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <section class="section-list">
                    <table>
                        <?php foreach ($result as $each) { ?>
                            <tr>
                                <td>
                                    <img src="manufacturers_images/<?php echo $each['image'] ?>" style="object-fit: fit;
                            object-position: fit;
                            width:500px;
                            height:300px;">
                                </td>
                                <td>
                                    <h2><?php echo $each['manufacturer_name'] ?></h2>
                                    <p><?php echo $each['address'] ?></p>
                                    <p><?php echo $each['phone_number'] ?></p>
                                    <div style="position: relative; left: 95px;">
                                        <a href="update_form.php?id=<?php echo $each['manufacturer_id'] ?>">
                                            <button class="btn" style="font-size: medium;">Cập nhật</button>
                                        </a>
                                        <a href="delete.php?id=<?php echo $each['manufacturer_id'] ?>">
                                            <button class="btn" style="font-size: medium;">Xoá</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </section>

                <ul id=" list-page" class="pagination modal-1">
                    <li class="page-number">
                        <?php if ($page > 1) { ?>
                            <a href="?page=<?php echo $page - 1 ?>&search_manufacturer=<?php echo $search ?>" class="prev">&laquo</a>
                        <?php } else { ?>
                            <a href="" class="prev">&laquo;</a>
                        <?php } ?>
                    </li>
                    <?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
                        <li class="page-number">
                            <a href="?page=<?php echo $i ?>&search_manufacturer=<?php echo $search ?>">
                                <?php echo $i ?>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="page-number">
                        <?php if ($page < $number_of_pages) { ?>
                            <a href="?page=<?php echo $page + 1 ?>&search_manufacturer=<?php echo $search ?>" class="next">&raquo;</a>
                        <?php } else { ?>
                            <a href="" class="next">&raquo;</a>
                        <?php } ?>

                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>