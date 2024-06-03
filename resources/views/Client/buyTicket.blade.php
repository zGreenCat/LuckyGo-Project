@extends('layouts.app')

@section('content')

<h1 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white items-center justify-center text-center">Compra de boleto de lotería</h1>
<div class="ml-10 mt-10 justify-center">
    <h1 class="mb-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white">¿Como jugar?</h1>
    <p class="mt-5">Si no sabes cómo jugar, aquí te explicamos brevemente los pasos a seguir:</p>
    <p class="mt-5">1. Selecciona tus 5 números favoritos para jugar. Son solo 5, así que elige sabiamente.</p>
    <p class="mt-5">2. Puedes seleccionar la casilla de "Tendré suerte", esto te dará más posibilidades de ganar.</p>
    <p class="mt-5">3. Cuando estés listo con tu selección de números, presiona el botón "Jugar", confirma la compra. ¡Y listo! Ya estarás participando en el siguiente sorteo.</p>
    <p class="mt-10 mb-10 mr-5">Para participar en el sorteo de cada domingo, asegúrate de realizar la compra de tus billetes antes de las 23:59 horas de ese mismo día. Todas las compras efectuadas dentro de ese plazo serán incluidas en el sorteo correspondiente.</p>
    <h1 class="mb-10 mt-5 text-lg font-bold tracking-tight text-gray-900 dark:text-white">¿Listo para jugar?</h1>
</div>
<div class="container flex mx-auto">
    <form id="regForm" class="max-w-lg mx-auto bg-gray-100 p-9 rounded-lg shadow-lg w-full" method="POST" action="{{ route('buyTicket') }}" novalidate>
        @csrf
        <h2 class="mb-7 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Selecciona los números para tu boleto:</h2>
        <div class="number-grid grid grid-cols-6 gap-4">
            @for ($i = 1; $i <= 30; $i++)
                <div class="number-circle flex items-center justify-center px-6 py-6 bg-white rounded-full shadow" data-number="{{ $i }}">
                    {{ $i }}
                </div>
            @endfor
        </div>
        <input type="hidden" name="selectedNumbers" id="selectedNumbers">
        <div class="mt-6">
            <p class="mb-5">Billete: $2000</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="tendresuerte" id="tendresuerte" value="1">
                <label class="form-check-label" for="tendresuerte">
                    Categoría "Tendré suerte" (+$1000)
                </label>
            </div>
        </div>
        <div class="mt-5 mb-5">
            <p>Total: <span id="total">$2000</span></p>
        </div>
        <button type="submit" class="text-white bg-[#0A74DA] hover:bg-[#084A91] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center transition duration-200">Jugar</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const totalElement = document.getElementById('total');
        const tendresuerteCheckbox = document.getElementById('tendresuerte');

        tendresuerteCheckbox.addEventListener('change', function () {
            updateTotal();
        });

        function updateTotal() {
            let total = 2000;
            if (tendresuerteCheckbox.checked) {
                total += 1000;
            }
            totalElement.textContent = '$' + total.toLocaleString();
        }
        
    });
</script>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('regForm').addEventListener('submit', function(event) {

        const selectedNumbersInput = document.getElementById('selectedNumbers');
        const selectedNumbers = Array.from(document.querySelectorAll('.number-circle.selected'))
        .map(circle => circle.getAttribute('data-number'));
        selectedNumbersInput.value = selectedNumbers.join('-');

        event.preventDefault();
        
        Swal.fire({
            title: 'Confirmar compra',
            text: 'Has seleccionado los números: ' + selectedNumbersInput.value  + 'El valor de tu billete es: ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, comprar billete',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>

@endsection
<style>
    .number-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 10px;
    }

    .number-circle {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e0e0e0;
        cursor: pointer;
    }

    .number-circle.selected {
        background-color: #007bff;
        color: #fff;
    }
</style>