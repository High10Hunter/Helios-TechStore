<?php
require '../check_admin_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="sidebar.css">
    <style type="text/css">
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
</head>

<body>
    <?php
    include '../menu.php';
    require '../connectDB.php';
    ?>
    <div id='center' class="main center">
        <form method="POST" style="text-align:center">
            <br>
            <h3>Thống kê doanh thu trong khoảng thời gian:</h3>
            <?php if (isset($_POST['begin_date'])) { ?>
                <input type="date" name="begin_date" value="<?php echo $_POST['begin_date'] ?>" />
                <i class="fa fa-calendar"></i> đến
            <?php } else { ?>
                <input type="date" name="begin_date" />
                <i class="fa fa-calendar"></i> đến
            <?php } ?>

            <?php if (isset($_POST['end_date'])) { ?>
                <input type="date" name="end_date" value="<?php echo $_POST['end_date'] ?>" />
                <i class="fa fa-calendar"></i>
            <?php } else { ?>
                <input type="date" name="end_date" />
                <i class="fa fa-calendar"></i>
            <?php } ?>
            <br>
            <br>
            <button>Thống kê</button>
            <br><br>
            <?php
            if (isset($_POST['begin_date']) && isset($_POST['end_date'])) { ?>

                <div id="statistic" style="text-align: center">
                    Số đơn hàng:
                    <?php
                    $begin = $_POST['begin_date'];
                    $end = $_POST['end_date'];
                    $sql = "select count(*) from orders
                    where DATE_FORMAT(created_at, '%Y-%m-%d')
                    between '$begin' and '$end'";
                    $result = mysqli_query($connect_db, $sql);
                    $number_of_orders_in_date_range = mysqli_fetch_array($result)['count(*)'];
                    echo $number_of_orders_in_date_range;
                    ?> đơn
                    <br>
                    Doanh thu:
                    <?php
                    $sql = "SELECT sum(total_price) as revenue 
                    from orders 
                    WHERE status = 1 and
                    DATE_FORMAT(created_at, '%Y-%m-%d') between '$begin' and '$end'";
                    $result = mysqli_query($connect_db, $sql);
                    $revenue = mysqli_fetch_array($result)['revenue'];
                    echo $revenue;
                    ?>
                </div>
            <?php } ?>
            <hr>
        </form>
        <div id="best_selling_product" style="text-align: center;">
            <p style="font-size:medium; font-weight:bold">Sản phẩm đang bán chạy:
                <?php
                $sql = "SELECT
                products.product_id,
                product_name,
                ifnull(sum(orders_products.quantity),0) as sales
                FROM products
                left join orders_products ON orders_products.product_id = products.product_id
                LEFT join orders on orders.order_id = orders_products.order_id
                where orders.status = 1 or orders.order_id is null
                GROUP BY product_id
                order by sales DESC;";
                $result = mysqli_query($connect_db, $sql);
                $best_selling_product = mysqli_fetch_array($result);
                echo $best_selling_product['product_name'];
                ?>
            </p>
        </div>
        <div id="number_of_customer" style="text-align:center;">
            Số khách hàng:
            <?php
            $sql = "select count(*) from customers";
            $result = mysqli_query($connect_db, $sql);
            $number_of_customers = mysqli_fetch_array($result)['count(*)'];
            echo $number_of_customers;
            ?> khách hàng
        </div>

        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/drilldown.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                const days = 30;
                $.ajax({
                    type: "GET",
                    url: "../orders/get_sold_products.php",
                    data: {
                        days
                    },
                    dataType: "json",
                    success: function(response) {
                        const arr = Object.values(response[0]);
                        const arrDetail = [];
                        Object.values(response[1]).forEach((each) => {
                            each.data = Object.values(each.data);
                            arrDetail.push(each);
                        })
                        setTimeout(function() {
                            getChart(days, arr, arrDetail)
                        }, 100);
                    }

                });

            });

            function getChart(days, arr, arrDetail) {
                Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Tổng doanh thu trong ' + days + ' ngày'
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Doanh thu'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:f}'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> total<br/>'
                    },

                    series: [{
                        name: "Sản phẩm",
                        colorByPoint: true,
                        data: arr
                    }],
                    drilldown: {
                        breadcrumbs: {
                            position: {
                                align: 'right'
                            }
                        },
                        series: arrDetail,
                    }
                });
            }
        </script>
    </div>
</body>

</html>