<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Reservas') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="flex">
                <div class="flex-auto text-2xl mb-4">Lista de Reservas</div>
                <div class="flex-auto text-2xl mb-4"">
                <label for="search">Busque las reservas del dia</label>
                <a href="/search"  name="search" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Buscar</a>
            </div>

        </div>
            <div class="flex-auto text-right mt-2">
                <a href="/reserva" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Añadir nueva Reserva</a>
            </div>

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
                @foreach(auth()->user()->reservas as $reserva)
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

        </div>
    </div>
</div>
</x-app-layout>
