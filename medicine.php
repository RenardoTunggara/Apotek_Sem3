<?php
include 'apotekdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medicineID = $_POST['medicineID'];
    $newStock = $_POST['newStock'];

    // Validasi jika $newStock adalah angka positif
    if (!is_numeric($newStock) || $newStock < 0) {
        echo "Jumlah stok harus angka positif.";
    } else {
        // Update jumlah stok di database
        $updateSql = "UPDATE Medicine SET Medicine_Stock = $newStock WHERE Medicine_ID = '$medicineID'";
        if ($koneksi->query($updateSql) === TRUE) {
            echo "Jumlah stok obat berhasil diperbarui.";
        } else {
            echo "Error: " . $koneksi->error;
        }
    }
}

$sql = "SELECT Medicine_ID, Supplier_Name, Medicine_Name, Medicine_Description, Medicine_Date, Medicine_Price, Medicine_Stock
        FROM Medicine m
        INNER JOIN Supplier s ON m.Suplier_ID = s.Supplier_ID";

$result = $koneksi->query($sql);
?>

<html>
<head>
    <title>Medicine</title>
</head>
<body>
    <h1>Medicine</h1>
    <table>
        <tr>
            <th>Medicine ID</th>
            <th>Supplier name</th>
            <th>Medicine name</th>
            <th>Medicine description</th>
            <th>Medicine expierd date</th>
            <th>Medicine price</th>
            <th>Medicine stock</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['Medicine_ID']; ?></td>
                <td><?php echo $row['Supplier_Name']; ?></td>
                <td><?php echo $row['Medicine_Name']; ?></td>
                <td><?php echo $row['Medicine_Description']; ?></td>
                <td><?php echo $row['Medicine_Date']; ?></td>
                <td><?php echo $row['Medicine_Price']; ?></td>
                <td><?php echo $row['Medicine_Stock']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="medicineID" value="<?php echo $row['Medicine_ID']; ?>">
                        <input type="number" name="newStock" placeholder="New Stock" required>
                        <input type="submit" value="Update Stock">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <form method="POST" action="main.php">
        <input type="submit" value="back">
    </form>
</body>
</html>
