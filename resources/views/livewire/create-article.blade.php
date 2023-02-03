<div>
    <x-jet-button wire:click="$set('open', true)">
        Registrar
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Nuevo objeto</h3>
            <button wire:click="$set('open', false)" type="button"
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
                    <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3 text-white">Cargando ...</span>
                    <span class="font-normal mr-2 text-left flex-auto text-gray-500 text-sm">Espere un momento hasta que la imagen se haya cargado!</span>
                    <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
                    </svg>
                </div>
            </div>
            @if ($image)
                <div class="img-container mb-4">
                    <img src="{{ $image->temporaryUrl() }}">
                </div>
            @endif
            <div class="mb-4">
                <x-jet-label value="Nombre del objeto" />
                <x-jet-input wire:model.defer="name" type="text" class="w-full" placeholder="Nombre" />
                @error('name')
                    <span class="text-red-500 text-sm">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-4">
                <x-jet-label value="Descripción del objeto" />
                <textarea wire:model.defer="description" class="form-control w-full" rows="6"
                    placeholder="Escriba una descripción"></textarea>
                @error('description')
                    <span class="text-red-500 text-sm">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div wire:ingnore class="mb-4">
                <x-jet-label value="Laboratorio encontrado" />
                <select wire:model.defer="laboratory_id" class="form-control w-full">
                    <option value="">Seleccione un laboratorio</option>
                    @foreach ($laboratories as $laboratory)
                        <option value="{{ $laboratory->id }}">{{ $laboratory->name }}</option>
                    @endforeach
                </select>
                @error('laboratory_id')
                    <span class="text-red-500 text-sm">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-4">
                <x-jet-label value="Seleccione una imagen" />
                <input wire:model="image" type="file" id="{{ $identificador }}">
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)" class="mr-2">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-25">
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
{{-- Video 7 --}}
