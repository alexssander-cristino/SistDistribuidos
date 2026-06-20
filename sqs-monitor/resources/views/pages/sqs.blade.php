@extends('layouts.app')

@section('content')
<h3>Fila SQS (Logs)</h3>

<table class="table">
    <thead>
        <tr>
            <th>Hora</th>
            <th>Dados</th>
        </tr>
    </thead>

    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->data_hora ?? '-' }}</td>
            <td>{{ json_encode($log) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection