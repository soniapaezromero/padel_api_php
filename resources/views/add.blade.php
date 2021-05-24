<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Añadir Reserva') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

            <form method="POST" action="/reserva">
                <div class="form-group">
                <label for="fecha">Elija la fecha de la reserva:</label>
                <p>
                    <input type="date" class="form-control" name="fecha" min={{$now->format('d-m-Y')}}  max={{$end}} required>
                </p>
                @if ($errors->has('fecha'))
                    <span class="text-danger">{{ $errors->first('fecha') }}</span>
                @endif
                <span class="validity"></span>
                </div>

               <div class="form-group">
                <label for="hora_comienzo">Elija la hora de la reserva:</label>
                <p>
                <input  type="time" class="form-control" name="hora_comienzo" min={{$startmin->format('H:i')}} max={{$startmax->format('H:i')}} required>

                </p>
                @if ($errors->has('hora_comienzo'))
                    <span class="text-danger">{{ $errors->first('hora_comienzo') }}</span>
                @endif
                <span class="validity"></span>
                </div>
                <div class="form-group">
                    <label for="hora_fin">Elija la hora de fin de reserva:</label>
                    <p>
                        <input  type="time" class="form-control" name="hora_fin" min={{$endmin->format('H:i')}} max={{$endmax->format('H:i')}}  required>
                    </p>
                    @if ($errors->has('hora_fin'))
                        <span class="text-danger">{{ $errors->first('hora_fin') }}</span>
                    @endif
                    <span class="validity"></span>
                </div>


                <div class="form-group">
                <label for="email">Email de tu acompañante:</label>
                    <textarea id="email"name="email_cia" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Email de tu acompañante'></textarea>
                    @if ($errors->has('email_cia'))
                        <span class="text-danger">{{ $errors->first('email_cia') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Reserva realizada</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
</x-app-layout>
