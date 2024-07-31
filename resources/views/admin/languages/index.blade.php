@extends('layouts.admin')

@section('title','عرض اللغات')

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
                <li class="breadcrumb-item active">عرض اللغات</li>
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الصفحة الرئيسية</a></li>

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      {{-- {{ dd(session()->all()) }} --}}

      {{-- @php
      session()->put('test', 'جلسة العمل تعمل بنجاح');
  @endphp

  @if (session('test'))
      <div class="alert alert-info">
          {{ session('test') }}
      </div>
  @endif --}}



      @include('admin.includes.alerts.success')
      @include('admin.includes.alerts.errors')

    <!-- Main content -->
    <div class="content">



        <section class="content">

            <div class="container-fluid">

                <div class="d-flex flex-row-reverse" >
                        <a href="{{route('admin.languages.create')}}" class="btn btn-primary mb-4" style="height: 40px;">
                            <i class="fa-solid fa-plus mr-2"></i>إضافة لغة جديدة
                        </a>
                </div>

              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">جدول لغات الموقع</h3>
                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>

{{--                            <a class="btn btn-tool" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>--}}


                        </div>
                    </div>


                    <!-- /.card-header -->
                    <div class="card-body table-responsive ">
                      <table id="example" class="table table-bordered table-hover table-striped display nowrap" aria-describedby="example1_info" style="width:100%" >
                        <thead>
                        <tr>
                          <th>الإسم</th>
                          <th>الإختصار</th>
                          <th>الإتجاه</th>
                          <th>الحالة</th>
                          <th>الإجراء</th>
                        </tr>
                        </thead>
                        <tbody>
                            @isset($languages)
                            @foreach ($languages as $language )

                                <tr>
                                <td>{{$language -> name}}</td>
                                <td>{{$language -> abbr}}</td>
                                <td>{{$language -> direction}}</td>
                                <td>{{$language -> getActive()}}</td>
                                <td>

                                <div class="ml-3">
                                    <a href="{{route('admin.languages.edit',$language -> id)}}" class="btn  btn-primary">
                                        <i class="fas fa-edit"></i> تعديل
                                    </a>


                                    <a href="{{ route('admin.languages.delete', $language->id) }}" class="btn btn-delete bg-danger">
                                        <i class="fa-solid fa-trash-can"></i> حذف
                                    </a>
                                </div>

                                </td>
                                </tr>

                            @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>الإسم</th>
                            <th>الإختصار</th>
                            <th>الإتجاه</th>
                            <th>الحالة</th>
                            <th>الإجراء</th>
                        </tr>
                        </tfoot>
                      </table>
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
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
