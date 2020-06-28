$(function(){
  $('.new').click(function(){
    $('.mobile').slideToggle();
    $('.f-l-select, .f-r-select').slideUp();
  });

  $('input[name="title"]')
    .focusin(function(e) {
      $('#title-select').show();
    })
    .focusout(function(e) {
      setTimeout(function(){$('#title-select').hide()},100);
    });
  $('#title-select button').click(function(){
    $('input[name="title"]').val($(this).text());
  });

  $('input[name="section"]').change(function() {
    var tit = $('input[name="title"]').val();
    var sec = $(this).val();
    var data = {'title': tit, 'section': sec};
    $.ajax({
        url: './model/questionNumber.php',
        type: 'GET',
        data: data,
        timeout: 10000,  // 単位はミリ秒

        // 通信成功時の処理
        success: function(result, textStatus, xhr) {
          $('input[name="q_num"]').val(result);
        },

        // 通信失敗時の処理
        error: function(xhr, textStatus, error) {
            alert('NG...');
        }
    });
    $.ajax({
        url: './model/Count.php',
        type: 'GET',
        data: data,
        timeout: 10000,  // 単位はミリ秒

        // 通信成功時の処理
        success: function(result, textStatus, xhr) {
          $('input[name="cnt"]').val(parseInt(result) + 1);
        },

        // 通信失敗時の処理
        error: function(xhr, textStatus, error) {
            alert('NG...');
        }
    });
  });

  $('.f-l').click(function(){
    $('.f-l-select').slideToggle();
    $('.f-r-select, .mobile').slideUp();
  });
  $('.f-r').click(function(){
    $('.f-r-select').slideToggle();
    $('.f-l-select, .mobile').slideUp();
  });

  $('.wrapper').click(function(){
    $('.f-l-select, .f-r-select, .mobile').slideUp();
  });


  $('#add form').submit(function(event) {
    // HTMLでの送信をキャンセル
    event.preventDefault();

    // 操作対象のフォーム要素を取得
    var $form = $(this);

    // 送信ボタンを取得
    var $button = $form.find('button');

    // 送信
    $.ajax({
        url: $form.attr('action'),
        type: $form.attr('method'),
        data: $form.serialize(),
        timeout: 10000,  // 単位はミリ秒

        // 通信成功時の処理
        success: function(result, textStatus, xhr) {
          location.reload();
        },

        // 通信失敗時の処理
        error: function(xhr, textStatus, error) {
            alert('NG...');
        }
    });
});

$('li').click(function(){
  $(this).toggleClass('anime');
  $(this).find('.up-del').toggleClass('opa');
});

$('.update').click(function(){
  console.log('Hello');
});
});
