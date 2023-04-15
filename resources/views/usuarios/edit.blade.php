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
    <h3>EDITAR USUARIO</h3>
    <br>
    <form method="POST" action="{{ route('usuarios.update', $usuario) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-3 gap-4">
            <div>
                <x-input-label for="dni" :value="__('DNI')" />
                <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni" value="{{$usuario->name}}" required autofocus autocomplete="dni" />
                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$usuario->name}}" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$usuario->email}}" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <!-- Telefono -->
            <div>
                <x-input-label for="telefono" :value="__('Telefono')" />
                <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" value="{{$usuario->telefono}}" required autofocus autocomplete="telefono" />
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
            </div>
            <!-- Direccion -->
            <div class="col-span-2">
                <x-input-label for="direccion" :value="__('Direccion')" />
                <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" value="{{$usuario->direccion}}" required autofocus autocomplete="Direccion" />
                <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="password" :value="__('Nuevo Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="password" :value="__('Imagen')" />
                <div>
                    <div id="tooltip-jese" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Jese Leos
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    <img data-tooltip-target="tooltip-jese" class="w-full rounded" src="{{ asset('storage/profiles/'.$usuario->imagen) }}" alt="Medium avatar">
                </div>
                <input class="mt-2 block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="imagen"
                name="imagen"
                type="file" />
            </div>
            <div>
                <x-input-label for="id_tipo_user" :value="__('Tipo Usuario')" />
                <select id="id_tipo_user" name="id_tipo_user"
                readonly
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" {{$usuario->id_tipo_user == 1 ? 'selected' : ''}}>Administrador</option>
                <option value="2" {{$usuario->id_tipo_user == 2 ? 'selected' : ''}}>Supervisor</option>
                <option value="3" {{$usuario->id_tipo_user == 3 ? 'selected' : ''}}>Gestor</option>
                <option value="4" {{$usuario->id_tipo_user == 4 ? 'selected' : ''}}>Cliente</option>
                </select>
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        <div class="flex items-center justify-left mt-4">
            <x-primary-button class="ml-4">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
</div>
