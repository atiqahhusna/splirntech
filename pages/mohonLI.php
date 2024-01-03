<?php
$post_id = $_GET['post_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PERMOHONAN</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
<div class="register-box" >
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h3"><b>Permohonan Latihan Industri</b></a>
    </div>
    <div class="card-body">
    <!-- Replace the relevant sections in the first code with the input fields from the second code -->

<form id="form-edit" action="mohonLI_db.php?post_id=<?php echo $post_id;?>" method="post" enctype="multipart/form-data" class="p-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Input fields from the registration form -->
                <div class="mb-3">

                <?php
                    date_default_timezone_set('Asia/Kuala_Lumpur');
                    $Date = gmdate('Y-m-d'); 
                    $currenttime = date('h:ia');
                ?>


                  <!-- <h4>Sila isikan butiran dibawah</h4> -->
                  <!-- <label for="name" class="form-label">Sila isikan butiran dibawah untuk permohonan latihan industri di RN Technologies Sdn.Bhd.</label> -->
                  <div class="mb-3">
                    <label for="date" class="form-label">Tarikh Mohon Latihan Industri:</label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="dateApply" name="dateApply" value="<?php echo $Date; ?>" readonly>
                    </div>
                  </div>
                  <div>
                    <div class="mb-3">
                    <label for="time" class="form-label">Masa Mohon Latihan Industri:</label>
                    <div class="input-group">
                        <input class="form-control" id="timeApply" name="timeApply" value ="<?php echo $currenttime; ?>" placeholder="<?php echo $currenttime; ?>" readonly>
                    </div>
                </div>
                    
                </div>  
                  <label for="name" class="form-label">Nama Penuh:</label>
                    <div class="input-group">
                        <!-- <span class="input-group-text"><i class="bi bi-person-circle"></i></span> -->
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Penuh">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Emel Pengguna:</label>
                    <div class="input-group">
                    <!-- <span class="input-group-text"><i class="bi bi-envelope"></i></span> -->
                        <input type="email" class="form-control" id="email" name="email" placeholder="Emel Pengguna">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Alamat">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone_num" class="form-label">Nombor Telefon:</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="phone_num" name="phone_num" placeholder="Nombor Telefon">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Continue adding the input fields from the registration form -->
                <div class="mb-3">
                    <label for="universiti" class="form-label">Universiti:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="universiti" name="universiti" placeholder="Universiti">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="no_Uni" class="form-label">Nombor Telefon Universiti:</label>
                    <div class="input-group">
                        <input type="phoneNumU" class="form-control" id="phoneNumU" name="phoneNumU" placeholder="Nombor Telefon Universiti">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="course" class="form-label">Kursus:</label>
                    <div class="input-group">
                        <input type="course" class="form-control" id="course" name="course" placeholder="Kursus">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Tarikh Mula Latihan Industri:</label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="dateStart" name="dateStart" placeholder="Tarikh Mula Latihan Industri">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Tarikh Akhir Latihan Industri:</label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="dateEnd" name="dateEnd" placeholder="Tarikh Akhir Latihan Industri">
                    </div>
                </div>

                <!-- <div>
                  <div class="mb-3">
                    <label for="markah" class="form-label">Resume:</label>
                    <br>
                    <input type="file" name="resume" id="resume" >
                  </div>
                </div> -->
                <td>
                  <td>
                    <label for="markah" class="form-label">Resume:</label>
                    <br>
                    <form action="mohonLI.php?post_id=<?php echo $post_id;?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="pdfFile" id="pdfFile">
                        <!-- <input type="submit" value="Muatnaik" name="submit"> -->
                        <br>
                        <!-- <a href ="submit" value="MuatTurun" name="download"> -->
                    </form>
                  </td>
              </td>

              
                <!-- Continue adding any additional input fields from the registration form -->
            </div>
            <input type="submit" class="btn btn-primary btn-block" value="Hantar" name="submit" >

                <!-- Continue adding any additional input fields from the registration form -->
            </div>

            <!-- Include the rest of your form code as it is -->

        </div>
    </div>
</form><br>

    </div>
  </div><!-- /.card -->
</div>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<style>
    .register-box {
        width: 80%; 
        min-height: 500px; 
        margin: auto; 
        margin-top: 50px; 
    }
</style>

</body>
</html>
