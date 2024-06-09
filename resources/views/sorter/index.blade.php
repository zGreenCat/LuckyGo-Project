@extends('layouts.app')
@section('content')
 
</div>
      @if ($raffles->count()>0) 
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha del sorteo
                    </th>
                    <th scope="col" class="px-6 py-3">

                        Cantidad de Billetes

                    </th>
                    <th scope="col" class="px-6 py-3">
                        Subtotal de Billetes
                    </th>
                    <th scope="col" class="px-6 py-3">
                      "Tendre Suerte"
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ingresado por
                    </th>
                </tr>
            </thead>
            <tbody>
              @foreach ($raffles as $raffle)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{$raffle->id}}
                  </th>
                  <td class="px-6 py-4">
                    {{$raffle->sunday}}
                  </td>
                  <td class="px-6 py-4">
                    {{$raffle->cant_tickets+$raffle->cant_tickets_luck}}
                  </td>
                  <td class="px-6 py-4">
                    ${{number_format(($raffle->cant_tickets+$raffle->cant_tickets_luck) * 2000,0, ',', '.')}}
                  </td>
                  <td class="px-6 py-4">
                    ${{ number_format($raffle->cant_tickets_luck * 1000, 0, ',', '.') }}
                  </td>
                  <td class="px-6 py-4">
                    ${{number_format(($raffle->cant_tickets_luck*3000)+($raffle->cant_tickets*2000), 0, ',', '.') }}
                  </td>
                  
                    @if ($raffle->stat==1)
                      <td class="px-6 py-4">
                        Abierto
                      </td>
                    @elseif ($raffle->stat==0)
                      <td class="px-6 py-4">
                        Realizado
                      </td>
                    @else
                      <td class="px-6 py-4">
                        No realizado
                        <button style="background-color:#2ECC71; margin-left: 10px; transition: background-color 0.1s;" onmouseover="this.style.backgroundColor='#27AE60'" onmouseout="this.style.backgroundColor='#2ECC71'" class="px-3 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 text-white" type="submit">Actualizar</button>
                      </td>
                    @endif
                    {{$raffle->stat}}
                  
                  <td class="px-6 py-4">
                    {{$raffle->emal_sorter}}
                  </td>
                </tr> 
              @endforeach
            </tbody>
        </table>
      </div>    
      @else
      <div class="flex justify-center">

        <p style="background-color:#F56558" class=" text-white my-2 rounded-lg text-lg text-center p-2">No hay sorteos en sistema </p>    
      </div>
        
      @endif

@endsection