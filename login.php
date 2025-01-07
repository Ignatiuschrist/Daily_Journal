<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    include('connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['user'];

        $password = md5($_POST['pass']);

        $stmt = $conn->prepare("SELECT username
                                FROM user
                                WHERE username=? AND password=?");

        $stmt->bind_param("ss", $username, $password);

        $stmt->execute();

        $hasil = $stmt->get_result();

        $row = $hasil->fetch_array(MYSQLI_ASSOC);

        if (!empty($row)) {
            $_SESSION['username'] = $row['username'];

            header("location:admin.php");
        } else {
            echo "<p style='color: red; text-align: center;'>Username atau Password salah!</p>";
        }
    }
    ?>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card p-4 shadow" style="width: 400px;">
            <h2 class="text-center mb-4">Login</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" class="form-control" name="user" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" name="pass" required>
                </div>
                <button type="submit" class="btn btn-secondary w-100">Login</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>