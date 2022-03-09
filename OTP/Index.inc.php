<?php

function generaCodice($email)
{

  $string = "0123456789";
  $codice = '';
  for ($i = 0; $i < 6; $i++) {
    $codice .=  $string[random_int(0, 9)];
  }
  file_put_contents('Codici/' . $email . ".txt", $codice);
  return $codice;
}

function registraPersona($email, $password)
{

  file_put_contents('Salvataggi/' . $email . ".txt", $password);
}

function verificaCodice($email, $codice)
{

  if (file_exists("Codici/" . $email . ".txt") == true) {
    $trueCode = file_get_contents("Codici/" . $email . ".txt");

    if ($trueCode == $codice) {

      unlink("Codici/" . $email . ".txt");
      return true;
    } else {
      return false;
    }
  } else {
    echo ("Codice non generato");
  }
}

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === "POST") {

  if (isset($_POST['accedi'])) {

    $password = $_POST['password'];
    $to = $_POST['email'];

    if (file_exists("Salvataggi/" . $to . ".txt") == true) {
      $truePssw = file_get_contents("Salvataggi/" . $to . ".txt");

      if ($password == $truePssw) {
        $subject = "Codice di Verifica";
        $message = generaCodice($to);

        mail($to, $subject, $message);

        http_response_code(200);

        header("Location: Index.php?login=false&email=$to&password=$password");
        exit();
        
      } else {
      	var_dump($truePssw);
        echo ("Password errata");
      }
    } else {
      echo ("Utente non registrato");
    }
  } else if (isset($_POST['registrati'])) {

    $to = $_POST['email'];
    $subject = "Codice di Verifica";

    if (file_exists("Salvataggi/" . $to . ".txt") == false) {
      $message = generaCodice($to);
      mail($to, $subject, $message);

      $password = $_POST['password'];

      header("Location: Index.php?login=false&email=$to&password=$password");
      exit();
    } else {
      echo ("Utente già esistente");
    }
  } else if (isset($_POST['invia'])) {

    $codiceUser = $_POST['otp'];
    $to = $_POST["email"];
    $password = $_POST['password'];

    if (verificaCodice($to, $codiceUser) == true) {
      registraPersona($to, $password);
      echo ("Registrazione effettuata");
      http_response_code(200);

      header("Location: Index.html");
      exit();
    }
  }
} else {
  http_response_code(405);
  $oggetto->allowed_method = "POST";
}
