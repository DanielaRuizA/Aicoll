<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('companies.update', $company) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">Nombre</label>
                        <span class="text-xs text-red-600">@error('name') {{ $message }} @enderror</span>
                        <input type="text" name="name" class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700" value="{{ old('name', $company->name) }}">

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">Dirección</label>
                        <span class="text-xs text-red-600">@error('address') {{ $message }} @enderror</span>
                        <input type="text" name="address" class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700" value="{{ old('address', $company->address) }}">

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase">Teléfono</label>
                        <span class="text-xs text-red-600">@error('phone') {{ $message }} @enderror</span>
                        <input type="text" name="phone" class="rounded border-gray-200 w-full mb-4 text-sm text-gray-700" value="{{ old('phone', $company->phone) }}">

                        <label class="text-base font-semibold leading-7 text-gray-900 uppercase"> Empresa Activa</label>
                        <span class="text-xs text-red-600">@error('status') {{ $message }} @enderror</span>
                        <input type="checkbox" value="{{ $company->status }}" class="peer" {{ $company->status === 'Active' ? 'checked' : '' }} data-id="{{ $company->id }}" onchange="updateStatus(this)">

                        <div class="flex justify-between items-center mt-4">
                            <a href="{{ route('companies.index') }}" class="bg-gray-800 text-white rounded px-4 py-2 text-sm text-gray-700">Volver</a>
                            <input type="submit" value="Enviar" class="bg-gray-800 text-white rounded px-4 py-2 text-sm text-gray-700" onclick="return confirm('¿Desea Editar El Usuario?')">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function updateStatus(checkbox) {
        const status = checkbox.checked ? 'Active' : 'Inactive';
        const company_id = checkbox.dataset.id;
        $.ajax({
            type: "Get",
            url: "{{ route('company.status') }}",
            data: {
                status: status,
                company_id: company_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.success);
            },
            error: function(error) {
                console.error(error.responseText);
            }
        });
    }
</script>