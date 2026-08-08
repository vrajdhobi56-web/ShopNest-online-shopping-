<?php 
include 'includes/header.php';

// Search query handling
$search = "";
if(isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $product_query = "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
} else {
    $product_query = "SELECT * FROM products";
}
$products = mysqli_query($conn, $product_query);
?>

<div class="container my-4">
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <form action="index.php" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
        </div>
    </div>

    <h2 class="mb-4 text-center fw-bold">Our Products</h2>
    <div class="row">
        <?php if(mysqli_num_rows($products) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($products)): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo !empty($row['image']) ? $row['image'] : 'https://via.placeholder.com/150'; ?>" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <p class="card-text text-success fw-bold">₹<?php echo number_format($row['price'], 2); ?></p>
                            <a href="product-details.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm mt-auto">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted fs-5">No products found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>