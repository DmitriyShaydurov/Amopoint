@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <canvas id="linearChart"></canvas>
            <canvas id="pieChart"></canvas>

        </div>
        </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    
function makeChart(data) {
    console.log(data);
  let massPopChart = new Chart(data.name, {
    type: data.type, 
    data:{
      labels:data.lables,
      datasets:[{
        label:'кол-во',
        data:data.qty,
        backgroundColor:[
          'rgba(255, 99, 132, 0.6)',
          'rgba(54, 162, 235, 0.6)',
          'rgba(255, 206, 86, 0.6)',
          'rgba(75, 192, 192, 0.6)',
          'rgba(153, 102, 255, 0.6)',
          'rgba(255, 159, 64, 0.6)',
          'rgba(255, 99, 132, 0.6)'
        ],
        borderWidth:1,
        borderColor:'#777',
        hoverBorderWidth:3,
        hoverBorderColor:'#000'
      }]
    },
    options:{
      title:{
        display:true,
        text: data.header,
        fontSize:25
      },
      legend:{
        display:true,
        position:'right',
        labels:{
          fontColor:'#000'
        }
      },
      layout:{
        padding:{
          left:0,
          right:0,
          bottom:0,
          top:0
        }
      },
      tooltips:{
        enabled:true
      },

      scales: {
        yAxes: [{
            ticks: {
                stepSize: 1
            }
        }]
    }

    }
  });
}

function makePieLables(statistics) {
    let lables = [];
    let qty = [];
    let data = [];
    for (const [key, value]  of Object.entries(statistics)) {
        lables.push(value.city);
        qty.push(value.quantity);
    }
    data.lables =lables;
    data.qty = qty;
    return data;
}

function makeLinearLables(statistics) {
    let lables = [];
    let qty = [];
    let data = [];
    for (const [key, value]  of Object.entries(statistics)) {
        lables.push(key);
        qty.push(value);
    }
    data.lables =lables;
    data.qty = qty;
    return data;
}

function getChartData() {
    $.ajax({
    url: "{{ asset('api/today') }}",
    type: 'POST',
    dataType: 'json',
    success: function(data) {
        pie = makePieLables(data.city_statistics);
        pie.name = 'pieChart';
        pie.type = 'pie';
        pie.header = 'Распределение по городам';
        makeChart(pie);
        linear = makeLinearLables(data.visit_stisstics);
        linear.name = 'linearChart';
        linear.type = 'bar';
        linear.header = 'Уникальные пользователи по часам';
        makeChart(linear);
    },
    error: function(data){
        console.log(data);
    }
    });
}

getChartData();


</script>



