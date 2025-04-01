<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $server = "localhost:3306";
    $user = "root";
    $password = "";
    $db = "we_lab";

    $conn = new mysqli($server, $user, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $columns = ["brand", "category", "type", "color", "size"];
    $products = [];

    if (isset($_GET['searchkey'])) {
        $_SESSION['searchkey'] = $_GET['searchkey'];
        setcookie("searchkey", $_GET['searchkey'], time() + 86400, "/");
    } elseif (isset($_COOKIE['searchkey'])) {
        $_SESSION['searchkey'] = $_COOKIE['searchkey'];
    }

    if (isset($_GET['searchval'])) {
        $_SESSION['searchval'] = $_GET['searchval'];
        setcookie("searchval", $_GET['searchval'], time() + 86400, "/");
    } elseif (isset($_COOKIE['searchval'])) {
        $_SESSION['searchval'] = $_COOKIE['searchval'];
    }
    
    $searchkey = $_SESSION['searchkey'] ?? "";
    $searchval = $_SESSION['searchval'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Products</title>
</head>
<body>
    <div class="row-flex">
        <form action="" method="GET">
            <select name="searchkey" id="search">
                <?php
                    foreach ($columns as $col) {
                        $keyselected = ($searchkey == $col) ? "selected" : "";
                        echo "<option value=\"$col\" $keyselected>" . ucfirst($col) . "</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Fetch">
        </form>

        <?php
            if ($searchkey) {
                $values = $conn->query("SELECT DISTINCT $searchkey FROM wearables;");
                echo '<form action="" method="GET">';
                echo '<select name="searchval" id="val">';
                while ($row = $values->fetch_assoc()) {
                    $val = $row[$searchkey];
                    $val_selected = ($searchval == $val) ? "selected" : "";
                    echo "<option value=\"$val\" $val_selected>$val</option>";
                }
                echo '</select>';
                echo "<input type='hidden' name='searchkey' value='$searchkey'>";
                echo '<input type="submit" value="Search">';
                echo '</form>';
            }

            $query = "SELECT * FROM wearables";
            if ($searchkey && $searchval) {
                $query .= " WHERE $searchkey = '$searchval'";
            }
            $products = $conn->query($query);
        ?>
    </div>

    <h2>Recommendations : </h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Type</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($products->num_rows > 0) {
                    while ($row = $products->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row["id"]}</td>";
                        echo "<td>{$row["name"]}</td>";
                        echo "<td>{$row["brand"]}</td>";
                        echo "<td>{$row["category"]}</td>";
                        echo "<td>{$row["type"]}</td>";
                        echo "<td>{$row["color"]}</td>";
                        echo "<td>{$row["size"]}</td>";
                        echo "<td> ₹ {$row["price"]}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No Products found.</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <?php
        $query = "SELECT * FROM wearables";
        $products = $conn->query($query);
    ?>
    <h2>All Products : </h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Type</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($products->num_rows > 0) {
                    while ($row = $products->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row["id"]}</td>";
                        echo "<td>{$row["name"]}</td>";
                        echo "<td>{$row["brand"]}</td>";
                        echo "<td>{$row["category"]}</td>";
                        echo "<td>{$row["type"]}</td>";
                        echo "<td>{$row["color"]}</td>";
                        echo "<td>{$row["size"]}</td>";
                        echo "<td> ₹ {$row["price"]}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No Products found.</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
