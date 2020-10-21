<?php
session_start();
require('server.php');
$con = connectDB();

$user = $_SESSION['user_id'];
$sql = "SELECT DISTINCT o.order_id, o.order_created, p.total_amount, os.name
    FROM orders o
    LEFT JOIN order_status os ON o.status=os.order_status_id
    LEFT JOIN payment p ON o.user_id = p.user_id
    WHERE o.user_id = $user AND p.id = o.order_id
    ORDER BY o.order_id ASC
    ";
$result = mysqli_query($GLOBALS['con'], $sql);

// $order = mysqli_fetch_assoc($result);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <title>My Orders</title>
</head>

<body>
    <?php
    include 'include/header.php';
    ?>
    <main>
        <div class="container height-100">
            <div class="row">
                <div class="col-12 my-5 text-center">
                    <h1>My Orders</h1>
                </div>
            </div>

            <div class="row pb-5">
                <div class="col-12 col-md-3">
                    <div class="list-group">
                        <a href="my_account.php?id=<?php echo $_SESSION['user_id']; ?>"
                            class=" list-group-item list-group-item-action">Personal Info</a>
                        <a href="my_orders.php" class="list-group-item list-group-item-actio active">My Orders</a>
                    </div>
                </div>

                <div class="col-12 col-md-9">
                    <div class="d-flex">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['order_created']); ?></td>
                                    <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($order['name']); ?></td>
                                    <td><a class="btn btn-outline-dark"
                                            href="my_order_details.php?id=<?php echo $order['order_id']; ?>">View</a>
                                    </td>
                                    <input type='hidden' name='id' value="<?php echo $order['order_id']; ?>">
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include 'include/footer.php'; ?>

    <script src=" http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
        integrity="sha256-Y1rRlwTzT5K5hhCBfAFWABD4cU13QGuRN6P5apfWzVs=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="app.js"></script>