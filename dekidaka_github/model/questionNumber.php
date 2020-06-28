<?php
require_once './Db.php';
$db = new Db();
$q_num = $db->selectQNum($_GET);
print $q_num[0]['q_num'];
