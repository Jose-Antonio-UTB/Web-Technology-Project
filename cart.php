<?php
session_start();
include('./connect.php');

$cart_item_count = 0;
$cart_items = [];

if (isset($_SESSION['userinfo'][0])) {
    $user_id = $_SESSION['userinfo'][0]['user_id'];

    $sql = "SELECT SUM(quantity) AS total_items FROM shopping_cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($cart_item_count);
    $stmt->fetch();
    $stmt->close();

    if (!$cart_item_count) {
        $cart_item_count = 0;
    }

    $sql = "SELECT p.product_id, p.product_name, p.image_url, p.price, c.quantity 
            FROM shopping_cart c 
            JOIN products p ON c.product_id = p.product_id 
            WHERE c.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>The Unofficial Warframe Merchandise Website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header_footer.css">
    <link rel="stylesheet" href="cart_style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
</head>

<body>
<div class="page-wrapper">
    <nav class="navbar">
        <div class="navdiv">
            <a href="homepage.php"><img class="img-logo" src="https://www-static.warframe.com/images/landing/logo-white.png" 
            style= 
            "margin-left: 25px;
            margin-top: 5px;
            margin-bottom: 10px;
            max-width: 160px;
            width: 100%;
            height: auto;">
            </a>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="tees.php">Tees</a></li>
                <li><a href="accessories.php">Accessories</a></li>
                <li><a href="featured.php">Featured</a></li>
                <li class="welcome-text">Welcome, <?php
                
                if(isset($_SESSION['userinfo'][0])){
                    $username = $_SESSION['userinfo'][0]['username'];
                    echo $username;
                }

                ?>
                </li>
                <li>
                    <a href="cart.php" class="cart-icon">
                        <i class="ri-shopping-cart-2-line"></i>
                        <span class="cart-item-count"><?php echo $cart_item_count; ?></span>
                    </a>
                </li>
                <a href="logout.php"><button>Log Out</button></a>
            </ul>
        </div>
    </nav>

    <section class="product-collection">
        <h1>Your Cart</h1>
        <div class="product-list">
            <?php if (!empty($cart_items)): ?>
                <form method="POST" action="update_cart.php">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($cart_items as $item): ?>
                            <?php $subtotal = $item['price'] * $item['quantity']; ?>
                            <?php $total += $subtotal; ?>
                            <tr>
                                <td><img src="<?php echo $item['image_url']; ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>"></td>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                <td>
                                    <input type="number" name="quantity[<?php echo $item['product_id']; ?>]" value="<?php echo $item['quantity']; ?>" min="0" required>
                                    <div class="qty-note">Set to 0 to remove</div>
                                </td>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                                <td>
                                    <button type="submit" name="update_product_id" value="<?php echo $item['product_id']; ?>">Update</button>
                                </td>
                                <td>
                                    <button type="submit" name="quantity[<?php echo $item['product_id']; ?>]" value="0" class="delete-btn" onclick="return confirm('Are you sure you want to remove this item?');">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                                <td colspan="2"><strong>$<?php echo number_format($total, 2); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            <?php else: ?>
                <div class="empty-cart-message">
                    <p>Your cart is empty.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if (!empty($cart_items)): ?>
        <div class="checkout-fixed-container">
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    <?php endif; ?>

    <footer>
        <div class="footercontainer">
            <div class="footerNav">
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="tees.php">Tees</a></li>
                    <li><a href="accessories.php">Accessories</a></li>
                    <li><a href="featured.php">Featured</a></li>
                </ul>
            </div>
            <div class="footerBottom">
                <p>All rights reserved to the Warframe and its team.</p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
