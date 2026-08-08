<?php 
include 'includes/header.php';
$msg = "";

if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if($row = mysqli_fetch_assoc($result)) {
        if(password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            
            if($row['role'] == 'admin') {
                echo "<script>window.location.href='admin-dashboard.php';</script>";
            } else {
                echo "<script>window.location.href='index.php';</script>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Invalid Password!</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>No account found with this email!</div>";
    }
}
?>

<div class="container my-5" style="max-width: 400px;">
    <div class="card shadow">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">User Login</h3>
            <?php echo $msg; ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>