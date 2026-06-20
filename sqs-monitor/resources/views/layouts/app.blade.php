<!DOCTYPE html>
<html>
<head>
    <title>TicketFlow</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .sidebar {
            height:100vh;
            width:250px;
            position:fixed;
            background:#1e293b;
            color:#fff;
            padding:20px;
        }

        .sidebar a {
            display:block;
            color:#fff;
            margin:10px 0;
            text-decoration:none;
        }

        .content {
            margin-left:270px;
            padding:20px;
        }

        .seat {
            width:60px;
            height:60px;
            margin:5px;
            border:none;
            border-radius:10px;
        }

        .livre { background:#22c55e; color:white; }
        .reservado { background:#f59e0b; color:white; }
        .vendido { background:#ef4444; color:white; }
    </style>
</head>

<body>

<div class="sidebar">
    <h4>TicketFlow</h4>

    <a href="/">Dashboard</a>
    <a href="/assentos">Assentos</a>
    <a href="/compras">Compras</a>
    <a href="/fila-sqs">Fila SQS</a>
    <a href="/dlq">DLQ</a>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>