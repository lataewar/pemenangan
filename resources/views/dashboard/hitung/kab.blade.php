@extends('layouts.template')

@push('css')
@endpush

@section('subheader')
  <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <!--begin::Info-->
      <div class="d-flex align-items-center flex-wrap mr-1">
        <!--begin::Page Heading-->
        <div class="d-flex align-items-baseline flex-wrap mr-5">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
          <!--end::Page Title-->
          <!--begin::Breadcrumb-->
          <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
              <a href="{{ route('dashboard.hitung') }}" class="text-muted">Kabupaten/Kota</a>
            </li>
          </ul>
          <!--end::Breadcrumb-->
        </div>
        <!--end::Page Heading-->
      </div>
      <!--end::Info-->
      <!--begin::Toolbar-->
      <div class="d-flex align-items-center">
        <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('dashboard') }}"
          class="btn-sm btn-light-primary mr-2">
          Kembali</x-btn.a-weight-bold-svg>
      </div>
      <!--end::Toolbar-->
    </div>
  </div>
@endsection

@section('content')
  <div class="card card-custom">
    <div class="card-header card-header-tabs-line">
      <div class="card-title">
        <h3 class="card-label">Perhitungan</h3>
      </div>
      <div class="card-toolbar">
        <ul class="nav nav-tabs nav-bold nav-tabs-line">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#table_tab_pane">
              <span class="nav-icon"><i class="flaticon2-indent-dots"></i></span>
              <span class="nav-text">Tabel</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#chart_tab_pane">
              <span class="nav-icon"><i class="flaticon2-graphic-1"></i></span>
              <span class="nav-text">Grafik</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="table_tab_pane" role="tabpanel" aria-labelledby="table_tab_pane">
          <!--begin: Datatable-->
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th class="text-center" width="10%">No</th>
                <th width="30%">Kabupaten / Kota </th>
                <th class="text-center" width="50%">Alokasi Suara</th>
                <th class="text-center" width="10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)
                <tr class="align-top">
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td class="font-weight-bold text-primary">
                    {{ $item->status . ' ' . $item->name }}
                  </td>
                  <td>
                    <div class="col-md-11 mt-1 mb-2">
                      <div class="row border-bottom bg-secondary">
                        <div class="col-sm-2 font-size-sm">No. Urut</div>
                        <div class="col-sm-5 font-size-sm">Nama Calon</div>
                        <div class="col-sm-3 font-size-sm text-right">Suara</div>
                        <div class="col-sm-2 font-size-sm text-right">%</div>
                      </div>
                      @php
                        $count_suara = 0;
                        foreach ($item->calons as $value) {
                            $count_suara += $value->suaras;
                        }
                      @endphp
                      @foreach ($item->calons as $value)
                        <div class="row border-bottom @if ($value->is_selected) bg-primary text-white @endif">
                          <div class="col-sm-2 font-size-sm">{{ $value->no_urut }}</div>
                          <div class="col-sm-5 font-size-sm">{{ $value->name }}</div>
                          <div class="col-sm-3 font-size-sm text-right">{{ formatNomor($value->suaras) }}</div>
                          <div class="col-sm-2 font-size-sm text-right">
                            {{ round(($value->suaras * 100) / $count_suara, 1) }} %</div>
                        </div>
                      @endforeach
                    </div>

                  </td>
                  <td class="text-center">
                    <a href='{{ route('dashboard.hitung.kec', ['kab' => $item->id]) }}'
                      class='btn btn-sm btn-clean btn-icon mr-2' title='Detail'>
                      <span class='svg-icon svg-icon-md'>
                        {!! file_get_contents('assets/media/svg/icons/Code/Compiling.svg') !!}
                      </span>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <!--end: Datatable-->
        </div>
        <div class="tab-pane fade" id="chart_tab_pane" role="tabpanel" aria-labelledby="chart_tab_pane">
          <!--begin::Chart-->
          <div id="pie_chart" class="d-flex justify-content-center"></div>
          <!--end::Chart-->
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    const series_2 = [
      @foreach ($pie_chart['suaras'] as $item)
        {{ $item }},
      @endforeach
    ];
    const labels_2 = [
      @foreach ($pie_chart['calon'] as $item)
        "{{ $item }}",
      @endforeach
    ];
    const colors_2 = [
      @foreach ($pie_chart['is_selected'] as $item)
        "{{ $item }}",
      @endforeach
    ];
  </script>
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/new/apexpiecharts.js"></script>
  <script src="{{ asset('js') }}/new/app.js"></script>
  <!--end::Page Scripts-->
@endpush
