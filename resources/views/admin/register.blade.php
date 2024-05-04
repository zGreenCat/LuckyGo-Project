@extends('layouts.app')
@section('content')
  <form class="max-w-sm mx-auto bg-gray-100 p-5 rounded-lg" method="POST" action="{{route('register.store')}}"  novalidate>
    <h1 class="text-center mb-5" style="font-size: 18px; font-weight: bold;">Registro de nuevo sorteador</h1>
  @csrf
    <div class="mb-5">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del sorteador</label>
      <input type="name" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        @error('name')
          <p class="bg-red-400 text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-5">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
      <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
        @error('email')
          <p class="bg-red-400 text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-5">
      <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad</label>
      <input type="text" id="age" name="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
        @error('age')
          <p class="bg-red-400 text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
        @enderror
    </div>
    @if (@session('message'))
            <p class="bg-red-400 text-white my-2 rounded-lg text-sm text-center p-2">{{ session('message')}}</p>    
     @endif
     <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #0A74DA;">Registrar</button>
     
  
  </form>
@endsection
   


