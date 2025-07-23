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
<html lang="en">
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
        <h1>Tees</h1>
        <?php
            $category_id = 1201;
            $sql = "SELECT * FROM products WHERE category_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();

            echo '<div class="image-container">';
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
            <?php
            endwhile;
            echo '</div>';

            $stmt->close();
        ?>
    </div>

    <!--Small Alert for Added to Cart-->
    <?php if (isset($_GET['success'])): ?>
        <div class="toast" id="toast">Your order was placed successfully!</div>
        <script>
            const toast = document.getElementById('toast');
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        </script>
    <?php endif; ?>

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