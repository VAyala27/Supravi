<?php
require('../include/server.php');

$con = connectDB();

$sql = "SELECT id, product_img, product_name, product_price,category_id FROM products";
$result = mysqli_query($GLOBALS['con'], $sql);
$product = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = '$id'";
    mysqli_query($GLOBALS['con'], $sql);
    header("location: item_management.php");
}