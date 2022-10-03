@extends('layouts.main')
@section('content')
    <section class="products-section">
        @if(isset($breadcrumbs))
            @include('components.breadcrumbs')
        @endif
        <div class="main-container">
            <div class="row">

                <!--sidebar-->
            @include('components.sidebar')

            <!--products-->
                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center">{{$banner->title}}</h2>
                    </div>
                    @include('components.filter')
                    <div class="row">
                        <div class="products">
                            @if(isset($products) && !empty($products) && count($products) > 0)
                                @foreach($products as $item)
                                    @include('components.product')
                                @endforeach
                            @else
                                <div class="col-sm-12 no-found">
                                    Товари не знайдені.
                                </div>
                            @endif
                        </div>
                        {{$products->appends(request()->query())->links('components.pagination')}}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('custom-js')
    {{--<script src="/js/ajax-filters.js"></script>--}}
    {{--<script>--}}
        {{--indexAjax("{{route('promotion', [$group->seo_name, $banner->seo_name])}}");--}}
    {{--</script>--}}
    <script>
        $('.hidden-img').hover(function () {
            $(this).parent().css("background-image", "url('/images/products/" + $(this).attr('id') +  "')")
        });
        $('.hidden-img').mouseout(function () {
            $(this).parent().css("background-image", "url('/images/products/" + $(this).parent().attr('id') +  "')");
        })
    </script>
    <script src="/js/elastic-filters.js"></script>
@endsection
