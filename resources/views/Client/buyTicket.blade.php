@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{ route('main') }}" class="btn">Volver</a> 
    <form id="regForm" class="max-w-sm mx-auto bg-gray-100  p-9 rounded-lg shadow-lg" method="POST" action="{{route('buyTicket')}}"  novalidate>
    @csrf
    <h2>Compra de billetes de lotería</h2>  
    <div class="number-grid">
        @for ($i = 1; $i <= 30; $i++)
            <div class="number-circle" data-number="{{ $i }}">
                {{ $i }}
            </div>
        @endfor
    </div>
    <input type="hidden" name="selectedNumbers" id="selectedNumbers">
        <div class="mt-3">
            <p>Billete: $2,000</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="tendresuerte" id="tendresuerte" value="1">
                <label class="form-check-label" for="tendresuerte">
                    Categoría "Tendré suerte" (+$1,000)
                </label>
            </div>
        </div>
        <div class="mt-3">
            <p>Total: <span id="total">$2,000</span></p>
        </div>  
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #0A74DA;">Jugar</button>   
    </form>
    <p class="mt-3">Para participar en el sorteo de cada domingo, asegúrate de realizar la compra de tus billetes antes de las 23:59 horas de ese mismo día. Todas las compras efectuadas dentro de ese plazo serán incluidas en el sorteo correspondiente.</p>
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
            text: 'Has seleccionado los números: ' + selectedNumbersInput.value ,
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