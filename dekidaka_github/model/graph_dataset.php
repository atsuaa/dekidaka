<?php
require_once './Db.php';
$db = new Db();

$pers = $db->selectPercent();


//配列Aの１番目から順に値を変数に格納する。
//配列Aには数種類の文字列が格納されており、種類ごとに変数を作成する。
//例
// $A = ['aa', 'bb', 'bb', 'cc', 'aa', 'aa'];
//
// $B['aa'] = ['section' => 'percent'];
// $B['bb'];
// $B['cc'];
//
// $A = $pers[$i]['title'];

$t = [];
$i = 0;
foreach ($pers as $per) {
  if (!in_array($per['title'], $t)) {
    $tmp = $per['title'];
  }
  $t[$tmp][$per['section']] = $per['percent'];
}
//$t[タイトル] = [セクション => パーセント]

$pers = json_encode($t);
print $pers;
