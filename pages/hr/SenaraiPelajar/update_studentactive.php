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
    exit(); // Stop further execution if not authenticated
}

include "../../conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_edit'])) {
   
    // Retrieve values from the form
    $user_id = $_POST['id_edit'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_num = $_POST['phone_num'];
    $address = $_POST['address'];
    $start_intern_formatted= $_POST['start_intern'];
    $last_intern_formatted= $_POST['last_intern'];

    // Update student information in the database
    $update_student_query = "UPDATE `student` SET `name`='$name', `email`='$email', `phone_num`='$phone_num', `address`='$address' WHERE student_id='" . $user_id . "'";
    $update_intern_query = "UPDATE `application_intern` SET `start_intern`='$start_intern_formatted', `last_intern`='$last_intern_formatted' WHERE `student_id`='$user_id'";

    $stmtStudent = $conn->prepare($update_student_query);
    $stmtIntern = $conn->prepare($update_intern_query);

    // Execute the statements
    $successStudent = $stmtStudent->execute();
    $successIntern = $stmtIntern->execute();

    // Close the statements
    $stmtStudent->close();
    $stmtIntern->close();

    // Check if both updates were successful
    if ($successStudent && $successIntern) {
     


        echo '<center><script> 
            window.location.replace("viewlist_studentactive.php?id=' . $user_id .'"); </script></center>'; 

    } else {
        '<center><script> 
            window.location.replace("viewlist_studentactive.php?id=' . $user_id .'"); </script></center>'; 
    }
    
} else {

    // Handle cases where the form data or ID is not properly received
    echo "Invalid request";
}

?>
