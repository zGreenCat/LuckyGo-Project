@extends('layouts.app')
@section('content')

 <h1 class="flex space-x-4 mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white items-center justify-center text-center mt-5">¡BIENVENIDO A LUCKY GO!</h1>
 <p class="mb-10 mt-10 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400 items-center justify-center text-center">¡Bienvenido a Lucky Go, tu destino para la emoción y la fortuna! 
    Estamos encantados de tenerte aquí mientras te adentras en el emocionante mundo de la lotería. ¿Estás listo para desafiar a la suerte y abrir las puertas hacia un futuro lleno de posibilidades? ¡Únete 
    a la diversión en Lucky Go y deja que la fortuna te sonría!</p>

 <hr style="border: 0; border-top: 1px solid #e0e0e0; margin: 20px 0;">

    <div class="flex justify-center space-x-4 mt-10">
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mr-5">
            <a href="#">
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">¿Quieres jugar?</h2>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Para obtener tu boleto de lotería y jugar en nuestra página, por favor presiona el botón de acá abajo y sigue las instrucciones. ¡Mucha suerte!</p>
            <a href="{{ route('buyTicket') }}" class="btn text-white bg-[#0A74DA] hover:bg-[#084A91] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 transition duration-200 justify-center items-center">
                Comprar Boleto
            </a> 
        </div>
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">¿Ya jugaste?</h2>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">¿Ya tienes un boleto? Si ya tienes un boleto y quieres revisar cómo te fue en el sorteo, solo necesitas tener el número de billete e ingresarlo aquí abajo.</p>
            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Read more
            
            </a>
        </div>
    </div>

@endsection