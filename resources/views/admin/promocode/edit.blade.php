@extends('layouts.admin')

@section('content')
    @if(isset($breadcrumbs))
        @include('admin.components.breadcrumbs')
    @endif
    <section class="form-add">
        <div class="container">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <form action="{{route('promocodes.update', $promocode->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="add-block">
                        <label for="title">Назва*</label>
                        <input type="text" name="title" value="{{$promocode->title}}" required >
                    </div>
                    @if($errors->has('title'))
                        <div class="invalid-feedback admin-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </div>
                    @endif
                    <div class="add-block">
                        <label for="description">Опис* </label>
                        <textarea  name="description" cols="30"  rows="10" required maxlength="100">{{$promocode->description}}</textarea>
                    </div>
                    @if($errors->has('description'))
                        <div class="invalid-feedback admin-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </div>
                    @endif
                    <div class="add-block">
                        <label for="discount">Знижка на товари у кошику* </label>
                        <input type="text" name="discount"   value="{{$promocode->discount}}" required  onkeyup="this.value = this.value.replace(/[^\d]/g,'');" maxlength="2">
                    </div>
                    <div class="add-block">
                        <label for="promocode">Промокод* </label>
                        <input type="text" name="promocode"  value="{{$promocode->promocode}}"  maxlength="20" required>
                    </div>
                    @if($errors->has('promocode'))
                        <div class="invalid-feedback admin-feedback" role="alert">
                            <strong>{{ $errors->first('promocode') }}</strong>
                        </div>
                    @endif
                    <div class="add-block">
                        <label for="min_cart_products">Мінімальна кількість товарів у кошику </label>
                        <input type="text"  name="min_cart_products"   value="{{!empty($promocode->min_cart_products) ? $promocode->min_cart_products : '' }}" onkeyup="this.value = this.value.replace(/[^\d]/g,'');" placeholder="Без обмежень">
                    </div>
                    <div class="add-block">
                        <label for="min_cart_total">Мінімальна сума товарів у кошику (₴) </label>
                        <input type="text"  name="min_cart_total"   value="{{!empty($promocode->min_cart_total) ? $promocode->min_cart_total : '' }}" onkeyup="this.value = this.value.replace(/[^\d]/g,'');" placeholder="Без обмежень">
                    </div>
                    <div class="add-block">
                        <label for="active">Активність </label>
                        <input type="checkbox" name="active" {{$promocode->active ? 'checked' : ""}}>
                    </div>
                    <button type="submit" class="btn btn-default todo-btn">Зберегти</button>
                </form>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </section>

@endsection
