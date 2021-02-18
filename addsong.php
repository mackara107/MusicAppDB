<html>
<head>
<title>Add songs to your new playlist!</title>
</head>
<body>
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
<input type="submit" name="submit" value="FINISH" />
</p>

</form>
</body>
</html>
