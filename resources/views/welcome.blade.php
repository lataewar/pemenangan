<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
  <base href="">
  <meta charset="utf-8" />
  <title>{{ $title ?? config('app.name') }}</title>
  <meta name="description"
    content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="canonical" href="https://keenthemes.com/metronic" />
  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <!--end::Fonts-->
  <!--begin::Page Vendors Styles(used by this page)-->
  <link href="{{ asset('assets') }}/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet"
    type="text/css" />
  <!--end::Page Vendors Styles-->
  <!--begin::Global Theme Styles(used by all pages)-->
  <link href="{{ asset('assets') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets') }}/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />
  <!--end::Global Theme Styles-->
  <!--begin::Layout Themes(used by all pages)-->
  <link href="{{ asset('assets') }}/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets') }}/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets') }}/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets') }}/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
  <!--end::Layout Themes-->
  <link rel="shortcut icon" href="{{ asset('assets') }}/media/logos/favicon.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
  <!--begin::Main-->
  <!--begin::Header Mobile-->
  <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <!--begin::Logo-->
    <a href="index.html">
      <img alt="Logo" src="{{ asset('assets') }}/media/logos/logo-light.png" />
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <!--begin::Aside Mobile Toggle-->
      <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
        <span></span>
      </button>
      <!--end::Aside Mobile Toggle-->
      <!--begin::Header Menu Mobile Toggle-->
      <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
        <span></span>
      </button>
      <!--end::Header Menu Mobile Toggle-->
      <!--begin::Topbar Mobile Toggle-->
      <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
        <span class="svg-icon svg-icon-xl">
          <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/General/User.svg-->
          {!! file_get_contents('assets/media/svg/icons/General/User.svg') !!}
          <!--end::Svg Icon-->
        </span>
      </button>
      <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
  </div>
  <!--end::Header Mobile-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
      <!--begin::Aside-->
      <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
        <!--begin::Brand-->
        <div class="brand flex-column-auto" id="kt_brand">
          <!--begin::Logo-->
          <a href="index.html" class="brand-logo">
            <img alt="Logo" src="{{ asset('assets') }}/media/logos/logo-light.png" />
          </a>
          <!--end::Logo-->
          <!--begin::Toggle-->
          <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
              <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Navigation/Angle-double-left.svg-->
              {!! file_get_contents('assets/media/svg/icons/Navigation/Angle-double-left.svg') !!}
              <!--end::Svg Icon-->
            </span>
          </button>
          <!--end::Toolbar-->
        </div>
        <!--end::Brand-->
        <!--begin::Aside Menu-->
        <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
          <!--begin::Menu Container-->
          <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
            data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
              <li class="menu-item menu-item-active" aria-haspopup="true">
                <a href="index.html" class="menu-link">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Design/Layers.svg-->
                    {!! file_get_contents('assets/media/svg/icons/Design/Layers.svg') !!}
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Dashboard</span>
                </a>
              </li>
              <li class="menu-section">
                <h4 class="menu-text">Custom</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
              </li>
              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Layout/Layout-4-blocks.svg-->
                    {!! file_get_contents('assets/media/svg/icons/Layout/Layout-4-blocks.svg') !!}
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Applications</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                      <span class="menu-link">
                        <span class="menu-text">Applications</span>
                      </span>
                    </li>
                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                      <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-line">
                          <span></span>
                        </i>
                        <span class="menu-text">Users</span>
                        <span class="menu-label">
                          <span class="label label-rounded label-primary">6</span>
                        </span>
                        <i class="menu-arrow"></i>
                      </a>
                      <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                          <li class="menu-item" aria-haspopup="true">
                            <a href="custom/apps/user/list-default.html" class="menu-link">
                              <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                              </i>
                              <span class="menu-text">List - Default</span>
                            </a>
                          </li>
                          <li class="menu-item" aria-haspopup="true">
                            <a href="custom/apps/user/list-datatable.html" class="menu-link">
                              <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                              </i>
                              <span class="menu-text">List - Datatable</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
            <!--end::Menu Nav-->
          </div>
          <!--end::Menu Container-->
        </div>
        <!--end::Aside Menu-->
      </div>
      <!--end::Aside-->
      <!--begin::Wrapper-->
      <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
        <!--begin::Header-->
        <div id="kt_header" class="header header-fixed">
          <!--begin::Container-->
          <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
              <!--begin::Header Menu-->
              <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                <!--begin::Header Nav-->
                <div class="d-flex align-items-center flex-wrap">
                  <h3 class="text-dark font-weight-lighter mt-2">SIMONA Sekretariat DPRD Prov. Sultra</h3>
                </div>
                <!--end::Header Nav-->
              </div>
              <!--end::Header Menu-->
            </div>
            <!--end::Header Menu Wrapper-->
            <!--begin::Topbar-->
            <div class="topbar">
              <!--begin::User-->
              <div class="topbar-item">
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                  id="kt_quick_user_toggle">
                  <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                  <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">Sean</span>
                  <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                    <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                  </span>
                </div>
              </div>
              <!--end::User-->
            </div>
            <!--end::Topbar-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">


          <!--begin::Subheader-->
          <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
              <!--begin::Info-->
              <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <!--begin::Breadcrumb-->
                <div class="d-flex align-items-center font-weight-bold my-2">
                  <!--begin::Item-->
                  <a href="#" class="opacity-75 hover-opacity-100">
                    <i class="flaticon2-shelter text-muted icon-1x"></i>
                  </a>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <span class="label label-dot label-sm bg-white opacity-75 mx-1"></span>
                  <a href="{{ route('dashboard') }}"
                    class="text-muted text-hover-primary opacity-75 hover-opacity-100">Data</a>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <span class="label label-dot label-sm bg-white opacity-75 mx-1 bc-dot"
                    style="display: none;"></span>
                  <a href="{{ url()->current() }}#"
                    class="text-muted text-hover-primary opacity-75 hover-opacity-100 bc-title"
                    style="display: none;">Tambah Data</a>
                  <!--end::Item-->
                </div>
                <!--end::Breadcrumb-->
                <!--end::Actions-->
              </div>
              <!--end::Info-->
              <!--begin::Toolbar-->
              <div class="d-flex align-items-center">
                <!--begin::Actions-->

                <!--end::Actions-->
              </div>
              <!--end::Toolbar-->
            </div>
          </div>
          <!--end::Subheader-->


          <!--begin::Entry-->
          <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
              <!--begin::Dashboard-->
              <!--begin::Row-->
              <div class="row">

                <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">
                  <!--begin::List Widget 1-->
                  <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                      <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Tasks Overview</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">Pending 10 tasks</span>
                      </h3>
                      <div class="card-toolbar">
                        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions"
                          data-placement="left">
                          <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover py-5">
                              <li class="navi-item">
                                <a href="#" class="navi-link">
                                  <span class="navi-icon">
                                    <i class="flaticon2-drop"></i>
                                  </span>
                                  <span class="navi-text">New Group</span>
                                </a>
                              </li>
                            </ul>
                            <!--end::Navigation-->
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-8">
                      <!--begin::Item-->
                      <div class="d-flex align-items-center mb-10">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-light-primary mr-5">
                          <span class="symbol-label">
                            <span class="svg-icon svg-icon-xl svg-icon-primary">
                              <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Dashboard/Library.svg-->
                              {{-- {!! file_get_contents("assets/media/svg/icons/Dashboard/Library.svg") !!} --}}
                              <!--end::Svg Icon-->
                            </span>
                          </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column font-weight-bold">
                          <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Project
                            Briefing</a>
                          <span class="text-muted">Project Manager</span>
                        </div>
                        <!--end::Text-->
                      </div>
                      <!--end::Item-->
                    </div>
                    <!--end::Body-->
                  </div>
                  <!--end::List Widget 1-->
                </div>
                <div class="col-xxl-8 order-2 order-xxl-1">
                  <!--begin::Advance Table Widget 2-->
                  <div class="card card-custom card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                      <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">New Arrivals</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
                      </h3>
                      <div class="card-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                          <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_11_3">Day</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2 pb-0 mt-n3">
                      <div class="tab-content mt-5" id="myTabTables11">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_tab_pane_11_3" role="tabpanel"
                          aria-labelledby="kt_tab_pane_11_3">
                          <!--begin::Table-->
                          <div class="table-responsive">
                            <table class="table table-borderless table-vertical-center">
                              <thead>
                                <tr>
                                  <th class="p-0 w-40px"></th>
                                  <th class="p-0 min-w-200px"></th>
                                  <th class="p-0 min-w-100px"></th>
                                  <th class="p-0 min-w-125px"></th>
                                  <th class="p-0 min-w-110px"></th>
                                  <th class="p-0 min-w-150px"></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="pl-0 py-4">
                                    <div class="symbol symbol-50 symbol-light mr-1">
                                      <span class="symbol-label">
                                        <img src="{{ asset('assets') }}/media/svg/misc/006-plurk.svg"
                                          class="h-50 align-self-center" alt="" />
                                      </span>
                                    </div>
                                  </td>
                                  <td class="pl-0">
                                    <a href="#"
                                      class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Sant
                                      Outstanding</a>
                                    <div>
                                      <span class="font-weight-bolder">Email:</span>
                                      <a class="text-muted font-weight-bold text-hover-primary"
                                        href="#">bprow@bnc.cc</a>
                                    </div>
                                  </td>
                                  <td class="text-right">
                                    <span
                                      class="text-dark-75 font-weight-bolder d-block font-size-lg">$2,000,000</span>
                                    <span class="text-muted font-weight-bold">Paid</span>
                                  </td>
                                  <td class="text-right">
                                    <span class="text-muted font-weight-500">ReactJs, HTML</span>
                                  </td>
                                  <td class="text-right">
                                    <span class="label label-lg label-light-primary label-inline">Approved</span>
                                  </td>
                                  <td class="text-right pr-0">
                                    <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/General/Settings-1.svg-->
                                        {!! file_get_contents('assets/media/svg/icons/General/Settings-1.svg') !!}
                                        <!--end::Svg Icon-->
                                      </span>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                      <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Communication/Write.svg-->
                                        {!! file_get_contents('assets/media/svg/icons/Communication/Write.svg') !!}
                                        <!--end::Svg Icon-->
                                      </span>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/General/Trash.svg-->
                                        {!! file_get_contents('assets/media/svg/icons/General/Trash.svg') !!}
                                        <!--end::Svg Icon-->
                                      </span>
                                    </a>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <!--end::Table-->
                        </div>
                        <!--end::Tap pane-->
                      </div>
                    </div>
                    <!--end::Body-->
                  </div>
                  <!--end::Advance Table Widget 2-->
                </div>

              </div>
              <!--end::Row-->
              <!--end::Dashboard-->
            </div>
            <!--end::Container-->
          </div>
          <!--end::Entry-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
          <!--begin::Container-->
          <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
              <span class="text-muted font-weight-bold mr-2">2021©</span>
              <a href="http://keenthemes.com/metronic" target="_blank"
                class="text-dark-75 text-hover-primary">Keenthemes</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Nav-->
            <div class="nav nav-dark">
              <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-5">About</a>
              <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-5">Team</a>
              <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-0">Contact</a>
            </div>
            <!--end::Nav-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::Footer-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Page-->
  </div>
  <!--end::Main-->
  <!-- begin::User Panel-->
  <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
      <h3 class="font-weight-bold m-0">User Profile
        <small class="text-muted font-size-sm ml-2">12 messages</small>
      </h3>
      <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
        <i class="ki ki-close icon-xs text-muted"></i>
      </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
      <!--begin::Header-->
      <div class="d-flex align-items-center mt-5">
        <div class="symbol symbol-100 mr-5">
          <div class="symbol-label" style="background-image:url('{{ asset('assets') }}/media/users/300_21.jpg')">
          </div>
          <i class="symbol-badge bg-success"></i>
        </div>
        <div class="d-flex flex-column">
          <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">James Jones</a>
          <div class="text-muted mt-1">Application Developer</div>
          <div class="navi mt-2">
            <a href="#" class="navi-item">
              <span class="navi-link p-0 pb-2">
                <span class="navi-icon mr-1">
                  <span class="svg-icon svg-icon-lg svg-icon-primary">
                    <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Communication/Mail-notification.svg-->
                    {!! file_get_contents('assets/media/svg/icons/Communication/Mail-notification.svg') !!}
                    <!--end::Svg Icon-->
                  </span>
                </span>
                <span class="navi-text text-muted text-hover-primary">jm@softplus.com</span>
              </span>
            </a>
            <a href="#" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
          </div>
        </div>
      </div>
      <!--end::Header-->
      <!--begin::Separator-->
      <div class="separator separator-dashed mt-8 mb-5"></div>
      <!--end::Separator-->
      <!--begin::Nav-->
      <div class="navi navi-spacer-x-0 p-0">
        <!--begin::Item-->
        <a href="custom/apps/user/profile-1/personal-information.html" class="navi-item">
          <div class="navi-link">
            <div class="symbol symbol-40 bg-light mr-3">
              <div class="symbol-label">
                <span class="svg-icon svg-icon-md svg-icon-success">
                  <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/General/Notification2.svg-->
                  {!! file_get_contents('assets/media/svg/icons/General/Notification2.svg') !!}
                  <!--end::Svg Icon-->
                </span>
              </div>
            </div>
            <div class="navi-text">
              <div class="font-weight-bold">My Profile</div>
              <div class="text-muted">Account settings and more
                <span class="label label-light-danger label-inline font-weight-bold">update</span>
              </div>
            </div>
          </div>
        </a>
        <!--end:Item-->
        <!--begin::Item-->
        <a href="custom/apps/user/profile-3.html" class="navi-item">
          <div class="navi-link">
            <div class="symbol symbol-40 bg-light mr-3">
              <div class="symbol-label">
                <span class="svg-icon svg-icon-md svg-icon-warning">
                  <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Shopping/Chart-bar1.svg-->
                  {!! file_get_contents('assets/media/svg/icons/Shopping/Chart-bar1.svg') !!}
                  <!--end::Svg Icon-->
                </span>
              </div>
            </div>
            <div class="navi-text">
              <div class="font-weight-bold">My Messages</div>
              <div class="text-muted">Inbox and tasks</div>
            </div>
          </div>
        </a>
        <!--end:Item-->
        <!--begin::Item-->
        <a href="custom/apps/user/profile-2.html" class="navi-item">
          <div class="navi-link">
            <div class="symbol symbol-40 bg-light mr-3">
              <div class="symbol-label">
                <span class="svg-icon svg-icon-md svg-icon-danger">
                  <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Files/Selected-file.svg-->
                  {!! file_get_contents('assets/media/svg/icons/Files/Selected-file.svg') !!}
                  <!--end::Svg Icon-->
                </span>
              </div>
            </div>
            <div class="navi-text">
              <div class="font-weight-bold">My Activities</div>
              <div class="text-muted">Logs and notifications</div>
            </div>
          </div>
        </a>
        <!--end:Item-->
        <!--begin::Item-->
        <a href="custom/apps/userprofile-1/overview.html" class="navi-item">
          <div class="navi-link">
            <div class="symbol symbol-40 bg-light mr-3">
              <div class="symbol-label">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                  <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Communication/Mail-opened.svg-->
                  {!! file_get_contents('assets/media/svg/icons/Communication/Mail-opened.svg') !!}
                  <!--end::Svg Icon-->
                </span>
              </div>
            </div>
            <div class="navi-text">
              <div class="font-weight-bold">My Tasks</div>
              <div class="text-muted">latest tasks and projects</div>
            </div>
          </div>
        </a>
        <!--end:Item-->
      </div>
      <!--end::Nav-->
    </div>
    <!--end::Content-->
  </div>
  <!-- end::User Panel-->
  <!--begin::Scrolltop-->
  <div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
      <!--begin::Svg Icon | path:{{ asset('assets') }}/media/svg/icons/Navigation/Up-2.svg-->
      {!! file_get_contents('assets/media/svg/icons/Navigation/Up-2.svg') !!}
      <!--end::Svg Icon-->
    </span>
  </div>
  <!--end::Scrolltop-->
  <script>
    var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
  </script>
  <!--begin::Global Config(global config for global JS scripts)-->
  <script>
    var KTAppSettings = {
      "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1400
      },
      "colors": {
        "theme": {
          "base": {
            "white": "#ffffff",
            "primary": "#3699FF",
            "secondary": "#E5EAEE",
            "success": "#1BC5BD",
            "info": "#8950FC",
            "warning": "#FFA800",
            "danger": "#F64E60",
            "light": "#E4E6EF",
            "dark": "#181C32"
          },
          "light": {
            "white": "#ffffff",
            "primary": "#E1F0FF",
            "secondary": "#EBEDF3",
            "success": "#C9F7F5",
            "info": "#EEE5FF",
            "warning": "#FFF4DE",
            "danger": "#FFE2E5",
            "light": "#F3F6F9",
            "dark": "#D6D6E0"
          },
          "inverse": {
            "white": "#ffffff",
            "primary": "#ffffff",
            "secondary": "#3F4254",
            "success": "#ffffff",
            "info": "#ffffff",
            "warning": "#ffffff",
            "danger": "#ffffff",
            "light": "#464E5F",
            "dark": "#ffffff"
          }
        },
        "gray": {
          "gray-100": "#F3F6F9",
          "gray-200": "#EBEDF3",
          "gray-300": "#E4E6EF",
          "gray-400": "#D1D3E0",
          "gray-500": "#B5B5C3",
          "gray-600": "#7E8299",
          "gray-700": "#5E6278",
          "gray-800": "#3F4254",
          "gray-900": "#181C32"
        }
      },
      "font-family": "Poppins"
    };
  </script>
  <!--end::Global Config-->
  <!--begin::Global Theme Bundle(used by all pages)-->
  <script src="{{ asset('assets') }}/plugins/global/plugins.bundle.js"></script>
  <script src="{{ asset('assets') }}/plugins/custom/prismjs/prismjs.bundle.js"></script>
  <script src="{{ asset('assets') }}/js/scripts.bundle.js"></script>
  <!--end::Global Theme Bundle-->
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('assets') }}/js/pages/widgets.js"></script>
  <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
