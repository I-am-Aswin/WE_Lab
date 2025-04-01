<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
        }
        div {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 75%;
        }
        form {
            display: flex;
            gap: 1rem;
        }
        input[type="text"] {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 0.5rem 1rem;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 0.5rem;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

    <?php
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

        $students = [];
        $searchQuery = "";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $rollno = $_POST['rollno'];
            $name = $_POST['name'];
            $dept = $_POST['dept'];

            $query = "INSERT INTO students (rollno, name, dept) VALUES ('$rollno', '$name', '$dept')";
            if ($conn->query($query)) {
                echo "<p style='color:green;'>Student added successfully!</p>";
            } else {
                echo "<p style='color:red;'>Error adding student: " . $conn->error . "</p>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['search'])) {
            $searchQuery = $_GET['search'];
            $query = "SELECT * FROM students WHERE rollno LIKE '%$searchQuery%' OR name LIKE '%$searchQuery%' OR dept LIKE '%$searchQuery%'";
            $students = $conn->query($query);
        } else {
            $students = $conn->query("SELECT * FROM students");
        }
    ?>

    <div>
        <form action="" method="POST">
            <input type="text" name="rollno" id="rollno" placeholder="Register Number" required>
            <input type="text" name="name" id="name" placeholder="Student Name" required>
            <input type="text" name="dept" id="dept" placeholder="Department" required>
            <input type="submit" value="Add Student">
        </form>

        <form action="" method="GET">
            <input type="text" name="search" id="search" placeholder="Search by Roll No, Name, or Department" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <input type="submit" value="Search">
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Register Number</th>
                <th>Name</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($students->num_rows > 0) {
                    while ($row = $students->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["rollno"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["dept"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No students found.</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <?php
        $conn->close();
    ?>
</body>
</html>