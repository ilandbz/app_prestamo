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
        <div class="w-full w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form method="POST" action="{{ route('pagos.store') }}" class="space-y-6">
                @csrf
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">CLIENTE : {{$prestamo->cliente->apellidos.', '.$prestamo->cliente->nombres}}</h5>
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">ID PRESTAMO : {{$prestamo->id}}</h5>
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">SALDO : S/.{{$prestamo->saldo}}</h5>
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <input type="hidden" name="id_prestamo" id="id_prestamo" value="{{$prestamo->id}}">
                        <input type="hidden" name="fecha" id="fecha" value="{{date('Y-m-d H:i:s')}}">
                        <label for="nrocuotas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nro de Cuotas</label>
                        <input type="number" min="1" max="30" value="1" onchange="calcularmontopagar(this)" id="nrocuotas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                    </div>
                    <div class="...">
                        <x-input-label for="cuota" :value="__('Cuota')" />
                        <div class="relative">
                            <input type="text" id="cuota" name="cuota" value="{{$prestamo->cuota}}"
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
                        <x-input-error :messages="$errors->get('cuota')" class="mt-2" field="cuota" />
                    </div>
                    <div class="...">
                        <x-input-label for="monto" :value="__('Monto')" />
                        <div class="relative">
                            <input type="text" id="monto" name="monto" value="{{$prestamo->cuota}}"
                            class="py-3 px-4 pl-9 pr-16 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                            placeholder="0.00">
                            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none z-20 pl-4">
                                <span class="text-gray-500">S/.</span>
                            </div>
                            <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none z-20 pr-4">
                                <span class="text-gray-500">Soles</span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('monto')" class="mt-2" field="monto" />
                    </div>
                </div>
                    <div>
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Realizar Pago</button>
                    </div>
            </form>
        </div>

</div>
