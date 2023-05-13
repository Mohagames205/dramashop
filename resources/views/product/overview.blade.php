<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Overzicht') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-5">

                    <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                        Creëer product
                    </h2>
                    <x-secondary-button
                        x-data=""
                        x-on:click="location.href='/product/create'"
                    >
                        Product aanmaken
                    </x-secondary-button>

                    <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                        Bestaande producten
                    </h2>

                    <div class="flex flex-wrap justify-around gap-10">
                        @forelse(\App\Models\Product::all() as $product)

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center bg-blue-400 rounded-tr rounded-tl"> {{ $product->name }} </h3>

                                <img width="300px" height="auto" src="products/{{ $product->image }}" >
                                <a href="/product/{{ $product->id }}"><button class="bg-orange-400 w-full text-center rounded-b p-2 hover:cursor-pointer">Bewerken</button></a>
                            </div>
                        @empty

                            <p> Er zijn geen producten om weer te geven... <i> *krekelgeluidjes* </i> </p>
                        @endforelse

                    </div>






                </div>
            </div>
        </div>
    </div>
</x-app-layout>
