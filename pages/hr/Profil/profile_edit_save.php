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

// Check if a new profile picture is being uploaded
$new_profile_pic = $_FILES['new_profile_pic']['name']; // Assuming 'new_profile_pic' is the name of the file input field

if ($new_profile_pic != '') {
    // Process the uploaded file
    $target_directory = "../../upload/";
    $target_file = $target_directory . basename($_FILES['new_profile_pic']['name']);
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
                window.location.replace("profile.php"); 
            }); </script>';
        exit();
    }

    if (move_uploaded_file($_FILES['new_profile_pic']['tmp_name'], $target_file)) {
        // Update the profile picture field in the database
        $sql_update_pic = "UPDATE `hr` SET `profile_pic` = ? WHERE `id` = ?";
        $stmt_pic = $conn->prepare($sql_update_pic);
        $stmt_pic->bind_param("si", $new_profile_pic, $id_edit);
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
                window.location.replace("profile.php"); 
            }); </script>';
        exit();
    }
}

// Perform database update for other fields
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
    echo '<script> 
        Swal.fire({
            title: "Success",
            text: "Profile updated successfully.",
            icon: "success"
        }).then(function() {
            window.location.replace("profile.php"); 
        }); </script>';
    exit();
} else {
    $error_message = "Error updating data: " . $conn->error;
    echo $error_message;
}

$stmt->close();
$conn->close();
?>
