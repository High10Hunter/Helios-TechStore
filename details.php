<?php
if (empty($_SESSION['customer_id'])) {
    $check_login = false;
} else {
    $check_login = true;
}

$id = $_GET['id'];
require 'admin/connectDB.php';
$sql = "select * from products
where product_id = '$id'";
$result = mysqli_query($connect_db, $sql);
$each = mysqli_fetch_array($result);
?>

<div class="container">
    <div class="middle">
        <div class="middle__gallery">
            <img class="middle__img" src="admin/products/products_images/<?php echo $each['image'] ?>" alt="" />
        </div>

        <div class="middle__description">
            <div class="description__name">
                <p><?php echo $each['product_name'] ?></p>
            </div>

            <div class="description__head">
                <p style="color: red;">Giá: <?php echo $each['price'] ?> VNĐ</p>
            </div>

            <h2>Mô tả:</h2>
            <div class="description__info">
                <?php echo $each['description'] ?>
            </div>
            <?php if ($check_login == true) { ?>
                <div class="description__btn">
                    <button data-id="<?php echo $id ?>" class="bag add-to-cart-btn">
                        <a href="#" style="color: white; text-decoration:none">
                            Thêm vào giỏ
                        </a>
                    </button>
                </div>
            <?php } ?>

        </div>
    </div>
</div>

<?php
$sql = "select
rating_comment.rating,
rating_comment.comment,
customers.customer_name,
DATE_FORMAT(rating_comment.created_at, '%e-%m-%Y') as rating_date
from rating_comment
join customers on customers.customer_id = rating_comment.customer_id
where product_id = '$id'";
$result = mysqli_query($connect_db, $sql);
$num_rows = mysqli_num_rows($result);
?>

<h2>* Đánh giá từ khách hàng</h2>
<?php if ($num_rows != 0) { ?>

    <div class="display_rating_and_comment" style="position:relative; left: 15px;">
        <?php foreach ($result as $each) { ?>
            <ul>
                <li>
                    <div class="comment-container">
                        <div class="costumer-aval">
                            <span class="costumer-name">
                                <?php echo $each['customer_name'] ?>
                            </span>
                            </br>
                            <span class="star-rating">
                                <?php for ($i = 1; $i <= $each['rating']; $i++) { ?>
                                    <?php echo '<i class="star"></i>' ?>
                                <?php } ?>
                            </span>
                            </br>
                            <span style="font-size: 15px;">
                                <?php echo $each['rating_date'] ?>
                            </span>
                        </div>
                    </div>

                    <p style="font-size:medium;" class="comment-text">
                        <?php echo $each['comment'] ?>
                    </p>
                </li>
            </ul>
        <?php } ?>
    </div>
<?php } else { ?>
    <h3 style="color:orange">Chưa có đánh giá nào</h3>
<?php } ?>

<br>
<?php if ($check_login == true) { ?>
    <div class="rating_and_comment" style="position: relative; left: 15px;">
        <h1>Đánh giá sản phẩm</h1>
        <form method="POST" action="rating_process.php">
            <textarea name="comment" style="width: 250px; height: 100px;
            font-size:medium"></textarea>
            <input type="hidden" name="product_id" value="<?php echo $id ?>">
            <input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id'] ?>">
            <br>
            <fieldset class="rating">
                <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
            </fieldset>
            <button type="submit" style="display: block;
      float: left;
      width: 70px;height: 30px;
      background-color: #3dd28d;
      text-align: center;
      font-weight:600;
      position: relative;
      text-decoration: none;
      margin: 10px;
      border:0.5px solid black;
      overflow: hidden;
      font-size:15px;">Đánh giá</button>
        </form>
    </div>
<?php } ?>