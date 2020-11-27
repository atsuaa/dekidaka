<?php
/**
 *
 */
class Db
{
  protected $_pdo;

  function __construct()
  {
    $dsn= '';
    $usr= '';
    $passwd= '';

    try {
      $db = new PDO($dsn, $usr, $passwd);
      $this->_pdo = $db;
    } catch (PDOException $e) {
      exit("データベースに接続できません。：{$e->getMessage()}");
    }
  }

  public function execute($sql, $parameter = [])
  {
    try {
      $stmt = $this->_pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
      $stmt->execute($parameter);
      return $stmt;
    } catch (PDOException $e) {
      exit("エラーが発生しました。：{$e->getMessage()}");
    }
  }

  public function getAllRecord($sql, $parameter = [])
  {
    try {
      $all_rec = $this->execute($sql, $parameter)->fetchAll(PDO::FETCH_ASSOC);
      return $all_rec;
    } catch (PDOException $e) {
      exit("エラーが発生しました。：{$e->getMessage()}");
    }
  }

  public function insert($parameter = [])
  {
    $sql = "
    INSERT INTO dekidaka
      (title, section, q_num, a_num, cnt)
    VALUES
      (:title, :section, :q_num, :a_num, :cnt)
    ";

    $this->execute($sql, $parameter);
  }

  public function update($column, $parameter)
  {
    $sql = "
    UPDATE dekidaka
    SET $column = :value
    WHERE title = :title
    AND section = :section
    AND cnt = :cnt";

    $this->execute($sql, $parameter);
  }

  public function select($order='', $desc='')
  {
    $sql = "
    SELECT
      title, section, q_num, a_num, TRUNCATE(a_num/q_num*100, 2) AS percent, cnt, date
    FROM dekidaka";

    switch ($order) {
      case 'section':
        $_order = " ORDER BY section";
        break;
      case 'q_num':
        $_order = " ORDER BY q_num";
        break;
      case 'percent':
        $_order = " ORDER BY percent";
        break;
      case 'cnt':
        $_order = " ORDER BY cnt";
        break;
      default:
        $_order = " ORDER BY date";
        break;
    }
    $desc === 'desc' ? $_desc = " DESC" : $_desc = " ASC";

    $sql = $sql. $_order. $_desc;

    return $this->getAllRecord($sql);
  }

  public function selectTitle()
  {
    $sql = "
    SELECT DISTINCT title
    FROM dekidaka";

    return $this->getAllRecord($sql);
  }

  public function selectQNum($parameters)
  {
    $sql = "
    SELECT DISTINCT q_num
    FROM dekidaka
    WHERE title = :title
    AND section = :section";

    return $this->getAllRecord($sql, $parameters);
  }

  public function selectCount($parameters)
  {
    $sql = "
    SELECT COUNT(cnt) AS cnt
    FROM dekidaka
    WHERE title = :title
    AND section = :section";

    return $this->getAllRecord($sql, $parameters);
  }

  //sectionごとの最大得点率
  public function selectPercent()
  {
    $sql = "
    SELECT
      title, section, MAX(TRUNCATE(a_num/q_num*100, 2)) AS percent
    FROM dekidaka
    GROUP BY title, section";

    return $this->getAllRecord($sql);
  }

  public function __destruct()
  {
    unset($this->_cnt);
  }
}
