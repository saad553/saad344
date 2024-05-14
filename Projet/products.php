<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>E-commerce</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>
<body>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php"><h2>Projet <em>PHP</em></h2></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">Our Products</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>new products</h4>
                        <h2></h2>
                    </div>
                    <button onclick="processCheckout();" style="background-color: black; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin: 20px;">Checkout</button>
                </div>
            </div>
        </div>
    </div>
    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="filters-content">
                        <div class="row grid">
                            <?php
                            $products = array(
                                array("id" => 1, "name" => "Iphone 14", "price" => 7000, "image" => "assets/images/Iphone.jpg"),
                                array("id" => 2, "name" => "Macbook", "price" => 18000, "image" => "assets/images/Mac.jpg"),
                                array("id" => 3, "name" => "PC PORTABLE HP", "price" => 12000, "image" => "assets/images/Pc2.jpg"),
                                array("id" => 4, "name" => "Iphone 12", "price" => 5000, "image" => "assets/images/Iphone2.jpg"),
                                array("id" => 5, "name" => "Gaming PC", "price" => 15000, "image" => "assets/images/Pc.jpg"),
                                array("id" => 6, "name" => "PS5", "price" => 5000, "image" => "assets/images/PS5.jpg"),
                            );

                            foreach ($products as $product) {
                                echo '<div class="col-lg-4 col-md-4 all des">';
                                echo '<div class="product-item">';
                                echo '<img src="' . $product['image'] . '" alt="">';
                                echo '<div class="down-content">';
                                echo '<h4>' . $product['name'] . '</h4>';
                                echo '<h6>' . $product['price'] . 'dh</h6>';
                                echo '<p>Produit Example</p>';
                                echo '<div class="form-group">';
                                echo '<label for="quantity' . $product['id'] . '">Quantité:</label>';
                                echo '<input type="number" id="quantity' . $product['id'] . '" class="form-control" min="1" value="1">';
                                echo '</div>';
                                echo '<button type="button" onclick="addToCart(' . htmlspecialchars(json_encode($product)) . ')" class="btn btn-primary btn-block" style="background-color: #f33f3f; border-color: #f33f3f;">Ajouter au panier</button>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    function addToCart(product) {
        let quantityInput = document.getElementById('quantity' + product.id);
        let quantity = parseInt(quantityInput.value);
        if (isNaN(quantity) || quantity < 1) quantity = 1;

        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let found = cart.find(p => p.id === product.id);

        if (found) {
            found.quantity = quantity; // Update the existing quantity
        } else {
            product.quantity = quantity;
            cart.push(product);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        alert("Product added");
    }

    function processCheckout() {
        
        let cart = localStorage.getItem('cart');
        if (cart) {
            alert("Passer au checkout?");
            window.location.href = 'checkout.php?cart=' + encodeURIComponent(cart);
            localStorage.removeItem('cart'); // Clear the cart after redirecting
        } else {
            alert("Your cart is empty!");
        }
    }
</script>
</body>
</html>
