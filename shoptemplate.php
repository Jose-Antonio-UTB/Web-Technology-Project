<?php
    session_start();
    include('./connect.php');

    $cart_item_count = 0;

    if(isset($_SESSION['userinfo'][0])) {
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
    }

    $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $product = null;

    if ($product_id > 0) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $product = $result->fetch_assoc();
        }

        $stmt->close();
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <title>The Unofficial Warframe Merchandise Website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header_footer.css">
    <link rel="stylesheet" href="templatestyle.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
    
    <body>
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

        <div class="back-button-container">
            <button onclick="history.back()" class="back-btn">← Back</button>
        </div>

        <div class="mainbody">
            <div class="product">
                <div class="image-gallery">
                    <img src="<?php echo $product ? htmlspecialchars($product['image_url']) : ''; ?>" id="productImg">
                </div>
                <div class="product-details">
                    <div class="details">
                        <?php if ($product): ?>
                            <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                            <h3>BD<?php echo number_format($product['price'], 2); ?></h3>
                            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                        <?php else: ?>
                            <h2>Product not found</h2>
                            <p>This product does not exist or is unavailable.</p>
                        <?php endif; ?>
                    </div>
                    <div class="submit">
                        <form action="submit_order.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product ? $product['product_id'] : ''; ?>">
                            <input type="hidden" name="price" value="<?php echo $product ? $product['price'] : ''; ?>">
                            <input type="hidden" name="redirect_back" value="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER'] ?? 'homepage.php'); ?>">
                            <div class="quantity">
                                <div class="select-quantity">
                                    <h3>Quantity: </h3>
                                    <input type="number" name="quantity" value="1" min="1">
                                </div>
                            </div>
                            <div class="sub-btn">
                                <button class="submit" type="submit">Buy</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="footercontainer">
                <div class="footerNav">
                    <ul>
                        <li><a href="https://www.warframe.com">About Us</a></li>
                        <li><a href="businessweb.html">Home</a></li>
                        <li><a href="tees.html">Tees</a></li>
                        <li><a href="accessories.html">Accessories</a></li>
                        <li><a href="featured.html">Featured</a></li>
                    </ul>
                </div>
    
                <div class="footerBottom">
                    <p>All rights reserved to the Warframe and its team.</p>
                </div>
            </div>
        </footer>
    </body>
</html>