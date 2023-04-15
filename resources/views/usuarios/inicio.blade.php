<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Usuarios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul class="hidden mb-4 text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                        <li class="w-full">
                            <x-nav-button-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.index')">
                                {{ __('Listar') }}
                            </x-nav-button-link>
                        </li>
                        <li class="w-full">
                            <x-nav-button-link :href="route('usuarios.create')" :active="request()->routeIs('usuarios.create')">
                                {{ __('Nuevo Registro') }}
                            </x-nav-button-link>
                        </li>
                    </ul>
                    @if(Request::path()=='usuarios')
                        @include('usuarios.busqueda')
                    @elseif (Request::path()=='usuarios/create' && session('tipo_usuario')!= 'Gestor' && session('tipo_usuario')!= 'Cliente')
                        @include('usuarios.create')
                    @else
                        @include('usuarios.edit')
                    @endif
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
    @include('usuarios.script')
    @endsection
</x-app-layout>
