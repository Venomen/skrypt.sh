<!DOCTYPE html>

<!--
# Copyright (c) 2019 - Dawid Deręgowski - MIT
#
# Little-ultra-simple-php-uploader
#
# VERSION 1.0.0
-->

<html>
<head>
<title>SKRYPT.sh</title>
<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Inconsolata|Staatliches|ZCOOL+KuaiLe" rel="stylesheet">
<link rel="stylesheet" href="public/css/style.css">
<link rel="shortcut icon" type="image/png" href="public/img/favicon.png"/>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
function reloadPage() {
  location.replace("./");
}
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </head>
  <body style="background-color: #000;">

  <div class="container theme-showcase" role="main">
  <center>
  <a href="/" style="text-decoration:none"><index>SKRYPT.SH</index></a><br><br><br><br>
  <hh2>Wybierasz plik -> wrzucasz -> dostajesz link.. <br></hh2>
  <hh2><code>curl -F "upload=@ip.py" skrypt.sh</code></hh2> <br><br>
  <hh3>..aby pobrać klepiesz przykładowo: <br><br> <code> curl -s skrypt.sh/ip.py | python</code></hh3>
  </center>
  <br><br>

  <?PHP
  $allowed_types = array('py', 'sh', 'rb', 'php', 'js', 'jar', 'go', 'c', 'json' );
  $firstDayNextMonth = date('Y-m-d', strtotime('first day of next month'));
  $end = "<br><br><br><br><br></div><center><div class='footerr'><br><br><br><br><br><br><br><small>&copy; <a href='http://deregowski.net'>deregowski.net</small></a></div></center></div></body></html>";
  ?>

  <div class="box">
  <form enctype="multipart/form-data" action="./" method="POST">
    <font color="white"><h4>Wrzuć swój m@g1czny skrypt!</h4></font>
    <input type="file" class="btn btn-primary" name="upload"></input>
    <input type="submit" class="btn btn-danger" value="Wrzucaj!"></input>
    <input type="button" class="btn btn-sm btn-info" name="refresh" value="Wyczyść" onclick="reloadPage()">
    <?PHP echo 'Limit: ' . ini_get('post_max_size') . "\n"; ?>
    <small><br><font color="grey">Dbaj o unikalną nazwę - pliki i linki są nadpisywane! <br>Dozwolone rozszerzenia: <i><?php echo join (', ', $allowed_types); ?></i>.
		<br> Czyszczenie wszystkiego co miesiąc. Następne: <i><?PHP echo $firstDayNextMonth; ?></i></font></small>
  </form>

<?PHP
  if(!empty($_FILES['upload']))
  {
    $path = "../../";
    // $verifyToken = md5('unique_salt' . $_POST['timestamp']); // not used.. yet ;)
    $path = $path . basename( $_FILES['upload']['name']);
    $extension = pathinfo($path, PATHINFO_EXTENSION);
		$raw_len = number_format($_SERVER['CONTENT_LENGTH'] / 1048576, 2);
    $post_max_size = number_format(ini_get('post_max_size'));

    if (in_array($extension, $allowed_types, false) != true) {
          echo "<font color='red'>Błąd: rozszerzenie <strong>.$extension</strong> jest niedozwolone! </font>";
          echo $end;
          exit;
        }

      if(move_uploaded_file($_FILES['upload']['tmp_name'], $path)) {
        echo "<code><font color='green'>Link: <strong><a target='blank' href='http://skrypt.sh/".  basename( $_FILES['upload']['name'])."'> skrypt.sh/".  basename( $_FILES['upload']['name']). "</a></strong></font></code> ";
     } else {
       echo "<font color='red'>Błąd: nie wybrałeś pliku lub brak uprawnień.</font>";
       echo $end;
     }

  }

  if (isset($_SERVER['CONTENT_LENGTH'])) {
    if (number_format($_SERVER['CONTENT_LENGTH'] / 1048576, 2) > $post_max_size) {
     echo "<font color='red'>Błąd: przekroczyłeś limit 20MB! Próbowałeś wysłać <strong>";
     $length = number_format($_SERVER['CONTENT_LENGTH'] / 1048576, 2) . ' MB </strong></font>';
     echo $length;
    }
  }

echo $end;

?>
