<?php
  //server information for dsn connection.
  $sqlServerName = $_SERVER["SQL_SVR"];
  $sqlUser = $_SERVER["SQL_USR"];
  $sqlPass = $_SERVER["SQL_PASS"];
  $dbName = "wwnet";

  // set the PDO error mode to exception
  try {
    $pdo = new PDO("mysql:host=$sqlServerName;dbname=$dbName", $sqlUser, $sqlPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "<p>ERROR: FAILED TO GET INFORMATION FROM DATABASE. PLEASE <a href=\"mailto:errorreport@willwitherspoon.net\">CONTACT</a> SYSTEM ADMINSTRATOR FOR ASSISTANCE.</p><br>";
    exit();
  }

?>
