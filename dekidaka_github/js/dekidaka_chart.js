$.getJSON('./model/graph_dataset.php', function(data){
  console.log(data);

  $.each(data, function(title, value) {
    var lb=[], dt=[];
    $.each(value, function(ind, val){
      lb.push(ind);
      dt.push(val);
    });
    console.log(lb);
    console.log(dt);

    var ctx = document.getElementById(title).getContext('2d');
              ctx.canvas.height = 280;

    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: lb,
        datasets: [
          {
            label: '最高得点率',
            data: dt,
            animation : true,
            lineTension: 0, // draw straightline
          }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          yAxes: [
            {
              ticks: {
                min: 0,
                max: 100
              }
            }
          ]
        }
      }
    });
  })
});
