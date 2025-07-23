<?php
session_start();
include('./connect.php');

if (!isset($_SESSION['userinfo'][0])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['userinfo'][0]['user_id'];

if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        $product_id = intval($product_id);
        $quantity = intval($quantity);

        if ($product_id > 0) {
            if ($quantity <= 0) {
                $sql = "DELETE FROM shopping_cart WHERE user_id = ? AND product_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $user_id, $product_id);
                $stmt->execute();
                $stmt->close();
            } else {
                $sql = "UPDATE shopping_cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iii", $quantity, $user_id, $product_id);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
}

header("Location: cart.php");
exit();
?>
