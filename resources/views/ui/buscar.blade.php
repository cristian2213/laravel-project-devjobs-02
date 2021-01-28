<h2 class="my-10 text-2xl text-gray-700">
    Buscar una Vacante
</h2>

<form action="{{ route('vacantes.buscar') }}" method="POST">
    @csrf
    <div class="mb-5">
        <label for="categoria" class="block text-gray-700 text-sm mb-2">Categorias Vacante</label>

        <select name="categoria" id="categoria"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded focus:border-gray-500 p-3 bg-gray-100">

            <option disabled selected>- Selecciona -</option>
            @foreach ($categorias as $categoria)
                <option {{ old('categoria') == $categoria->id ? 'selected' : '' }} value="{{ $categoria->id }}"
                    class="text-sm text-gray-500">
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>


        @error('categoria')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative mt-3 text-sm">
                <strong class="font-bold">Error!</strong>
                <p class="block">{{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="mb-5">
        <label for="ubicacion" class="block text-gray-700 text-sm mb-2">Ubicacion Vacante</label>

        <select name="ubicacion" id="ubicacion"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded focus:border-gray-500 p-3 bg-gray-100">

            <option disabled selected>- Selecciona -</option>
            @foreach ($ubicaciones as $ubicacion)
                <option {{ old('ubicacion') == $ubicacion->id ? 'selected' : '' }} value="{{ $ubicacion->id }}"
                    class="text-sm text-gray-500">
                    {{ $ubicacion->nombre }}
                </option>
            @endforeach
        </select>

        @error('ubicacion')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative mt-3 text-sm">
                <strong class="font-bold">Error!</strong>
                <p class="block">{{ $message }}</p>
            </div>
        @enderror
    </div>

    <button type="submit"
        class="bg-teal-500 w-full hover:bg-teal-600 font-bold p-3 focus:outline-none focus:shadow-outline uppercase mt-10 text-gray-100">Buscar
        Vacante</button>
</form>
