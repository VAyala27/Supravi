<?php
require('../include/server.php');

$con = connectDB();
session_start();


$sql = "SELECT DISTINCT o.order_id, o.order_created, p.total_amount, os.name
    FROM orders o
    LEFT JOIN order_status os ON o.status=os.order_status_id
    LEFT JOIN payment p ON o.user_id = p.user_id
    WHERE p.id = o.order_id
    ORDER BY o.order_id ASC
    ";
$result = mysqli_query($GLOBALS['con'], $sql);

$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<?php include 'include/head.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/top_nav.php'; ?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <main>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Order Management</h1>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <th>Order ID</th>
                                <th>Order Created</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>View</th>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['order_created']); ?></td>
                                    <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($order['name']); ?></td>
                                    <td><a class="btn btn-outline-dark"
                                            href="order_details.php?id=<?php echo $order['order_id']; ?>">View</a>
                                    </td>
                                    <input type='hidden' name='id' value="<?php echo $order['order_id']; ?>">
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include('include/footer.php') ?>


</body>

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
    integrity="sha256-Y1rRlwTzT5K5hhCBfAFWABD4cU13QGuRN6P5apfWzVs=" crossorigin="anonymous"></script>