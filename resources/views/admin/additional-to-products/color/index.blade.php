@extends('layouts.admin')

@section('content')
    @if(session()->has('success-message'))
        <div class="alert alert-success alert-active" role="alert">
            <h4 class="alert-heading">Виконано!</h4>
            <p>{{session('success-message')}}</p>
            <hr>
            <div class="mb-0"><button type="button" class="btn btn-danger alert-btn alert-btn-close">Закрити</button></div>
        </div>
        @php(session()->forget('success-message'))
    @endif
    <section id="table_items">
        @if(isset($breadcrumbs))
            @include('admin.components.breadcrumbs')
        @endif
        <div class="container">
            <div class="row">
                <div class="btn-admin">
                    <a href="/admin/colors/create"><button type="button" class="btn btn-default todo-btn">Додати</button></a>
                </div>
            </div>
            <div class="table-responsive general-table-index">
                <table class="table table-condensed">
                    <thead>
                    <tr class="general_menu">
                        <td>ID</td>
                        <td><b>Назва</b></td>
                        <td><b>SEO</b></td>
                        <td> <b>Активність</b></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody class="general-table">

                    @foreach($colors as $item)
                        <tr>
                            <td>
                                <p>{{$item->id}}</p>
                            </td>
                            <td>
                                <p>{{$item->name}}</p>
                            </td>
                            <td>
                                <p>{{$item->seo_name}}</p>
                            </td>
                            <td>
                                <input type="checkbox" {{$item->active ? "checked" : ""}} disabled>
                            </td>
                            <td>
                                <a href="{{route('colors.edit', $item->id)}}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg></a>
                            </td>
                            <td>
                                <form action="{{route('colors.destroy', $item->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button id="{{$item->id}}" type="submit" class="btn btn-danger btn-danger-admin"><svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                            <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                        </svg></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
@section('custom-js')
    <script src="/js/components/admin/alerts.js"></script>
@endsection
