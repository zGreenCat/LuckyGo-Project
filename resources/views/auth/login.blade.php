<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
  <nav>
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <img src="{{ asset('images/LogoFinal-LuckyGo.png') }}" alt="Imagen del logo de Lucky Go" width="150">
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <a href="{{route('main')}}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" style="color: #0A74DA;" aria-current="page">Volver</a>
          </li>

          </li>
        </ul>
      </div>
    </div>
  </nav>   
  <main>
    <form class="max-w-sm mx-auto bg-gray-100 p-5 rounded-lg" method="POST" action="{{route('login.store')}}"  novalidate>
      @csrf
      <h1 class="text-center mb-5" style="font-size: 18px; font-weight: bold;">Iniciar sesión</h1>
        <div class="mb-5">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
          <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
            @error('email')
              <p class="bg-red-400 text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="*********" required />
          @error('password')
              <p class="bg-red-400 text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
          @enderror
        </div>
        @if (@session('message'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ session('message')}}</p>    
         @endif
        <div class="flex justify-center">
          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #0A74DA;">Entrar</button>
        </div>
        
      </form>
  </main>
</body>
</html>

