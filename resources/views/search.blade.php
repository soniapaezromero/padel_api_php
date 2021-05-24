<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Busqueda') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <form method="POST" action="/search">
                <div class="flex">
                        <div class="flex-auto text-2xl mb-4">Lista de Reservas</div>
                </div>
                <div class="flex-auto text-2xl mb-4"">
                <label for="fechabusqueda">Elija la fecha de la reserva:</label>
                <p>
                    <input type="date" class="form-control"  name="fechabusqueda" min={{$now->format('d-m-Y')}}  max={{$end}}>
                </p>
                @if ($errors->has('fechabusqueda'))
                    <span class="text-danger">{{ $errors->first('fechabusqueda') }}</span>
                @endif
                <span class="validity"></span>
                <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar</button>
                </div>
                <table class="w-full text-md rounded mb-4">
                <thead>
                <p class="border-b">
                <p>
                <th class="text-left p-3 px-5">Reserva</th>
                </p>
                <tr>
                    <th class="text-left p-3 px-5">Codigo</th>
                    <th class="text-left p-3 px-5">Fecha</th>
                    <th class="text-left p-3 px-5">Hora de inicio</th>
                    <th class="text-left p-3 px-5">Hora de Fin</th>
                    <th class="text-left p-3 px-5">Actions</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservas as $reserva)
                    <tr class="border-b hover:bg-orange-100">
                        <td class="p-3 px-5">
                            {{$reserva->id}}
                        </td>
                        <td class="p-3 px-5">
                            {{$reserva->fecha}}
                        </td>
                        <td class="p-3 px-5">
                            {{$reserva->hora_comienzo}}
                        </td>
                        <td class="p-3 px-5">
                            {{$reserva->hora_fin}}
                        </td>
                        <td class="p-3 px-5">

                            <a href="/reserva/{{$reserva->id}}" name="edit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
                            <form action="/reserva/{{$reserva->id}}" class="inline-block">
                                <button type="submit" name="delete" formmethod="POST" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                {{ csrf_field() }}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
