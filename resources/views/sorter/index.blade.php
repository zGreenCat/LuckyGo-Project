@extends('layouts.app')
@section('content')
<link href="{{ asset('css/registerSorter.css') }}" rel="stylesheet">
<script src="{{ asset('js/sorterRegister.js') }}"></script>
<!-- Tabla con datos -->
@if ($raffles->count()>0)
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table id="dataTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
              <th scope="col" class="px-6 py-3">#</th>
              <th scope="col" class="px-6 py-3">Fecha del sorteo</th>
              <th scope="col" class="py-3">Cantidad de Billetes</th>
              <th scope="col" class="px-6 py-3">Subtotal de Billetes</th>
              <th scope="col" class="py-3">"Tendré Suerte"</th>
              <th scope="col" class="px-6 py-3">Total</th>
              <th scope="col" class="px-6 py-3">Estado</th>
              <th scope="col" class="py-3">Ingresado por</th>
          </tr>
      </thead>
      <tbody id="tableBody">
          <!-- Filas de datos aquí -->
          @foreach ($raffles as $raffle)
          <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$raffle->id}}</th>
              <td class="px-6 py-4">{{$raffle->sunday}}</td>
              <td class="py-4">{{$raffle->cant_tickets + $raffle->cant_tickets_luck}}</td>
              <td class="px-6 py-4">${{number_format(($raffle->cant_tickets + $raffle->cant_tickets_luck) * 2000, 0, ',', '.')}}</td>
              <td class="py-4">${{number_format($raffle->cant_tickets_luck * 1000, 0, ',', '.')}}</td>
              <td class="px-6 py-4">${{number_format(($raffle->cant_tickets_luck * 3000) + ($raffle->cant_tickets * 2000), 0, ',', '.')}}</td>
              @if ($raffle->stat == 1)
              <td class="px-6 py-4 ">Abierto</td>
              @elseif ($raffle->stat == 0)
              <td class="px-6 py-4">Realizado</td>
              <td class="py-3">{{ $raffle->user->name ?? '' }}    {{ $raffle->updated_at}}</td>
              @else
              <td class="px-6 py-4 flex items-center">
                  No realizado
                  <button title="Realizar sorteo" style="transition color 0.1s; color:#2ECC71;" onmouseover="this.style.color='#27AE60'" onmouseout="this.style.color='#2ECC71'" onclick="showForm('{{$raffle->sunday}}','{{$raffle->cant_tickets_luck}}')"  class="rounded-lg focus:outline-none focus:ring-blue-300 text-white px-2 py-2" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg>
                </button>
              </td>
              @endif
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
@else
  <div class="flex justify-center">
    <p style="background-color:#F56558" class=" text-white my-2 rounded-lg text-lg text-center p-2">No hay sorteos disponibles</p>    
  </div>
  @endif

<!-- Contenedor del formulario de edición -->
@if ($raffles->count() > 0)
<div id="overlay" class="overlay fixed inset-0 bg-black bg-opacity-50 hidden z-50" ></div>
<div id="editFormContainer" class="hidden fixed-form rounded-lg">
  <h2 class="mb-7 text-lg font-bold tracking-tight text-gray-900 dark:text-white justify-center flex">Registrar sorteo</h2>
  <table cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; justify-center text-center text-center">
    <tr style="background-color: #f2f2f2; text-align: center;">
        <th style="border: 1px solid #ddd; padding: 8px;">Fecha del sorteo</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Cantidad de billetes</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Subtotal de billetes</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Tendré Suerte</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Total</th>
    </tr>
    <tr style="text-align: center;">
        <td style="border: 1px solid #ddd; padding: 8px;">{{$raffle->sunday}}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">{{$raffle->cant_tickets + $raffle->cant_tickets_luck}}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">${{number_format(($raffle->cant_tickets + $raffle->cant_tickets_luck) * 2000, 0, ',', '.')}}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">${{number_format($raffle->cant_tickets_luck * 1000, 0, ',', '.')}}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">${{number_format(($raffle->cant_tickets_luck * 3000) + ($raffle->cant_tickets * 2000), 0, ',', '.')}}</td>
    </tr>
