@extends('layouts.app')
@section('content')

<div>
  <form method="get" action="{{route('search.admin')}}" class="max-w-md mx-auto">   
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="form-control" name="search" id="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingrese nombre o correo electrónico"  />
        <button style="background-color:#0A74DA; transition: background-color 0.1s;" onmouseover="this.style.backgroundColor='#074f9d'" onmouseout="this.style.backgroundColor='#0A74DA'" type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-1000 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>

    </div>
  </form>
</div>
      @if ($users->count()>0) 
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm  rtl:text-right text-gray-500 dark:text-gray-400 items-center justify-center text-center">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre del sorteador
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Correo electrónico
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Edad
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Cantidad de sorteos
                    </th>
                    <th scope="col" class="px-6 py-3 ">
                        Estado
                    </th>
                </tr>
            </thead>
            <tbody>
              
              @foreach ($users as $user)
              @if ($user->role =='S')
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$i++}}
                  </th>
                  <td class="px-6 py-4">
                    {{$user->name}}
                  </td>
                  <td class="px-6 py-4">
                    {{$user->email}}
                  </td>
                  <td class="px-6 py-4">
                    {{$user->age}}
                  </td>
                  <td class="px-6 py-4">
                    {{$user->lotcant}}
                  </td>
                  <td class="px-6 py-4">

                    <form action="{{ route('admin.change', ['id' => $user->id]) }}" method="POST" style="display: flex; align-items: center;" class="items-center justify-center text-center">
                        @csrf
                        <select name="estado">
                            <option value="true" @if($user->stat) selected @endif>Habilitado</option>
                            <option value="false" @if(!$user->stat) selected @endif>Deshabilitado</option>
                        </select>
                      
                </td>
                <td class="px-6 py-4">
                  <button data-tooltip-target="tooltip-animation-{{ $loop->index }}" style="margin-left: 20px; transition background-color 0.1s; background-color:#2ECC71;" onmouseover="this.style.backgroundColor='#27AE60'" onmouseout="this.style.backgroundColor='#2ECC71'" class="rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 text-white flex  px-2 py-2" type="submit">
                    <svg width="20" height="20" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="1 0 16 14">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                    </svg>
                    
                    <a class="flex">Actualizar</a>
                </button>
                <div id="tooltip-animation-{{ $loop->index }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                  Actualizar Estado
                  <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                  </form>
                </td>

                </tr> 
              @endif
              @endforeach
            </tbody>
        </table>
      </div>    
      @else
      <div class="flex justify-center">
        <p style="background-color:#F56558" class=" text-white my-2 rounded-lg text-lg text-center p-2">No hay sorteadores en sistema </p>    
      </div>
      @endif

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (Session::has('success'))
<script>
    Swal.fire({
      title: "¡Registrado!",
      text: "El sorteador ha sido registrado con éxito",
      icon: "success"
    }); 
</script>
@elseif (Session::has('success2'))
<script>
    Swal.fire({
      title: "¡Actualizado!",
      text: "El o los sorteadores han sido actualizados con éxito.",
      icon: "success"
    });
</script>
@elseif (Session::has('success2'))
<script>
    Swal.fire({
      title: "¡Actualizado!",
      text: "El o los sorteadores han sido actualizados con éxito.",
      icon: "success"
    });
</script>
  

@endif


@if (Session::has('error'))
<script>
    Swal.fire({
        title: "Error",
        text: "Ha ocurrido un error al registrar el sorteador, inténtelo más tarde",
        icon: "error"
    });
</script>
@endif

@endsection
</head>
<body>   
  <main>
    
  

  </main>
</body>
