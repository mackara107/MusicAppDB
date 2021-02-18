<html>
<head>
<title>Login!</title>
</head>
<body>
<form action="http://localhost:1234/login.php" method="post">

<b>Login / Create a New Account!</b>

<p>Username:
<input type="text" name="usernamee" size="30" value="" />
</p>

<p>Password:
<input type="password" name="pass_wordd" size="30" value="" />
</p>

<p>
<input type="submit" name="login" value="Login" />
</p>

<p>
<input type="submit" name="newaccount" value="Create New Account" />
</p>

<?php
require_once('/XAMPP/mysqli_connect.php');
if(isset($_POST['usernamee'])){
  $username = $_POST['usernamee'];
}
if(isset($_POST['pass_wordd'])){
  $pass_word = $_POST['pass_wordd'];
}



if(isset($_POST['login'])){
  $login = "SELECT * FROM Customer WHERE Username = '$username'";
  $login = mysqli_query($dbc, $login);
  $passcheck = null;
  if($login->num_rows>0){
    $passcheck = "SELECT pass_word FROM Customer WHERE Username = '$username'";
    $passcheck = mysqli_query($dbc,$passcheck);
    $passcheck = $passcheck->fetch_array();
    $passcheck = $passcheck[0];
  }


  if($passcheck == $pass_word){
    header( 'Location: http://localhost:1234/homescreen.php' );
    exit();
  }
  else{
    echo("User Not Found. Try again or Create an Account!");
  }
}
if(isset($_POST['newaccount'])){
  header( 'Location: http://localhost:1234/useradded.php' );
  exit();
}

?>

</form>
</body>
</html>
