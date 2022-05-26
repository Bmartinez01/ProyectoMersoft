@extends('layouts.main', ['activePage' => 'informes', 'titlePage' => 'Grafica de compras'])
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="content">
        <div class="conteiner-fluid">
            <div class="row">

                <div class="col-12 text-center mb-1">
                    <form action="{{ route('compras.charts') }}" method="POST">
                        <div class="col-12 text-left">
                            <a href="{{ route('compras.index') }}"><span class="material-icons">
                                arrow_back
                                </span></a>
                        </div>
                        @csrf
                        @method('GET')
                        <?php
                        $cont = date('Y');
                        ?>
                        <h3 style="font-family: cursive"><strong>Tabla por meses</strong></h3>
                        <select style="border-radius: 5px; width: 70px; text-align: center" id="selaño" name="selaño">
                        @while ($cont >=2000)
                         <option @if ($year == $cont)
                         selected="true"  value={{$cont}}>{{$cont}}</option>
                         @else
                         <option value="{{$cont}}">{{$cont}}
                        </option>
                        @endif
                        {{$cont--}}
                        @endwhile
                        </select>
                        <button type="submit" class="btn btn-outline-dark btn-sm" name="search"><i
                                class="material-icons">search</i></button>
                </div>
                <div class="col-md-12">
                    <canvas id="myChart" width="150" height="50"></canvas>
                </div>
            </div>
        </div>
    </div>
                                {{-- Inicia la 2 grafica  --}}
        <div class="conteiner-fluid">
            <div class="text-center">
                <div id="tabla2" class="col-12 text-center">
                    <?php
                        $cont = date('Y');
                        ?>
                        <h3 style="font-family: cursive"><strong>Tabla por año</strong></h3>
                        <select style="border-radius: 5px; width: 70px; text-align: center" id="año" name="año">
                            @while ($cont >=2000)
                            <option @if ($año == $cont)
                            selected="true"  value={{$cont}}>{{$cont}}</option>
                            @else
                            <option value="{{$cont}}">{{$cont}}
                           </option>
                           @endif
                           {{$cont--}}
                           @endwhile
                        </select>
                        <button type="submit" class="btn btn-outline-dark btn-sm" name="search"><i
                                class="material-icons">search</i></button>
                     </div>
                <canvas id="myChart_año" width="150" height="50"></canvas>
            </div>

        </div>
                            {{-- Inicia la 3 grafica  --}}
                                <div class="conteiner-fluid">
                                    <div class="text-center">
                                        <div id="tabla3" class="col-12 text-center">
                                            <?php
                                                $cont = date('Y');
                                                ?>
                                                <h3 style="font-family: cursive"><strong>Productos más comprados</strong></h3>
                                        </form>

                                            </div>
                                        <canvas id="myChart_producto" width="150" height="50"></canvas>
                                    </div>

                                </div>



@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Inicia la grafica de compras por mes
        var cData = JSON.parse(`<?php echo $data; ?>`)
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: cData.label1,
                datasets: [{
                    label: 'Total de compras',
                    data: cData.data1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
                            //  Inicia la 2 grafica
        const ctxa = document.getElementById('myChart_año').getContext('2d');
        const myCharta = new Chart(ctxa, {
            type: 'bar',
            data: {
                labels: cData.label2,
                datasets: [{
                    label: 'Total de compras',
                    data: cData.data2,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Inicia la 3 grafica
        const ctxaa = document.getElementById('myChart_producto').getContext('2d');
        const myChartaa = new Chart(ctxaa, {
            type: 'bar',
            data: {
                labels: cData.label3,
                datasets: [{
                    label: 'Total de compras',
                    data: cData.data3,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        function imprim1(myChart) {
            var printContents = document.getElementById('myChart').innerHTML;
            w = window.open();
            w.document.write(printContents);
            w.document.close(); // necessary for IE >= 10
            w.focus(); // necessary for IE >= 10
            w.print();
            w.close();
            return true;
        }
    </script>
@endsection
