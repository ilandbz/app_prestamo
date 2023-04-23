<div class="relative overflow-x-auto mt-4">
    <table id="tablareporte" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">USUARIO</th>
                <th scope="col" class="px-6 py-3">FECHA HORA</th>
                <th scope="col" class="px-6 py-3">CONCEPTO</th>
                <th scope="col" class="px-6 py-3">MONTO</th>
                <th scope="col" class="px-6 py-3">SALDO</th>
                <th scope="col" class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cajaregistros as $row )
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row"  class="px-6 py-4">{{$row->usuario->name}}</td>
                <td scope="row"  class="px-6 py-4">{{$row->fecha}}</td>
                <td scope="row"  class="px-6 py-4">{{$row->descripcion}}</td>
                <td scope="row"  class="px-6 py-4">{{$row->monto}}</td>
                <td scope="row"  class="px-6 py-4">{{$row->saldo}}</td>
                <td scope="row"  class="flex items-center px-6 py-4 space-x-3 px-6 py-4">
                    <form class="inline-block" action="{{ route('caja.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ __('¿Estás seguro de que deseas eliminar este préstamo?') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 rounded-full text-sm px-3 py-2 text-center mr-1 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
<!-- Mostramos los links de paginación -->
{{ $cajaregistros->links() }}
</div>
