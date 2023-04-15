<div class="fixed z-10 inset-0 overflow-y-auto" id="miModal">
    <div class="flex items-center justify-center min-h-screen px-4">
      <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
      <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full md:max-w-3xl">
        <div class="bg-gray-50 px-4 py-3 border-b">
          <h3 class="text-lg font-medium text-gray-900">Editar Prestamo</h3>
        </div>
        <div class="p-4">
            <form method="POST" action="{{ route('prestamos.update', $prestamo->id) }}">
                @csrf
                @method('PUT')
                <h3>DATOS CLIENTE</h3>
                <table class="w-full mt-6">
                    <tr>
                        <td width="20%" class="p-2">
                            <x-input-label for="dni" :value="__('DNI')" />
                            <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni" value="{{$prestamo->cliente->dni}}" required
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"  />
                            <x-input-error :messages="$errors->get('dni')" class="mt-2" field="dni" />
                        </td>
                        <td class="p-2">
                            <x-input-label for="apellidos" :value="__('Apellidos')" />
                            <x-text-input id="apellidos" class="block mt-1 w-full uppercase" type="text" name="apellidos" value="{{$prestamo->cliente->apellidos}}" required />
                            <x-input-error :messages="$errors->get('apellidos')" class="mt-2" field="apellidos" />
                        </td>
                        <td class="p-2">
                            <x-input-label for="nombres" :value="__('Nombres')" />
                            <x-text-input id="nombres" class="block mt-1 w-full uppercase" type="text" name="nombres" value="{{$prestamo->cliente->nombres}}" required />
                            <x-input-error :messages="$errors->get('nombres')" class="mt-2" field="nombres" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-2">
                            <x-input-label for="direccionCasa" :value="__('Direccion Casa')" />
                            <x-text-input id="direccionCasa" class="block mt-1 w-full" type="text" name="direccionCasa" value="{{$prestamo->cliente->direccionCasa}}" required />
                            <x-input-error :messages="$errors->get('direccionCasa')" class="mt-2" field="direccionCasa" />
                        </td>
                        <td class="p-2">
                            <x-input-label for="telefono" :value="__('Telefono')" />
                            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" value="{{$prestamo->cliente->telefono}}" required />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2" field="telefono" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-2">
                            <x-input-label for="direccionCobro" :value="__('Direccion Cobro')" />
                            <x-text-input id="direccionCobro" class="block mt-1 w-full" type="text" name="direccionCobro" value="{{$prestamo->cliente->direccionCobro}}" required />
                            <x-input-error :messages="$errors->get('direccionCobro')" class="mt-2" field="direccionCobro" />
                        </td>
                        <td class="p-2">
                            <x-input-label for="telefonoContacto" :value="__('Telefono Contacto')" />
                            <x-text-input id="telefonoContacto" class="block mt-1 w-full" type="text" name="telefonoContacto" value="{{$prestamo->cliente->telefonoContacto}}" required />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2" field="telefonoContacto" />
                        </td>
                    </tr>
                </table>
                <h3 class="mt-4">DATOS PRESTAMO</h3>
                <table class="mt-6 w-full">
                    <tr>
                        <td class="p-2">
                            <x-input-label for="fecha" :value="__('Fecha Hora de registro')" />
                            <x-text-input id="fecha" class="block mt-1 w-full" type="datetime" name="fecha" value="{{$prestamo->fecha}}" required />
                            <x-input-error :messages="$errors->get('fecha')" class="mt-2" field="fecha" />
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">
                            <x-input-label for="fechavencimiento" :value="__('Fecha de vencimiento')" />
                            <x-text-input id="fechavencimiento" class="block mt-1 w-full" type="date" name="fechavencimiento" value="{{$prestamo->fechavencimiento}}" required />
                            <x-input-error :messages="$errors->get('fechavencimiento')" class="mt-2" field="fechavencimiento" />
                        </td>
                        <td class="p-2">
                            <x-input-label for="monto" :value="__('Monto en soles')" />
                            <div class="relative">
                                <input type="text" id="monto" name="monto"
                                    value="{{$prestamo->monto}}"
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
                    <tr>
                        <td class="p-2">
                            <x-input-label for="frecuencia" :value="__('Frecuencia')" />
                            <select id="frecuencia" name="frecuencia"
                            onchange="calcularTotal()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              <option value="Diario" {{$prestamo->frecuencia=='Diario' ? 'selected="selected"' : ''}}>Diario</option>
                              <option value="Semanal" {{$prestamo->frecuencia=='Semanal' ? 'selected="selected"' : ''}}>Semanal</option>
                              <option value="Quincenal" {{$prestamo->frecuencia=='Quincenal' ? 'selected="selected"' : ''}}>Quincenal</option>
                            </select>
                        </td>
                        <td class="p-2">
                            <x-input-label for="tasa" :value="__('Tasa de interés')" />
                            <div class="relative">
                                <x-text-input id="tasa" class="block mt-1 w-full px-4 pl-9 text-end pr-8" type="text" name="tasa"
                                onchange="calcularTotal()"
                                value="9" placeholder="0.00" required />
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
                                <input type="text" id="total" name="total"
                                    value="{{$prestamo->total}}"
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
                                <input type="text" id="cuota" name="cuota"
                                value="{{$prestamo->cuota}}"
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

                    </tr>
                    <tr>
                        @php
                            if($prestamo->frecuencia=='Diario'){
                                $periodotexto='30 Dias';
                                $periodo=30;
                            }elseif ($prestamo->frecuencia=='Semanal') {
                                $periodotexto='4 Semanas';
                                $periodo=4;
                            }else{
                                $periodotexto='2 Quincenas';
                                $periodo=2;
                            }
                        @endphp
                        <td class="p-2">
                            <x-input-label for="cuota" :value="__('Periodo')" />
                            <input type="hidden" name="periodo" id="periodo" value="{{$periodo}}">
                            <blockquote class="text-xl italic font-semibold text-gray-900 dark:text-white">
                                <p id="periodotxt">{{$periodotexto}}</p>
                            </blockquote>
                        </td>
                        <td class="p-2">
                            <x-input-label for="cuota" :value="__('Estado')" />
                            <select name="estado" id="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="ACTIVO" {{$prestamo->estado==1 ? 'selected' : '' }}>ACTIVO</option>
                                <option value="INACTIVO" {{$prestamo->estado==0 ? 'selected' : '' }}>INACTIVO</option>
                            </select>
                        </td>
                        <td class="p-2" colspan="3">
                            <x-input-label for="zona" :value="__('Zona')" />
                            <x-text-input id="zona" class="block mt-1 w-full" type="text" name="zona" value="{{$prestamo->zona}}" required />
                            <x-input-error :messages="$errors->get('zona')" class="mt-2" field="zona" />
                        </td>
                    </tr>
                </table>
                <div class="mt-4">
                    <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                </div>
            </form>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="cerrarModal()">
            Cerrar
          </button>
        </div>
      </div>
    </div>
</div>
