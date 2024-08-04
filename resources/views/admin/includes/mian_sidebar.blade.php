  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary fixed elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset("assets/admin/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset("assets/admin/dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ibrahim</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('admin.dashboard')}}" class="nav-link active">
                <i class="fa-solid fa-house"></i>
              <p class="pl-2">
                الصفحة الرئيسية
              </p>
            </a>

          </li>
          <li class="nav-header border-bottom mt-3"> إعدادات اللغات </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-earth-americas mr-2"></i>
              <p>
                لــغــات الــموقــع
                <i class="fas fa-angle-left right"></i>

                <span class="badge badge-info right">{{App\Models\Language::count()}}</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.languages')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>عرض جميع اللغات </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.languages.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>إضافة لغة جديدة</p>
                </a>
              </li>
            </ul>


            <li class="nav-header border-bottom mt-3"> إعدادات الإقسام </li>






                   {{-----------  Main Categories  -----------}}
            <li class="nav-item mb-1 mt-2">
              <a href="#" class="nav-link">
                  <i class="fa-solid fa-list-ul"></i>
                <p>
                  الأقسام الرئيسية للموقع
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">{{App\Models\MainCategory::defaultCategory()->count()}}</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.maincategories')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>عرض  جميع الأقسام </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('admin.maincategories.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>إضافة قسم جديد</p>
                  </a>
                </li>
              </ul>
          </li>








            {{-----------  Sub Categories  -----------}}
            <li class="nav-item mb-1">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-network-wired"></i>
                    <p>
                        الأقسام الفرعية للموقع
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right">{{App\Models\SubCategory::count()}}</span>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.subcategories')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>عرض  جميع الأقسام </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.subcategories.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>إضافة قسم فرعي جديد</p>
                        </a>
                    </li>
                </ul>
            </li>







            {{-----------  Vendors  -----------}}

            <li class="nav-item mb-1 ">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-network-wired"></i>
                    <p>
                الــمــتـــاجــر
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right">{{App\Models\Vendor::count()}}</span>{{--defaultCategory()->--}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.vendors')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>عرض  جميع المتاجر </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.vendors.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>إضافة متجر جديد</p>
                        </a>
                    </li>
                </ul>
            </li>






            </li>
            <li class="nav-header border-bottom mt-3"> إعدادات الوجبات </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-earth-americas mr-2"></i>
                    <p>
                        الوجبات
                        <i class="fas fa-angle-left right"></i>

                        <span class="badge badge-info right">{{App\Models\Add_meal::count()}}</span>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.meals')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>عرض جميع الوجبات </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.meals.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>إضافة لغة جديدة</p>
                        </a>
                    </li>
                </ul>




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
