<html>
<head>
<title>Welcome!</title>
</head>
<body>
<form action="http://localhost:1234/homescreen.php" method="post">

  <p>To get started, you can EXPLORE existing playlists:</p>
  <p>
  <input type="submit" name="explore" value="Explore" />
  </p>
  <p>Or CREATE your own!</p>
  <p>
  <input type="submit" name="create" value="Create" />
  <p>Or DELETE a playlist from your view!</p>
  <p>
  <input type="submit" name="delete" value="Delete" />
  <p><br><br><br><br><input type="submit" name="logout" value="Log Out" />
</p>

<?php
require_once('/XAMPP/mysqli_connect.php');
if(isset($_POST['explore'])){
  header( 'Location: http://localhost:1234/explorepage.php' );
  exit();
}
if(isset($_POST['create'])){
  header( 'Location: http://localhost:1234/playlistadded.php' );
  exit();
}
if(isset($_POST['delete'])){
  header( 'Location: http://localhost:1234/deleteplaylist.php' );
  exit();
}
if(isset($_POST['logout'])){
  header( 'Location: http://localhost:1234/login.php' );
  exit();
}
?>
