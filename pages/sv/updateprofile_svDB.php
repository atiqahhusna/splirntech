<link rel="stylesheet" href="../../plugins/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../../dist/js/demo.js"></script>


<?php
session_start();
if (!isset($_SESSION['name']) || $_SESSION['name'] == '') {
    header("Location: ../login.php");
    exit();
}

include "../conn.php";

// Retrieve form data
$id_edit = $_SESSION['id']; // Assuming 'id_edit' is a field in your form
$name = $_POST['name'];
$email = $_POST['email'];
$phone_num = $_POST['phone_num'];
$password = $_POST['password'];

// Check if any data has changed
$sql_select = "SELECT * FROM `supervisor` WHERE `id` = ?";
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
    echo "<script>alert('$success_message'); window.location.href = 'profile_sv.php';</script>";
    exit();
}

// Perform database update
$sql_update = "UPDATE `supervisor` SET `name` = ?, `email` = ?, `phone_num` = ?, `password` = ? WHERE `id` = ?";

$stmt = $conn->prepare($sql_update);
$stmt->bind_param( "ssssi", $name, $email, $phone_num, $password, $id_edit);

if ($stmt->execute()) {
    echo '<center><script> 
    Swal.fire({
        title: "Berjaya",
        text: "Profil anda berjaya dikemaskini.",
        icon: "success"
    }).then(function() {
        window.location.replace("profile_sv.php"); 
    }); </script></center>';
} else {
    echo "<center><script> alert('Tidak berjaya dikemaskini.'); </script></center>";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=updateTask_sv.php\">";
}

// Close the database connection
$stmt_select->close();
$stmt->close();
$conn->close();
?>
