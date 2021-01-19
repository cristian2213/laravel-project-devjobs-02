@extends('layouts.app')

@section('styles')
    {{--Medium editor --}}
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/css/medium-editor.min.css" type="text/css"
        media="screen" charset="utf-8">

    {{-- Dropzone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css"
        integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA=="
        crossorigin="anonymous" />

@endsection

@section('navegacion')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Nueve Vacante</h1>

    <form action="{{ route('vacantes.store') }}" method="POST" class="max-w-lg mx-auto my-10">
        @csrf
        <div class="mb-5">
            <label for="titulo" class="block text-gray-700 text-sm mb-2">Titulo Vacante</label>

            <input type="text" name="titulo" class="p-2 bg-white rounded form-input w-full" id="titulo"
                placeholder="Web developer" value="{{ old('titulo') }}">

            @error('titulo')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative mt-3 text-sm">
                    <strong class="font-bold">Error!</strong>
                    <p class="block">{{ $message }}</p>
                </div>
            @enderror
        </div>

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
            <label for="experiencia" class="block text-gray-700 text-sm mb-2">Experiencia Vacante</label>

            <select name="experiencia" id="experiencia"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded focus:border-gray-500 p-3 bg-gray-100">

                <option disabled selected>- Selecciona -</option>
                @foreach ($experiencias as $experiencia)
                    <option {{ old('experiencia') == $experiencia->id ? 'selected' : '' }} value="{{ $experiencia->id }}"
                        class="text-sm text-gray-500">
                        {{ $experiencia->nombre }}
                    </option>
                @endforeach
            </select>

            @error('experiencia')
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

        <div class="mb-5">
            <label for="salario" class="block text-gray-700 text-sm mb-2">Salario Vacante</label>

            <select name="salario" id="salario"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded focus:border-gray-500 p-3 bg-gray-100">

                <option disabled selected>- Selecciona -</option>
                @foreach ($salarios as $salario)
                    <option {{ old('salario') == $salario->id ? 'selected' : '' }} value="{{ $salario->id }}"
                        class="text-sm text-gray-500">
                        {{ $salario->nombre }}
                    </option>
                @endforeach
            </select>

            @error('salario')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative mt-3 text-sm">
                    <strong class="font-bold">Error!</strong>
                    <p class="block">{{ $message }}</p>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="descripcion" class="block text-gray-700 text-sm mb-2">Descripcion de la Vacante</label>

            <div name="editable"
                class="editable p-3 bg-gray-100 rounded form-input w-full text-gray-700 @error('descripcion') border border-red-400  @enderror ">
            </div>

            <input type="hidden" name="descripcion" id="descripcion" value="{{ old('descripcion') }}">

            @error('descripcion')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative mt-3 text-sm">
                    <strong class="font-bold">Error!</strong>
                    <p class="block">{{ $message }}</p>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="imagen" class="block text-gray-700 text-sm mb-2">Imagen de la Vacante</label>

            <div id="dropzoneDevJobs" class="dropzone rounded bg-gray-100"></div>

            {{-- input hidden para guardar el nombre de la imagen que se genero en la db
            --}}
            <input type="hidden" name="imagen" id="imagen" value="{{ old('imagen') }}">

            <p id="error"></p>


            @error('imagen')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative mt-3 text-sm">
                    <strong class="font-bold">Error!</strong>
                    <p class="block">{{ $message }}</p>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="skills" class="block text-gray-700 text-sm mb-2">Habilidades y Conocimientos: <span
                    class="text-xs">(Elige al menos 3)</span></label>
            {{-- Componente de vue js --}}

            <lista-skills :lista-skills="{{ $skills }}" old-fields="{{ old('skills') }}"></lista-skills>



            @error('skills')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative mt-3 text-sm">
                    <strong class="font-bold">Error!</strong>
                    <p class="block">{{ $message }}</p>
                </div>
            @enderror
        </div>

        <div>
            <button type="submit"
                class="bg-teal-500 w-full text-gray-100 font-bold p-3 hover:bg-teal-600 focus:outline focus:shadow-outline">Publicar
                Vacante</button>
        </div>
    </form>
@endsection

@section('scripts')
    {{--Medium editor --}}
    <script src="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/js/medium-editor.min.js" defer></script>

    {{-- Dropzone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"
        integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg=="
        crossorigin="anonymous"></script>

    <script>
        // Eliminar error de dropzone en consola
        Dropzone.autoDiscover = false;

        // Configuracion del editor
        document.addEventListener('DOMContentLoaded', () => {
            const editor = new MediumEditor('.editable', {
                toolbar: {
                    buttons: ['bold', 'italic', 'underline', 'quote', 'anchor', 'justifyLeft',
                        'justifyCenter',
                        'justifyRight', 'justifyFull', 'orderedlist', 'unorderedlist', 'h2', 'h3'
                    ],
                    static: true,
                    sticky: true
                },
                placeholder: {
                    text: 'Informacion de la Vacante'
                }
            });

            // se optiene en tiempo real en contenido del editor a traves del evento 
            editor.subscribe('editableInput', function(eventObj, editable) {
                const contenido = editor.getContent();
                // se pasa el contenido al input
                document.getElementById('descripcion').value = contenido;
            });

            //llena el editor con el contenido del input gidden 
            editor.setContent(document.getElementById('descripcion').value);

            // Dropzone
            const csrf_token = document.querySelector('meta[name=csrf-token]').content;

            var dropzoneDevJobs = new Dropzone("#dropzoneDevJobs", {
                url: "/vacantes/imagen",
                /* ruta a la cual se va a enviar la imagen */
                dictDefaultMessage: 'Sube tu Imagen',
                acceptedFiles: '.png,.jpg,.jpeg,.gif,.bmp',
                addRemoveLinks: true,
                dictRemoveFile: 'Borrar archivo',
                maxFiles: 1,
                headers: {
                    'X-CSRF_TOKEN': csrf_token
                },
                init: function() {
                    // si la validacion falla, mostrar otra vez la imagen
                    if (document.querySelector('#imagen').value.trim()) {
                        let imagenPublicada = {};
                        imagenPublicada.size = 2000;
                        imagenPublicada.name = document.getElementById('imagen').value;

                        this.options.addedfile.call(this, imagenPublicada);
                        this.options.thumbnail.call(this, imagenPublicada,
                            `/storage/vacantes/${imagenPublicada.name}`);

                        imagenPublicada.previewElement.classList.add('dz-sucess');
                        imagenPublicada.previewElement.classList.add('dz-complete');

                    }
                },
                // eventos de dropzone
                success: function(file, response) {
                    //console.log(file)
                    //console.log(response['correcto'])
                    // pasando la ruta de la imagen generada en el servidor al input oculto
                    const inputImg = document.getElementById('imagen');
                    inputImg.value = response['correcto'];

                    // Eliminar mensaje de error
                    document.getElementById('error').textContent = '';


                    // Añadir al objeto de archivo el nombre del servidor
                    file.nombreImagenServidor = response['correcto'];

                    console.log(response)
                },

                // error: function(file, response) {
                //     console.log(file);
                //     console.log(response);
                //     document.getElementById('error').textContent = 'Formato no valido';
                // },

                maxfilesexceeded: function(file) {
                    if (this.files[1] != null) {
                        this.removeFile(this.files[0]); // elimina la posicion anterior
                        // agregar new file
                        this.addFile(file)
                    }
                },

                removedfile: async function(file, response) {
                    //console.log(file.nombreImagenServidor);
                    // request to delete image
                    // console.log(file)
                    file.previewElement.parentNode.removeChild(file.previewElement);

                    params = {
                        imagen: file.nombreImagenServidor ?? document.getElementById('imagen').value
                    }

                    const respuesta = await axios.post('/vacantes/borrarimagen', params);
                    console.log(respuesta.data)

                }

            });
        });

    </script>
@endsection
