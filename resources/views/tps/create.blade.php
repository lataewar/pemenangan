@extends('layouts.template')

@section('subheader')
  <x-subheader title="TPS" route="tps.index">
    <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('tps.index') }}"
      class="btn-sm btn-light-primary mr-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <input type="hidden" id="kec_url" value="{{ URL('getkec') }}">
  <input type="hidden" id="kel_url" value="{{ URL('getkel') }}">
  <form action="{{ route('tps.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah TPS</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 bgi-no-repeat">
              <x-validation.select-stack-with-default id='selector1' name="kabupaten_id" :items="$kabupatens"
                :old="old('kabupaten_id')" :messages="$errors->get('kabupaten_id')">
                Kabupaten/Kota <x-redstar />
              </x-validation.select-stack-with-default>
              <x-validation.select-stack-with-default id='selector2' name="kecamatan_id" :items="[]"
                :old="old('kecamatan_id')" :messages="$errors->get('kecamatan_id')">
                Kecamatan <x-redstar />
              </x-validation.select-stack-with-default>
              <x-validation.select-stack-with-default id='selector3' name="kelurahan_id" :items="[]"
                :old="old('kelurahan_id')" :messages="$errors->get('kelurahan_id')">
                Desa/Kelurahan <x-redstar />
              </x-validation.select-stack-with-default>
            </div>
            <div class="col-md-6">
              <x-validation.txt-stack type="text" name="name" placeholder="Nama TPS" value="{{ old('name') }}"
                :messages="$errors->get('name')">Nama
                TPS
                <x-redstar /></x-validation.txt-stack>
              <x-validation.txtarea-stack name="alamat" placeholder="Alamat" :messages="$errors->get('alamat')">
                @slot('title')
                  Alamat
                @endslot
              </x-validation.txtarea-stack>
              <x-validation.txtarea-stack name="desc" placeholder="Deskripsi" :messages="$errors->get('desc')">
                @slot('title')
                  Deskripsi
                @endslot
              </x-validation.txtarea-stack>

            </div>
          </div>
        </div>
        <x-form2.submit-group :route="route('tps.index')" />
      </div>
    </div>
  </form>
  <!--end::Card-->
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      selector();
      $("#selector1").select2({
        placeholder: "Pilih salah satu..."
      });
      $("#selector2").select2({
        placeholder: "Pilih salah satu..."
      });
      $("#selector3").select2({
        placeholder: "Pilih salah satu..."
      });
    });
  </script>
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/new/app.js"></script>
  <script src="{{ asset('js') }}/new/select3.js"></script>
  <!--end::Page Scripts-->
@endpush