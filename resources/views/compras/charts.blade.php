@extends('layouts.main', ['activePage' => 'compras', 'titlePage' => 'Grafica de compras'])
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" >
@endsection
@section('content')
<div class="content">
    <div class="conteiner-fluid">
        <div class="row">
            <div class="col-12 text-center">
            <a href="{{route('compras.index')}}">Regresar</a>
            </div>
            <div class="col-md-12">
    <canvas id="myChart" width="100" height="50"></canvas>

            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    var cData = JSON.parse(`<?php echo $data; ?>`)
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type:'bar',
        data: {
            labels:cData.label,
            datasets:[{
                label:'Total de compras',
                data:cData.data,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
                borderWidth:1
            }]
        },
        options:{
            scales:{
                yAxes:[{
                    ticks:{
                        beginAtZero:true
                    }
                }]
            }
        }
    });
  </script>
@endsection
