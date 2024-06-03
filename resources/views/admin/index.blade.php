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
        <input type="form-control" name="search" id="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingrese nombre o correo electronico"  />
        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
    </div>
  </form>
</div>
      @if ($users->count()>0) 
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre del sorteador
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Correo electronico
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Edad
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Cantidad de sorteos
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              @if ($user->role =='S')
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{$user->id-1}}
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
                    <form action="{{route('admin.change',['id'=>$user->id])}}" method="POST">
                      @csrf
                      <select name="estado">
                          <option value="true" @if($user->stat) selected @endif>Habilitado</option>
                          <option value="false" @if(!$user->stat) selected @endif>Deshabilitado</option>
                      </select>
                      <div>
                        <button style="background-color:#2ECC71" class="px-3 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 text-white" type="submit">Actualizar</button>
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
        <p style="background-color:#F6686B" class=" text-white my-2 rounded-lg text-lg text-center p-2">No hay sorteadores en sistema </p>    
      </div>
        
      @endif
=======
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (Session::has('success'))
<script>
    Swal.fire({
      title: "Registrado!",
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
  
@endif
@endsection
</head>
<body>   
  <main>
    
  

  </main>
</body>
