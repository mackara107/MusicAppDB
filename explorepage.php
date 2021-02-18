<html>
<head>
<title>Check Out These Playlists!</title>
</head>
<body>
<form action="http://localhost:1234/explorepage.php" method="post">

  <p><b>Check Out These Playlists!</b></p>


  <?php
  require_once('/XAMPP/mysqli_connect.php');
$allvals = "SELECT * FROM playlist";
$allvals = mysqli_query($dbc, $allvals);

while ($row = mysqli_fetch_array($allvals)) {
    echo $row['playlistID'];
    $id = $row['playlistID'];
    echo(". Playlist: ");
    echo $row['playlistName'];
    echo("<br>Created By: ");
    echo $row['username'];
    echo("<br>On: ");
    echo $row['dateCreated'];
    echo("<br><br>");

    $songs = "SELECT s.songName, a.firstname_primary, a.lastName from playlisthassongs p, song s, album b, artist a where p.playlistID = $id and p.songID = s.songID and s.albumID = b.albumID and b.artistID = a.artistID";
    $songs = mysqli_query($dbc, $songs);
    while ($rowsongs = mysqli_fetch_array($songs)){
        echo $rowsongs['songName'];
        echo(" - ");
        echo $rowsongs['firstname_primary'];
        echo(" ");
        echo $rowsongs['lastName'];
        echo("<br>");
      }
    echo("<br><br>");

}
if(isset($_POST['back'])){
  header( 'Location: http://localhost:1234/homescreen.php' );
  exit();
}


   ?>

   <p><br><br><br><br><input type="submit" name="back" value="BACK" />

     </html>
