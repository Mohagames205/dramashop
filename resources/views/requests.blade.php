<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Aanvragen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                            Open aanvragen
                        </h2>

                        <div class="flex flex-wrap justify-around mt-5 gap-10">
                            @forelse(\App\Models\Request::all()->sortDesc() as $request)

                                <div class="max-w-xs rounded bg-blue-500">

                                        <div class="text-gray-900 dark:text-gray-100 bg-blue-400 rounded-tr rounded-tl p-4">
                                            <h3 class="text-lg font-medium"> {{ $request->name }} </h3>
                                            <p class="text-gray-200 text-sm"> {{ \Carbon\Carbon::parse($request->created_at)->locale("nl", "eng")->diffForHumans(new DateTime())}}</p>
                                        </div>

                                        <div class="flex justify-center bg-blue-500"  style="height: 350px">
                                            <img width="100%" class="h-full" src="products/{{ $request->product->image }}">
                                        </div>

                                        <div class="p-3 border-b border-blue-400">
                                            <p class="text-gray-200 text-sm"> Status </p>
                                            <p class="text-lg"> {{ \App\Enums\Status::from($request->status)->readable() }} </p>
                                        </div>

                                        <div class="p-3 border-b border-blue-400">
                                            <p class="text-gray-200 text-sm "> Maat </p>
                                            <p class="text-lg"> {{ $request->size }} </p>
                                        </div>

                                        <div class="p-3 border-b border-blue-400">
                                            <p class="text-gray-200 text-sm"> Adres </p>
                                            <p class="text-lg"> {{ $request->address }}, {{ $request->postal }} </p>
                                        </div>

                                        <div class="p-3">
                                            <p class="text-gray-200 text-sm"> E-mail </p>
                                            <p class="text-lg"> {{ $request->email }} </p>
                                        </div>

                                        <a href="/requestview/{{ $request->id }}"><button class="bg-orange-400 w-full text-center rounded-b p-2 hover:cursor-pointer">Opvolgen</button></a>
                                </div>
                            @empty

                                <p> <i> Ai caramba! Geen aanvragen meer, misschien de volgende keer? </i> </p>
                            @endforelse

                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
