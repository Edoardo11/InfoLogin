<?php
session_start();

require_once "../login_php_db/db.php";

if (isset($_GET["edit"])) {

  $login = false;
} else {
  $login = true;
}
?>

<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OTP Generator</title>

  <link rel="stylesheet" href="Style.css">
</head>

<body>

  <?php

  if ($login) {

  ?>
    <div id="accesso">
      <form action="Index.inc.php" method="POST">
        <input type="text" name="email" id="email" placeholder="Enter your email">
        <input type="text" name="password" id="password" placeholder="Enter your new password">
        <input type="submit" value="Edit" name="edit">

      </form>
    </div>

  <?php

  } else {

  ?>
    <div id="codiceVerifica">
      <form action="Index.inc.php" method="POST">
        <input type="number" name="otp" id="otp" placeholder="Enter the code sent via email">
        <input type="hidden" name="email" value=<?php echo($_GET["email"]); ?>>
        <input type="hidden" name="password" value=<?php echo($_GET["password"]); ?>>
        <input type="submit" value="Enter" name="invia">

        <div>
          Il codice scade tra
          <span id="time"></span>
          minuti!
        </div>
      </form>
    </div>

    <script src="Script.js"></script>

  <?php

  }

  ?>

</body>

</html>