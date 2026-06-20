<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>TicketFlow - Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { background:#f4f6f9; }

        .sidebar {
            height:100vh;
            background:#1e293b;
            color:white;
            position:fixed;
            width:250px;
        }

        .sidebar h3 { padding:20px; text-align:center; }

        .sidebar a {
            color:white;
            text-decoration:none;
            display:block;
            padding:15px 20px;
        }

        .sidebar a:hover { background:#334155; }

        .content {
            margin-left:250px;
            padding:20px;
        }

        .card {
            border:none;
            border-radius:15px;
            box-shadow:0 4px 12px rgba(0,0,0,.1);
        }

        .seat {
            width:60px;
            height:60px;
            margin:5px;
            border:none;
            border-radius:10px;
            font-weight:bold;
        }

        .livre { background:#22c55e; color:white; }
        .reservado { background:#f59e0b; color:white; }
        .vendido { background:#ef4444; color:white; }
    </style>
</head>

<body>

<div class="sidebar">
    <h3>🎟 TicketFlow</h3>

    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('page.seats') }}">Assentos</a>
    <a href="{{ route('page.purchases') }}">Compras</a>
    <a href="{{ route('page.sqs') }}">Fila SQS</a>
    <a href="{{ route('page.dlq') }}">Dead Letter Queue</a>
</div>

<div class="content">

    <h2 class="mb-4">Painel de Monitoramento</h2>

    <!-- CARDS -->
    <div class="row">

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Total Assentos</h6>
                    <h2>{{ $totalSeats }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Vendidos</h6>
                    <h2>{{ $soldSeats }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Reservados</h6>
                    <h2>{{ $reservedSeats }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Compras</h6>
                    <h2>{{ $purchases }}</h2>
                </div>
            </div>
        </div>

    </div>

    <!-- SEGUNDA LINHA -->
    <div class="row mt-3">

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Livres</h6>
                    <h2>{{ $freeSeats }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>DLQ</h6>
                    <h2>{{ $deadMessages }}</h2>
                </div>
            </div>
        </div>

    </div>

    <!-- GRÁFICOS -->
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

    <!-- MAPA DE ASSENTOS -->
    <div class="card mt-4">
        <div class="card-body">
            <h5>Mapa de Assentos</h5>

            <div class="d-flex flex-wrap">

                @foreach($seats as $seat)
                    <button class="seat 
                        {{ $seat->status == 'livre' ? 'livre' : '' }}
                        {{ $seat->status == 'reservado' ? 'reservado' : '' }}
                        {{ $seat->status == 'vendido' ? 'vendido' : '' }}
                    ">
                        {{ $seat->numero }}
                    </button>
                @endforeach

            </div>
        </div>
    </div>

    <!-- TABELA ÚLTIMAS COMPRAS -->
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
                    @foreach($latestPurchases ?? [] as $p)
                        <tr>
                            <td>{{ $p->cliente ?? 'N/A' }}</td>
                            <td>{{ $p->seat ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $p->status ?? 'Processando' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

<!-- CHARTS -->
<script>
new Chart(document.getElementById('chartFila'), {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Mensagens Processadas',
            data: @json($filaData),
            borderWidth: 2
        }]
    }
});

new Chart(document.getElementById('chartAssentos'), {
    type: 'doughnut',
    data: {
        labels: ['Livres','Reservados','Vendidos'],
        datasets: [{
            data: @json([$freeSeats, $reservedSeats, $soldSeats])
        }]
    }
});
</script>

</body>
</html>