<?php
session_start();
require('server.php');
$con = connectDB();
// include 'include/add_to_cart.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM order_items WHERE order_id = '$id'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"
        integrity="sha256-HAaDW5o2+LelybUhfuk0Zh2Vdk8Y2W2UeKmbaXhalfA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>Orders</title>
</head>

<body>
    <?php include 'include/admin_nav.php'; ?>
    <main class="height-100">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 offset-md-3 px-0">
                <h1 class="text-center my-5">Order Details</h1>
                <div class="d-flex">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                <td>$<?php echo htmlspecialchars($order['product_price']); ?></td>
                                <td><?php echo $order['qty']; ?></td>
                                <td>$<?php echo number_format($order['qty'] * $order['product_price'], 2); ?></td>
                            </tr>
                            </tr> <?php endforeach ?> </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </main>
</body>