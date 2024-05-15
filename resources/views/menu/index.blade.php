@extends('layouts.template')

@push('css')
<link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
<x-subheader title="Menu" route="menu.index">
  <div class="default-btns">
    <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;" class="btn-sm btn-light-danger mr-2 btn-multdelete">
      Hapus Terpilih</x-btn.weight-bold-svg> 

    <x-btn.weight-bold-svg svg="Design/Flatten.svg" onclick="create()" class="btn-sm btn-light-success btn-create">
      Tambah Data</x-btn.weight-bold-svg>
  </div>
  <x-btn.weight-bold-svg svg="Navigation/Angle-left.svg" style="display: none;" class="btn-sm btn-light-primary ml-2 btn-back">
    Kembali</x-btn.weight-bold-svg>
</x-subheader>
@endsection

@section('content')
<!--begin::Card-->
<input type="hidden" id="urx" value="{{ URL('menu') }}">
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
    { data: 'has_submenu', name: 'has_submenu' },
    { data: 'desc', name: 'desc' },
    { data: 'aksi', name: 'aksi' },
  ];
  const columnDefs = [
    { targets: [0, 6], orderable: false, className: 'text-right' },
    { targets: [4], orderable: true, className: 'text-center' },
    { targets: [1, 2, 3, 5], orderable: true },
  ];
  const forms = ['name'];
</script>
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('js') }}/bootstrap_.js"></script>
<script src="{{ asset('js') }}/app.js"></script>
<script src="{{ asset('js') }}/dt.js"></script>
<!--end::Page Scripts-->
@endpush