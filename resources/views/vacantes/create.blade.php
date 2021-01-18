@extends('layouts.app')

@section('navegacion')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Nueve Vacante</h1>

    <form action="#" class="max-w-lg mx-auto my-10">
        <div class="mb-5">
            <label for="titulo" class="block text-gray-700 text-sm mb-2">Titulo Vacante</label>
            <input type="text" name="titulo" class="p-2 bg-white rounded form-input w-full" id="titulo"
                placeholder="Web developer">
        </div>

        <div class="mb-5">
            <label for="categoria" class="block text-gray-700 text-sm mb-2">Categorias Vacante</label>

            <select name="categoria" id="categoria"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded focus:border-gray-500 p-3 bg-gray-100">

                <option disabled selected>- Selecciona -</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" class="text-sm text-gray-500">
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label for="experiencia" class="block text-gray-700 text-sm mb-2">Experiencia Vacante</label>

            <select name="experiencia" id="experiencia"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded focus:border-gray-500 p-3 bg-gray-100">

                <option disabled selected>- Selecciona -</option>
                @foreach ($experiencias as $experiencia)
                    <option value="{{ $experiencia->id }}" class="text-sm text-gray-500">
                        {{ $experiencia->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label for="ubicacion" class="block text-gray-700 text-sm mb-2">Ubicacion Vacante</label>

            <select name="ubicacion" id="ubicacion"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded focus:border-gray-500 p-3 bg-gray-100">

                <option disabled selected>- Selecciona -</option>
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}" class="text-sm text-gray-500">
                        {{ $ubicacion->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label for="salario" class="block text-gray-700 text-sm mb-2">Salario Vacante</label>

            <select name="salario" id="salario"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded focus:border-gray-500 p-3 bg-gray-100">

                <option disabled selected>- Selecciona -</option>
                @foreach ($salarios as $salario)
                    <option value="{{ $salario->id }}" class="text-sm text-gray-500">
                        {{ $salario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit"
                class="bg-teal-500 w-full text-gray-100 font-bold p-3 hover:bg-teal-600 focus:outline focus:shadow-outline">Publicar
                Vacante</button>
        </div>
    </form>
@endsection
