<?php

require '../connectDB.php';
$max_date = $_GET['days'];
$sql = "SELECT 
products.product_name as 'product_name',
products.product_id as 'product_id',
DATE_FORMAT(created_at, '%e-%m') as 'order_date', 
SUM(quantity) as 'sale'
FROM orders 
JOIN orders_products on orders_products.order_id = orders.order_id
JOIN products on products.product_id = orders_products.product_id
where date(created_at) >= CURDATE() - INTERVAL $max_date DAY
GROUP BY products.product_id,DATE_FORMAT(created_at, '%e-%m');";
$result = mysqli_query($connect_db, $sql);

$today = date('d');
$arr = [];
if ($today < $max_date) {
    $get_day_of_last_month = $max_date - $today - 1;
    $last_month_date = date('Y-m-d', strtotime("first day of last month"));
    $last_month = date('m', strtotime("first day of last month"));
    $end_day_last_month = (new DateTime($last_month_date))->format('t');
    $start_day_of_last_month = $end_day_last_month - $get_day_of_last_month;

    $start_day_of_this_month = 1;
} else {
    $start_day_of_this_month = $today - $max_date - 1;
}

$arr = [];
foreach ($result as $each) {
    $product_id = $each['product_id'];
    if (empty($arr[$product_id])) {
        $arr[$product_id] = [
            'name' => $each['product_name'],
            'y' => (float)$each['sale'],
            'drilldown' => (int)$each['product_id']
        ];
    } else {
        $arr[$product_id]['y'] += (float)$each['sale'];
    }
}

$arr2 = [];
foreach ($arr as $product_id => $each) {
    $arr2[$product_id] = [
        'name' => $each['name'],
        'id' => $product_id
    ];
    $arr2[$product_id]['data'] = [];
    for ($i = $start_day_of_last_month; $i <= $end_day_last_month; $i++) {
        $key = $i . "-" . $last_month;
        $arr2[$product_id]['data'][$key] = [
            $key,
            0
        ];
    }
    for ($i = $start_day_of_this_month; $i <= date('d'); $i++) {
        $key = $i . "-" . date('m');
        $arr2[$product_id]['data'][$key] = [
            $key,
            0
        ];
    }
}

foreach ($result as $each) {
    $product_id = $each['product_id'];
    $key = $each['order_date'];
    $arr2[$product_id]['data'][$key] = [
        $key,
        (float)$each['sale']
    ];
}

$object = json_encode([$arr, $arr2]);
echo $object;
