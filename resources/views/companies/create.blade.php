<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('companies.store') }}" method="POST">
                        @csrf

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">NIT</label>
                        <span class="text-xs text-red-600">@error('nit') {{ $message }} @enderror </span>
                        <input type="text" name="nit" class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700">

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">Nombre</label>
                        <span class="text-xs text-red-600">@error('name') {{ $message }} @enderror </span>
                        <input type="text" name="name" class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700">

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">Dirección</label>
                        <span class="text-xs text-red-600">@error('address') {{ $message }} @enderror </span>
                        <input type="text" name="address" class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700">

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">Teléfono</label>
                        <span class="text-xs text-red-600">@error('phone') {{ $message }} @enderror </span>
                        <input type="text" name="phone" class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700">

                        <div class="flex justify-between items-center">
                            <a href="{{ route('companies.index') }}" class="bg-gray-800 text-white rounded px-4 py-2 text-sm text-gray-700">Volver</a>
                            <input type="submit" value="Enviar" class="bg-gray-800 text-white rounded px-4 py-2 text-sm text-gray-700">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>