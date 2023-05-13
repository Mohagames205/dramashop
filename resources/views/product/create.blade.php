<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product aanmaken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 ">

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Nieuw product') }}
                    </h2>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <img src="images/{{ Session::get('image') }}" class="mb-2" style="width:400px;height:200px;">
                    @endif


                    <div class="max-w-xl">
                        <form method="POST" action="{{ route("product.create") }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('Product naam')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="price" :value="__('Prijs')" />
                                <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" required autofocus autocomplete="price" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>


                            <div>
                                <x-input-label for="image" :value="__('Foto')" />
                                <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" required autofocus autocomplete="foto" />
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <div>
                                <x-input-label for="max_amount" :value="__('Maximum aantal')" />
                                <x-text-input id="max_amount" name="max_amount" type="number" class="mt-1 block w-full" required autocomplete="max_amount" />
                                <x-input-error class="mt-2" :messages="$errors->get('max_amount')" />
                            </div>

                            <x-primary-button>{{ __('Aanmaken') }}</x-primary-button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
