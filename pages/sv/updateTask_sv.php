<?php
// Start or resume the session
session_start();

include "../conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SPLI RN TECH | Task</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
	<link rel="stylesheet" href="../../dist/css/adminlte.css">
	<link rel="stylesheet" href="../../dist/css/alt/splicss.css">
	<link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
</head>

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Loading indicator -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img src="/splirnt/assets/img/loading.png" alt="Loading..." class="spinning-image">
		</div>
		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		<?php
		include("includes/navbar.php");
		?>


		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		<?php
		include("includes/mainsidebar.php");
		?>

		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Maklumbalas</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="dashboard_sv.php">Laman Utama</a></li>
								<li class="breadcrumb-item active">Tugasan Harian</li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<section class="content">
				<div class="container-fluid">
					<div class="card card-navy">
						<div class="card-header">
							<h3 class="card-title">Maklumat Aktiviti Tugasan</h3>
						</div>
						<?php
						$student_id = $_REQUEST['student_id'];
						if (isset($student_id)) {
							$id = $_REQUEST['unique_id'];
							$query = "SELECT * FROM task_activity WHERE student_id = '" . $student_id . "' AND id = '" . $id . "'";
							$result = mysqli_query($conn, $query);
							$num_rows = mysqli_num_rows($result);
							while ($row = mysqli_fetch_array($result)) {
						?>
								<div class="card-body">
									<form method='post' action='updateTask_svDB.php?unique_id=<?php echo $id; ?>&student_id=<?php echo $student_id ?>'>
										<div class="form-group">
											<div class="mb-3">
												<label for="week">Minggu</label>
												<input type="text" class="form-control" name="unique_week" value="<?php echo $row["week"]; ?>" readonly>
											</div>

											<div class="mb-3">
												<label for="description">Keterangan</label>
												<textarea class="form-control" name="description" readonly style="height: 150px;"><?php echo $row["task_description"]; ?></textarea>
											</div>

											<div class="mb-3">
												<label for="date">Tarikh</label>
												<input type="text" class="form-control" name="date" value="<?php echo date("d/m/Y", strtotime($row["task_date"])) ?>" readonly>
											</div>

											<div class="mb-3">
												<label for="time">Jumlah Masa</label>
												<input type="text" class="form-control" name="time" value="<?php echo $row["total_time"]; ?>" readonly>
											</div>

											<div class="mb-3">
												<label for="comment">Maklumbalas*</label>
												<input type="text" class="form-control" name="comment" value="<?php echo $row['comment']; ?>" required>
											</div>
											<div cclass="mb-3">
												<label for="level">Peringkat*</label>
												<p class="padding-left:95px;">
													<input type="radio" name="level" id="level" value="Sangat Tidak Memuaskan" required>&emsp;Sangat Tidak Memuaskan&emsp;&emsp;
													<input type="radio" name="level" id="level" value="Tidak Memuaskan" required>&emsp;Tidak Memuaskan&emsp;&emsp;
													<input type="radio" name="level" id="level" value="Memuaskan" required>&emsp;Memuaskan&emsp;&emsp;
													<input type="radio" name="level" id="level" value="Sangat Memuaskan" required>&emsp;Sangat Memuaskan&emsp;&emsp;
												</p>
											</div>

											<button type="submit" name="submit" class="btn btn-danger" onclick="return confirmUpdate()">Simpan</button>
											<a href="studentActivityView_sv.php?student_id=<?php echo $student_id ?>&unique_week=<?php echo $row['week']; ?>" class="btn btn-warning">Kembali</a>

										</div>
									</form>
								</div>
						<?php
							}
						}
						?>
					</div><!-- /.card -->
				</div><!-- /.container-fluid -->
			</section><!-- Section -->


			<br><br>
		</div>
		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		<?php
		include("includes/footer.php");
		?>


	</div>

	<script src="../../plugins/jquery/jquery.min.js"></script>
	<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../../plugins/chart.js/Chart.min.js"></script>
	<script src="../../plugins/sparklines/sparkline.js"></script>
	<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
	<script src="../../plugins/moment/moment.min.js"></script>
	<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
	<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
	<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<script src="../../dist/js/adminlte.js"></script>
	<script src="../../dist/js/demo.js"></script>
	<script src="../../dist/js/pages/dashboard.js"></script>
</body>

</html>