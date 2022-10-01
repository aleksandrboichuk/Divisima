
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/images/home/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/images/home/favicon.ico" type="image/x-icon">
    <title>Divisima</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/css/animate.css" rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" />
    <link href="/css/responsive.css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!--start header-->

<header id="header">
    <div class="header-middle">
        <div class="container">
            <div class="row">
                <div class="col-md-2 clearfix">
                    <div class="logo pull-left">
                        <a href="/shop/women"><img src="/images/home/logo.png" alt=""
                            /></a>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="search_box">
                        @include('components.search')
                    </div>
                </div>
                <div class="col-md-6 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                                <li>
                                    <a href="/personal/orders"><i class="fa fa-user"></i> Особистий кабінет</a>
                                </li>

                                @if($user->superuser)
                                    <li>
                                        <a href="/admin"><i class="fa fa-crosshairs"></i>Адмін-панель</a>
                                    </li>
                                @endif
                                <li>
                                    <a class="a-cart-title"    href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i> Кошик <b>{{isset($user->cart->products) ? count($user->cart->products) : "0"}}</b></a>
                                </li>
                                <li>
                                    <a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Вихід</a>
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="navbar-header">
                        <button
                                type="button"
                                class="navbar-toggle"
                                data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left admin-navbar">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            @if(isset($user->roles) && count($user->roles) > 0)
                                    @foreach($user->roles as $key => $r)
                                        @if($r->seo_name == 'main-admin')
                                            <li><a href="/admin/orders"><u>Замовлення</u></a></li>
                                            <li><a href="/admin/messages"><u>Повідомлення</u></a></li>
                                            <li><a href="/admin/users">Користувачі</a></li>
                                            <li><a href="/admin/promocodes">Промокоди</a></li>
                                            <li><a href="/admin/banners">Банери<i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="sub-menu">
                                                    <li><a href="/admin/banners/women">Для жінок</a></li>
                                                    <li><a href="/admin/banners/men">Для чоловіків</a></li>
                                                    <li><a href="/admin/banners/boys">Для хлопчиків</a></li>
                                                    <li><a href="/admin/banners/girls">Для дівчаток</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="/admin/categories" >Групи категорій<i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="sub-menu">
                                                    <li><a href="/admin/categories">Категорії</a></li>
                                                    <li><a href="/admin/subcategories">Підкатегорії</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="/admin/products">Товари<i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="sub-menu">
                                                    <li><a href="/admin/products/women">Жіночі</a></li>
                                                    <li><a href="/admin/products/men">Чоловічі</a></li>
                                                    <li><a href="/admin/products/boys">Для хлопчиків</a></li>
                                                    <li><a href="/admin/products/girls">Для дівчаток</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#">Властивості товарів<i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="sub-menu">
                                                    <li><a href="/admin/colors">Кольори</a></li>
                                                    <li><a href="/admin/brands">Бренди</a></li>
                                                    <li><a href="/admin/materials">Матеріали</a></li>
                                                    <li><a href="/admin/sizes">Розміри</a></li>
                                                </ul>
                                            </li>
                                            @unset($user->roles[$key])
                                            @break
                                        @elseif($r->seo_name == 'orders-admin')
                                            <li><a href="/admin/orders"><u>Замовлення</u></a></li>
                                            <li><a href="/admin/messages"><u>Повідомлення</u></a></li>
                                            @unset($user->roles[$key])
                                        @elseif($r->seo_name == 'content-manager')
                                            <li><a href="/admin/promocodes">Промокоди</a></li>
                                            <li><a href="/admin/banners">Банери<i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="sub-menu">
                                                    <li><a href="/admin/banners/women">Для жінок</a></li>
                                                    <li><a href="/admin/banners/men">Для чоловіків</a></li>
                                                    <li><a href="/admin/banners/boys">Для хлопчиків</a></li>
                                                    <li><a href="/admin/banners/girls">Для дівчаток</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="/admin/categories" >Групи категорій<i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="sub-menu">
                                                    <li><a href="/admin/categories">Категорії</a></li>
                                                    <li><a href="/admin/subcategories">Підкатегорії</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="/admin/products">Товари<i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="sub-menu">
                                                    <li><a href="/admin/products/women">Жіночі</a></li>
                                                    <li><a href="/admin/products/men">Чоловічі</a></li>
                                                    <li><a href="/admin/products/boys">Для хлопчиків</a></li>
                                                    <li><a href="/admin/products/girls">Для дівчаток</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#">Властивості товарів<i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="sub-menu">
                                                    <li><a href="/admin/colors">Кольори</a></li>
                                                    <li><a href="/admin/brands">Бренди</a></li>
                                                    <li><a href="/admin/materials">Матеріали</a></li>
                                                    <li><a href="/admin/sizes">Розміри</a></li>
                                                </ul>
                                            </li>
                                            @unset($user->roles[$key])
                                        @endif
                                    @endforeach
                            @endif



                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- end header-->



<!--start content-->
@yield('content')
<!--end content-->



<script src="/js/menu.js"></script>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.scrollUp.min.js"></script>
<script src="/js/main.js"></script>
@yield('custom-js')
</body>
</html>
