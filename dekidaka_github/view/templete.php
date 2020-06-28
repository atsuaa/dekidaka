<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-touch-icon" href="./apple-touch-icon.png">
    <link rel="apple-touch-startup-image" href="./splash.png">
    <link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="./node_modules/chart.js/dist/Chart.js" charset="utf-8"></script>
    <script src="./js/script.js" charset="utf-8"></script>
    <title>DEIDAKA</title>
  </head>
  <body>
    <header>
      <h1>ヘッダー</h1>
    </header>

    <!-- スライダーのメインコンテナの div 要素 -->
    <div class="swiper-container">
    <!-- ラッパーの（スライドを囲む） div 要素 -->
    <div class="swiper-wrapper">
    <!-- それぞれのスライドの div 要素 -->
      <div class="swiper-slide">

        <div class="new">
          <button type="button" name="button">新規追加</button>
        </div>

        <div class="mobile" id="add">
          <form class="" action="./model/insert.php" method="get">
            <input type="text" name="title" placeholder="タイトル">
            <div id="title-select" style="display: none">
              <?php require_once './model/titles.php'; ?>
              <?php foreach ($titles as $title): ?>
                <button type="button"><?= $title['title'] ?></button>
              <?php endforeach; ?>
            </div>
            <input type="text" name="section" placeholder="章">
            <input type="number" name="q_num" placeholder="問題数">
            <input type="number" name="a_num" placeholder="正答数">
            <input type="text" name="cnt" placeholder="回数">
            <input type="submit" value="追加">
          </form>
        </div>
        <!-- <div class="pc">
          <form class="" action="./model/insert.php" method="get">
            <label>タイトル<input type="text" name="title"></label>
            <label>章<input type="text" name="section"></label>
            <label>問題数<input type="number" name="q_num"></label>
            <label>正答数<input type="number" name="a_num"></label>
            <label>回数<input type="text" name="cnt"></label>
            <input type="submit" value="送信">
          </form>
        </div> -->


        <?php
        if (empty($_GET)) {
          require_once './model/default_list.php';
        } else {
          require_once './model/sorted_select.php';
        }

         ?>
        <div class="wrapper">
          <ul>
            <?php foreach ($records as $record): ?>
              <li>
                <div class="up-del">
                  <div class="update">
                    <span>編集</span>
                    <div class="update-data">
                      <?= $record['title']; ?><?= $record['section']; ?><?= $record['cnt']; ?>
                    </div>
                  </div>
                  <div class="delete">
                    <span>削除</span>
                  </div>
                </div>
                <div class="li-box">
                  <div class="li-l">
                    <p><?= $record['title']; ?><span class="sec"><?= $record['section']; ?></span>章</p>
                    <div class="li-l-b">
                      <div>問題数：<span><?= $record['q_num']; ?></span></div>
                      <div>正答数：<span><?= $record['a_num']; ?></span></div>
                      <div>回数：<span><?= $record['cnt']; ?></span></div>
                    </div>
                  </div>
                  <div class="li-r">
                    <span><b><?= $record['percent']; ?></b></span>
                    <div class="per">％</div>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="swiper-slide">
        <!-- スライドしたらグラフ -->
        <?php foreach ($titles as $title): ?>
          <h3><?= $title['title'] ?></h3>
          <div class="chart-container">
            <canvas id="<?= $title['title'] ?>"></canvas>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <?php
  switch ($_GET['order']) {
    case 'section':
      $order_dsp = '章順';
      break;
    case 'q_num':
      $order_dsp = '問題数順';
      break;
    case 'percent':
      $order_dsp = '正答率順';
      break;
    case 'cnt':
      $order_dsp = '回数順';
      break;
    default:
      $order_dsp = '新着順';
      break;
  }
  switch ($_GET['desc']) {
    case 'desc':
      $desc_dsp = '降順';
      break;
    default:
      $desc_dsp = '昇順';
      break;
  }
   ?>

   <div id="foot">
     <div class="f-l-select">
       <a href="?order=section&desc=<?= $_GET['desc'] ?>">章順</a>
       <a href="?order=q_num&desc=<?= $_GET['desc'] ?>">問題数順</a>
       <a href="?order=percent&desc=<?= $_GET['desc'] ?>">正答率順</a>
       <a href="?order=cnt&desc=<?= $_GET['desc'] ?>">回数順</a>
       <a href="?order=date&desc=<?= $_GET['desc'] ?>">日付順</a>
     </div>
     <div class="f-l">
       <span><?= $order_dsp; ?></span>
     </div>
     <div class="f-r-select">
       <a href="?desc=asc&order=<?=$_GET['order']?>">昇順</a>
       <a href="?desc=desc&order=<?=$_GET['order']?>">降順</a>
     </div>
     <div class="f-r">
       <span><?= $desc_dsp; ?></span>
     </div>
   </div>
    <footer>

    </footer>
    <script src="./js/dekidaka_chart.js" charset="utf-8"></script>
    <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
    <script>
      let mySwiper = new Swiper ('.swiper-container', {
        //ページネーション表示の設定
        pagination: {
          el: '.swiper-pagination', //ページネーションの要素
          type: 'bullets', //ページネーションの種類
        },
        autoHeight: true,
      })
      </script>
  </body>
</html>
