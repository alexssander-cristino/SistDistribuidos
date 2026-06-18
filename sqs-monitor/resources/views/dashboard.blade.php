<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketFlow - Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body{
            background:#f4f6f9;
        }

        .sidebar{
            height:100vh;
            background:#1e293b;
            color:white;
            position:fixed;
            width:250px;
        }

        .sidebar h3{
            padding:20px;
            text-align:center;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:15px 20px;
        }

        .sidebar a:hover{
            background:#334155;
        }

        .content{
            margin-left:250px;
            padding:20px;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 4px 12px rgba(0,0,0,.1);
        }

        .seat{
            width:60px;
            height:60px;
            margin:5px;
            border:none;
            border-radius:10px;
            font-weight:bold;
        }

        .livre{
            background:#22c55e;
            color:white;
        }

        .reservado{
            background:#f59e0b;
            color:white;
        }

        .vendido{
            background:#ef4444;
            color:white;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>🎟 TicketFlow</h3>

    <a href="#">Dashboard</a>
    <a href="#">Assentos</a>
    <a href="#">Compras</a>
    <a href="#">Fila SQS</a>
    <a href="#">Dead Letter Queue</a>
</div>

<div class="content">

    <h2 class="mb-4">Painel de Monitoramento</h2>

    <div class="row">

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Total Assentos</h6>
                    <h2>{{ $totalSeats ?? 100 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Vendidos</h6>
                    <h2>{{ $soldSeats ?? 35 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Compras</h6>
                    <h2>{{ $purchases ?? 40 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Mensagens DLQ</h6>
                    <h2>{{ $deadMessages ?? 3 }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5>Processamento de Mensagens</h5>
                    <canvas id="chartFila"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Status dos Assentos</h5>
                    <canvas id="chartAssentos"></canvas>
                </div>
            </div>
        </div>

    </div>

    <div class="card mt-4">
        <div class="card-body">

            <h5>Mapa de Assentos</h5>

            <div class="d-flex flex-wrap">

                <button class="seat livre">A1</button>
                <button class="seat livre">A2</button>
                <button class="seat reservado">A3</button>
                <button class="seat vendido">A4</button>
                <button class="seat livre">A5</button>

                <button class="seat vendido">B1</button>
                <button class="seat reservado">B2</button>
                <button class="seat livre">B3</button>
                <button class="seat livre">B4</button>
                <button class="seat vendido">B5</button>

            </div>

        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">

            <h5>Últimas Compras</h5>

            <table class="table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Assento</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Alex</td>
                        <td>A4</td>
                        <td><span class="badge bg-success">Aprovado</span></td>
                    </tr>

                    <tr>
                        <td>Maria</td>
                        <td>B5</td>
                        <td><span class="badge bg-warning">Processando</span></td>
                    </tr>

                    <tr>
                        <td>João</td>
                        <td>A3</td>
                        <td><span class="badge bg-danger">Falhou</span></td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

</div>

<script>

new Chart(
    document.getElementById('chartFila'),
    {
        type:'line',
        data:{
            labels:['10h','11h','12h','13h','14h','15h'],
            datasets:[{
                label:'Mensagens Processadas',
                data:[10,25,15,30,45,60]
            }]
        }
    }
);

new Chart(
    document.getElementById('chartAssentos'),
    {
        type:'doughnut',
        data:{
            labels:['Livres','Reservados','Vendidos'],
            datasets:[{
                data:[50,15,35]
            }]
        }
    }
);

</script>

</body>
</html>