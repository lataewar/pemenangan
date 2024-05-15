<!--Begin::Header-->
<div class="card-header card-header-tabs-line">
  <div class="card-toolbar">
    <span class="nav-icon mr-2">
      <span class="svg-icon mr-3">
        {!! file_get_contents("assets/media/svg/icons/".$svg) !!}
      </span>
    </span>
    <span class="nav-text font-weight-bold">{{ $slot }}</span>
  </div>
</div>
<!--end::Header-->