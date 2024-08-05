@extends('layouts.admin')

@section('title','إضافة وجبة جديدة')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">لوحة التحكم</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">إضافة وجبة جديدة</li>
                        <li class="breadcrumb-item"><a href="{{route('admin.meals')}}">عرض الوجبات</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الصفحة الرئيسية</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @include('admin.includes.alerts.errors')
    @include('admin.includes.alerts.success')

    <form action="{{route('admin.meals.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Main content -->
        <div class="content" dir="rtl">
            <section class="content" dir="rtl">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-12 ">
                            <div class="card card-secondary">
                                <div class="card-header ">

                                    <h3 class="card-title  justify-content-center">إضافة وجبة جديدة</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="form-group col-6 mt-3">
                                            <label class="float-right">اختر قسم الوجبة</label>
                                            <select class="form-control select2 float-left" name="category_id">
                                                <optgroup label="من فضلك اختر القسم">
                                                    @if($categories && $categories->count() > 0)
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </optgroup>
                                            </select>
                                            <div class="d-flex flex-row-reverse">
                                                @error('category_id')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-6 mt-5">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">صورة الوجبة</label>
                                                <input type="file" name="photo" class="form-control" id="inputGroupFile01">
                                            </div>
                                            <div class="d-flex flex-row-reverse">
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 mt-3">
                                            <label class="float-right">السعر</label>
                                            <input type="number" name="price" class="form-control" style="height: 55px">
                                            <div class="d-flex flex-row-reverse">
                                                @error('price')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    @if (get_language()->count() > 0)
                                        @foreach (get_language() as $index => $lang)
                                            <div class="row border pb-3 mt-5 clearfix">
                                                <div class="row">
                                                    <div class="col-6 mt-3">
                                                        <label class="float-right">اسم الوجبة - {{__('messages.'.$lang->abbr)}}</label>
                                                        <input type="text" name="meal[{{$index}}][name]" class="form-control" style="height: 55px">
                                                        <div class="d-flex flex-row-reverse">
                                                            @error('meal.{{$index}}.name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-6 mt-3">
                                                        <label class="float-right">الوصف - {{__('messages.'.$lang->abbr)}}</label>
                                                        <input type="text" name="meal[{{$index}}][description]" class="form-control" style="height: 55px">
                                                        <div class="d-flex flex-row-reverse">
                                                            @error('meal.{{$index}}.description')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-1 mt-3" style="visibility: hidden;">
                                                    <label class="float-right hidden">إختصار اللغة - {{__('messages.'.$lang->abbr)}}</label>
                                                    <input type="text" name="meal[{{$index}}][abbr]" value="{{$lang->abbr}}" class="form-control" style="height: 55px">
                                                    <div class="d-flex flex-row-reverse">
                                                        @error('meal.{{$index}}.abbr')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="d-flex float-right">
                                                    <div class="form-check form-switch" style="margin-top: -70px">
                                                        <label class="form-check-label ml-2 font-bold" style="font-size: 21px" for="flexSwitchCheckDefault">الحالة - {{__('messages.'.$lang->abbr)}}</label>
                                                        <input type="hidden" name="meal[{{$index}}][active]" value="0">
                                                        <input class="form-check-input" style="width: 45px; height: 25px;" name="meal[{{$index}}][active]" type="checkbox" value="1" id="flexSwitchCheckDefault" checked>
                                                        @error('meal.{{$index}}.active')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="card-body pt-5 mt-5 w-80 mt-3">
                                        <button type="reset" class="btn btn-warning float-right ml-3">تــراجــع <i class="fa-solid fa-square-xmark"></i></button>
                                        <button type="submit" class="btn btn-success float-right">حــفــظ <i class="fa-regular fa-square-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
@endsection
