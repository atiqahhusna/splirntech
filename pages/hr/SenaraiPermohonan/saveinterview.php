<link rel="stylesheet" href="../../../plugins/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="../../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<script src="../../../plugins/jquery/jquery.min.js"></script>
<script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="../../../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../../../dist/js/demo.js"></script>

<?php
extract($_POST);
extract($_GET);
include "../../conn.php";

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the form data
    $student_id = $_POST['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $link = $_POST['onlineMeetingLink'];
    $statusInterview = "Temuduga";
    $statusApplicationIntern = "Temuduga"; // Status to update in application_intern

    // Use a JOIN to fetch student information based on the student_id
    // $queryInterview = "INSERT INTO interview (student_id, interview_date, interview_time, location, status)
    //                   SELECT student.id, '$date', '$time', '$location', '$statusInterview'
    //                   FROM student
    //                   WHERE student.id = '$student_id'";

    $queryInterview = "INSERT INTO interview (student_id, interview_date, interview_time, location, interview_link, status)
                      VALUES ('$student_id', '$date', '$time', '$location', '$link', '$statusInterview')";

    $queryUpdateStatus = "UPDATE application_intern SET status = 'Temuduga'
    WHERE student_id = '" . $student_id . "'";

    if (mysqli_query($conn, $queryInterview)) {
       

        if (mysqli_query($conn, $queryUpdateStatus)) {
            // Status updated successfully in application_intern table
           echo '<center><script> 
                Swal.fire({
                    title: "Berjaya",
                    text: "Temuduga pelajar baru disimpan. Email berjaya dihantar.",
                    icon: "success"
                }).then(function() {
                    window.location.href = document.referrer;
                }); </script></center>';
        } else {
            // Error occurred while updating status in application_intern table
            echo '<script>alert("Ralat semasa mengemas kini status: ' . mysqli_error($conn) . '");</script>';
            echo '<script>window.location.href = document.referrer;</script>';
        }
    } else {
        // Error occurred while inserting data into interview table
        echo '<script>alert("Ralat semasa menyimpan temuduga: ' . mysqli_error($conn) . '");</script>';
        echo '<script>window.location.href = document.referrer;</script>';
    }
} else {
    // Redirect back to the form if the form is not submitted
    header("Location: list_apply.php");
    exit;
}
?>
