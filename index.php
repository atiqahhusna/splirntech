<?php
session_start();
include "pages/conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SPLI RNTECH</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <header id="header" class="fixed-top d-flex align-items-center" style="background-color: #001f3f;">
    <div class="container d-flex align-items-center">
      <div class="logo me-auto">
        <a href="index.html"><img src="assets/img/rntech.png" alt="" class="img-fluid"></a>
      </div>
      <div class="header-social-links d-flex align-items-center">
        <a href="http://www.rntechnologies.com.my/" class="twitter" style="color: white;"><i class="bi bi-browser-edge"></i></a>
        <a href="https://www.facebook.com/p/RN-Technologies-Sdn-Bhd-100063539293947/" class="facebook" style="color: white;"><i class="bi bi-facebook"></i></a>
        <a href="https://www.linkedin.com/company/rn-technologies-sdn-bhd/about/" class="linkedin" style="color: white;"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </header>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>SELAMAT DATANG KE</h1>
      <h2>SISTEM PENGURUSAN LATIHAN INDUSTRI RN TECHNOLOGIES SDN. BHD.</h2>
      <a href="pages/login.php" class="btn-get-started scrollto">Log Masuk</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Tawaran Latihan Industri</h2>
        </div>

        <div class="row">
          <?php
          $query = "SELECT * FROM intern_post WHERE date_to >= CURDATE()";
          $result = mysqli_query($conn, $query);
          $num_rows = mysqli_num_rows($result);

          // get data from spli_db (supervisor table)
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <div class="col-md-6 mb-4" onclick="location.href='pages/mohonLI.php?post_id=<?php echo $row['id']; ?>';" style="cursor: pointer;">
              <div class="icon-box">
                <i class="bi bi-briefcase"></i>
                <h4><a href="pages/mohonLI.php?post_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h4>
                <?php
                // separate sentence
                $description = $row["description"];
                //split
                $sentences = preg_split('/(?=[0-9]\.)|(?=-)/', $description);
                foreach ($sentences as $sentence) {
                ?>
                  <p><span style='display:block;'><?php echo $sentence;
                                                } ?></span></p>
                  <p>Tarikh Tutup Permohonan : <?php echo date('d/m/Y', strtotime($row['date_to'])); ?></p>
              </div>
            </div>
          <?php } ?>
        </div>

      </div>
    </section><!-- End Services Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
    $Date = gmdate('Y');
  ?>

  <footer id="footer">
    <div class="container d-md-flex py-4">
      <div class="mx-auto text-center text-md-start"> <!-- Updated class here -->
        <div class="copyright">
        <strong>Hak Cipta &copy; <?php echo $Date; ?><a href="#"> RN Technologies Sdn. Bhd</a>.</strong>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


</body>

</html>