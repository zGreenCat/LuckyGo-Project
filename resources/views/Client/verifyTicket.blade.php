@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
   <title>Lotería</title>
</head>
<body>
	<div class="px-4 sm:px-6 lg:px-8">
		<div class="max-w-4xl mx-auto overflow-hidden">
		  <form>
			<h1 class="text-2xl font-bold text-center text-black mb-8">Detalles de tu Billete</h1>
			<table class="w-full bg-white shadow-md rounded-lg overflow-hidden mb-8">
			  <tr>
				<th class="bg-[#0a74da] text-white uppercase font-bold p-3">ID</th>
				<th class="bg-[#0a74da] text-white uppercase font-bold p-3">Fecha</th>
				<th class="bg-[#0a74da] text-white uppercase font-bold p-3">Números Jugados</th>
			  </tr>
			  <tr class="even:bg-gray-100">
				<td class="p-3">{{$ticket->ticketID}}</td>
				<td class="p-3">{{$ticket->date}}</td>
				<td class="p-3">{{$ticket->selectedNumbers}}</td>
			  </tr>
			</table>
	  
			@if ($raffle->stat == 1)
			  <div class="text-center text-lg bg-yellow-100 text-yellow-800 p-4 rounded-lg mb-8">
				<h2 class="text-xl font-bold mb-2">El sorteo aún no se ha realizado</h2>
				<p>Por favor, vuelve más tarde para ver los resultados.</p>
			  </div>
			@else
			  <h1 class="text-2xl font-bold text-center text-black mb-8">Resultados del Sorteo</h1>
			  <table class="w-full bg-white shadow-md rounded-lg overflow-hidden mb-8">
				<tr>
				  <th class="bg-[#0a74da] text-white uppercase font-bold p-3 text-center w-1/3">Fecha del Sorteo</th>
				  <th class="bg-[#0a74da] text-white uppercase font-bold p-3 text-center w-1/3">Números Ganadores</th>
				  <th class="bg-[#0a74da] text-white uppercase font-bold p-3 text-center w-1/3">"Tendré Suerte"</th>
				</tr>
					<tr class="even:bg-gray-100">
					<td class="p-3 text-center">{{$raffle->sunday}}</td>
					<td class="p-3 text-center">{{$raffle->won}}</td>
					<td class="p-3 text-center">{{$raffle->won_luck}}</td>
				  </tr>
					
				</tr>
			  </table>
	  
			  @if ($raffle->won == $ticket->selectedNumbers || $raffle->won_luck == $ticket->selectedNumbers)
				<div class="text-center text-lg bg-green-100 text-green-800 p-4 rounded-lg mb-8">
				  <h2 class="text-xl font-bold mb-2">¡Felicidades! Has Ganado</h2>
				</div>
				<h1 class="text-2xl font-bold text-center text-black mb-8">Premios</h1>
				<table class="w-full bg-white shadow-md rounded-lg overflow-hidden mb-8">
					<tr>
					  <th class="bg-[#0a74da] text-white uppercase font-bold p-3 text-center w-1/2">Premio Sorteo Principal</th>
					  <th class="bg-[#0a74da] text-white uppercase font-bold p-3 text-center w-1/2">Premio Sorteo "Tendré Suerte"</th>
					</tr>
					<tr class="even:bg-gray-100">
					  @if ($raffle->won == $ticket->selectedNumbers)
						<td class="p-3 text-center">${{number_format(($raffle->cant_tickets_luck*2000)/$ticketCountWon, 0, ',', '.')}}</td>
					  @else
						<td class="p-3 text-center">Sin premio</td>
					  @endif
					  @if ($ticket->luck && $raffle->won_luck == $ticket->selectedNumbers)
					  <td class="p-3 text-center">${{number_format(($raffle->cant_tickets_luck*1000)/$ticketCountWon, 0, ',', '.')}}</td>
						@else
					  <td class="p-3 text-center">Sin premio</td>
					@endif
					</tr>
				  </table>
			  @else
				<div class="text-center text-lg bg-red-100 text-red-800 p-4 rounded-lg mb-8">
				  <h2 class="text-xl font-bold mb-2">Lo sentimos, no has ganado esta vez</h2>
				  <p>¡Mejor suerte para la próxima!</p>
				</div>
			  @endif
			@endif
		  </form>
		</div>
	  </div>
</body>
@if ($raffle->won == $ticket->selectedNumbers || $raffle->won_luck == $ticket->selectedNumbers)
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
<script>
	window.onload = function() {

		confetti({
			particleCount: 100,
			spread: 70,
			origin: { y: 0.6 }
		});
	};
</script>

@endif

<style>
	table {
		border-collapse: collapse;
		width: 50%;
		margin: 0 auto;
	}
	th, td {
		border: 1px solid black;
		padding: 8px;
		text-align: center;
	}
	th {
		background-color: #f2f2f2;
	}
</style>
</html>
@endsection