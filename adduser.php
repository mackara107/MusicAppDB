<html>
<head>
<title>Create New Account</title>
</head>
<body>
<form action="http://localhost:1234/useradded.php" method="post">

<b>Create Your Account!</b>

<p>Username:
<input type="text" name="username" size="30" value="" />
</p>

<p>Password:
<input type="password" name="pass_word" size="30" value="" />
</p>

<p>First Name:
<input type="text" name="firstname" size="30" value="" />
</p>

<p>Last Name:
<input type="text" name="lastname" size="30" value="" />
</p>

<p>Email:
<input type="email" name="email" size="30" value="" />
</p>

<p>Free / Trial ($3) / Premium ($8):
<input type="text" name="subscriptionType" size="30" value="" />
</p>

<p>Card Type:
<input type="text" name="cardType" size="30" value="" />
</p>

<p>Card Number:
<input type="text" name="cardNum" size="30" value="" />
</p>

<p>CVV:
<input type="text" name="cvv" size="30" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>
</body>
</html>
