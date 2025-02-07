@php
    $MainMenu = Menu::getByName('main_menu');
@endphp


<nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset(config('settings.logo')) }}" alt="FoodClick" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                @if ($MainMenu)
                    @foreach ($MainMenu as $menu)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $menu['link'] }}">{{ $menu['label'] }}
                                @if ($menu['child'])
                                    <i class="far fa-angle-down"></i>
                                @endif
                            </a>
                            @if ($menu['child'])
                                <ul class="droap_menu">
                                    @foreach ($menu['child'] as $item)
                                        <li><a href="{{ $item['link'] }}">{{ $item['label'] }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
            <ul class="menu_icon d-flex flex-wrap">
                <li>
                    <a href="#" class="menu_search"><i class="far fa-search"></i></a>
                    <div class="fp__search_form">
                        <form action="{{ route('product.index') }}" method="GET">
                            <span class="close_search"><i class="far fa-times"></i></span>
                            <input type="text" placeholder="Search . . ." name="search">
                            <button type="submit">search</button>
                        </form>
                    </div>
                </li>
                <li>
                    <a class="cart_icon"><i class="fas fa-shopping-basket"></i> <span
                            class="cart_count">{{ count(Cart::content()) }}</span></a>
                </li>

                @php
                    @$unseenMessages = \App\Models\Chat::where([
                        'sender_id' => 1,
                        'receiver_id' => auth()->user()->id,
                        'seen' => 0,
                    ])->count();
                @endphp
                <li>
                    <a class="message_icon" href="{{ route('dashboard') }}">
                        <i class="fas fa-comment-alt-dots"></i> <span
                            class="unseen-message-count">{{ $unseenMessages > 0 ? 1 : 0 }}</span></a>
                </li>
                <li>
                    <a class="common_btn"
                        style="width: 55px; height: 45px; display: flex; justify-content: center; align-items: center;"
                        href="{{ route('login') }}"><i class="fas fa-user"></i></a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="fp__menu_cart_area">
    <div class="fp__menu_cart_boody">
        <div class="fp__menu_cart_header">
            <h5>total item (<span class="cart_count" style="font-size: 16px">{{ count(Cart::content()) }}</span>)</h5>
            <span class="close_cart"><i class="fal fa-times"></i></span>
        </div>
        <ul class="cart_contents">
            @foreach (Cart::content() as $cartProduct)
                <li>
                    <div class="menu_cart_img">
                        <img src="{{ asset($cartProduct->options->product_info['image']) }}" alt="menu"
                            class="img-fluid w-100">
                    </div>
                    <div class="menu_cart_text">
                        <a class="title"
                            href="{{ route('product.show', $cartProduct->options->product_info['slug']) }}">{!! $cartProduct->name !!}
                        </a>
                        <p class="size">Qty: {{ $cartProduct->qty }}</p>

                        <p class="size">{{ @$cartProduct->options->product_size['name'] }}
                            {{ @$cartProduct->options->product_size['price']
                                ? '(' . currencyPosition(@$cartProduct->options->product_size['price']) . ')'
                                : '' }}
                        </p>

                        @foreach ($cartProduct->options->product_options as $cartProductOption)
                            <span class="extra">{{ $cartProductOption['name'] }}
                                ({{ currencyPosition($cartProductOption['price']) }})
                            </span>
                        @endforeach

                        <p class="price">{{ currencyPosition($cartProduct->price) }}</p>
                    </div>
                    <span class="del_icon" onclick="removeProductFromSidebar('{{ $cartProduct->rowId }}')"><i
                            class="fal fa-times"></i></span>
                </li>
            @endforeach

        </ul>
        <p class="subtotal">sub total <span class="cart_subtotal">{{ currencyPosition(cartTotal()) }}</span></p>
        <a class="cart_view" href="{{ route('cart.index') }}"> view cart</a>
        <a class="checkout" href="{{ route('checkout.index') }}">checkout</a>
    </div>
</div>
