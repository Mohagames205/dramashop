
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Aanvraag #{{ $request->id }}
                </h2>
            </div>
        </header>
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="space-y-5">
                            <ol class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4">
                                <li class="flex items-center @if($request->status >= 0) text-blue-600 dark:text-blue-500 @endif">
                                <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border @if($request->status >= 0)  border-blue-600 dark:border-blue-500 @else border-gray-500 dark:border-gray-400 @endif rounded-full shrink-0 ">
                                    1
                                </span>
                                    Reservatie geplaatst
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                </li>
                                <li class="flex items-center @if($request->status >= 1) text-blue-600 dark:text-blue-500 @endif">
                                <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border @if($request->status >= 1)  border-blue-600 dark:border-blue-500 @else border-gray-500 dark:border-gray-400 @endif  rounded-full shrink-0">
                                    2
                                </span>
                                    In behandeling
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                </li>
                                <li class="flex items-center @if($request->status >= 2) text-blue-600 dark:text-blue-500 @endif">
                                <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border @if($request->status >= 2)  border-blue-600 dark:border-blue-500 @else border-gray-500 dark:border-gray-400 @endif  rounded-full shrink-0">
                                    3
                                </span>
                                    Verzonden
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 sm:ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                </li>
                                <li class="flex items-center @if($request->status >= 3) text-blue-600 dark:text-blue-500 @endif">
                                <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border @if($request->status >= 3)  border-blue-600 dark:border-blue-500 @else border-gray-500 dark:border-gray-400 @endif  rounded-full shrink-0">
                                    4
                                </span>
                                    Ontvangen
                                </li>

                            </ol>

                            <x-modal name="confirm-product-deletion" :show="$errors->productDeletion->isNotEmpty()" focusable>
                                <form method="post" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Ben je zeker dat je deze aanvraag wilt verwijderen?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Een aanvraag verwijderen kan ernstige gevolgen hebben! Je zal de persoon zelf moeten inlichten over de annulatie van de aanvraag.') }}
                                    </p>


                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Annuleren') }}
                                        </x-secondary-button>

                                        <x-danger-button class="ml-3">
                                            {{ __('Verwijder aanvraag') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>

                            @if (session('status') === 'request-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >{{ __('Opgeslagen.') }}</p>
                            @endif

                            <div class="grid sm:grid-cols-none md:grid-cols-5 md:grid-rows-2 sm:grid-rows-none gap-10">


                                <div class="md:col-span-3">
                                    <div class="p-4">
                                        <h2 class="text-xl">Details</h2>
                                        <p class="mb-5 text-gray-400 tracking-tight">U kan de details op dit moment niet aanpassen.</p>
                                        <div class="md:flex flex-wrap justify-between mt-3 gap-4">
                                            <div class="basis-5/12 mt-4">
                                                <x-input-label for="name" value="Naam" />
                                                <x-text-input id="name" name="name" type="text" value="{{ $request->name }}" class="block w-full cursor-not-allowed" readonly />
                                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                            </div>

                                            <div class="basis-6/12 mt-4">
                                                <x-input-label for="email" value="E-mail"/>
                                                <x-text-input id="email" name="email" type="email" value="{{ $request->email }}" class="block w-full cursor-not-allowed" readonly />
                                            </div>

                                            <div class="basis-8/12 mt-4">
                                                <x-input-label for="adress" value="Adres"/>
                                                <x-text-input id="adress" name="adress" type="text" value="{{ $request->address }}" class="block w-full cursor-not-allowed" readonly />
                                            </div>

                                            <div class="basis-1/5 mt-4">
                                                <x-input-label for="postal" value="Postcode"/>
                                                <x-text-input id="postal" name="postal" type="number" value="{{ $request->postal }}" class="block w-full cursor-not-allowed" readonly />
                                            </div>

                                            <div class="basis-full mt-4">
                                                <x-input-label for="notes" value="Opmerkingen"/>
                                                <x-text-input id="notes" name="adress" type="text" value="{{ $request->notes }}" class="block w-full cursor-not-allowed" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="md:col-span-2">
                                    <div class="p-6 flex justify-center">
                                        <div class="flex flex-col items-center">
                                            <img src="/products/{{ $request->product->image }}" class="w-3/4 text-center rounded-lg border border-gray-700 shadow"><br>
                                        </div>
                                    </div>
                                </div>



                                <div class="md:col-span-3 md:row-span-1">
                                    <div class="button-container px-8 tracking-tight">
                                        <div class="p-10 border border-gray-700 rounded-lg shadow space-y-5">

                                            <div>
                                                <h2 class="text-xl">Contact</h2>
                                                <p class="text-gray-400">Vragen? Opmerkingen? Aarzel dan niet om contact op te nemen.</p>

                                                <x-input-label for="contact-mail" class="mt-2">E-mail</x-input-label>
                                                <x-text-input id="contact-mail" name="contact-mail" type="email" value="affie.decooman@gmail.com" class="block w-full cursor-not-allowed" readonly/>

                                            </div>

                                            <div class="mt-6 pt-6 border-t border-gray-700">
                                                <h2 class="text-xl">Gevarenzone</h2>
                                                <p class="text-gray-400">Kleine knop, grote gevolgen.</p>
                                                @if($request->status  == 0)
                                                    <x-danger-button
                                                        x-data=""
                                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion')"
                                                        class="mt-6"
                                                    >Aanvraag annuleren</x-danger-button>
                                                @else
                                                    <p> Je kan je aanvraag niet meer annuleren. Neem contact op indien je dit toch zou wensen. </p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <div class="details-container px-8 tracking-tight">
                                        <div class="details p-10 border border-gray-700 rounded-lg shadow space-y-2">

                                            <div class="border-b border-gray-700 pb-3">
                                                <p class="text-gray-300 text-sm">Productnaam</p>
                                                <p class="text-lg"> {{$request->product->name }}</p>
                                            </div>

                                            <div class="border-b border-gray-700 pb-3">
                                                <p class="text-gray-300 text-sm">Prijs</p>
                                                <p class="text-lg">€{{ $request->product->price }}</p>
                                            </div>
                                            <div class="pb-3">
                                                <p class="text-gray-300 text-sm">Maat</p>
                                                <p class="text-lg">{{ $request->size }}</p>
                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>





