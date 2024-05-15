<div class="row">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-lg-3">
        <div class="row">
          <div class="col-lg-12">
            <!--begin::Tiles Widget 12-->
            <div class="card card-custom gutter-b" style="height: 150px">
              <div class="card-body">
                <span class="svg-icon svg-icon-3x svg-icon-primary">
                  {!! file_get_contents('assets/media/svg/icons/Home/Flower2.svg') !!}
                </span>
                <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{ count($pie_chart['calon']) }}
                </div>
                <a href="{{ route('calon.index') }}"
                  class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Jumlah Calon</a>
              </div>
            </div>
            <!--end::Tiles Widget 12-->
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <!--begin::Tiles Widget 11-->
            <div class="card card-custom bg-success gutter-b" style="height: 150px">
              <div class="card-body">
                <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                  {!! file_get_contents('assets/media/svg/icons/General/Half-heart.svg') !!}
                </span>
                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">
                  {{ formatNomor($pemilu_count) }} TPS
                </div>
                <a href="{{ route('pemilu.index') }}"
                  class="text-inverse-success font-weight-bold font-size-lg mt-1">Jumlah sura masuk</a>
              </div>
            </div>
            <!--end::Tiles Widget 11-->
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <!--begin::Mixed Widget 14-->
            <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b card-stretch"
              style="background-image: url({{ asset('assets') }}/media/stock-600x600/img-16.jpg)">
              <!--begin::Body-->
              <div class="card-body d-flex flex-column align-items-start justify-content-start">
                <div class="p-1 flex-grow-1">
                  <h3 class="text-white font-weight-bolder line-height-lg mb-5">Perhitungan suara
                  </h3>
                </div>
                <a href='{{ route('dashboard.hitung') }}' class="btn btn-link btn-link-warning font-weight-bold">Detail
                  <span class="svg-icon svg-icon-lg svg-icon-warning">
                    {!! file_get_contents('assets/media/svg/icons/Navigation/Arrow-right.svg') !!}
                  </span></a>
              </div>
              <!--end::Body-->
            </div>
            <!--end::Mixed Widget 14-->
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <!--begin::Card-->
        <div class="card card-custom gutter-b card-stretch">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Perhitungan Suara</h3>
            </div>
          </div>
          <div class="card-body">
            <!--begin::Chart-->
            <div id="pie_chart" class="d-flex justify-content-center"></div>
            <!--end::Chart-->
          </div>
        </div>
        <!--end::Card-->
      </div>
    </div>
  </div>
</div>
