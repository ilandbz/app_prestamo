<div>
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Éxito!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 5.652a.999.999 0 1 0-1.414 1.414L11 8.414l-1.934 1.934a.999.999 0 1 0 1.414 1.414L12.414 10l1.934 1.934a.999.999 0 1 0 1.414-1.414L13.828 10l1.52-1.52a.999.999 0 0 0 0-1.414z"/>
            </svg>
        </span>
    </div>
    @endif
    <form method="POST" action="{{ route('caja.store') }}">
        @csrf
        <h3>NUEVO INGRESO</h3>
        <table class="w-full mt-6">
            <tr>
                <td class="p-2">
                    <x-input-label for="fecha" :value="__('Fecha Hora de registro')" />
                    <x-text-input id="fecha" class="block mt-1 w-full" type="datetime" name="fecha" :value="old('fecha', date('Y-m-d H:i:s'))" required readonly />
                    <x-input-error :messages="$errors->get('fecha')" class="mt-2" field="fecha" />
                </td>
                <td class="p-2">
                    <x-input-label for="descripcion" :value="__('Concepto')" />
                    <x-text-input id="descripcion" class="block mt-1 w-full uppercase" type="text" name="descripcion" :value="old('descripcion')" required autofocus />
                    <x-input-error :messages="$errors->get('descripcion')" class="mt-2" field="descripcion" />
                </td>
                <td class="p-2">
                    <x-input-label for="monto" :value="__('Monto en soles')" />
                    <div class="relative">
                        <input type="text" id="monto" name="monto" :value="old('monto')"
                            onchange="calcularTotal()"
                            class="py-3 px-4 pl-9 pr-16 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                            placeholder="0.00"
                            {{-- onchange="mostrar(this.value)"  --}}
                        />
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none z-20 pl-4">
                            <span class="text-gray-500">S/.</span>
                        </div>
                        <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none z-20 pr-4">
                            <span class="text-gray-500">Soles</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('monto')" class="mt-2" field="monto" />
                </td>
            </tr>
        </table>

        <div class="mt-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>
        </div>
    </form>
</div>
