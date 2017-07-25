<?php
include_once('dbcon.php');

$error = false;
if(isset($_POST['btn-contact'])){
    //clean user input to prevent sql injection
    $konu = $_POST['konu'];
    $konu = strip_tags($konu);
    $konu = htmlspecialchars($konu);

    $adsoyad = $_POST['adsoyad'];
    $adsoyad = strip_tags($adsoyad);
    $adsoyad = htmlspecialchars($adsoyad);

    $email = $_POST['email'];
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
	
	$ileti = $_POST['ileti'];
    $ileti = strip_tags($ileti);
    $ileti = htmlspecialchars($ileti);
	
	//validate
    if(empty($konu)){
        $error = true;
        $errorKonu = 'Lütfen Konu alanını boş bırakmayınız';
    }
	
	//validate
    if(empty($adsoyad)){
        $error = true;
        $errorAdsoyad = 'Lütfen Ad - Soyad alanını boş bırakmayınız';
    }
	
	//validate
    if(empty($email)){
        $error = true;
        $errorEmail = 'Lütfen Email alanını boş bırakmayınız';
    }
	
	//validate
    if(empty($ileti)){
        $error = true;
        $errorİleti = 'Lütfen İleti alanını boş bırakmayınız';
    }
	
	//insert data if no error
    if(!$error){
        $sql = "insert into contact(konu, adsoyad, email, ileti)
                values('$konu', '$adsoyad', '$email', '$ileti')";
        if(mysqli_query($conn, $sql)){
            $successMsg = 'Mesajınız Alınmıştır.';
        }else{
            echo 'Error '.mysqli_error($conn);
        }
    }

}
	
?>


<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>İletişim Sayfası</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </head>
  <body>
	
<div class="container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
<div class="row text-center">
<p><div class="col-md-12"><h2  style="margin:0;"><b>İletişim Sayfası</b></h2></div></p>
</div>
<?php
                    if(isset($successMsg)){
                 ?>
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            <?php echo $successMsg; ?>
                        </div>
                <?php
                    }
                ?>
  <div class="form-group">
    <label for="examplekonu1">Konu</label>
    <input type="konu"  name="konu" class="form-control" id="examplekonu1" placeholder="Konu">
	<span class="text-danger"><?php if(isset($errorKonu)) echo $errorKonu; ?></span>
  </div>
  <div class="form-group">
    <label for="exampleadsoyad1">Ad - Soyad</label>
    <input type="adsoyad"  name="adsoyad" class="form-control" id="exampleadsoyad1" placeholder="Ad - Soyad">
	<span class="text-danger"><?php if(isset($errorAdsoyad)) echo $errorAdsoyad; ?></span>
  </div>
  <div class="form-group">
    <label for="exampleEmail1">E-Mail</label>
    <input type="email"  name="email" class="form-control" id="exampleEmail1" placeholder="E-Mail">
	<span class="text-danger"><?php if(isset($errorEmail)) echo $errorEmail; ?></span>
  </div>
  <div class="form-group">
      <label for="comment">İleti</label>
      <textarea class="form-control"  name="ileti" rows="5" id="comment" placeholder="İleti"></textarea>
	  <span class="text-danger"><?php if(isset($errorİleti)) echo $errorİleti; ?></span>
    </div>
  <button type="submit" name="btn-contact" class="btn btn-default">Gönder</button>
</form>
</div>


</body>
</html>