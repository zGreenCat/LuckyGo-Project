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
              <th scope="col" class="px-6 py-3">Cantidad de Billetes</th>
              <th scope="col" class="px-6 py-3">Subtotal de Billetes</th>
              <th scope="col" class="px-6 py-3">"Tendre Suerte"</th>
              <th scope="col" class="px-6 py-3">Total</th>
              <th scope="col" class="px-6 py-3">Estado</th>
              <th scope="col" class="px-6 py-3">Ingresa</th>
          </tr>
      </thead>
      <tbody id="tableBody">
          <!-- Filas de datos aquí -->
          @foreach ($raffles as $raffle)
          <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$raffle->id}}</th>
              <td class="px-6 py-4">{{$raffle->sunday}}</td>
              <td class="px-6 py-4">{{$raffle->cant_tickets + $raffle->cant_tickets_luck}}</td>
              <td class="px-6 py-4">${{number_format(($raffle->cant_tickets + $raffle->cant_tickets_luck) * 2000, 0, ',', '.')}}</td>
              <td class="px-6 py-4">${{number_format($raffle->cant_tickets_luck * 1000, 0, ',', '.')}}</td>
              <td class="px-6 py-4">${{number_format(($raffle->cant_tickets_luck * 3000) + ($raffle->cant_tickets * 2000), 0, ',', '.')}}</td>
              @if ($raffle->stat == 1)
              <td class="px-6 py-4 ">Abierto</td>
              @elseif ($raffle->stat == 0)
              <td class="px-6 py-4">Realizado</td>
              @else
              <td class="px-6 py-4">
                  No realizado
                  <button style="margin-left: 20px; transition background-color 0.1s; background-color:#2ECC71;" onmouseover="this.style.backgroundColor='#27AE60'" onmouseout="this.style.backgroundColor='#2ECC71'" class="rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 text-white flex  px-2 py-2" type="submit">
                    
                    <a class="flex">Actualizar</a>
                </button>
              </td>
              @endif
              <td class="px-6 py-4">{{ $raffle->user->name ?? '' }}    {{ $raffle->timeRegister }}</td>
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
<div id="overlay" class="overlay" ></div>
<div id="editFormContainer" class="hidden fixed-form rounded-lg">
    <div class="form-wrapper flex justify-center">
      <form id="regForm1" class="p-4 rounded-lg w-full mx-2" method="POST" action="{{ route('sorter.register') }}" novalidate>
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <input type="hidden" name="sunday" id="sundayInput1">
        <div class="flex justify-between">
          <div class="section sorteo">
            <h2 class="mb-7 text-lg font-bold tracking-tight text-gray-900 dark:text-white justify-center flex">Sorteo</h2>
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
            <h2 class="mb-7 text-lg font-bold tracking-tight text-gray-900 dark:text-white justify-center flex">Tendre Suerte</h2>
            <div class="number-grid grid grid-cols-5 gap-4">
              @for ($j = 1; $j <= 30; $j++)
              <div class="number-square2 flex items-center justify-center px-4 py-4 bg-gray-100" data-number2="{{ $j }}" onclick="selectNumber2(this)">
                {{ $j }}
              </div>
              @endfor
            </div>
            
          </div>
        </div>
        <div class="flex justify-between mt-4">
          <button style="background-color:#2ECC71" type="button" class="px-4 py-2 text-white rounded" onclick="submitForm(this)">Guardar</button>
          <button style="background-color:#F56558" type="button" class="px-4 py-2 text-white rounded" onclick="cancelForm(this)">Cancelar</button>
        </div>
      </form>
    </div>
</div>



<div id="overlay2" class="overlay2 " ></div>
<div id="editFormContainer2" class="hidden fixed-form rounded-lg ">
    <div class="form-wrapper flex justify-center">
      <form id="regForm2" class="p-4 rounded-lg w-full mx-2" method="POST" action="{{route('sorter.register')}}" novalidate>
          @csrf
          <input type="hidden" name="sunday" id="sundayInput2">
        <h2 class="mb-7 text-lg font-bold tracking-tight text-gray-900 dark:text-white justify-center flex">Sorteo</h2>
        <div class="number-grid grid grid-cols-5 gap-4">
            @for ($i = 1; $i <= 30; $i++)
            <div class="number-square flex items-center justify-center px-4 py-4 bg-gray-100" data-number="{{ $i }}" onclick="selectNumber(this)">
                {{ $i }}
            </div>
            @endfor
        </div>
        <input type="hidden" name="selectedNumbers1" id="selectedNumbers1">
        <div class="flex justify-end mt-4">
            <button style="background-color:#2ECC71" type="button" class="px-4 py-2 text-white rounded" onclick="submitForm2(this)">Guardar</button>
            <button style="background-color:#F56558" type="button" class="px-4 py-2 text-white rounded" onclick="cancelForm2(this)">Cancelar</button>
        </div>
    </form>
</div>
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