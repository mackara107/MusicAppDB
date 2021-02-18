<html>
<head>
<title>Create New Account</title>
</head>
<body>
<?php

if(isset($_POST['submit'])){

    $data_missing = array();

    if(empty($_POST['username'])){

        // Adds name to array
        $data_missing[] = 'Username';

    } else {

        // Trim white space from the name and store the name
        $username = trim($_POST['username']);

    }

    if(empty($_POST['pass_word'])){

        // Adds name to array
        $data_missing[] = 'Password';

    } else{

        // Trim white space from the name and store the name
        $pass_word = trim($_POST['pass_word']);

    }

    if(empty($_POST['firstname'])){

        // Adds name to array
        $data_missing[] = 'First Name';

    } else {

        // Trim white space from the name and store the name
        $firstname = trim($_POST['firstname']);

    }

    if(empty($_POST['lastname'])){

        // Adds name to array
        $data_missing[] = 'Last Name';

    } else {

        // Trim white space from the name and store the name
        $lastname = trim($_POST['lastname']);

    }

    if(empty($_POST['email'])){

        // Adds name to array
        $data_missing[] = 'Email';

    } else {

        // Trim white space from the name and store the name
        $email = trim($_POST['email']);

    }

    if(empty($_POST['subscriptionType'])){

        // Adds name to array
        $data_missing[] = 'subscriptionType';

    } else {

        // Trim white space from the name and store the name
        $subscriptionType = trim($_POST['subscriptionType']);

    }

    if(empty($_POST['cardType'])){

        // Adds name to array
        if($subscriptionType!="Free")
            $data_missing[] = 'cardType';
        else
          $cardType = NULL;

    } else {

        // Trim white space from the name and store the name
        $cardType = trim($_POST['cardType']);

    }

    if(empty($_POST['cardNum'])){

      if($subscriptionType!="Free")
          $data_missing[] = 'cardNum';
      else
        $cardNum = NULL;

    } else {

        // Trim white space from the name and store the name
        $cardNum = trim($_POST['cardNum']);

    }

    if(empty($_POST['cvv'])){

      if($subscriptionType!="Free")
          $data_missing[] = 'cvv';
      else
        $cvv = NULL;

    } else {

        // Trim white space from the name and store the name
        $cvv = trim($_POST['cvv']);

    }


    if(empty($data_missing)){

        require_once('/XAMPP/mysqli_connect.php');

        $query = "INSERT INTO customer (username, pass_word, firstname,
        lastname, email, dateJoined) VALUES (?, ?, ?,
        ?, ?, NOW()) ";

        $sql = "SELECT MAX(PaymentID) from Payment";
        $sqlquery = mysqli_query($dbc, $sql);
        $sql2 = $sqlquery->fetch_array();
        $newid = intval($sql2[0]);
        $newid = $newid + 1; //CREATES NEW ID!!!!!!!!!

        $sql2 = "SELECT subscriptionType\n"

    . "from subscription\n"

    . "where subscriptionName = '$subscriptionType'";
        $subtype = mysqli_query($dbc, $sql2);
        $subtypearray = $subtype->fetch_array();
        $subtypeint = intval($subtypearray[0]);


        $payquery = "INSERT INTO payment(paymentID, username, subscriptionType, cardType, cardNumber, cardCVV) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($dbc, $query);
        if($stmt == false)
          die("<pre>".mysqli_error($dbc).PHP_EOL.$query."</pre>");

        $stmt2 = mysqli_prepare($dbc, $payquery);
        if($stmt2 == false)
          die("<pre>".mysqli_error($dbc).PHP_EOL.$payquery."</pre>");

        mysqli_stmt_bind_param($stmt, "sssss", $username,
                               $pass_word, $firstname, $lastname, $email);
        mysqli_stmt_bind_param($stmt2, "isssii", $newid, $username, $subtypeint, $cardType, $cardNum, $cvv);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_execute($stmt2);

        $affected_rows = mysqli_stmt_affected_rows($stmt);
        $pay_rows = mysqli_stmt_affected_rows($stmt2);

        if($affected_rows == 1 && $pay_rows == 1){

            echo 'Account Created';

            mysqli_stmt_close($stmt);

            mysqli_close($dbc);

            header( 'Location: http://localhost:1234/homescreen.php' );
            exit();

        } else {

            echo 'Error Occurred<br />';
            echo mysqli_error($dbc);

            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt2);

            mysqli_close($dbc);

        }


    } else {

        echo 'ERROR--The following fields were left blank:<br />';

        foreach($data_missing as $missing){

            echo "$missing<br />";

        }
        echo"<br/>";

    }

}

?>

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
