@extends('layouts.app')

@section('content')
<h3>Dead Letter Queue</h3>

<table class="table">
    <thead>
        <tr>
            <th>Assento</th>
            <th>Cliente</th>
            <th>Erro</th>
        </tr>
    </thead>

    <tbody>
        @foreach($messages as $m)
        <tr>
            <td>{{ $m->seat }}</td>
            <td>{{ $m->cliente }}</td>
            <td>{{ $m->error }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection