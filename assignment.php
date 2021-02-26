<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h2>Working with MySQL Database</h2>

    <form action="assignment.php" method="post">
        The age is <input type="text" name="txtAge" value="" placeholder="#" id="">and UP!
        <input type="submit" value="View" name="btnSubmit">
    </form>
    <?php
    require 'db.php';
    if (isset($_POST['btnSubmit'])) {
        $age = $_POST['txtAge'];
        $sql = mysqli_query($conn, "SELECT * FROM ecommercetable WHERE age >=" . $age . " Order BY age DESC");
        echo "<table border=1>
        <tr>
        <td>ID</td>
        <td>NAME</td>
        <td>AGE</td>
        </tr>";
        // output data of each row
        while ($row = mysqli_fetch_array($sql)) {
            echo '
                <tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['age'] . '</td>
                </tr>

                ';
        }
    }
    echo '</table>';
    ?>
</body>

</html>
