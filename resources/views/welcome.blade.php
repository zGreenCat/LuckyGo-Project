@extends('layouts.app')
@section('content')
 <h1 class="flex space-x-4 mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white items-center justify-center text-center mt-5">¡BIENVENIDO A LUCKYGO!</h1>
 <p class="mb-10 mt-10 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 items-center justify-center text-center"> Bienvenido(a) a LuckyGo. En esta sección podrás realizar la compra de billetes y consultar tus números ganadores. ¡Mucha suerte!</p>
 <hr style="border: 0; border-top: 1px solid #e0e0e0; margin: 20px 0;">
 <div class="flex justify-center space-x-4 mt-10">
    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mr-5">       
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">¿Quieres jugar?</h2>            
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Para obtener tu billete de lotería y jugar en nuestra página, por favor presiona el botón de acá abajo y sigue las instrucciones. ¡Mucha suerte!</p>
        <div class="mt-4">
            <a href="{{ route('buyTicket') }}" class="inline-block text-white bg-[#0A74DA] hover:bg-[#084A91] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200 whitespace-nowrap">Comprar billete</a> 
        </div>
    </div>
    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">    
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">¿Ya jugaste?</h2>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">¿Ya tienes un billete? Si ya tienes un billete y quieres revisar cómo te fue en el sorteo, solo necesitas tener el número de billete e ingresarlo aquí abajo.</p>
        <form id="regForm" class="mt-4" method="POST" action="{{ route('verifyTicket.store') }}" novalidate>
            @csrf
            <div class="flex items-center space-x-2">
                <div class="form-group">    
                    <input type="text" class="form-control w-full px-3 py-2 border rounded-lg" id="ticketID" name="ticketID" placeholder="LG123" maxlength="5">
                </div>
                <button type="submit" class="text-white bg-[#0A74DA] hover:bg-[#084A91] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200 whitespace-nowrap">Verificar billete</button>
            </div>
            @error('ticketID')
                <p style="background-color:#F6686B" class="text-white my-2 rounded-lg text-sm text-center p-2">{{$message}}</p>
            @enderror
            @if (@session('message'))
                <p style="background-color:#F6686B" class="text-white my-2 rounded-lg text-sm text-center p-2">{{ session('message')}}</p>    
            @endif
        </form>
    </div>
</div>
@endsection

