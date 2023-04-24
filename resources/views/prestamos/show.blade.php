<div class="fixed z-10 inset-0 overflow-y-auto" id="miModal">
    <div class="flex items-center justify-center min-h-screen px-4">
      <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
      <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full md:max-w-3xl">
        <div class="bg-gray-50 px-4 py-3 border-b">
          <h3 class="text-lg font-medium text-gray-900">Detalles Prestamo</h3>
        </div>
        <div class="p-4">
            <h3 class="mb-4">CLIENTE : {{$prestamo->cliente->apellidos.', '.$prestamo->cliente->nombres}}</h3>
            <div class="grid grid-cols-4 gap-4">
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <small>Monto : </small><span class="text-2xl font-bold text-gray-900 dark:text-white">S/.{{ number_format($prestamo->monto, 2) }}</span>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Cuota : <span class="text-2xl font-bold text-gray-900 dark:text-white">S/.{{ number_format($prestamo->cuota, 2) }}</span>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Saldo : <span class="text-2xl font-bold text-gray-900 dark:text-white">S/.{{number_format($prestamo->saldo,2)}}</span>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Frecuencia : <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $prestamo->frecuencia }}</span>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Tasa : <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $prestamo->tasa }}%</span>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Cuota : <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $prestamo->cuota }}</span>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Zona : <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $prestamo->zona }}</span>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    Estado :
                    <?php if($prestamo->estado == 1){ ?>
                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Vigente</span>
                    <?php }else{ ?>
                            <span class="bg-pink-100 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">Cancelado</span>
                    <?php } ?>
                </p>
            </div>
            <a href="{{route('pagos.create', $prestamo->id)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Pagar Cuota
                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
            <div class="p-4">
            <h3>DETALLE DE PAGOS</h3>
            <table id="tablareporte" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">NRO</th>
                        <th scope="col" class="px-6 py-3">FECHA</th>
                        <th scope="col" class="px-6 py-3">MONTO</th>
                        <th scope="col" class="px-6 py-3">USUARIO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row"  class="px-6 py-4">{{$loop->iteration}}</td>
                        <td scope="row"  class="px-6 py-4">{{$pago->fecha}}</td>
                        <td scope="row"  class="px-6 py-4">{{$pago->monto}}</td>
                        <td scope="row"  class="px-6 py-4">{{$pago->usuario->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="cerrarModal()">
            Cerrar
          </button>
        </div>
      </div>
    </div>
</div>
