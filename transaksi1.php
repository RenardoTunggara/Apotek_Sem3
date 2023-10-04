<?php
include 'apotekdb.php';

// Ambil daftar kasir untuk pilihan
$sqlKasir = "SELECT k.Kasir_ID, s.Staff_Name FROM Kasir k
             INNER JOIN Staff s ON k.Staff_ID = s.Staff_ID";
$resultKasir = $koneksi->query($sqlKasir);

// Ambil daftar medicine untuk pilihan
$sqlMedicine = "SELECT Medicine_ID, Medicine_Name FROM Medicine";
$resultMedicine = $koneksi->query($sqlMedicine);

// Ambil daftar customer untuk pilihan
$sqlCustomer = "SELECT Customer_ID, Customer_Name FROM Customer";
$resultCustomer = $koneksi->query($sqlCustomer);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tambahkan logika untuk mengelola transaksi
}
?>

<html>
<head>
    <title>Transaksi</title>
</head>
<body>
    <h1>Transaksi</h1>
    <form method="POST">
        <label for="kasir">Pilih Kasir:</label>
        <select name="kasir">
            <?php while ($row = $resultKasir->fetch_assoc()): ?>
                <option value="<?php echo $row['Kasir_ID']; ?>"><?php echo $row['Staff_Name']; ?></option>
            <?php endwhile; ?>
        </select><br>

        <label for="medicine">Pilih Medicine:</label>
        <select name="medicine">
            <?php while ($row = $resultMedicine->fetch_assoc()): ?>
                <option value="<?php echo $row['Medicine_ID']; ?>"><?php echo $row['Medicine_Name']; ?></option>
            <?php endwhile; ?>
        </select><br>

        <form method="POST">
        <label for="customer">Pilih Customer:</label>
        <select name="customer">
            <?php while ($row = $resultCustomer->fetch_assoc()): ?>
                <option value="<?php echo $row['Customer_ID']; ?>"><?php echo $row['Customer_Name']; ?></option>
            <?php endwhile; ?>
        </select><br>

        <label for="transaction_date">Tanggal Transaksi:</label>
        <input type="date" name="transaction_date" required><br>


        <!-- Tambahkan input untuk mengelola transaksi -->
        <?php
    if (isset($_POST['Cus'])) {
        header("Location: tambahCustomer.php");
        exit(); 
    }
    ?>

    <form method="post">
        <input type="submit" name="Cus" value="Tambah Customer Baru">
    </form>

        <input type="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['balikT'])) {
        header("Location: main.php");
        exit(); 
    }
    ?>   

<form method="post">
        <input type="submit" name="balikT" value="back">
    </form>
</body>
</html>
