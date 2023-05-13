<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/css/request.css">
    <link rel="stylesheet" href="/css/mobile-style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Dramatic T-shirts</title>

    <script>
        document.addEventListener("touchstart", function() {}, true);
    </script>


</head>
<body class="bg-gray-200">
<div id="bannersection">
    <h1 class="text-4xl">Bestelling</h1>
</div>

<div id="sell-page">

    <div id="reservation-container" class="px-10">

        <div class="bg-gray-100 rounded-lg shadow p-10 border-4" style="border-color: var(--dark-blue);">
            <h3 class="text-2xl">Reserveren</h3>
            <ul class="list-disc list-inside">
                <li>Je reserveert je favoriete T-Shirt.</li>
                <li>Ik neem dan zo snel mogelijk contact met je op om het verder verloop te bespreken.</li>
                <li>Dat is het! Makkelijk hé :)</li>
            </ul>
            <form method="POST" class="formcontrol mt-3">
                @csrf

                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}" required>

                <div>
                    <label for="name">Volledige naam</label>
                    <input type="text" name="name" id="name" class="rounded-lg shadow-sm border-gray-300" required autofocus>

                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="rounded-lg shadow-sm border-gray-300" required autofocus>
                </div>
                <div>
                    <label for="address">Straatnaam en nummer</label>
                    <input type="text" name="address" id="address" class="rounded-lg shadow-sm border-gray-300" required>
                </div>
                <div>
                    <label for="postal">Postcode</label>
                    <input type="number" name="postal" id="postal" class="rounded-lg shadow-sm border-gray-300" required>
                </div>
                <div>
                    <label for="size">Kledingmaat</label>
                    <select name="size" id="size" class="shadow-sm rounded-lg border-gray-300">
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                    </select>
                </div>

                <div>
                    <label for="notes">Opmerkingen</label>
                    <input type="text" name="notes" id="notes" class="rounded-lg shadow-sm border-gray-300">
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Reserveer nu
                    <svg aria-hidden="true" class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>

            </form>
        </div>
    </div>

    <div id="sidebar" class="text-center">
        <div class="img-container my-10">
            <div class="design-item rounded-lg" style="background-image: url('/products/{{ $product->image }}')"></div>
        </div>
        <div class="p-3 border-b border-blue-400">
            <p class="text-gray-300 text-sm"> T-shirtkeuze </p>
            <p class="text-lg text-white"> {{ $product->name }} </p>
        </div>


        <div class="p-3 border-b border-blue-400">
            <p class="text-gray-300 text-sm"> Prijs </p>
            <p class="text-lg text-white"> €{{ $product->price }} </p>
        </div>
    </div>





</div>




</body>

</html>
