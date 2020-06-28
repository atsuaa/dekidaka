<?php
session_start();
if (htmlspecialchars($_POST['user']) === 'atsuaa' && htmlspecialchars($_POST['pass']) === '98410427') {
  $_SESSION['user'] = $_POST['user'];
  $_SESSION['pass'] = $_POST['pass'];
  setcookie('user', $_POST['user'], time()+(60*60*24), '/');
  setcookie('pass', md5($_POST['pass']), time()+(60*60*24), '/');
  header("location: ../");
}
