<?php
session_start();
require('../include/server.php');
require_once('../include/products.php');

$con = connectDB();

if (isset($_GET['action'])) {
    if ($_GET['action'] == "delete") {
        foreach ($_SESSION["cart"] as $key => $value) {
            if ($value['product_id'] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                header('location:/Supravi/cart/');
            }
        }
    }
}

if (isset($_POST["qty"])) {
    foreach ($_SESSION['cart'] as $key => &$item) {
        if ($item['product_id'] == $_POST['id']) {
            $item['item_quantity'] = htmlspecialchars($_POST['qty']);
            header('location:/Supravi/cart/');
        }
    }
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
    <link rel="stylesheet" href="../css/style.css">
    <title>Cart</title>
</head>

<body>
    <?php
    include("../include/header.php");
    ?>
    <main class="height-100">
        <h3 class="py-5 text-center">Shopping Cart Details</h3>
        <table class="table table-bordered">
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price Details</th>
                <th>Total Price</th>
                <th></th>
            </tr>

            <?php
            if (!empty($_SESSION['cart'])) {
                $id = $_GET['product_id'];
                $total = 0;
                foreach ($_SESSION['cart'] as $key => $value) {
            ?>
            <tr>
                <td><img src="<?php echo $value['product_img']; ?>" class="img-fluid" width="100px" height="100px"
                        alt="">
                </td>
                <td><?php echo $value['item_name']; ?></td>
                <td>
                    <input type="hidden" class="id" value="<?php echo $value['product_id']; ?>">
                    <input type="number" min="1" max="10" name="quantity" class="w-50 form-control qty"
                        value="<?php echo $value['item_quantity']; ?>" />
                </td>
                <td>$<?php echo $value['product_price']; ?></td>
                <td>$<?php echo number_format($value['item_quantity'] * $value['product_price'], 2); ?>
                </td>
                <td><a href="/Supravi/cart/?action=delete&id=<?php echo $value['product_id']; ?>"><span
                            class="text-danger">Remove</span></a>
                </td>
            </tr>

            <?php $total = $total + ($value['item_quantity'] * $value['product_price']);
                }
                ?>
            <tr>
                <td colspan="4" align="right">Tax</td>
                <th align="right">$ <?php echo number_format(5.00, 2); ?></th>
                <td></td>
            </tr>

            <tr>
                <td colspan="4" align="right">Total</td>
                <?php $total = $total + 5.00; ?>
                <th align="right">$ <?php echo number_format($total, 2); ?></th>
                <td></td>
            </tr>
            <?php
            }
            ?>
        </table>

        <?php if ($count == 0) { ?>
        <a href="all_products.php" class="btn btn-warning d-block w-25 mt-5 mx-auto">Continue Shopping</a>";
        <?php } else if (isset($_SESSION['user_id'])) { ?>
        <a href="<?php echo '/Supravi/' . 'checkout' ?>" class="btn btn-warning d-block w-25 mt-5 mx-auto">Proceed to
            Buy <i class="fas fa-arrow-right"></i></a>
        <?php } else { ?>
        <a href="<?php echo '/Supravi/' . 'sign_in_checkout' ?>"
            class="btn btn-warning d-block w-25 mt-5 mx-auto">Proceed to Buy
            <i class="fas fa-arrow-right"></i></a>
        <?php }  ?>
        ?>

    </main>

    <?php
    include("../include/footer.php");
    ?>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
        integrity="sha256-Y1rRlwTzT5K5hhCBfAFWABD4cU13QGuRN6P5apfWzVs=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
    $('.qty').on('change', function() {
        var tr = $(this).closest('tr');
        var id = tr.find('.id').val();
        var qty = tr.find('.qty').val();
        console.log(tr);
        console.log(id);
        console.log(qty);

        $.ajax({
            url: "index.php",
            type: "POST",
            data: {
                id: id,
                qty: qty
            },
            success: function(data, status) {
                location.reload(true);
                console.log(status);
            }
        })
    })
    </script>