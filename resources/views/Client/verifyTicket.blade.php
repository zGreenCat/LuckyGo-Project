@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
   <title>Lotería</title>
</head>
<body>
   <h1>Datos de tu billete</h1>
   <table>
   	<tr>
        <th>ID</th>
   		<th>Fecha</th>
   		<th>Números jugados</th>

   	</tr>
   	<tr>
        <td>{{$ticket->ticketID }}</td>
   		<td>{{$ticket->date }}</td>
   		<td>{{$ticket->selectedNumbers }}</td>
		
   	</tr>
   </table>
   <!-- Si aún no se hace el sorteo -->
   @if ($raffle->stat == 1)
		<h1>El sorteo aun no se hace, vuelve despues</h1>
	<!-- Si ya se hizo el sorteo -->
   @else
    	<h1>Resultados del sorteo</h1>
		<table>
			<tr>
				<th>Fecha del sorteo</th>
				<th>Números Ganadores</th>
				<th>"Tendré Suerte"</th>
			</tr>
			<tr>
				<td>{{$raffle->sunday }}</td>
				<td>{{$raffle->won }}</td>
				<td>{{$raffle->won_luck }}</td>
			</tr>
		</table>

		@if ($raffle->won == $ticket->selectedNumbers || $raffle->won_luck == $ticket->selectedNumbers)
			<h1>Haz ganao </h1> 
			<h1>Premios</h1>
			<table>
				<tr>
					<th>Premio sorteo principal</th>
					<th>Premio sorteo "Tendré suerte"</th>
				</tr>
				<tr>

					@if ($ticket->luck)
						<td>Sin premio</td>
						<td>${{($raffle->cant_tickets_luck*3000)}}</td>
					@else
						<td>${{($raffle->cant_tickets*2000)}}</td>
						<td>Sin premio</td>
					@endif

					
				</tr>
				
			</table>
			
		@else
			<h1>perdiste</h1>
		@endif
	@endif
</body>


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