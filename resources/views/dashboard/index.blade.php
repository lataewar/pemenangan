@extends('layouts.template')

@section('subheader')
  <x-subheader title="Dashboard" route="dashboard">

  </x-subheader>
@endsection

@section('content')
  @include('dashboard.chart1')

  @include('dashboard.chart2')
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
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
  <script src="{{ asset('js') }}/new/apexpiecharts.js"></script>
  <script src="{{ asset('js') }}/new/apexcolcharts.js"></script>
  <script src="{{ asset('js') }}/bootstrap_.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/dashboard.js"></script>
  <!--end::Page Vendors-->
@endpush
