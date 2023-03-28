<div {{-- wire:init="loadArticles" --}}>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b class="font-extrabold">Objetos</b> <b class="font-thin">encontrados</b>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {{-- Boton nuevo --}}
        <div class="overflow-hidden rounded-lg m-4 items-center">
            <div class="flex items-center">
                <span>Mostrar</span>
                <select wire:model="cant" class="form-control mx-2">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>entradas.</span>
                <div class="ml-auto">
                    @livewire('create-article')
                </div>

            </div>
        </div>
        {{-- Boton nuevo / --}}

        {{-- Buscar --}}
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-4">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input wire:model="search" type="search" id="default-search"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Buscar..." required>
            </div>
        </div>
        {{-- Buscar / --}}

        <!-- Tabla listado -->
        <x-table>
            @if (count($articles))
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                    <thead class="bg-gray-50">
                        <tr>
                            <th wire:click="order('id')" scope="col"
                                class="w-24 px-6 py-4 font-medium text-gray-900 cursor-pointer">ID
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th wire:click="order('name')" scope="col"
                                class="px-6 py-4 font-medium text-gray-900 cursor-pointer"><b>Nombre</b>
                                @if ($sort == 'name')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th wire:click="order('description')" scope="col"
                                class="px-6 py-4 font-medium text-gray-900 cursor-pointer"><b>Descripción</b>
                                @if ($sort == 'description')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Fecha</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Registrador</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Estado</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        @foreach ($articles as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $item->id }}</td>
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                    <div class="relative h-10 w-10">
                                        <img wire:click="show({{ $item }})"
                                            class="h-full w-full rounded-full object-cover object-center cursor-pointer"
                                            src="{{ Storage::url($item->image) }}" alt="" />
                                        <span
                                            class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                                    </div>
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ $item->name }}</div>
                                        <div class="text-gray-400">{{ $item->laboratory->name }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">{{ $item->description }}</td>
                                <td class="px-6 py-4">{{ $item->created_at->formatLocalized('%A %d %B %Y') }}</td>
                                <td class="px-6 py-4">{{ $item->user->name }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        @if ($item->status == 1)
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-600">
                                                <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                                Entregar
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                                <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                                Entregado
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-4">
                                        <a wire:click="$emit('deleteArticle', {{ $item->id }})"
                                            x-data="{ tooltip: 'Delete' }" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6"
                                                x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </a>
                                        <a wire:click="edit({{ $item }})" x-data="{ tooltip: 'Edite' }"
                                            href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="h-6 w-6" x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>
                                        <a wire:click="state({{ $item }})" href="#">
                                            <div class="text-cyan-600 mt-1">
                                                <i class="fa-solid fa-right-left"></i>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($articles->hasPages())
                    <div class="px-6 py-4">
                        {{ $articles->links() }}
                    </div>
                @endif
            @else
                <div class="px-6 py-4 bg-white text-center">
                    <b>------ NO </b>existe ningún registro coincidente ------
                </div>
            @endif
        </x-table>
        <!-- Tabla listado /-->
    </div>

    {{-- Modal Editar --}}
    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Editar objeto</h3>
            <button wire:click="$set('open_edit', false)" type="button"
                class="absolute top-3 right-6 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-hide="authentication-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <hr class="mt-4">
        </x-slot>

        <x-slot name="content">
            <div wire:loading wire:target="image" class="bg-white text-center py-4 lg:px-4 mb-3 w-full">
                <div class="p-2 bg-red-100 items-center leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert">
                    <span
                        class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3 text-white">Cargando
                        ...</span>
                    <span class="font-normal mr-2 text-left flex-auto text-gray-500 text-sm">Espere un momento hasta
                        que la imagen se haya cargado!</span>
                    <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
                    </svg>
                </div>
            </div>
            @if ($image)
                <div class="img-container mb-4">
                    <img src="{{ $image->temporaryUrl() }}">
                </div>
            @else
                <img src="{{ Storage::url($article->image) }}" alt="">
            @endif
            <div class="mb-4">
                <x-jet-label value="Nombre del objeto" />
                <x-jet-input wire:model="article.name" type="text" class="w-full" placeholder="Nombre" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Descripción del objeto" />
                <textarea wire:model="article.description" rows="6" class="form-control w-full"
                    placeholder="Escriba una descripción"></textarea>
            </div>
            <div class="mb-4">
                <x-jet-label value="Laboratorio encontrado" />
                <select wire:model="article.laboratory_id" class="form-control w-full">
                    <option value="">Seleccione un laboratorio</option>
                    @foreach ($laboratories as $laboratory)
                        <option value="{{ $laboratory->id }}"
                            {{ old('laboratory->id') == 'laboratory->id' ? 'selected' : '' }}>{{ $laboratory->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <x-jet-label value="Seleccione una imagen" />
                <input type="file" wire:model="image" id="{{ $identificador }}">
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit', false)" class="mr-2">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{-- Modal Editar / --}}

    {{-- Modal ver imagen --}}
    <x-jet-modal wire:model="open_image">
        <div class="img-container">
            <div class="m-2">
                <img src="{{ Storage::url($article->image) }}" class="max-w-full h-auto rounded-full"
                    alt="">
            </div>
        </div>
    </x-jet-modal>
    {{-- Modal ver imagen / --}}

    {{-- Modal cambiar estado --}}
    <x-jet-dialog-modal wire:model="open_state">
        <x-slot name="title">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Estado</h3>
            <button wire:click="$set('open_state', false)" type="button"
                class="absolute top-3 right-6 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-hide="authentication-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <hr class="mt-4">
        </x-slot>
        <x-slot name="content">
            <x-jet-label value="Cambiar estado" />
            <div class="flex items-center mb-4 mt-2">
                <input wire:model="article.status" id="default-radio-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"">
                <label for="default-radio-1" class="mr-5 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Entregar
                </label>
                <i class="fa-solid fa-arrow-right mr-2"></i>
                <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-red-600 dark:text-white">
                        Por entregar
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Marque esta <b>opción</b> cuando aún el objeto no ha sido entregado a su propietario.</p>
                </div>
            </div>
            <div class="flex items-center">
                <input wire:model="article.status" id="default-radio-2" type="radio" value="2" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-radio-2" class="mr-2 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Entregado
                </label>
                <i class="fa-solid fa-arrow-right mr-2"></i>
                <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-green-600 dark:text-white">
                        Entregado
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Marque esta <b>opción</b> cuando el objeto ha sido entregado a su propietario.</p>
                    <hr class="mt-2">
                    <p class="text-xs text-red-600"><b>OJO: </b>Llenar el campo nombre propietario.</p>
                </div>
            </div>
            <x-jet-label value="Nombre propietario" class="mt-4" />
            <x-jet-input wire:model="article.owner" type="text" class="w-full uppercase" placeholder="Nombre - DNI" />
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_state', false)" class="mr-2">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                Cambiar estado
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{-- Modal cambiar estado / --}}
    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('deleteArticle', articleId => {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podrás revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('list-articles', 'delete', articleId)
                        Swal.fire(
                            'Eliminado!',
                            'Su archivo ha sido eliminado.',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush
</div>
