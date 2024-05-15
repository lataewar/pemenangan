@extends('layouts.template')

@section('subheader')
  <x-subheader-dinamyc title="Kecamatan">
    @slot('routes', $routes)
    <div class="default-btns">
      <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('kecamatan.index', ['kab' => $kab->id]) }}"
        class="btn-sm btn-light-primary mr-2">
        Kembali</x-btn.a-weight-bold-svg>
    </div>
  </x-subheader-dinamyc>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('kecamatan.store', ['kab' => $kab->id]) }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Kecamatan</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-2 bgi-no-repeat">
            </div>
            <div class="col-md-8">
              <x-validation.txt-stack type="text" value="{{ $kab->name }}" disabled :messages="null">Nama
                {{ $kab->status }}</x-validation.txt-stack>
              <x-validation.txt-stack type="text" name="name" placeholder="Nama Kecamatan"
                value="{{ old('name') }}" :messages="$errors->get('name')">Nama
                Kecamatan
                <x-redstar /></x-validation.txt-stack>

            </div>
            <div class="col-md-2 bgi-no-repeat">
            </div>
          </div>
        </div>
        <x-form2.submit-group :route="route('kecamatan.index', ['kab' => $kab->id])" />
      </div>

    </div>
  </form>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/new/app.js"></script>
  <!--end::Page Scripts-->
@endpush
