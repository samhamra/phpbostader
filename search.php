<?php
 $servername = "mysql-vt2016.csc.kth.se";
 $username = "shamra_admin";
 $password = "rOVAeCpn";
 $database = "shamra";
 $statement = "SELECT DISTINCT lan FROM bostader";
 try {
   $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $preparedstmt = $conn->prepare($statement);
   $preparedstmt->execute();
   $result = $preparedstmt->fetchAll();


 } catch(PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
 }

 ?>

<!DOCTYPE html>
<html lang="sv">
  <head>
     <link href="search.css" rel="stylesheet">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body style="margin: 50px;">
    <form class="form-horizontal" method="post" action="index.php">
      <div class="form-group">
        <label>Län</label>
        <select class="form-control" name="lan">
          <?php
          foreach($result as $city) {
            echo "<option value=" . $city['lan'] . ">" . $city['lan'] . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
      <label>Objekttyp </label>
      <select class ="form-control" name="objekttyp">
        <option value="villa">Villa </option>
        <option value="bostadsrätt">Bostadsrätt</option>
      </select>
    </div>
    <div class="form-inline">
      <label>MinArea </label>
      <input class ="form-control" type="number" name="minArea">
      <label>MaxArea </label>
      <input class ="form-control" type="number" name="maxArea">
    </div>
    <div class="form-inline">
      <label>MinRum </label>
      <input class ="form-control" type="number" name="minRum">
      <label>MaxRum </label>
      <input class ="form-control" type="number" name="maxRum">
    </div>
    <div class="form-inline">
      <label>MinPris </label>
      <input class ="form-control" type="number" name="minPris">
      <label>MaxPris </label>
      <input class ="form-control" type="number" name="maxPris">
    </div>
    <div class="form-inline">
      <label>MinAvgift </label>
      <input class ="form-control" type="number" name="minAvgift">
      <label>MaxAvgift </label>
      <input class ="form-control" type="number" name="maxAvgift">
    </div>



    <input class="btn btn-default" type="submit" value="Search">
    </form>
  </body>
    <script src="search.js" charset="utf-8"></script>
</html>
