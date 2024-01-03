<link rel="stylesheet" href="../../../plugins/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="../../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<script src="../../../plugins/jquery/jquery.min.js"></script>
<script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="../../../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../../../dist/js/demo.js"></script>

<?php
session_start();
if (!isset($_SESSION['name']) || $_SESSION['name'] == '') {
    header("Location: ../../login.php");
    exit();
}

include "../../conn.php";

// Retrieve form data
$id_edit = $_POST['id_edit']; // Assuming 'id_edit' is a field in your form
$name = $_POST['name'];
$email = $_POST['email'];
$phone_num = $_POST['phone_num'];
$password = $_POST['password'];

// Check if any data has changed
$sql_select = "SELECT * FROM `hr` WHERE `id` = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $id_edit);
$stmt_select->execute();
$result = $stmt_select->get_result();
$row = $result->fetch_assoc();

if (
    $row['name'] === $name &&
    $row['email'] === $email &&
    $row['phone_num'] === $phone_num &&
    $row['password'] === $password
) {
    // No changes in data
    $success_message = "Tiada perubahan dalam data.";
    echo "<script>alert('$success_message'); window.location.href = 'profile.php';</script>";
    exit();
}

// Perform database update
$sql_update = "UPDATE `hr` SET
        `name` = ?,
        `email` = ?,
        `phone_num` = ?,
        `password` = ?
        WHERE `id` = ?";

$stmt = $conn->prepare($sql_update);
$stmt->bind_param(
    "ssssi",
    $name,
    $email,
    $phone_num,
    $password,
    $id_edit
);

$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Update successful
    // $success_message = "Profil berjaya di kemaskini.";
    // echo "<script>alert('$success_message'); window.location.href = 'profile.php';</script>";
    echo '<center><script> 
        Swal.fire({
            title: "Berjaya",
            text: "Profil berjaya di kemaskini.",
            icon: "success"
        }).then(function() {
            window.location.replace("profile.php"); 
        }); </script></center>';
    exit();
} else {
    // Error occurred, handle it accordingly
    $error_message = "Ralat dalam kemaskini data: " . $conn->error;
    echo $error_message;
}

// Close the database connection
$stmt_select->close();
$stmt->close();
$conn->close();
?>
