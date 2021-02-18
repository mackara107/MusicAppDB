<html>
<head>
<title>Delete Playlist</title>
</head>
<body>
<form action="http://localhost:1234/deleteplaylist.php" method="post">
  <p><b>Delete Playlist</b></p>
  <p>Enter Playlist Number:
  <input type="int" name="playlistid" size="30" value="" />
  <input type="submit" name="delete" value="Delete";
  </p>

<?php
require_once('/XAMPP/mysqli_connect.php');
if(isset($_POST['delete'])){
  $id = null;
  if(isset($_POST['playlistid'])){
    $id = $_POST['playlistid'];
    $query = "DELETE from playlist where playlistid = '$id'";
    $query2 = "DELETE from playlisthassongs where playlistid = '$id'";

    if (mysqli_query($dbc, $query2) == TRUE && mysqli_query($dbc, $query) === TRUE) {
      echo "Playlist deleted successfully";
    }
    else {
      echo "Error deleting playlist.";
    }
  }
}
if(isset($_POST['back'])){
  header( 'Location: http://localhost:1234/homescreen.php' );
  exit();
}


?>
<p><br><br><br><br><input type="submit" name="back" value="BACK" />
</form>
</html>
