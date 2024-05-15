@extends('layouts.template')

@section('subheader')
  <x-subheader title="DPT" route="dpt.index">
    <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('dpt.index') }}"
      class="btn-sm btn-light-primary mr-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <input type="hidden" id="kec_url" value="{{ URL('getkec') }}">
  <input type="hidden" id="kel_url" value="{{ URL('getkel') }}">
  <input type="hidden" id="tps_url" value="{{ URL('gettps') }}">
  <form action="{{ route('dpt.update', ['dpt' => $data->id]) }}" class="row" method="POST">
    @method('PUT')
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Ubah DPT</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 bgi-no-repeat">
              <x-validation.select-stack-with-default id='selector1' name="kabupaten_id" :items="$kabupatens"
                :old="old('kabupaten_id')" :messages="$errors->get('kabupaten_id')">
                Kabupaten/Kota <x-redstar />
                @slot('current', $kabupaten_id)
              </x-validation.select-stack-with-default>
              <x-validation.select-stack-with-default id='selector2' name="kecamatan_id" :items="$kecamatans"
                :old="old('kecamatan_id')" :messages="$errors->get('kecamatan_id')">
                Kecamatan <x-redstar />
                @slot('current', $kecamatan_id)
              </x-validation.select-stack-with-default>
              <x-validation.select-stack-with-default id='selector3' name="kelurahan_id" :items="$kelurahans"
                :old="old('kelurahan_id')" :messages="$errors->get('kelurahan_id')">
                Desa/Kelurahan <x-redstar />
                @slot('current', $data->kelurahan_id)
              </x-validation.select-stack-with-default>
              <x-validation.select-stack-with-default id='selector4' name="tps_id" :items="$tps" :old="old('tps_id')"
                :messages="$errors->get('tps_id')">
                TPS <x-redstar />
                @slot('current', $data->tps_id)
              </x-validation.select-stack-with-default>
            </div>
            <div class="col-md-6">
              <x-validation.txt-stack type="text" name="name" placeholder="Nama TPS" value="{{ old('name') }}"
                value="{{ old('name') ?? $data->name }}" :messages="$errors->get('name')">Nama
                TPS
                <x-redstar /></x-validation.txt-stack>
              <x-validation.txt-stack type="text" name="nik" placeholder="NIK" value="{{ old('nik') }}"
                value="{{ old('nik') ?? $data->nik }}" :messages="$errors->get('nik')">NIK
                <x-redstar /></x-validation.txt-stack>
              <x-validation.txt-stack type="text" name="no_tlp" placeholder="Nama TPS" value="{{ old('no_tlp') }}"
                value="{{ old('no_tlp') ?? $data->no_tlp }}" :messages="$errors->get('no_tlp')">No. Telpon
              </x-validation.txt-stack>
              <x-validation.txtarea-stack name="alamat" placeholder="Alamat" :messages="$errors->get('alamat')">
                @slot('title')
                  Alamat
                @endslot
                {{ old('alamat') ?? $data->alamat }}
              </x-validation.txtarea-stack>
              <x-validation.txtarea-stack name="desc" placeholder="Deskripsi" :messages="$errors->get('desc')">
                @slot('title')
                  Deskripsi
                @endslot
                {{ old('desc') ?? $data->desc }}
              </x-validation.txtarea-stack>

            </div>
          </div>
        </div>
        <x-form2.submit-group :route="route('dpt.index')" />
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
      $("#selector4").select2({
        placeholder: "Pilih salah satu..."
      });
    });
  </script>
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/new/app.js"></script>
  <script src="{{ asset('js') }}/new/select4.js"></script>
  <!--end::Page Scripts-->
@endpush
