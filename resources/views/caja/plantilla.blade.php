@section('title') Caja @endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Caja
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 p-2">
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
                    @if(Request::path()=='caja/create')
                        @include('caja.create')
                    @elseif (Request::path()=='caja')
                        @include('caja.buscar')
                    @else

                    @endif
                </div>
            </div>
        </div>

    </div>

    @section('scripts')
    @include('caja.script')
    @endsection

</x-app-layout>