</table>
<p class="items-center justify-center text-center text-center mt-5">¡Selecciona los números ganadores!</p>
    <div class="form-wrapper flex justify-center text-center text-center">
      <form id="regForm1" class="p-4 rounded-lg w-full mx-5 " method="POST" action="{{ route('sorter.register') }}" novalidate>
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <input type="hidden" name="sunday" id="sundayInput1">
        <div class="flex justify-center text-center text-center ml-12">
          <div class="section sorteo">
            <h2 class="mb-7 text-sm font-bold tracking-tight text-gray-900 dark:text-white justify-center flex">Categoría Normal</h2>
            <div class="number-grid grid grid-cols-5 gap-4">
              @for ($i = 1; $i <= 30; $i++)
              <div class="number-square flex items-center justify-center px-4 py-4 bg-gray-100" data-number="{{ $i }}" onclick="selectNumber(this)">
                {{ $i }}
              </div>
              @endfor
            </div>
            <input type="hidden" name="selectedNumbers1" id="selectedNumbers1">
            <input type="hidden" name="selectedNumbers2" id="selectedNumbers2">
          </div>
          <div class="section tendre-suerte">
            <h2 class="mb-7 text-sm font-bold tracking-tight text-gray-900 dark:text-white justify-center flex">Categoría Tendré Suerte</h2>
            <div class="number-grid grid grid-cols-5 gap-4">
              @for ($j = 1; $j <= 30; $j++)
              <div class="number-square2 flex items-center justify-center px-4 py-4 bg-gray-100" data-number2="{{ $j }}" onclick="selectNumber2(this)">
                {{ $j }}
              </div>
              @endfor
            </div>
            
          </div>
        </div>
        <div class="flex justify-center mt-4">
          <button style="background-color:#2ECC71" type="button" class="px-4 py-2 text-white rounded mr-5" onclick="submitForm(this)">Confirmar</button>
          <button style="background-color:#F56558" type="button" class="px-4 py-2 text-white rounded" onclick="cancelForm(this)">Cancelar</button>
        </div>
      </form>
    </div>
</div>
@else
@endif


@if ($raffles->count() > 0)
<div id="editFormContainer2" class="hidden fixed-form rounded-lg ">
  <h2 class="mb-7 text-lg font-bold tracking-tight text-gray-900 dark:text-white justify-center flex">Registrar sorteo</h2>
  <table cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
    <tr style="background-color: #f2f2f2; text-align: center;">
        <th style="border: 1px solid #ddd; padding: 8px;">Fecha del sorteo</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Cantidad de billetes</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Subtotal de billetes</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Tendré Suerte</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Total</th>
    </tr>
    <tr style="text-align: center;">
        <td style="border: 1px solid #ddd; padding: 8px;">{{$raffle->sunday}}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">{{$raffle->cant_tickets + $raffle->cant_tickets_luck}}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">${{number_format(($raffle->cant_tickets + $raffle->cant_tickets_luck) * 2000, 0, ',', '.')}}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">${{number_format($raffle->cant_tickets_luck * 1000, 0, ',', '.')}}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">${{number_format(($raffle->cant_tickets_luck * 3000) + ($raffle->cant_tickets * 2000), 0, ',', '.')}}</td>
    </tr>
</table>
<p class="items-center justify-center text-center mt-5">¡Selecciona los números ganadores!</p>
    <div class="form-wrapper justify-center">
      <form id="regForm2" class="p-4 rounded-lg mx-2" method="POST" action="{{route('sorter.register')}}" novalidate>
          @csrf
          <input type="hidden" name="sunday" id="sundayInput2">
        <div class="number-grid grid grid-cols-5 gap-4">
            @for ($i = 1; $i <= 30; $i++)
            <div class="number-square flex items-center justify-center px-4 py-4 bg-gray-100" data-number="{{ $i }}" onclick="selectNumber(this)">
                {{ $i }}
            </div>
            @endfor
        </div>
        <input type="hidden" name="selectedNumbers1" id="selectedNumbers1">
        <div class="flex justify-center mt-4">
            <button style="background-color:#2ECC71" type="button" class="px-4 py-2 text-white rounded mr-5" onclick="submitForm2(this)">Confirmar</button>
            <button style="background-color:#F56558" type="button" class="px-4 py-2 text-white rounded" onclick="cancelForm2(this)">Cancelar</button>
        </div>
    </form>
</div>
@else
@endif

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function toggleDropdown(button) {
    const row = button.closest('tr');
    const dropdownRow = row.nextElementSibling;
    
    if (dropdownRow.classList.contains('dropdown-form')) {
        dropdownRow.classList.toggle('show');
    }
}
</script>
@section('js')
@if (Session::has('success'))
<script>
    Swal.fire({
      title: "¡Cambiado!",
      text: "Los datos han sido cambiado con exito!",
      icon: "success"
    }); 
</script>
@endif
@endsection

