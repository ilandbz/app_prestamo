<div class="relative overflow-x-auto mt-4">
    <table id="tablareporte" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">DNI</th>
                <th scope="col" class="px-6 py-3">Cliente</th>
                <th scope="col" class="px-6 py-3">Usuario</th>
                <th scope="col" class="px-6 py-3">Fecha de Registro</th>
                <th scope="col" class="px-6 py-3">Fecha de Vencimiento</th>
                <th scope="col" class="px-6 py-3">Monto</th>
                <th scope="col" class="px-6 py-3">TASA</th>
                <th scope="col" class="px-6 py-3">Saldo</th>
                <th scope="col" class="px-6 py-3">Cuota</th>
                <th scope="col" class="px-6 py-3">Zona</th>
                <th scope="col" class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prestamos as $prestamo )
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row"  class="px-6 py-4">{{$prestamo->cliente->dni}}</td>
                <td scope="row"  class="px-6 py-4">{{$prestamo->cliente->apellidos.', '.$prestamo->cliente->nombres}}</td>
                <td scope="row"  class="px-6 py-4">{{$prestamo->usuario->name}}</td>
                <td scope="row"  class="px-6 py-4">{{$prestamo->fecha}}</td>
                <td scope="row"  class="px-6 py-4">{{$prestamo->fechavencimiento}}</td>
                <td scope="row"  class="px-6 py-4">{{$prestamo->monto}}</td>
                <td scope="row"  class="px-6 py-4">{{$prestamo->tasa}}</td>
                <td scope="row"  class="px-6 py-4">{{$prestamo->saldo}}</td>
                <td scope="row"  class="px-6 py-4">{{$prestamo->cuota}}</td>
                <td scope="row"  class="px-6 py-4">{{$prestamo->zona}}</td>
                <td scope="row"  class="flex items-center px-6 py-4 space-x-3 px-6 py-4">
                    @if (session('tipo_usuario')== 'Gestor')
                        <button
                        onclick="cargarVista('{{ route('prestamos.show', $prestamo->id) }}')"
                        type="button"
                        class="text-white text-xs bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 rounded-full text-sm px-3 py-2 mr-1 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Mostrar</button>
                    @else
                        @if (session('tipo_usuario')== 'Administrador')
                        <form class="inline-block" action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" onsubmit="return confirm('{{ __('¿Estás seguro de que deseas eliminar este préstamo?') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white text-xs bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 rounded-full text-sm px-3 py-2 text-center mr-1 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
                        </form>
                        @endif
                        <button
                        onclick="cargarVista('{{ route('prestamos.show', $prestamo->id) }}')"
                        type="button"
                        class="text-white text-xs bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 rounded-full text-sm px-3 py-2 mr-1 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Mostrar</button>
                        <button
                        onclick="cargarVista('{{ route('prestamos.edit', $prestamo->id) }}')"
                        class="text-white text-xs bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-full text-sm px-3 py-2 mr-1 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Editar</button>
                    @endif

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
<!-- Mostramos los links de paginación -->
{{ $prestamos->links() }}
</div>
