@extends('layouts.admin')

@section('title','إضافة قسم جديد')

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
                <li class="breadcrumb-item active">إضافة متجر جديد</li>
                <li class="breadcrumb-item"><a href="{{route('admin.vendors')}}">عرض المتاجر</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الصفحة الرئيسية</a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      @include('admin.includes.alerts.errors')
      @include('admin.includes.alerts.success')

      <form action="{{route('admin.vendors.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Main content -->
        <div class="content" dir="rtl">
            <section class="content" dir="rtl">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-12 ">
                            <div class="card card-secondary">
                                <div class="card-header ">

                                    <h3 class="card-title  justify-content-center">إضافة تاجر جديد</h3>
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
                                <div class="card-body ">


                                    <div class="row border pb-3 ">
                                        <div class="col-6 mt-3">
                                            <label class="float-right">اسم المتجر</label>
                                            <input type="text" name="name" class="form-control" style="height: 55px" placeholder="اسم المتجر">

                                            <div class="d-flex flex-row-reverse">
                                                @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-6 mt-3">
                                            <label class="float-right">رقم الهاتف </label>
                                            <input type="text" name="mobile" class="form-control" style="height: 55px" placeholder="رقم الهاتف ">

                                            <div class="d-flex flex-row-reverse">
                                                @error('mobile')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-6 mt-3">
                                            <label class="float-right">البريد الالكتروني</label>
                                            <input type="text" name="email" class="form-control" style="height: 55px" placeholder="البريد الالكتروني">

                                            <div class="d-flex flex-row-reverse">
                                                @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>





                                        <div class="form-group col-6 mt-3">
                                            <label class="float-right">اختر القسم</label>
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


                                     </div>

                                        <div class="form-check form-switch mt-5 float-right mb-5" dir="rtl">
                                            <label class="form-check-label ml-2 font-bold" style="font-size: 21px" for="flexSwitchCheckDefault">الحالة :</label>

                                            <!-- حقل مخفي بقيمة 0 يتم إرساله عندما يكون مربع الاختيار غير مفعل -->
                                            <input type="hidden" name="active" value="0">

                                            <!-- مربع الاختيار يرسل 1 عندما يكون مفعل -->
                                            <input class="form-check-input" style="width: 45px; height: 25px;" name="active" type="checkbox" value="1" id="flexSwitchCheckDefault" checked>

                                            @error('active')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
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

                                    <div class="card-body pt-5 mt-5 w-80 mt-3">
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
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
