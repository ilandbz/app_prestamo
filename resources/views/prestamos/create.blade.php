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
    @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif
    <form method="POST" action="{{ route('prestamos.store') }}">
        @csrf
        <h3>CLIENTE</h3>
        <table class="w-full mt-6">
            <tr>
                <td width="20%" class="p-2">
                    <x-input-label for="dni" :value="__('DNI')" />
                    <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni" :value="old('dni')" required autofocus
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                    onchange="cargardatoscliente()"  />
                    <x-input-error :messages="$errors->get('dni')" class="mt-2" field="dni" />
                </td>
                <td class="p-2">
                    <x-input-label for="apellidos" :value="__('Apellidos')" />
                    <x-text-input id="apellidos" class="block mt-1 w-full uppercase" type="text" name="apellidos" :value="old('apellidos')" required autofocus />
                    <x-input-error :messages="$errors->get('apellidos')" class="mt-2" field="apellidos" />
                </td>
                <td class="p-2">
                    <x-input-label for="nombres" :value="__('Nombres')" />
                    <x-text-input id="nombres" class="block mt-1 w-full uppercase" type="text" name="nombres" :value="old('nombres')" required autofocus />
                    <x-input-error :messages="$errors->get('nombres')" class="mt-2" field="nombres" />
                </td>
            </tr>
            <tr>
                <td colspan="2" class="p-2">
                    <x-input-label for="direccionCasa" :value="__('Direccion Casa')" />
                    <x-text-input id="direccionCasa" class="block mt-1 w-full" type="text" name="direccionCasa" :value="old('direccionCasa')" required />
                    <x-input-error :messages="$errors->get('direccionCasa')" class="mt-2" field="direccionCasa" />
                </td>
                <td class="p-2">
                    <x-input-label for="telefono" :value="__('Telefono')" />
                    <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autofocus />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" field="telefono" />
                </td>
            </tr>
            <tr>
                <td colspan="2" class="p-2">
                    <x-input-label for="direccionCobro" :value="__('Direccion Cobro')" />
                    <x-text-input id="direccionCobro" class="block mt-1 w-full" type="text" name="direccionCobro" :value="old('direccionCobro')" required />
                    <x-input-error :messages="$errors->get('direccionCobro')" class="mt-2" field="direccionCobro" />
                </td>
                <td class="p-2">
                    <x-input-label for="telefonoContacto" :value="__('Telefono Contacto')" />
                    <x-text-input id="telefonoContacto" class="block mt-1 w-full" type="text" name="telefonoContacto" :value="old('telefonoContacto')" required autofocus />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" field="telefonoContacto" />
                </td>
            </tr>
        </table>
        <h3 class="mt-4">DATOS PRESTAMO</h3>
        <table class="mt-6 w-full">
            <tr>
                <td class="p-2">
                    <x-input-label for="fecha" :value="__('Fecha Hora de registro')" />
                    <x-text-input id="fecha" class="block mt-1 w-full" type="datetime" name="fecha" :value="old('fecha', date('Y-m-d H:i:s'))" required />
                    <x-input-error :messages="$errors->get('fecha')" class="mt-2" field="fecha" />
                </td>
                <td class="p-2">
                    <x-input-label for="fechavencimiento" :value="__('Fecha de vencimiento')" />
                    <x-text-input id="fechavencimiento" class="block mt-1 w-full" type="date" name="fechavencimiento" :value="old('fechavencimiento')" required />
                    <x-input-error :messages="$errors->get('fechavencimiento')" class="mt-2" field="fechavencimiento" />
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
                <td class="p-2">
                    <x-input-label for="frecuencia" :value="__('Frecuencia')" />
                    <select id="frecuencia" name="frecuencia"
                    onchange="calcularTotal()"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="Diario">Diario</option>
                    <option value="Semanal">Semanal</option>
                    <option value="Quincenal">Quincenal</option>
                    </select>
                </td>
                <td class="p-2" width="15%">
                    <x-input-label for="tasa" :value="__('Tasa de interés')" />
                    <div class="relative">
                        <x-text-input id="tasa" class="block mt-1 w-full px-4 pl-9 text-end pr-8" type="text" name="tasa" value="9"
                        onchange="calcularTotal()"
                        placeholder="0.00" required />
                        <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none z-20 pr-4">
                            <span class="text-gray-500">%</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="p-2">
                    <x-input-label for="total" :value="__('Total')" />
                    <div class="relative">
                        <input type="text" id="total" name="total" :value="old('total')"
                            class="py-3 px-4 pl-9 pr-16 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                            placeholder="0.00"
                            readonly
                        />
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none z-20 pl-4">
                            <span class="text-gray-500">S/.</span>
                        </div>
                        <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none z-20 pr-4">
                            <span class="text-gray-500">Soles</span>
                        </div>
                    </div>
                </td>
                <td class="p-2">
                    <x-input-label for="cuota" :value="__('Cuota')" />
                    <div class="relative">
                        <input type="text" id="cuota" name="cuota" :value="old('cuota')"
                        class="py-3 px-4 pl-9 pr-16 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                        readonly
                        placeholder="0.00">
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none z-20 pl-4">
                            <span class="text-gray-500">S/.</span>
                        </div>
                        <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none z-20 pr-4">
                            <span class="text-gray-500">Soles</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('cuota')" class="mt-2" field="cuota" />
                </td>
                <td class="p-2">
                    <x-input-label for="cuota" :value="__('Periodo')" />
                    <input type="hidden" name="periodo" id="periodo" value="30">
                    <blockquote class="text-xl italic font-semibold text-gray-900 dark:text-white">
                        <p id="periodotxt">30 Dias</p>
                    </blockquote>
                </td>
                <td class="p-2" colspan="3">
                    <x-input-label for="zona" :value="__('Zona')" />
                    <x-text-input id="zona" class="block mt-1 w-full" type="text" name="zona" :value="old('zona')" required />
                    <x-input-error :messages="$errors->get('zona')" class="mt-2" field="zona" />
                </td>
            </tr>
            <tr>
                <td class="p-2" colspan="4">

                </td>
                <td class="p-2">
                    <x-input-label for="id_gestor" :value="__('Gestor')" />
                    <select id="id_gestor" name="id_gestor" required
                    onchange="calcularTotal()"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Seleccione</option>
                        @foreach($gestores as $gestor)
                            <option value="{{ $gestor->id }}">{{ $gestor->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <div class="mt-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>
        </div>
    </form>
</div>
