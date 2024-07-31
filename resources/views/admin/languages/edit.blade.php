@extends('layouts.admin')

@section('title','تعديل بيانت اللغة ')

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
                <li class="breadcrumb-item active">تعديل اللغة </li>
                <li class="breadcrumb-item"><a href="{{route('admin.languages')}}"> عرض اللغات</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الصفحة الرئيسية</a></li>

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      @include('admin.includes.alerts.errors')
      @include('admin.includes.alerts.success')


      <form action="{{ route('admin.languages.update', $language->id) }}" method="post" >
        @csrf

    <!-- Main content -->
    <div class="content" dir="rtl">
        <section class="content" dir="rtl">
            <div class="container-fluid">
              <div class="row ">
                <div class="col-12 ">
                    <div class="card card-secondary ">
                        <div class="card-header">
                          <h3 class="card-title ">تــعــديــل الـلــغــة </h3>
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
                                <label class="float-right">اسم اللغة</label>
                              <input type="text" name="name" class="form-control" style="height: 55px" placeholder="اسم اللغة" value="{{ $language->name }}">

                              @error('name')
                              <span class="text-danger">{{$message}}</span>
                              @enderror

                            </div>


                            <div class="col-6 mt-3">
                                <label class="float-right">إختصار اللغة</label>
                              <input type="text" name="abbr" class="form-control" style="height: 55px" placeholder="إختصار اللغة" value="{{ $language->abbr }}">

                              @error('abbr')
                              <span class="text-danger">{{$message}}</span>
                              @enderror

                            </div>



                            <div class="form-group col-6 mt-5">
                                    <label class="float-right">الإتجاه</label>
                                            <select class="form-control select2bs4" name="direction"  style="height: 55px">
                                                    <option selected="selected" value="rtl" {{ $language->direction == 'rtl' ? 'selected' : '' }}>من اليمين إلى اليسار</option>
                                                    <option value="ltr" {{ $language->direction == 'ltr' ? 'selected' : '' }}>من اليسار إلى اليمين</option>
                                            </select>
                                @error('direction')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>


                             </div>

                             <div class="form-check form-switch mt-3 float-right" dir="rtl">
                                <label class="form-check-label ml-2 font-bold" style="font-size: 21px" for="flexSwitchCheckDefault">الحالة :</label>
                                <input class="form-check-input" style="width: 45px; height: 25px;" name="active" type="checkbox" value="1" id="flexSwitchCheckDefault"  @if($language->active  == 1 ) checked   @endif>
                                @error('active')
                                   <span class="text-danger">{{$message}}</span>
                                @enderror
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
