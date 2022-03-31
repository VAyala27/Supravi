<?php
require('../include/server.php');

$con = connectDB();
session_start();

$sql = "SELECT id, product_image, product_name, product_price FROM products";
$result = getDataProduct();
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                <h1 class="h3 mb-0 text-gray-800">Product Management</h1>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                                    <td><img width="150px" height="150px"
                                            src=<?php echo htmlspecialchars($product['product_img']); ?> />
                                    </td>
                                    <td><?php echo htmlspecialchars($product['product_name']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($product['product_price']); ?>
                                    </td>
                                    <td><a class="text-muted"
                                            href="update_product.php?id=<?php echo $product['id']; ?>">Edit</a>
                                    </td>
                                    <td><a class="text-danger"
                                            href="delete_product.php?id=<?php echo $product['id']; ?>"
                                            onclick="confirm(`Are you sure you want to delete`)">Delete</a>
                                    </td>
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