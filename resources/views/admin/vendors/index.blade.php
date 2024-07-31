@extends('layouts.admin')

@section('title','عرض الاقسام')

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
                <li class="breadcrumb-item active">عرض المتاجر</li>
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الصفحة الرئيسية</a></li>

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->



      @include('admin.includes.alerts.success')
      @include('admin.includes.alerts.errors')


    <!-- Main content -->
    <div class="content">



        <section class="content">

            <div class="container-fluid">

                <div class="d-flex flex-row-reverse" style="" dir="rtl ">
                        <a href="{{route('admin.vendors.create')}}" class="btn btn-primary mb-4" style="height: 40px;">
                            <i class="fa-solid fa-plus mr-2"></i>إضافة متجر جديد
                        </a>
                </div>

              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">جدول المتاجر</h3>
                        <div class="card-tools">
{{--                            <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">--}}
{{--                                <i class="fas fa-sync-alt"></i>--}}
{{--                            </button>--}}
                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>


                        </div>
                    </div>


                    <!-- /.card-header -->
                    <div class="card-body table-responsive " >
                      <table id="example" class="table table-bordered  table-hover  table-striped display nowrap" aria-describedby="example1_info" style="width:100%">
                        <thead>
                        <tr>
                          <th>الإسم</th>
                          <th>اللوجو</th>
                          <th>الهاتف</th>
                          <th>القسم الرئيسي</th>
                          <th>الحالة</th>
                          <th>الإجراء</th>
                        </tr>
                        </thead>
                        <tbody>
                            @isset($vendores)
                            @foreach ($vendores as $vendore )

                            <tr>
                                <td>{{$vendore -> name}}</td>
                                <td> <img style="width: 80px; height: 50px" src="{{ asset($vendore->logo) }}"></td>
                                <td>{{$vendore -> mobile}}</td>
                                <td>{{$vendore -> category -> name}}</td>
                                <td>{{$vendore -> getactive()}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                            <div class="ml-3">
                                    <a href="{{route('admin.maincategories.edit',$vendore -> id)}}" class="btn  btn-primary">
                                        <i class="fas fa-edit"></i> تعديل
                                    </a>


                                    <a href="{{ route('admin.maincategories.delete', $vendore->id) }}" class="btn btn-delete bg-danger ml-2">
                                        <i class="fa-solid fa-trash-can"></i> حذف
                                    </a>


                                <div class="mt-2">

                                  <a href="" class="btn btn-warning">
                                      @if($vendore -> active == 0)
                                          تفعيل
                                      @else
                                          الغاء تفعيل
                                      @endif
                                  </a>

                                </div>


                            </div>
{{-- {{route('admin.maincategories.status',$category -> id)}} --}}





                                    </div>
                                </td>
                            </tr>


                                </td>
                                </tr>

                            @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>الإسم</th>
                            <th>الصورة</th>
                            <th>اللغة</th>
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
