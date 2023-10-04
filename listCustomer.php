<?php
include 'apotekdb.php';

$sql = "SELECT Customer_ID, Customer_Name, Customer_Address, Customer_Gender, Customer_Phone FROM Customer";
$result = $koneksi->query($sql);
?>

<html>
<head>
    <title>List Customer</title>
</head>
<body>
    <h1>List Customer</h1>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Customer Address</th>
            <th>Customer Gender</th>
            <th>Customer Phone</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['Customer_ID']; ?></td>
                <td><?php echo $row['Customer_Name']; ?></td>
                <td><?php echo $row['Customer_Address']; ?></td>
                <td><?php echo $row['Customer_Gender']; ?></td>
                <td><?php echo $row['Customer_Phone']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <form method="POST" action="main.php">
        <input type="submit" value="back">
    </form>
</body>
</html>
