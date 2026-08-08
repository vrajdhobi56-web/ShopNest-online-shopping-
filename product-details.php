<?php 
include 'includes/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);

if(!$product) {
    echo "<div class='container my-5'><h3>Product not found!</h3></div>";
    include 'includes/footer.php';
    exit();
}

// Add to Cart logic using PHP Session
if(isset($_POST['add_to_cart'])) {
    if(!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login first to add items to cart!'); window.location.href='login.php';</script>";
        exit();
    }
    
    $product_id = $product['id'];
    $product_name = $product['name'];
    $product_price = $product['price'];
    
    // Initialize Cart Array in Session if not exists
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check if product already in cart
    if(isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        ];
    }
    echo "<script>alert('Product added to cart successfully!'); window.location.href='cart.php';</script>";
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo !empty($product['image']) ? $product['image'] : 'https://via.placeholder.com/400'; ?>" class="img-fluid rounded shadow" alt="Product Image">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold"><?php echo htmlspecialchars($product['name']); ?></h2>
            <p class="text-success fs-4 fw-bold">₹<?php echo number_format($product['price'], 2); ?></p>
            <p class="text-muted"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            
            <form action="" method="POST" class="mt-4">
                <button type="submit" name="add_to_cart" class="btn btn-primary btn-lg">Add to Cart 🛒</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>