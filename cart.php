<?php 
include 'includes/header.php';

// Remove item from cart
if(isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
    echo "<script>window.location.href='cart.php';</script>";
}
?>

<div class="container my-5">
    <h2 class="mb-4 fw-bold">Your Shopping Cart</h2>
    
    <?php if(!empty($_SESSION['cart'])): ?>
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grand_total = 0;
                foreach($_SESSION['cart'] as $id => $item): 
                    $total = $item['price'] * $item['quantity'];
                    $grand_total += $total;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>₹<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>₹<?php echo number_format($total, 2); ?></td>
                    <td><a href="cart.php?remove=<?php echo $id; ?>" class="btn btn-danger btn-sm">Remove</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-end">
            <h4>Grand Total: <span class="text-success">₹<?php echo number_format($grand_total, 2); ?></span></h4>
            <a href="checkout.php" class="btn btn-success btn-lg mt-3">Proceed to Checkout (Week 3)</a>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">Your cart is empty! <a href="index.php">Shop Now</a></div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>