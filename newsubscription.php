<html>
<head>
<title>Create A Subscription</title>
</head>
<body>
<?php

if(isset($_POST['submit'])){

    $data_missing = array();

    if(empty($_POST['subscription'])){

        // Adds name to array
        $data_missing[] = 'Subscription';

    } else {

        // Trim white space from the name and store the name
        $subscription = trim($_POST['subscription']);

    }


    if(empty($data_missing)){

        require_once('/XAMPP/mysqli_connect.php');

        $query = "INSERT INTO payment (subscription, pass_word, firstname,
        lastname, email, dateJoined) VALUES (?, ?, ?,
        ?, ?)";

        #ADD THING FOR SUBSCRIPTION.... IF FREE TRIAL, FILL PAYMENT WITH NULL, IF TRIAL OR PREMIUM PROMPT MORE AND FILL THOSE IN

        $stmt = mysqli_prepare($dbc, $query);
        if($stmt == false)
          die("<pre>".mysqli_error($dbc).PHP_EOL.$query."</pre>");



        mysqli_stmt_bind_param($stmt, "sssss", $username,
                               $pass_word, $firstname, $lastname, $email);

        mysqli_stmt_execute($stmt);

        $affected_rows = mysqli_stmt_affected_rows($stmt);

        $checkSub = $_GET['subscription'];
        if($checkSub == "Free"){}
        else{

            echo 'Account Created';

            mysqli_stmt_close($stmt);

            mysqli_close($dbc);

            header( 'Location: http://localhost:1234/studentadded.php' );
            exit();
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

<form action="http://localhost:1234/addsubscription.php" method="post">

<b>Choose Your Subscription:</b>

<p>Account Subscription </p>
<p>(Free OR Trial ($3/mo) OR Premium ($8/mo))</P>
<p><input type="text" name="subscription" size="30" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>


</form>
</body>
</html>
