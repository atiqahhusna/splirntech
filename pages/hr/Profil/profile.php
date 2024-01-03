<?php
session_start();
if (isset($_SESSION['name']) == '') {
	header("Location: ../../login.php");
}

include "../../conn.php";

$sql = "SELECT * FROM `hr` WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['name']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$id_edit = $row['id'];
		$name = $row['name'];
		$email = $row['email'];
		$phone_num = $row['phone_num'];
		$password = $row['password'];
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SPLI RN TECH | Profil</title>

	<?php include "../includes/styles.php"; ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Loading indicator -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img src="/splirnt/assets/img/loading.png" alt="Loading..." class="spinning-image">
		</div>


		<?php
		include("../includes/navbar.php");
		include("../includes/sidebar.php");
		?>

		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Profil Pengguna</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="../dashboard_hr.php">Laman Utama</a></li>
								<li class="breadcrumb-item active">Profil Pengguna</li>
							</ol>
						</div>
					</div>
				</div>
			</div>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card card-warning">
								<div class="card-header">
									<h3 class="card-title">Profil Pengguna</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<form id="form-edit" action="profile_edit_save.php" method="post" enctype="multipart/form-data" class="p-4">
										<div class="container">
											<div class="row justify-content-center">
												<div class="col-md-12">
													<div class="mb-3">
														<label for="name" class="form-label"> Nama:</label>
														<div class="input-group">
															<span class="input-group-text"><i class="bi bi-person-fill"></i></span>
															<input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" <?php echo isset($_GET['edit']) ? '' : 'disabled' ?>>
														</div>
													</div>

													<div class="mb-3">
														<label for="email" class="form-label"> Emel Pengguna:</label>
														<div class="input-group">
															<span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
															<input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" <?php echo isset($_GET['edit']) ? '' : 'disabled' ?>>
														</div>
													</div>

													<div class="mb-3">
														<label for="password" class="form-label">Katalaluan:</label>
														<div class="input-group">
															<span class="input-group-text" id="togglePassword">
																<i class="fas fa-eye"></i>
															</span>
															<input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>" <?php echo isset($_GET['edit']) ? '' : 'disabled' ?>>
														</div>
													</div>

													<div class="mb-3">
														<label for="phone_num" class="form-label">Nombor Telefon:</label>
														<div class="input-group">
															<span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
															<input type="tel" class="form-control" id="phone_num" name="phone_num" value="<?php echo $phone_num ?>" <?php echo isset($_GET['edit']) ? '' : 'disabled' ?>>
														</div>
													</div>

													<div class="text-center">
														<?php if (isset($_GET['edit'])) { ?>
															<button type="submit" class="btn btn-warning">Simpan</button>
															<input type="hidden" id="id_edit" name="id_edit" value="<?php echo $id_edit ?>">
															<a href="javascript:history.back()" class="btn btn-secondary mx-2">Kembali</a>
														<?php } else { ?>
															<a href="?edit=true" class="btn btn-primary">Kemaskini</a>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<!-- /.card-body -->
							</div>
						</div>
					</div>
				</div>
			</section>

		</div>

		<?php
		include("../includes/footer.php");
		?>

		<aside class="control-sidebar control-sidebar-dark">
		</aside>
	</div>

	<script src="../../../plugins/jquery/jquery.min.js"></script>
	<script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="../../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="../../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="../../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="../../../plugins/jszip/jszip.min.js"></script>
	<script src="../../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="../../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<script src="../../../dist/js/adminlte.min.js"></script>
	<script src="../Profil/profil.js"></script>

</body>

</html>