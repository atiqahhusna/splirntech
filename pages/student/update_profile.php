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
$id_edit = $_POST['id_edit']; // Assuming 'id_edit' is a field in your form
$name = $_POST['name'];
$email = $_POST['email'];
$phone_num = $_POST['phone_num'];
$password = $_POST['password'];

// Check if any data has changed
$sql_select = "SELECT * FROM `student` WHERE `student_id` = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("s", $id_edit);
$stmt_select->execute();
$result = $stmt_select->get_result();
$row = $result->fetch_assoc();

if (
    $row['name'] === $name &&
    $row['email'] === $email &&
    $row['phone_num'] === $phone_num &&
    $row['password'] === $password
) {
    echo '<center><script> 
    Swal.fire({
        title: "Berjaya",
        text: "Tiada perubahan dibuat.",
        icon: "success"
    }).then(function() {
        window.location.replace("profile_student.php"); 
    }); </script></center>';
}

// Perform database update
$sql_update = "UPDATE `student` SET
        `name` = ?,
        `email` = ?,
        `phone_num` = ?,
        `password` = ?
        WHERE `student_id` = ?";

$stmt = $conn->prepare($sql_update);
$stmt->bind_param(
    "sssss",
    $name,
    $email,
    $phone_num,
    $password,
    $id_edit
);



if ($stmt->execute()) {
    echo '<center><script> 
    Swal.fire({
        title: "Berjaya",
        text: "Profil anda berjaya dikemaskini.",
        icon: "success"
    }).then(function() {
        window.location.replace("profile_student.php"); 
    }); </script></center>';
} else {
    echo '<center><script> 
    Swal.fire({
        title: "Berjaya",
        text: "Profil anda tidak berjaya dikemaskini.",
        icon: "error"
    }).then(function() {
        window.location.replace("profile_student.php"); 
    }); </script></center>';
}

// Close the database connection
$stmt_select->close();
$stmt->close();
$conn->close();
?>
