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
              <a href="{{ route('dashboard.target') }}" class="text-muted">Kabupaten/Kota</a>
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
        <h3 class="card-label">Target ({{ $target }}%)</h3>
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
                <th class="text-center" width="15%">Jumlah DPT </th>
                <th class="text-center" width="15%">Terget </th>
                <th class="text-center" width="15%">Realisasi</th>
                <th class="text-center" width="15%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                $t_jumlah_dpt = 0;
                $t_target = 0;
                $t_suaras = 0;
              @endphp
              @foreach ($data as $item)
                @php
                  $t_jumlah_dpt += $item->jumlah_dpt;
                  $t_target += $item->target;
                  $t_suaras += $item->suaras;
                  $color = $item->suaras >= $item->target ? 'text-success' : 'text-danger';
                @endphp
                <tr class="align-top">
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td class="font-weight-bold text-primary">
                    {{ $item->status . ' ' . $item->name }}
                  </td>
                  <td class="text-center">{{ formatNomor($item->jumlah_dpt) }}</td>
                  <td class="text-center">{{ formatNomor($item->target) }}</td>
                  <td class="text-center {{ $color }}">{{ formatNomor($item->suaras) }}</td>
                  <td class="text-center">
                    <a href='{{ route('dashboard.target.kec', ['kab' => $item->id]) }}'
                      class='btn btn-sm btn-clean btn-icon mr-2' title='Detail'>
                      <span class='svg-icon svg-icon-md'>
                        {!! file_get_contents('assets/media/svg/icons/Code/Compiling.svg') !!}
                      </span>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th></th>
                <th>Total</th>
                <th class="text-center">{{ formatNomor($t_jumlah_dpt) }}</th>
                <th class="text-center">{{ formatNomor($t_target) }}</th>
                <th class="text-center">{{ formatNomor($t_suaras) }}</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
          <!--end: Datatable-->
        </div>
        <div class="tab-pane fade" id="chart_tab_pane" role="tabpanel" aria-labelledby="chart_tab_pane">
          <!--begin::Chart-->
          <div id="column_chart"></div>
          <!--end::Chart-->
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    const series_1 = [{
        name: "Jumlah DPT",
        // data: [44, 55, 57, 56, 61],
        data: [
          @foreach ($column_chart['jumlah_dpt'] as $item)
            {{ $item }},
          @endforeach
        ],
      },
      {
        name: "Target",
        // data: [76, 85, 101, 98, 87],
        data: [
          @foreach ($column_chart['target'] as $item)
            {{ $item }},
          @endforeach
        ],
      },
      {
        name: "Realisasi",
        // data: [35, 41, 36, 26, 45],
        data: [
          @foreach ($column_chart['realisasi'] as $item)
            {{ $item }},
          @endforeach
        ],
      },
    ];
    const categories_1 = [
      @foreach ($column_chart['categories'] as $item)
        "{{ $item }}",
      @endforeach
    ];
  </script>
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('js') }}/new/apexcolcharts.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/new/app.js"></script>
  <!--end::Page Scripts-->
@endpush
