<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Ingressos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h1>Sistema de Venda de Ingressos</h1>

    <div class="row mt-4">

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Assentos</h5>
                    <h2>{{ $totalSeats ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Vendidos</h5>
                    <h2>{{ $soldSeats ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Compras</h5>
                    <h2>{{ $purchases ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>DLQ</h5>
                    <h2>{{ $deadMessages ?? 0 }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>