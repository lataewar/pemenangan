@extends('layouts.template')

@section('subheader')
  <x-subheader-dinamyc title="Desa/Kelurahan">
    @slot('routes', $routes)
    <div class="default-btns">
      <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('kelurahan.index', ['kec' => $kec->id]) }}"
        class="btn-sm btn-light-primary mr-2">
        Kembali</x-btn.a-weight-bold-svg>
    </div>
  </x-subheader-dinamyc>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('kelurahan.update', ['kec' => $kec->id, 'kelurahan' => $data->id]) }}" class="row"
    method="POST">
    @method('PUT')
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Ubah Desa/Kelurahan</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-2 bgi-no-repeat">
            </div>
            <div class="col-md-8">
              <input type="hidden" name="id" value="{{ $data->id }}">
              <x-validation.txt-stack type="text" value="{{ $kec->name }}" disabled :messages="null">Nama
                Kecamatan</x-validation.txt-stack>

              <x-validation.txt-stack type="text" name="name" placeholder="Nama Kecamatan"
                value="{{ old('name') ?? $data->name }}" :messages="$errors->get('name')">Nama
                Daerah
                <x-redstar /></x-validation.txt-stack>

              <x-validation.select-stack name="status" :items="$status" :old="old('status')" :messages="null">
                Status <x-redstar />
                @slot('current', $data->status)
              </x-validation.select-stack>
            </div>
            <div class="col-md-2 bgi-no-repeat">
            </div>
          </div>
        </div>
        <x-form2.submit-group :route="route('kelurahan.index', ['kec' => $kec->id])" />
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
