<?php
require_once './Db.php';
$db = new Db();
$db->insert($_GET);
