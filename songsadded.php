<html>
<head>
<title>Add Songs to your Playlist! </title>
</head>
<body>
<?php


/*$playlist1 = "SELECT MAX(playlistID) from playlist";
$playlist1queried = mysqli_query($dbc, $playlist1);
$playlistarray = $playlist1queried->fetch_array();
$playlistid = intval($playlistarray[0]);
$playlist2 = "SELECT playlistName from playlist where playlistID = '$playlistid'";
$playlist2queried = mysqli_query($dbc, $playlist2);
$playlist2array = $playlist2queried->fetch_array();
$playlist2id = $playlist2array[0];

echo ("Add songs to your new playlist: $playlist2id");*/

if(isset($_POST['submit'])){

    $data_missing = array();

    if(empty($_POST['songName'])){

        // Adds name to array
        $data_missing[] = 'Song Name';

    } else {

        // Trim white space from the name and store the name
        $song_name = trim($_POST['songName']);

    }

 if(empty($_POST['songLength'])){

        // Adds name to array
        $data_missing[] = 'Song Length';

    } else {

        // Trim white space from the name and store the name
        $song_length = trim($_POST['songLength']);

    }

    if(empty($_POST['artistName'])){

       // Adds name to array
       $data_missing[] = 'artistName';

   } else {

       // Trim white space from the name and store the name
       $artistname = trim($_POST['artistName']);

   }

     if(empty($_POST['albumName'])){

        // Adds name to array
        $data_missing[] = 'Album';

    } else {

        // Trim white space from the name and store the name
        $album = trim($_POST['albumName']);

    }





    if(empty($data_missing)){

        require_once('/XAMPP/mysqli_connect.php');

        //getting PlaylistID
        $ply = "SELECT MAX(playlistID) from playlist";
        $play = mysqli_query($dbc, $ply);
        $playl = $play->fetch_array();
        $playid = intval($playl[0]);

        $playlisthassongs = "INSERT INTO playlisthassongs (playlistID, songID) VALUES (?, ?)";
        $query = "INSERT INTO song (songID,songName, songLength, albumID) VALUES (?, ?,?, ?)";
        $query2 = "INSERT INTO album (albumID, artistID, albumName,numofTracks,genre ) VALUES (?,?, ?,NULL,NULL)";
        $query3 = "INSERT INTO artist(artistID, firstname_primary, lastname, instagram) VALUES (?,?,NULL,NULL)";

        $sql = "SELECT MAX(songID) from Song";
        $sqlquery = mysqli_query($dbc, $sql);
        $sqll = $sqlquery->fetch_array();
        $newid = intval($sqll[0]);
        $songid = $newid + 1; //CREATES NEW ID!!!!!!!!!

        //get ID for artistName
        $statement = "SELECT MAX(artistID) from artist";
        $queried = mysqli_query($dbc, $statement);
        $stmtarray = $queried ->fetch_array();
        $intstmt = intval($stmtarray[0]);
        $artistid = $intstmt + 1;

        //getID for albumName

        $sql2 = "SELECT MAX(albumID) from album";
        $sqlquery2 = mysqli_query($dbc, $sql2);
        $sqll2 = $sqlquery2 ->fetch_array();
        $newid2 = intval($sqll2[0]);
        $albumid = $newid2 + 1;

        //----------------------------------

        $stmt = mysqli_prepare($dbc, $query);
        if($stmt == false) {
          die("<pre>".mysqli_error($dbc).PHP_EOL.$query."</pre>");
        }
        $playliststmt = mysqli_prepare($dbc, $playlisthassongs);
        if($playliststmt == false) {
          die("<pre>".mysqli_error($dbc).PHP_EOL.$playlisthassongs."</pre>");
        }
        $albumstmt = mysqli_prepare($dbc, $query2);
        if($albumstmt == false) {
          die("<pre>".mysqli_error($dbc).PHP_EOL.$query2."</pre>");
        }
        $artiststmt = mysqli_prepare($dbc, $query3);
        if($artiststmt == false) {
          die("<pre>".mysqli_error($dbc).PHP_EOL.$query3."</pre>");
        }

        mysqli_stmt_bind_param($stmt, "issi", $songid, $song_name, $song_length, $albumid);
        mysqli_stmt_bind_param($playliststmt, "ii",$playid,$songid);
        mysqli_stmt_bind_param($albumstmt,"iis",$albumid,$artistid,$album);
        mysqli_stmt_bind_param($artiststmt, "is",$artistid,$artistname);

        mysqli_stmt_execute($artiststmt);
        mysqli_stmt_execute($albumstmt);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_execute($playliststmt);



        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){

            echo 'Song Added';

            mysqli_stmt_close($stmt);

            mysqli_close($dbc);

        } else {

            echo 'Error Occurred<br />';
            echo mysqli_error($dbc);

            mysqli_stmt_close($stmt);

            mysqli_close($dbc);

        }

    } else {

        echo 'You need to enter the following data<br />';

        foreach($data_missing as $missing){

            echo "$missing<br />";

        }

    }

}

if(isset($_POST['finishbutton'])){
  header( 'Location: http://localhost:1234/playlistadded.php' );
  exit();
}

?>

<form action="http://localhost:1234/songsadded.php" method="post">

<b>Add songs to your new playlist!</b>

<p>Song Name:
<input type="text" name="songName" size="30" value="" />
</p>

<p>Song Length:
<input type="text" name="songLength" size="30" value="" />
</p>

<p>Artist:
<input type="text" name="artistName" size="30" value="" />
</p>

<p>Album:
<input type="text" name="albumName" size="30" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

<p>
<input type="submit" name="finishbutton" value="FINISH" />
</p>



</form>
</body>
</html>
