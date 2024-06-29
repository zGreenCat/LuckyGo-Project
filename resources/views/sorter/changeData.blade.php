@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto mt-10">
  <form id="regForm" class="bg-gray-100 p-8 rounded-xl shadow-lg" method="POST" action="{{route('sorter.data')}}" novalidate>
    <h1 class="text-center mb-5" style="font-size: 18px; font-weight: bold;">Cambio de datos personales</h1>
    <div class="bg-blue-50 p-4 rounded-lg mb-6">
      <h2 class="text-lg font-semibold mb-2">Datos actuales:</h2>
      <p><span class="font-medium">Nombre:</span> {{auth()->user()->name}}</p>
      <p><span class="font-medium">Edad:</span> {{auth()->user()->age}}</p>
    </div>
    @csrf
    <div class="mb-6">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nuevo nombre</label>
      <input type="name" id="name" name="name" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required />
      @error('name')
          <p style="background-color:#F6686B" class=" text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-6">
      <label for="age" class="block mb-2 text-sm font-medium text-gray-700">Nueva edad</label>
      <input type="text" id="age" name="age" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required />
      @error('age')
          <p style="background-color:#F6686B" class=" text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
        @enderror
    </div>
    @if (@session('message'))
            <p style="background-color:#F6686B" class=" text-white my-2 rounded-lg text-sm text-center p-2">{{ session('message')}}</p>    
     @endif
    <div class="flex justify-center">
      <button type="submit" class="px-6 py-3 bg-[#0a74da] text-white font-medium text-sm rounded-lg shadow-md hover:bg-[#084A91] transition duration-150 ease-in-out">
        Cambiar datos
      </button>
    </div>
  </form>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>