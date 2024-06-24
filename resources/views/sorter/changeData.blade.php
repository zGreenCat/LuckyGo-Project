@extends('layouts.app')
@section('content')
<form id="regForm" class="max-w-sm mx-auto bg-gray-100  p-9 rounded-lg shadow-lg" method="POST" action="{{route('sorter.data')}}"  novalidate>
    <h1 class="text-center mb-5" style="font-size: 18px; font-weight: bold;">Cambiar datos</h1>
    <h1 class="text-center mb-5" style="font-size: 18px; font-weight: bold;">{{auth()->user()->name}}</h1>
    <h1 class="text-center mb-5" style="font-size: 18px; font-weight: bold;">{{auth()->user()->age}}</h1>
  @csrf
    <div class="mb-5">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre nuevo</label>
      <input type="name" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        @error('name')
          <p style="background-color:#F6686B" class=" text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-5">
      <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad nueva</label>
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
