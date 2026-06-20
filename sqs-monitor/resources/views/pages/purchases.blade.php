@extends('layouts.app')

@section('content')
<h3>Compras</h3>

<table class="table">
    <thead>
        <tr>
            <th>Assento</th>
            <th>Cliente</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($purchases as $p)
        <tr>
            <td>{{ $p->seat }}</td>
            <td>{{ $p->cliente }}</td>
            <td>{{ $p->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection