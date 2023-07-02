<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/mobile-style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Dramatic T-shirts</title>

    <script>
        document.addEventListener("touchstart", function() {}, true);

        function sendAlert(message) {
            Swal.fire({
                title: 'Oepsie!',
                text: message,
                icon: 'error',
                confirmButtonText: 'Oki!'
            })
        }

    </script>


</head>
<body>
<div id="bannersection">
    <b><h1>Dramatic<br>T-shirts</h1></b>
</div>

@if(session()->exists("error"))

    <script defer> sendAlert('{{ session()->get("error") }}') </script>
@endif

<!-- Dynamic -->
<div id="designs">
    <h2><mark>DESIGNS</mark></h2>

    <div id="design-list">


        @foreach(\App\Models\Product::all()->sortBy(function ($model) { return !$model->is_available || $model->orders_placed >= $model->max_amount; } ) as $product)

            <a @if($product->is_available && $product->orders_placed < $product->max_amount) href="/request/{{ $product->id }}" @else onclick="sendAlert('Dit design is (tijdelijk) niet meer beschikbaar!')  @endif ">
                <div class="wrap-item @if(!$product->is_available || $product->orders_placed >= $product->max_amount) sold @endif" title="{{ $product->name }}">
                    <div class="border-wrapper">
                        <div class="border-bottom-wrapper">
                            <div class="design-item" style="background-image: url('/products/{{ $product->image }}')">
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        @endforeach


    </div>


</div>

<div id="customrequest">
    <div class="explain-request">
        <p>Vond je niet wat je exact zocht?<br>Ik kan persoonlijk, voor jou, een design maken.</p>
    </div>

    <div class="personalise-banner">
        personaliseer je design.
    </div>

    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfDz8-FX7bO3zD6g4eYh_edlcPUppdS0Z2KtrmcMkkH05CwFg/viewform?embedded=true" width="100%" height="1200px"  frameborder="0" marginheight="0" marginwidth="0">Laden…</iframe>
</div>



<!-- Dynamic -->
<div class="looks">
    <div id="looks-title"><h2>Hoe ziet het er uit?</h2></div>
    <div class="img-container"> <div id="image-preview"><img src="https://media.discordapp.net/attachments/1082616843468025897/1121788462228590723/IMG_3094.jpg?width=669&height=671" height="50%"></div></div>
    <div id="item-description">
        <p>Maten: XS - XXL</p>
        <p>Prijs: € 15,00</p>

    </div>
</div>


<footer>
    <div id="location">
        <div class="icon">
                <span class="material-symbols-outlined">
                    pin_drop
                </span>
        </div>
        <div>
            Leuven, België
        </div>
    </div>


    <hr width="50%">

    <div id="contact">
        <div id="profilepic">
            <img src="/assets/profilepic.png" width="170px">
        </div>
        <div id="description">
            <a href="https://www.instagram.com/dramatic.tshirts/" target="_blank">@dramatic.tshirts</a><br>
            Affie De Cooman
        </div>
    </div>
</footer>

</body>

</html>
