<html>
<head>
<title>Get started and create a playlist!</title>
</head>
<body>
<?php

if(isset($_POST['submit'])){

    $data_missing = array();

    if(empty($_POST['playlistName'])){

        // Adds name to array
        $data_missing[] = 'Playlist Name';

    } else {

        // Trim white space from the name and store the name
        $play_name = trim($_POST['playlistName']);

    }

    if(empty($_POST['username'])){

        // Adds name to array
        $data_missing[] = 'username';

    } else {

        // Trim white space from the name and store the name
        $username = trim($_POST['username']);

    }


    if(empty($data_missing)){

        require_once('/XAMPP/mysqli_connect.php');
        $query = "INSERT INTO playlist (playlistID,playlistName, username, dateCreated) VALUES (?, ?, ?, NOW())";

        $stmt = mysqli_prepare($dbc, $query);
        if($stmt == false) {
        die("<pre>".mysqli_error($dbc).PHP_EOL.$query."</pre>");
        }

        $sql = "SELECT MAX(PlaylistID) from Playlist";
        $sqlquery = mysqli_query($dbc, $sql);
        $sql2 = $sqlquery->fetch_array();
        $newid = intval($sql2[0]);
        $newid = $newid + 1; //CREATES NEW ID!!!!!!!!!


        mysqli_stmt_bind_param($stmt, "iss", $newid, $play_name, $username);

        mysqli_stmt_execute($stmt);

        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){

            echo 'Playlist Created';

            mysqli_stmt_close($stmt);

            mysqli_close($dbc);

            header( 'Location: http://localhost:1234/songsadded.php' );
            exit();
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
if(isset($_POST['back'])){
  header( 'Location: http://localhost:1234/homescreen.php' );
  exit();
}



?>

<form action="http://localhost:1234/playlistadded.php" method="post">

<b>Get Started and Create a Playlist!</b>

<p>Playlist Name:
<input type="text" name="playlistName" size="30" value="" />
</p>

<p>Username:
<input type="text" name="username" size="30" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>
<p><br><br><br><br><input type="submit" name="back" value="BACK" />



</form>
</body>
</html>
