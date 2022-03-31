<?php

function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "Supravi";

    $con = mysqli_connect($servername, $username, $password);

    if (!$con) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if (mysqli_query($con, $sql)) {
        $con = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "CREATE TABLE IF NOT EXISTS users(
                        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        firstname VARCHAR(25) NOT NULL,
                        lastname  VARCHAR(25) NOT NULL,
                        username  VARCHAR(25) NOT NULL,
                        email  VARCHAR(25) NOT NULL,
                        password  VARCHAR(25) NOT NULL
                        );";

        if (mysqli_query($con, $sql)) {
            return $con;
        } else {
            echo "Can't create table";
        }
    } else {
        echo "Error while creating database" . mysqli_error($con);
    }
}

function getDataProduct()
{
    $sql = "SELECT * FROM products";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0) {
        return $result;
    }
}

function getDataCategory($categoryId)
{
    $sql = "SELECT * FROM products WHERE category_id = $categoryId";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0) {
        return $result;
    }
}

function getDataSearch($search)
{
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0) {
        return $result;
    }
}

function getDataID($id)
{
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0) {
        return $result;
    }
}

if (isset($_GET['logout'])) {
    unset($_SESSION['usertype']);
    unset($_SESSION['user_id']);
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
    session_destroy();
    echo "<script>
    alert('Logout Successful');
    window.location.href='login.php';
    </script>";
}