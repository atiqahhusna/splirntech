<?php

include_once "conn.php"; 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        echo "Email and password are required.";
    } else {
        $studentQuery = "SELECT * FROM student WHERE email = ? AND password = ?";
        $studentStmt = mysqli_prepare($conn, $studentQuery);

        if ($studentStmt) {
            mysqli_stmt_bind_param($studentStmt, "ss", $email, $password);
            mysqli_stmt_execute($studentStmt);
            $studentResult = mysqli_stmt_get_result($studentStmt);

            if ($studentRow = mysqli_fetch_assoc($studentResult)) {
                $_SESSION['name'] = strtoupper($studentRow['name']);
                $_SESSION['phone_num'] = $studentRow['phone_num'];
                $_SESSION['address'] = $studentRow['address'];
				$_SESSION['id'] = $studentRow['student_id'];
                $_SESSION['studid'] = $studentRow['id'];
            
                header("Location: student/dashboard_student.php");
                exit();
            }
            
            mysqli_stmt_close($studentStmt);
        }

        $supervisorQuery = "SELECT * FROM supervisor WHERE email = ? AND password = ?";
        $supervisorStmt = mysqli_prepare($conn, $supervisorQuery);

        if ($supervisorStmt) {
            mysqli_stmt_bind_param($supervisorStmt, "ss", $email, $password);
            mysqli_stmt_execute($supervisorStmt);
            $supervisorResult = mysqli_stmt_get_result($supervisorStmt);

            if ($supervisorRow = mysqli_fetch_assoc($supervisorResult)) {
                $_SESSION['name'] = $supervisorRow['name'];
                $_SESSION['phone_num'] = $supervisorRow['phone_num'];
                $_SESSION['position'] = $supervisorRow['position'];
				$_SESSION['id'] = $supervisorRow['id'];
                $_SESSION['sv_id'] = $supervisorRow['sv_id'];


                header("Location: sv/dashboard_sv.php");
                exit();
            }
            mysqli_stmt_close($supervisorStmt);
        }

        $hrQuery = "SELECT * FROM hr WHERE email = ? AND password = ?";
        $hrStmt = mysqli_prepare($conn, $hrQuery);

        if ($hrStmt) {
            mysqli_stmt_bind_param($hrStmt, "ss", $email, $password);
            mysqli_stmt_execute($hrStmt);
            $hrResult = mysqli_stmt_get_result($hrStmt);

            if ($hrRow = mysqli_fetch_assoc($hrResult)) {
				$_SESSION['id'] = strtoupper($hrRow['id']);
                $_SESSION['name'] = strtoupper($hrRow['name']);
                $_SESSION['phone_num'] = $hrRow['phone_num'];

                header("Location: hr/dashboard_hr.php");
                exit();
            }
            mysqli_stmt_close($hrStmt);
        }

        echo "Invalid email or password.";
    }
} else {
    echo "Invalid request.";
}
?>
