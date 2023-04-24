@php
    $total = 0;
@endphp
<div id="tablareporte" class="relative overflow-x-auto mt-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Id Prestamo</th>
                <th scope="col" class="px-6 py-3">USUARIO</th>
                <th scope="col" >Fecha</th>
                <th scope="col">Cliente</th>
                <th scope="col" class="px-6 py-3">Monto</th>
                <th scope="col" class="px-6 py-3">Saldo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pagos as $pago )
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row" class="px-6 py-4">{{$pago->prestamo->id}}</td>
                <td scope="row" class="px-6 py-4">{{$pago->usuario->name}}</td>
                <td scope="row" class="px-6 py-4">{{$pago->fecha}}</td>
                <td scope="row" class="px-6 py-4">{{$pago->prestamo->cliente->apellidos.', '.$pago->prestamo->cliente->nombres}}</td>
                <td scope="row" class="px-6 py-4">{{$pago->monto }}
                @php
                    $total+=$pago->monto
                @endphp</td>
                <td scope="row" class="px-6 py-4">{{$pago->prestamo->saldo}}</td>
                <td scope="row" class="flex items-center px-6 py-4 space-x-3 px-6 py-4">
                    <form class="inline-block" action="{{ route('pagos.destroy', $pago->id) }}" method="POST" onsubmit="return confirm('{{ __('¿Estás seguro de que deseas eliminar este préstamo?') }}')">
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
{{ $pagos->links() }}
</div>
<h3>RESUMEN TOTAL PAGOS EN EL DIA : S/.{{number_format($total,2)}}</h3>
<br>
    <button
    class="text-white text-xs bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-full text-sm px-3 py-2 mr-1 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
    id="btnexportarexcel" title="Exportar a Excel" type="button" onclick="exportTableToExcel('tablareporte', 'REPORTE PAGOS')"><i class="fas fa-file-excel"></i>Generar Archivo Excel</button>
