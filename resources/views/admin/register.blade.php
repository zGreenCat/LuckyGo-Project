@extends('layouts.app')
@section('content')
<form id="regForm" class="max-w-sm mx-auto bg-gray-100  p-9 rounded-lg shadow-lg" method="POST" action="{{route('register.store')}}"  novalidate>
  <h1 class="text-center mb-5" style="font-size: 18px; font-weight: bold;">Registro de nuevo sorteador</h1>
@csrf
  <div class="mb-5">
    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del sorteador</label>
    <input type="name" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
      @error('name')
        <p style="background-color:#F6686B" class=" text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
      @enderror
  </div>
  <div class="mb-5">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
    <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nombre@ejemplo.com" required />
      @error('email')
        <p style="background-color:#F6686B" class="text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
      @enderror
  </div>
  <div class="mb-5">
    <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad</label>
    <input type="text" id="age" name="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
      @error('age')
        <p style="background-color:#F6686B" class=" text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
      @enderror
  </div>
  @if (@session('message'))
          <p style="background-color:#F6686B" class=" text-white my-2 rounded-lg text-sm text-center p-2">{{ session('message')}}</p>    
   @endif
   <div class="flex justify-center">
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #0A74DA; transition: background-color 0.1s;" onmouseover="this.style.backgroundColor='#074f9d'" onmouseout="this.style.backgroundColor='#0A74DA'">Registrar</button>
   </div>
   

</form>
 
@endsection

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
  <script>
    document.getElementById('regForm').addEventListener('submit', function(event) {
        event.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción registrará un nuevo sorteador',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, registrar sorteador',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>

     

@endsection
   


