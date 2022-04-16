@extends('layouts.admin')

@section('content')
    <div class="breadcrumbs admin-bread">
        <ol class="breadcrumb">
            <li><a href="/admin">Панель Адміністратора</a> </li>
            <li><a href="/admin/categories">Категорії</a> </li>
            <li class="active">Додавання</li>
        </ol>
    </div>
<section class="form-add">
    <div class="container">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            {{--<h2>Додавання категорії</h2>--}}
            <form action="{{route('save.category')}}" method="post">
                <div class="add-block">
                    <label for="title-field">Заголовок* </label>
                    <input type="text" name="title-field" required maxlength="20">
                </div>
                @if($errors->has('title-field'))
                    <div class="invalid-feedback admin-feedback" role="alert">
                        <strong>{{ $errors->first('title-field') }}</strong>
                    </div>
                @endif
                <div class="add-block">
                    <label for="name-field">Назва* </label>
                    <input type="text" name="name-field" required  maxlength="20">
                </div>
                @if($errors->has('name-field'))
                    <div class="invalid-feedback admin-feedback" role="alert">
                        <strong>{{ $errors->first('name-field') }}</strong>
                    </div>
                @endif
                <div class="add-block">
                    <label for="seo-field">SEO* </label>
                    <input type="text" name="seo-field" required maxlength="25" >
                </div>
                @if($errors->has('seo-field'))
                    <div class="invalid-feedback admin-feedback" role="alert">
                        <strong>{{ $errors->first('seo-field') }}</strong>
                    </div>
                @endif
                <div class="add-block">
                    <label for="active-field">Активність </label>
                    <input type="checkbox" name="active-field">
                </div>
                <div class="add-block">
                    <label for="cat-field">Група категорій </label>
                    <select required size="5" name="cat-field" class="select-option">
                        @foreach($category_groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default todo-btn">Додати</button>

            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>


</section>

@endsection