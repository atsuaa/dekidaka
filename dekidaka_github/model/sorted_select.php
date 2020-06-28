<?php
if (!$order = $_GET['order']) {
  $order = '';
}
if (!$desc = $_GET['desc']) {
  $desc = '';
}
$records = $db->select($order, $desc);
