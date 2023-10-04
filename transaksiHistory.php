<?php
include 'apotekdb.php';

$sql = "SELECT t.Transaction_ID, k.Staff_ID, c.Customer_Name, m.Medicine_Name, t.Price, t.Transaction_Date
        FROM `Transaction` t
        INNER JOIN Kasir k ON t.Kasir_ID = k.Kasir_ID
        INNER JOIN Customer c ON t.Customer_ID = c.Customer_ID
        INNER JOIN Medicine m ON t.Medicine_ID = m.Medicine_ID";

$result = $koneksi->query($sql);
?>

<html>
<head>
    <title>List Transaksi</title>
</head>
<body>
    <h1>List Transaksi</h1>
    <table>
        <tr>
            <th>Transaction ID</th>
            <th>Staff ID</th>
            <th>Customer Name</th>
            <th>Medicine Name</th>
            <th>Price</th>
            <th>Transaction Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['Transaction_ID']; ?></td>
                <td><?php echo $row['Staff_ID']; ?></td>
                <td><?php echo $row['Customer_Name']; ?></td>
                <td><?php echo $row['Medicine_Name']; ?></td>
                <td><?php echo $row['Price']; ?></td>
                <td><?php echo $row['Transaction_Date']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <form method="POST" action="main.php">
        <input type="submit" value="back">
    </form>
</body>
</html>
