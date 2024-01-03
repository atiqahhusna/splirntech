<link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../dist/js/demo.js"></script>

<?php
include "conn.php";
// Start or resume the session
session_start();

    // $id = $_SESSION['id'];
if (isset($_POST['submit'])) {
    $apply_date = $_POST['dateApply'];
    $student_name = $_POST['name'];
    $student_email = $_POST['email'];
    $student_address = $_POST['address'];
    $student_phone = $_POST['phone_num'];
    $apply_date = $_POST['dateApply'];
    $apply_time = $_POST['timeApply'];
    $uni_name = $_POST['universiti'];
    $uni_phone = $_POST['phoneNumU'];
    $course = $_POST['course'];
    // $resume = $_POST['resume'];
    $last_intern = $_POST['dateEnd'];
    $start_intern = $_POST['dateStart'];
    $post_id = $_GET['post_id'];

    // Check if the file input is set and not empty
    if (isset($_FILES['pdfFile']) && !empty($_FILES['pdfFile']['name'])) {
        $pdfFileName = $_FILES['pdfFile']['name'];
        $pdfTempName = $_FILES['pdfFile']['tmp_name'];

        

        // Define the directory path where you want to save the PDF file
        $uploadPath = __DIR__ . '/upload/' . $pdfFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($pdfTempName, $uploadPath)) {
            // Insert data into the student table
            $password = generatePassword();
            $queryStudent = "INSERT INTO student (name, phone_num, email, password, address, sv_id, status, student_id) VALUES (?,?,?,?,?,'SV000','Baru', 'IS000')";
            $stmtStudent = $conn->prepare($queryStudent);

            // Bind parameters
            $stmtStudent->bind_param("sssss", $student_name, $student_phone, $student_email, $password, $student_address);
            $stmtStudent->execute();
            $stmtStudent->close();

            $getID = "SELECT id FROM student WHERE name = '" . $student_name . "' AND email = '" . $student_email . "'";
            $result = $conn->query($getID);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $studentNo_ID = $row['id'];
            }
            } else {
            echo "0 results";
            }


            // Insert data into the application_intern table
            $query = "INSERT INTO application_intern (student_id, apply_date, apply_time, uni_name, uni_phone, course, resume, last_intern, start_intern, intern_post_id, status) VALUES (?,?,?,?,?,?,?,?,?,?, 'Baru')";
            $stmt = $conn->prepare($query);

            // Bind parameters
            $stmt->bind_param("issssssssi", $studentNo_ID, $apply_date, $apply_time, $uni_name, $uni_phone, $course, $pdfFileName, $last_intern, $start_intern, $post_id);
            $updateResult = mysqli_stmt_execute($stmt);

            if ($updateResult) {
                // If update is successful, show a pop-up and redirect to list_apply.php

                echo '<center><script> 
                        Swal.fire({
                            title: "Berjaya",
                            text: "Permohonan Anda Berjaya Dihantar! Kami akan menghantar email untuk tindakan selanjutnya.",
                            icon: "success"
                        }).then(function() {
                            window.location.replace("../index.php"); 
                        }); </script></center>';
            } else {
                // If there is an error, display the error message
                echo 'Error: ' . mysqli_error($conn);
            }
} else {
echo "Error uploading file.";
}
} else {
    echo '<center><script> 
            Swal.fire({
                title: "Tidak Berjaya",
                text: "Maklumat yang diisi perlulah lengkap dengan dokumen.",
                icon: "error"
            }).then(function() {
                window.location.replace("../index.php"); 
            }); </script></center>';
}

$conn->close();
}

function generatePassword() {
    // Generate a random 6-digit number
    $password = rand(100000, 999999);
    return $password;
}
?>