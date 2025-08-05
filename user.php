
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "info";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// إدخال بيانات جديدة
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $conn->query("INSERT INTO user (name, age) VALUES ('$name', $age)");
}

// تغيير الحالة
if (isset($_GET['toggle_id'])) {
    $id = $_GET['toggle_id'];
    $conn->query("UPDATE user SET status = 1 - status WHERE id = $id");
}

// استرجاع البيانات
$result = $conn->query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Smart Methods Task</title>
</head>
<body>
    <h2>Add User</h2>
    <form method="POST">
        Name: <input type="text" name="name" required>
        Age: <input type="number" name="age" required>
        <button type="submit" name="add_user">Submit</button>
    </form>

    <h2>User List</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Name</th><th>Age</th><th>Status</th><th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['age'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="?toggle_id=<?= $row['id'] ?>">Toggle</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>