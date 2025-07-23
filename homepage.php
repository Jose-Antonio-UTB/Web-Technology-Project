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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <script>
        function showToast() {
            const toast = document.getElementById("toast");
            if (!toast) return;

            toast.classList.add("show");
            setTimeout(() => {
                toast.classList.remove("show");
            }, 3000);
        }

        const params = new URLSearchParams(window.location.search);
        if (params.get("success") === "1") {
            showToast();

            const url = new URL(window.location);
            url.searchParams.delete("success");
            window.history.replaceState({}, document.title, url.toString());
        }
    </script>
</head>
<div id="toast" class="toast">Added to cart!</div>    
<body>
    <div class = "page-wrapper">
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
        
        <div class="mainbody">
            <div class="container">
                <div class="wrapper">
                    <img src="https://store.warframe.com/cdn/shop/files/Star-Days-Stickers-Shopify-1920-x-550_1944x.jpg?v=1738853579">
                    <img src="https://store.warframe.com/cdn/shop/files/WF1999-Collection-Shopify-1920-x-550_1_1944x.jpg?v=1734113511">
                    <img src="https://store.warframe.com/cdn/shop/files/WF-1999-Album-1920x550_1944x.png?v=1734968248">
                    <img src="https://store.warframe.com/cdn/shop/files/Star-Days-Stickers-Shopify-1920-x-550_1944x.jpg?v=1738853579">
                </div>  
            </div>

            <h1>FEATURED</h1>
            <div class="image-container">
                <?php
                    $selected_ids = [3030, 3033, 3029, 3032, 3028];

                    $placeholders = implode(',', array_fill(0, count($selected_ids), '?'));
                    $types = str_repeat('i', count($selected_ids));

                    $sql = "SELECT * FROM products WHERE product_id IN ($placeholders)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param($types, ...$selected_ids);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()):
                ?>
                    <div class="card">
                        <a href="shoptemplate.php?id=<?php echo $row['product_id']; ?>">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>">
                            <div class="card-content">
                                <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                                <p>BHD <?php echo number_format($row['price'], 2); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="viewbutton">
                <a href="featured.php" class="buttonview">View All <span>&#10230;</span></a>
            </div>
        </div>
        
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