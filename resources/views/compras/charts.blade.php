@extends('layouts.main', ['activePage' => 'informes', 'titlePage' => 'Grafica de compras'])
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="content">
        <div class="conteiner-fluid">
            <div class="row">

                <div class="col-12 text-center mb-5">
                    <form action="{{ route('compras.charts') }}" method="POST">
                        @csrf
                        @method('GET')
                        <?php
                        $cont = date('Y');
                        ?>

                        <select style="border-radius: 5px; width: 70px; text-align: center" id="selaño" name="selaño">
                            <?php while ($cont >= 2000) { ?>
                            <option value="<?php echo $cont; ?>"><?php echo $cont; ?></option>
                            <?php $cont = ($cont-1); } ?>
                        </select>
                        <button type="submit" class="btn btn-outline-dark btn-sm" name="search"><i
                                class="material-icons">search</i></button>

                    </form>
                </div>

                <div class="col-12 text-center">
                    <a href="{{ route('compras.index') }}">Regresar</a>
                </div>

                <div id="tabla1" class="col-12 text-center">
                    <h3 style="font-family: cursive"><strong>Tabla por meses</strong></h3>
                    <a href="javascript:imprSelec('myChart')">Imprimir</a>
                    <button type="button" onclick="javascript:imprim1(myChart);">Imprimir</button>
                </div>
                <div class="col-md-12">
                    <canvas id="myChart" width="100" height="50"></canvas>

                </div>

            </div>
        </div>
    </div>
    <div class="content">
        <div class="conteiner-fluid">
            <div class="text-center">
                <canvas id="myChart_año" width="100" height="50"></canvas>
            </div>

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
