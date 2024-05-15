<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-2">
      <!--begin::Page Title-->
      <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $title }}</h5>
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
        @foreach ($routes as $route)
          <span class="label label-dot label-sm bg-white opacity-75 mx-1"></span>
          <a href="{{ $route['route'] }}" class="text-muted text-hover-primary opacity-75 hover-opacity-100">{{ $route['name'] }}</a>
          @if ($loop->first)
            <div class="subheader-separator subheader-separator-ver my-2 ml-4 bg-gray-200"></div>
          @endif
        @endforeach
        <!--end::Item-->
        <div class="subheader-separator subheader-separator-ver my-2 ml-4 bg-gray-200 bc-dot" style="display: none;"></div>
        <!--begin::Item-->
        <span class="label label-dot label-sm bg-white opacity-75 mx-1 bc-dot" style="display: none;"></span>
        <a href="{{ url()->current() }}#" class="text-muted text-hover-primary opacity-75 hover-opacity-100 bc-title" style="display: none;">Tambah Data</a>
        <!--end::Item-->
      </div>
      <!--end::Breadcrumb-->
      <!--end::Actions-->
    </div>
    <!--end::Info-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <!--begin::Actions-->
      {{ $slot }}
      <!--end::Actions-->
    </div>
    <!--end::Toolbar-->
  </div>
</div>