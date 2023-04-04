<x-app-layout>
    <div class="p-16">
        <div class="max-w-4xl mx-auto relative" x-data="{
            activeSlide: 1,
            slides: [
                { id: 1, title: 'Bienvenidos', body: 'Estamos encantados de tenerte entre nosotros. ¡En nombre de todos los miembros y de la dirección, nos gustaría extender nuestra más cálida bienvenida y buenos deseos! ¡Bienvenido al equipo! Estamos encantados de tenerle en nuestra oficina.' },
                { id: 2, title: 'Servicios computacionales', body: 'Un servicio de tecnologías de la información es un conjunto de actividades que buscan responder a las necesidades de un cliente por medio de un cambio de condición en los bienes informáticos (llámese activos), potenciando el valor de estos y reduciendo el riesgo inherente del sistema.' },
                { id: 3, title: 'Laboratorios de cómputo', body: 'El laboratorio de informática es un instrumento muy completo para el entrenamiento de la comprensión de programas de informática, tales como Excel, Word, Photoshop, Illustrator, AutoCAD, HTML5, etc. Son espacios para estudiar, experimentar y aprender el funcionamiento de programas de informática y practicar su uso.' },
            ],
            loop(){
                setInterval(() => {this.activeSlide = this.activeSlide === 3 ? 1 : this.activeSlide + 1}, 2000)
            }
        }"
        x-init="loop">
            <template x-for="slide in slides" :key="slide.id">
                <div x-show="activeSlide === slide.id"
                    class="p-24 h-80 flex items-center bg-slate-500 text-white rounded-lg">
                    <div>
                        <h2 class="font-bold text-2xl" x-text="slide.title"></h2>
                        <p x-text="slide.body" class="text-base">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis distinctio explicabo ea nesciunt nihil amet praesentium illum possimus nostrum animi! Sequi accusantium at consectetur vel ducimus est perferendis cumque ad?
                        </p>
                    </div>
                </div>
            </template>
            <div class="absolute inset-0 flex">
                <div class="flex items-center justify-start w-1/2">
                    <button
                        x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1"
                        class="bg-slate-100 text-slate-500 font-bold rounded-full w-12 h-12 shadow flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center justify-end w-1/2">
                    <button
                        x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1"
                        class="bg-slate-100 text-slate-500 font-bold rounded-full w-12 h-12 shadow flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="absolute w-full flex items-center justify-center px-4">
                <template x-for="slide in slides" :key="slide.id">
                    <button class="flex-1 w-3 h-2 mt-4 mx-1 mb-2 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-slate-600 hover:shadow-lg"
                    :class="{
                        'bg-blue-600' : activeSlide === slide.id,
                        'bg-blue-300' : activeSlide !== slide.id,
                    }"
                    x-on:click="activeSlide = slide.id">
                    </button>
                </template>
            </div>
        </div>
    </div>
</x-app-layout>
