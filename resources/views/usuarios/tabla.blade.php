<div class="relative overflow-x-auto mt-4">
    <table id="tablareporte" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Telefono</th>
                <th scope="col" class="px-6 py-3">Direccion</th>
                <th scope="col" class="px-6 py-3">Imagen</th>
                <th scope="col" class="px-6 py-3">Tipo de Usuario</th>
                <th scope="col" class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario )
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row"  class="px-6 py-4">{{$usuario->name}}</td>
                <td scope="row"  class="px-6 py-4">{{$usuario->email}}</td>
                <td scope="row"  class="px-6 py-4">{{$usuario->telefono}}</td>
                <td scope="row"  class="px-6 py-4">{{$usuario->direccion}}</td>
                <td scope="row"  class="px-6 py-4">
                    <img class="w-10 h-10 rounded-full" src="{{ asset('storage/profiles/'.$usuario->imagen) }}" alt="Foto">
                </td>
                <td scope="row"  class="px-6 py-4">
                    {{$usuario->TipoUsuario->nombre}}
                </td>
                <td scope="row"  class="flex items-center px-6 py-4 space-x-3 px-6 py-4">
                    <a
                    href="{{route('usuarios.edit', $usuario->id)}}"
                    class="text-white text-xs bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-full text-sm px-3 py-2 mr-1 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                    >Editar
                    </a>
                    <form class="inline-block" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('{{ __('¿Estás seguro de que deseas eliminar este Registro?') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white text-xs bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 rounded-full text-sm px-3 py-2 text-center mr-1 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
<!-- Mostramos los links de paginación -->
{{ $usuarios->links() }}
</div>

