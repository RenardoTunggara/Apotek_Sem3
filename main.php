<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
    

    <h1>APOTEK</h1>
    <form method="post">
        <input type="submit" name="Staff" value="Staff List">
    </form>

    <?php
    if (isset($_POST['Staff'])) {
        header("Location: staff.php");
        exit(); 
    }
    ?>

    <?php
    if (isset($_POST['Med'])) {
        header("Location: medicine.php");
        exit(); 
    }
    ?>

    <?php
    if (isset($_POST['cst'])) {
        header("Location: listCustomer.php");
        exit(); 
    }
    ?>

    <form method="post">
        <input type="submit" name="cst" value="list Customer">
    </form>


    <form method="post">
        <input type="submit" name="Med" value="Medicine List">
    </form>

    <?php
    if (isset($_POST['trk'])) {
        header("Location: transaksi1.php");
        exit(); 
    }
    ?>

    <form method="post">
        <input type="submit" name="trk" value="transaksi">
    </form>

    <?php
    if (isset($_POST['history'])) {
        header("Location: transaksiHistory.php");
        exit(); 
    }
    ?>

    <form method="post">
        <input type="submit" name="history" value="History transaksi">
    </form>

</body>
</html>