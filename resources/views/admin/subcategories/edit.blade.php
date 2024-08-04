@extends('layouts.admin')

@section('title','تعديل بيانات القسم')

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
                        <li class="breadcrumb-item active">تعديل - {{$mainCategory->name}}</li>
                        <li class="breadcrumb-item"><a href="{{route('admin.maincategories')}}">عرض الأقسام الفرعية</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الصفحة الرئيسية</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @include('admin.includes.alerts.errors')
    @include('admin.includes.alerts.success')

    <form action="{{route('admin.maincategories.update', $subCategory->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <input name="id" value="{{$subCategory -> id}}" type="hidden">

        <div class="form-group">
            <div class="text-center">
                <img src="{{$subCategory->photo}}" class="rounded-circle" style="height: 350px;" alt="صورة القسم">
            </div>
        </div>

        <div class="content" dir="rtl">
            <section class="content" dir="rtl">





                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-secondary">

                                <div class="card-header ">
                                    <h3 class="card-title">تعديل القسم</h3>
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


                                <div class="form-group col-6 mt-3">
                                    <label class="float-right">اختر القسم الرئيسي</label>
                                    <select class="form-control select2 float-left"   name="category_id">
                                        <optgroup label="من فضلك اختر القسم">
                                            @if($categories && $categories -> count() > 0)
                                                @foreach($categories as $category)
                                                    <option  value="{{$category -> id}}">{{$category -> name}}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>

                                    </select>
                                </div>

                                <div class="card-body">
                                    <div class="row border pb-3 mt-5 clearfix">
                                        <div class="col-12 mt-3">
                                            <label class="float-right">اسم القسم - {{__('messages.'.$mainCategory->translation_lang)}}</label>
                                            <input type="text" name="category[0][name]" value="{{$mainCategory->name}}" class="form-control" style="height: 55px">
                                            <div class="d-flex flex-row-reverse">
                                                @error('category.0.name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-1 mt-3" style="visibility: hidden;">
                                            <label class="float-right hidden">إختصار اللغة - {{__('messages.'.$mainCategory->translation_lang)}}</label>
                                            <input type="text" name="category[0][abbr]" value="{{$mainCategory->translation_lang}}" class="form-control" style="height: 55px">
                                            <div class="d-flex flex-row-reverse">
                                                @error('category.0.abbr')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex float-right">
                                            <div class="form-check form-switch" style="margin-top: -70px">
                                                <label class="form-check-label ml-2 font-bold" style="font-size: 21px;" for="flexSwitchCheckDefault">الحالة - {{__('messages.'.$mainCategory->translation_lang)}}</label>
                                                <input class="form-check-input" style="width: 45px; height: 25px;" name="category[0][active]" type="checkbox" value="1" id="flexSwitchCheckDefault" @if($mainCategory->active == 1) checked @endif>
                                                @error('category.0.active')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="form-group col-6 mt-5">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupFile01">رفع</label>
                                            <input type="file" name="photo" class="form-control" id="inputGroupFile01">
                                        </div>
                                        <div class="d-flex flex-row-reverse">
                                            @error('photo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="card-body mt-3">
                                        <button type="reset" class="btn btn-warning float-right ml-3">    تــراجــع  <i class="fa-solid fa-square-xmark"></i></button>
                                        <button type="submit" class="btn btn-success float-right ">  حــفــظ   <i class="fa-regular fa-square-check"></i></button>
                                    </div>



                                </div>


{{--///////////////////////////////////////////////////////////////////////////--}}


                                    <div class="col-12">
                                        <div class="card card-primary card-tabs">
                                            <div class="card-header p-0 pt-1">
                                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                    @isset($mainCategory -> categories)
                                                        @foreach($mainCategory -> categories as $index => $translation)
                                                    <li class="nav-item">
                                                        <a class="nav-link @if($index ==  0) active @endif" id="custom-tabs-one-home-tab" data-toggle="pill"
                                                           href="#custom-tabs-one-home{{$index}}" role="tab" aria-controls="{{$index ==  0 ? 'true' : 'false'}}"
                                                           aria-selected="true">{{__('messages.'.$translation->translation_lang)}}</a>
                                                    </li>
                                                        @endforeach
                                                    @endisset
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                                    @isset($mainCategory -> categories)
                                                        @foreach($mainCategory -> categories as $index => $translation)
                                                    <div class="tab-pane fade show @if($index ==  0) active @endif" id="custom-tabs-one-home{{$index}}" role="tabpanel" aria-labelledby="{{$index ==  0 ? 'true' : 'false'}}">
                                                        <form action="{{route('admin.maincategories.update', $translation->id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input name="id" value="{{$translation -> id}}" type="hidden">


                                                            <div class="content" dir="rtl">
                                                                <section class="content" dir="rtl">

                                                                    <div class="container-fluid">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="card card-white border">

                                                                                    <div class="card-header ">
                                                                                        <h3 class="card-title">تعديل القسم</h3>
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
                                                                                        <div class="row border pb-3 mt-5 clearfix">
                                                                                            <div class="col-12 mt-3">
                                                                                                <label class="float-right">اسم القسم - {{__('messages.'.$translation->translation_lang)}}</label>
                                                                                                <input type="text" name="category[{{$translation ->id}}][name]" value="{{$translation->name}}" class="form-control" style="height: 55px">
                                                                                                <div class="d-flex flex-row-reverse">
                                                                                                    @error('category.0.name')
                                                                                                    <span class="text-danger">{{$message}}</span>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-1 mt-3" style="visibility: hidden;">
                                                                                                <label class="float-right hidden">إختصار اللغة - {{__('messages.'.$translation->translation_lang)}}</label>
                                                                                                <input type="text" name="category[{{$translation ->id}}][abbr]" value="{{$translation->translation_lang}}" class="form-control" style="height: 55px">
                                                                                                <div class="d-flex flex-row-reverse">
                                                                                                    @error('category.0.abbr')
                                                                                                    <span class="text-danger">{{$message}}</span>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="row">
                                                                                                <div class="d-flex  float-right">
                                                                                                    <div class="form-check form-switch" style="margin-top: -70px">
                                                                                                        <label class="form-check-label ml-2 font-bold" style="font-size: 21px;" for="flexSwitchCheckDefault">الحالة - {{__('messages.'.$translation->translation_lang)}}</label>
                                                                                                        <input class="form-check-input" style="width: 45px; height: 25px;" name="category[{{$translation ->id}}][active]" type="checkbox" value="1" id="flexSwitchCheckDefault" @if($translation->active == 1) checked @endif>
                                                                                                        @error('category.0.active')
                                                                                                        <span class="text-danger">{{$message}}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>


                                                                                        </div>


                                                                                        <div class="card-body mt-3">
                                                                                            <button type="reset" class="btn btn-warning float-right ml-3">    تــراجــع  <i class="fa-solid fa-square-xmark"></i></button>
                                                                                            <button type="submit" class="btn btn-success float-right ">  حــفــظ   <i class="fa-regular fa-square-check"></i></button>
                                                                                        </div>

                                                                                    </div>

                                                                                    <!-- /.card-body -->
                                                                                </div>

                                                                                <!-- /.card -->
                                                                            </div>
                                                                            <!-- /.col -->
                                                                        </div>
                                                                        <!-- /.row -->
                                                                    </div>
                                                                    <!-- /.container-fluid -->
                                                                </section>
                                                                <!-- /.container-fluid -->
                                                            </div>
                                                        </form>
                                                    </div>
                                                        @endforeach
                                                    @endisset
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>



                            </div>

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.container-fluid -->
        </div>
    </form>
@endsection
