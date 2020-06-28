<?php
require_once './Db.php';
$db = new Db();
$cnt = $db->selectCount($_GET);
print $cnt[0]['cnt'];
