@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader-dinamyc title="Kelurahan">
    @slot('routes', $routes)

    <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
      class="btn-sm btn-light-danger mr-2 btn-multdelete">
      Hapus Terpilih</x-btn.weight-bold-svg>

    <div class="default-btns" style="display: none;">
      <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('kecamatan.index') }}"
        class="btn-sm btn-light-success mr-2">
        Kecamatan</x-btn.a-weight-bold-svg>

      <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('kelurahan.create', ['kec' => $id]) }}"
        class="btn-sm btn-light-success mr-2">
        Tambah Data</x-btn.a-weight-bold-svg>
    </div>
  </x-subheader-dinamyc>
@endsection

@section('content')
  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ URL('kelurahan/' . $id) }}">
  <div class="viewdata">

  </div>
  <!--end::Card-->
@endsection

@push('js')
  <script>
    const columns = [{
        data: 'cb',
        name: 'cb'
      },
      {
        data: null,
        sortable: false,
        render: function(data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      {
        data: 'name',
        name: 'name'
      },
      {
        data: 'aksi',
        name: 'aksi'
      },
    ];
    const columnDefs = [{
        targets: [0, 1, 3],
        orderable: false,
        className: 'text-center',
      },
      {
        targets: [2],
        orderable: true,
      },
    ];
  </script>
  @include('sweetalert::alert')
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/new/app.js"></script>
  <script src="{{ asset('js') }}/new/dt.js"></script>
  <script src="{{ asset('js') }}/new/select2.js"></script>
  <!--end::Page Scripts-->
@endpush
