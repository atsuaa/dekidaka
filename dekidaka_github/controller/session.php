<?php
session_start();
$user = (isset($_COOKIE['user'])) ? $_COOKIE['user'] : '';
$pass = (isset($_COOKIE['pass'])) ? $_COOKIE['pass'] : '';

if ($user !== 'atsuaa' && $pass !== md5(98410427)): ?>

  <form action="./controller/login.php" method="post">
    <input type="text" name="user" placeholder="ログインID">
    <input type="password" name="pass" placeholder="パスワード">
    <input type="submit" value="ログイン">
  </form>

<?php
exit;
endif; ?>
