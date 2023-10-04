<?php
include 'apotekdb.php';

$sql = "SELECT s.Staff_ID, s.Staff_Name, s.Staff_Shift, w.Shift_Time, s.Staff_Address, s.Staff_Salary, s.Staff_Gender, s.Staff_Phone FROM Staff s
        LEFT JOIN Work w ON s.Staff_ID = w.Staff_ID";

$result = $koneksi->query($sql);
?>

<html>
<head>
    <title>List Staff</title>
</head>
<body>
    <h1>List Staff</h1>
    <table>
        <tr>
            <th>Staff ID</th>
            <th>Staff Name</th>
            <th>Shift</th>
            <th>Shift Time</th>
            <th>Addreses</th>
            <th>Salary</th>
            <th>Gender</th>
            <th>Phone</th>

        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['Staff_ID']; ?></td>
                <td><?php echo $row['Staff_Name']; ?></td>
                <td><?php echo $row['Staff_Shift']; ?></td>
                <td><?php echo $row['Shift_Time']; ?></td>
                <td><?php echo $row['Staff_Address']; ?></td>
                <td><?php echo $row['Staff_Salary']; ?></td>
                <td><?php echo $row['Staff_Gender']; ?></td>
                <td><?php echo $row['Staff_Phone']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    
    <?php
    if (isset($_POST['moveToPage'])) {
        header("Location: main.php");
        exit(); 
    }
    ?>        
    <form method="post">
        <input type="submit" name="moveToPage" value="back">
    </form>
</body>
</html>
