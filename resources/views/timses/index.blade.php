@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Tim Sukses" route="timses.index">
    <div class="default-btns">
      <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
        class="btn-sm btn-light-danger mr-2 btn-multdelete">
        Hapus Terpilih</x-btn.weight-bold-svg>

      <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('timses.create') }}"
        class="btn-sm btn-light-success mr-2">
        Tambah Data</x-btn.a-weight-bold-svg>
    </div>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ URL('timses') }}">
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
        data: 'kelurahan',
        name: 'kelurahan.name'
      },
      {
        data: 'no_tlp',
        name: 'no_tlp'
      },
      {
        data: 'alamat',
        name: 'alamat'
      },
      {
        data: 'aksi',
        name: 'aksi'
      },
    ];
    const columnDefs = [{
        targets: [0, 1, 6],
        orderable: false,
        className: 'text-center',
      },
      {
        targets: [4],
        orderable: false,
      },
      {
        targets: [2, 3, 5],
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
  <!--end::Page Scripts-->
@endpush
