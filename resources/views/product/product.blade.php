<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-5">


                    <form method="POST" action="" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div>
                            <x-input-label for="name" :value="__('Product naam')" />
                            <x-text-input id="name" name="name" type="text" value="{{ $product->name }}" class="mt-1 block w-full" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Prijs')" />
                            <x-text-input id="price" name="price" type="number" step="0.01"  value="{{ $product->price }}" class="mt-1 block w-full" required autofocus autocomplete="price" />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <div>
                            <x-input-label for="orders_placed" value="Aantal geplaatste bestellingen"/>
                            <x-text-input id="orders_placed" name="orders_placed" type="text" value="{{ $product->orders_placed }}" class="mt-1 block w-full cursor-not-allowed" readonly />
                        </div>

                        <div>
                            <x-input-label for="max_amount" :value="__('Maximum aantal')" />
                            <x-text-input id="max_amount" name="max_amount" type="number" class="mt-1 block w-full" value="{{ $product->max_amount }}" required autocomplete="max_amount" />
                            <x-input-error class="mt-2" :messages="$errors->get('max_amount')" />
                        </div>


                        <div>
                            <x-input-label for="is_available" :value="__('Beschikbaar?')" />
                            <label class="switch">
                                <input type="checkbox" id="is_available" name="is_available" value="1" @if($product->is_available) checked @endif>
                                <span class="slider round"></span>
                            </label>
                            <x-input-error class="mt-2" :messages="$errors->get('is_available')" />
                        </div>



                        @if (session('status') === 'product-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                        @endif

                        <div class="mt-6 flex justify-end space-x-3">
                            <x-primary-button>{{ __('Bewerken') }}</x-primary-button>

                            <x-danger-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion')"
                            >
                                Verwijder
                            </x-danger-button>
                        </div>

                    </form>

                    <x-modal name="confirm-product-deletion" :show="$errors->productDeletion->isNotEmpty()" focusable>
                        <form method="post" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Ben je zeker dat je dit product wilt verwijderen?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Een product verwijderen kan ernstige gevolgen hebben! Elke aanvraag die gelinked is aan dit product zal automatisch ook verwijderd worden.') }}
                            </p>


                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Annuleren') }}
                                </x-secondary-button>

                                <x-danger-button class="ml-3">
                                    {{ __('Verwijder product') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

