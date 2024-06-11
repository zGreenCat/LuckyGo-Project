@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Verificar Billete</h2>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="GET" action="{{ route('verifyTicket') }}">
        <div class="form-group">
            <label for="codigo">Código del Billete</label>
            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingrese el código del billete">
        </div>
        <button type="submit" class="btn btn-primary">Verificar</button>
    </form>

    @if (isset($billete))
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Resultado del Billete</h5>
                <p class="card-text">Código: {{ $billete->codigo }}</p>
                <p class="card-text">Números: {{ implode(', ', $billete->numeros) }}</p>
                <p class="card-text">Tendré Suerte: {{ $billete->tendresuerte ? 'Sí' : 'No' }}</p>
                @if ($sorteo->realizado)
                    <p class="card-text">Ganador: {{ $billete->ganador ? 'Sí' : 'No' }}</p>
                    @if ($billete->ganador)
                        <p class="card-text">Monto Ganado: ${{ number_format($billete->monto_ganado, 0, ',', '.') }}</p>
                    @endif
                @else
                    <div class="alert alert-warning">
                        El sorteo asociado a este billete aún no ha sido realizado.
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection