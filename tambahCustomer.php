<?php
include 'apotekdb.php';
$sql = "SELECT Customer_ID, Customer_Name, Customer_Address, Customer_Gender, Customer_Phone FROM Customer";
$result = $koneksi->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerID = $_POST['customer_id'];
    $customerName = $_POST['customer_name'];
    $customerAddress = $_POST['customer_address'];
    $customerGender = $_POST['customer_gender'];
    $customerPhone = $_POST['customer_phone'];

    
if (isset($customerID) && preg_match("/^CI\d{4}$/", $customerID) !== 1) {
    echo "Customer ID harus diawali dengan 'CI' dan diikuti oleh 4 digit angka.";
} else {
    // Cek apakah Customer_ID sudah ada dalam database
    $checkSql = "SELECT COUNT(*) FROM Customer WHERE Customer_ID = '$customerID'";
    $resultCheck = $koneksi->query($checkSql);
    $rowCount = $resultCheck->fetch_assoc()['COUNT(*)'];

    if ($rowCount > 0) {
        echo "Customer dengan ID tersebut sudah ada dalam database.";
    } else {
        // Tambahkan data pelanggan ke database
        $insertSql = "INSERT INTO Customer (Customer_ID, Customer_Name, Customer_Address, Customer_Gender, Customer_Phone)
                      VALUES ('$customerID', '$customerName', '$customerAddress', '$customerGender', '$customerPhone')";

        if ($koneksi->query($insertSql) === TRUE) {
            echo "Pelanggan berhasil ditambahkan ke database.";
        } else {
            echo "Error: " . $koneksi->error;
        }
    }
}
}

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
            <th>Customer Addreses</th>
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

    
          
    
    <form method="POST">
        <label for="customer_id">Customer ID:</label>
        <input type="text" name="customer_id" pattern="CI\d{4}" title="Customer ID harus diawali dengan 'CI' dan diikuti oleh 4 digit angka." required><br>

        <label for="customer_name">Nama Customer:</label>
        <input type="text" name="customer_name" required><br>

        <label for="customer_address">Alamat:</label>
        <input type="text" name="customer_address" required><br>

        <label for="customer_gender">Jenis Kelamin:</label>
        <input type="radio" name="customer_gender" value="Male" required> Male
        <input type="radio" name="customer_gender" value="Female" required> Female<br>

        <label for="customer_phone">Nomor Telepon:</label>
        <input type="text" name="customer_phone" required><br>

        <input type="submit" value="Tambah Customer">
    </form>
    
    <?php
    if (isset($_POST['balikT'])) {
        header("Location: transaksi1.php");
        exit(); 
    }
    ?>  

<form method="POST" action="transaksi1.php">
        <input type="submit" value="back">
    </form>
</body>
</html>
