@extends('layouts.login')

@section('title','تسجيل الدخول')

@section('content')

  <!-- /.login-logo -->
  <div class="card card-outline card-primary" >
    <div class="card-header text-center">
      <P class="h1"><b>لوحة</b>تسجيل الدخول</P>
    </div>
    <div class="card-body mt-3">
      <p class="login-box-msg">سجل دخولك لبدأ الجلسة</p>


      @include('admin.includes.alerts.errors')
      @include('admin.includes.alerts.success')


      <form action="{{route('admin.login')}}" method="post" >
        @csrf


        <div class="mb-3">
                <div class="input-group mt-4">
                <input type="email" class="form-control" placeholder="البريد الإلكتروني" name="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                </div>

                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

        </div>



        <div class="mb-3">
                <div class="input-group ">
                <input type="password" class="form-control" placeholder="كلمة السر" name="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>

                    @error('password')
                            <span class="text-danger">{{$message}}</span>
                    @enderror

        </div>



        <div class="row mt-5">
          <div class="col-6">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember_me">
              <label for="remember">
                تذكرني
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block w-">تسجيل الدخول</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
{{--
      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->

      {{-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> --}}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

@endsection
