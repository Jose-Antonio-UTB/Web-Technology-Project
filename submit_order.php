<?php
session_start();
include('./connect.php');

if (!isset($_SESSION['userinfo'][0])) {
    die("You must be logged in to place an order.");
}

$user_id = $_SESSION['userinfo'][0]['user_id'];
$product_id = intval($_POST['product_id']);
$quantity = intval($_POST['quantity']);

if ($quantity <= 0 || $product_id <= 0) {
    die("Invalid order details.");
}

$sql = "SELECT stocks FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$stmt->bind_result($stock);
$stmt->fetch();
$stmt->close();

if ($stock === null) {
    die("Product not found.");
}

if ($quantity > $stock) {
    die("Not enough stock. Only $stock items left.");
}

$new_stock = $stock - $quantity;
$update = $conn->prepare("UPDATE products SET stocks = ? WHERE product_id = ?");
$update->bind_param("ii", $new_stock, $product_id);
$update->execute();
$update->close();

$sql_check_cart = "SELECT quantity FROM shopping_cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql_check_cart);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($current_quantity);
    $stmt->fetch();
    $new_quantity = $current_quantity + $quantity;

    $update_cart = $conn->prepare("UPDATE shopping_cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
    $update_cart->bind_param("iii", $new_quantity, $user_id, $product_id);
    $update_cart->execute();
    $update_cart->close();
} else {
    $insert = $conn->prepare("INSERT INTO shopping_cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $insert->bind_param("iii", $user_id, $product_id, $quantity);
    $insert->execute();
    $insert->close();
}

$redirect_back = $_POST['redirect_back'] ?? 'homepage.php';
$redirect_back_with_flag = $redirect_back . (strpos($redirect_back, '?') === false ? '?' : '&') . 'success=1';

header("Location: $redirect_back_with_flag");
exit();
?>
