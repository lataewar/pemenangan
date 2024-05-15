@extends('layouts.template')

@push('css')
<link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
<x-subheader-dinamyc title="Sub Menu">
   @slot('routes', $routes)
  <div class="default-btns">
    <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('menu.index') }}" class="btn-sm btn-light-success mr-2">
      Menu</x-btn.a-weight-bold-svg>

    <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;" class="btn-sm btn-light-danger mr-2 btn-multdelete">
      Hapus Terpilih</x-btn.weight-bold-svg> 

    <x-btn.weight-bold-svg svg="Design/Flatten.svg" onclick="create()" class="btn-sm btn-light-success btn-create">
      Tambah Data</x-btn.weight-bold-svg>
  </div>
  <x-btn.weight-bold-svg svg="Navigation/Angle-left.svg" style="display: none;" class="btn-sm btn-light-primary ml-2 btn-back">
    Kembali</x-btn.weight-bold-svg>
</x-subheader-dinamyc>
@endsection

@section('content')
<!--begin::Card-->
<input type="hidden" id="urx" value="{{ URL('menu/submenu/' . $id) }}">
<div class="viewdata">

</div>
<!--end::Card-->
@endsection

@push('js')
<script>
  const columns = [
    {
      data: null,
      sortable: false,
      render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      },
    },
    { data: 'name', name: 'name' },
    { data: 'route', name: 'route' },
    { data: 'icon', name: 'icon' },
    { data: 'desc', name: 'desc' },
    { data: 'aksi', name: 'aksi' },
  ];
  const columnDefs = [
    { targets: [0, 5], orderable: false, className: 'text-center' },
    { targets: [1, 2, 3, 4], orderable: true },
  ];
  const forms = ['name', 'route'];
</script>
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('js') }}/bootstrap_.js"></script>
<script src="{{ asset('js') }}/app.js"></script>
<script src="{{ asset('js') }}/dt.js"></script>
{{-- <script src="{{ asset('js') }}/dt-bind.js"></script> --}}
<!--end::Page Scripts-->
@endpush