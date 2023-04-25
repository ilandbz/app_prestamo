<x-input-label for="id_supervisor" :value="__('Supervisor')" />
<select id="id_supervisor" name="id_supervisor"
readonly
class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
@foreach ($usuarios as $row)
    <option value="{{$row->id}}">{{$row->name}}</option>
@endforeach
</select>
