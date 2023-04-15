@section('title') Gastos @endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gastos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 p-2">
                    <div class="sm:hidden">
                        <label for="tabs" class="sr-only">Menu</label>
                        <select id="tabs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Listar</option>
                            <option>Nuevo Registro</option>
                            <option>Clientes</option>
                            <option>Pagos</option>
                        </select>
                    </div>
                    <ul class="hidden mb-4 text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                        <li class="w-full">
                            <x-nav-button-link :href="route('gastos.index')" :active="request()->routeIs('gastos.index')">
                                {{ __('Listar') }}
                            </x-nav-button-link>
                        </li>
                        <li class="w-full">
                            <x-nav-button-link :href="route('gastos.create')" :active="request()->routeIs('gastos.create')">
                                {{ __('Nuevo Registro') }}
                            </x-nav-button-link>
                        </li>
                    </ul>
                    @if(Request::path()=='gastos/create')
                        @include('gastos.create')
                    @elseif (Request::path()=='gastos')
                        @include('gastos.buscar')
                    @else

                    @endif
                </div>
            </div>
        </div>

    </div>

    @section('scripts')
    @include('gastos.script')
    @endsection

</x-app-layout>

