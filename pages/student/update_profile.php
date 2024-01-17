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
$unique_id = $_SESSION['studid'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone_num = $_POST['phone_num'];
$password = $_POST['password'];

// Check if a new profile picture is being uploaded
$new_profile_pic = $_FILES['new_profile_pic']['name']; // Assuming 'new_profile_pic' is the name of the file input field

if ($new_profile_pic != '') {
    // Process the uploaded file

    $folderpic = "profile_pic";
    $directoryPath = "../upload/" . $folderpic;

    // Check if the directory doesn't exist
    if (!is_dir($directoryPath)) {
        // The directory doesn't exist, so create it
        mkdir($directoryPath);
    }

    $target_file = $directoryPath . "/" . basename($_FILES['new_profile_pic']['name']);
    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions (you can modify this as needed)
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");

    if (!in_array($file_extension, $allowed_extensions)) {
        $error_message = "Invalid file format. Please upload a JPG, JPEG, PNG, or GIF file.";
        echo '<script> 
            Swal.fire({
                title: "Error",
                text: "' . $error_message . '",
                icon: "error"
            }).then(function() {
                window.location.replace("profile_student.php"); 
            }); </script>';
        exit();
    }

    if (move_uploaded_file($_FILES['new_profile_pic']['tmp_name'], $target_file)) {
        // Update the profile picture field in the database
        $sql_update_pic = "UPDATE `student` SET `profile_pic` = ? WHERE `id` = ?";
        $stmt_pic = $conn->prepare($sql_update_pic);
        $stmt_pic->bind_param("si", $new_profile_pic, $unique_id);
        $stmt_pic->execute();
        $stmt_pic->close();
    } else {
        $error_message = "Error uploading file.";
        echo '<script> 
            Swal.fire({
                title: "Error",
                text: "' . $error_message . '",
                icon: "error"
            }).then(function() {
                window.location.replace("profile_student.php"); 
            }); </script>';
        exit();
    }
}

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
    $row['password'] === $password &&
    $row['profile_pic'] !== $new_profile_pic
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
