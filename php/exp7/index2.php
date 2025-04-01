<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Products</title>

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
    ?>
</head>
<body>
    
    <div class="row-flex">

        <form action="" method="GET">

            <select name="searchkey" id="search" >
                <?php
                    foreach( $columns as $col ) {
                        $keyselected = ( isset($_GET["searchkey"]) && $_GET["searchkey"] == $col ) ? "selected" : "";
                        echo "<option value=\"$col\" $keyselected>" . $col . "</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Fetch">
        </form>
        
        <?php
            if( isset($_GET["searchkey"]) ) {
                
                $search = $_GET["searchkey"];

                $values = $conn->query( "SELECT DISTINCT $search FROM wearables;");

                echo '<form action="" method="GET">';
                echo '<select name="searchval" id="val">';

                while( $row = $values->fetch_assoc() ) {
                    $val = $row["$search"];
                    $val_selected = ( isset($_GET["searchval"]) && $_GET["searchval"] == $val ) ? "selected" : "";
                    echo "<option value=\"$val\" $val_selected>" . $val . "</option>";
                }
                
                echo '</select>';

                echo "<input type=\"text\" name=\"searchkey\" value=\"$search\" hidden>";
                echo '<input type="submit" value="Search">';
            }


            if( isset( $_GET["searchkey"] ) && isset($_GET["searchval"]) ) {
                $searchkey = $_GET["searchkey"];
                $searchval = $_GET["searchval"];

                $products = $conn->query( "SELECT * FROM wearables WHERE $searchkey = '$searchval';");
            } else {
                $products = $conn->query( "SELECT * FROM wearables;");
            }
        ?>
    </div>

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
                <th>Prize</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($products->num_rows > 0) {
                    while ($row = $products->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["brand"] . "</td>";
                        echo "<td>" . $row["category"] . "</td>";
                        echo "<td>" . $row["type"] . "</td>";
                        echo "<td>" . $row["color"] . "</td>";
                        echo "<td>" . $row["size"] . "</td>";
                        echo "<td> ₹ " . $row["price"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No Products found.</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>