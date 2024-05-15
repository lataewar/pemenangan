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
  <input type="hidden" id="ceknik_url" value="{{ URL('ceknik') }}">
  <form action="{{ route('dpt.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah DPT</h3>
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
              <x-validation.select-stack-with-default id='selector4' name="tps_id" :items="[]" :old="old('tps_id')"
                :messages="$errors->get('tps_id')">
                TPS <x-redstar />
              </x-validation.select-stack-with-default>
            </div>
            <div class="col-md-6">


              <div class="form-group">
                <label>NIK <x-redstar /></label>
                <div class="input-group">
                  <input type="text" name="nik" id="nik"
                    class="form-control @if ($errors->get('nik')) is-invalid @endif" placeholder="NIK"
                    value="{{ old('nik') }}" />
                  <div class="input-group-append">
                    <button class="btn btn-primary" id="ceknik" type="button">
                      <i id="ikon" class="la la-search pb-1"></i>Cek
                    </button>
                  </div>
                  <x-validation.input-error :messages="$errors->get('nik')" />
                </div>
              </div>


              <x-validation.txt-stack type="text" id="nama" name="name" placeholder="Nama dpt"
                value="{{ old('name') }}" :messages="$errors->get('name')">Nama
                <x-redstar /></x-validation.txt-stack>
              <x-validation.txt-stack type="text" name="no_tlp" placeholder="No. Telpon" value="{{ old('no_tlp') }}"
                :messages="$errors->get('no_tlp')">No. Telpon
              </x-validation.txt-stack>
              <x-validation.txtarea-stack id="alamat" name="alamat" placeholder="Alamat" :messages="$errors->get('alamat')">
                @slot('title')
                  Alamat
                @endslot
              </x-validation.txtarea-stack>
              <x-validation.txtarea-stack id="desc" name="desc" placeholder="Deskripsi" :messages="$errors->get('desc')">
                @slot('title')
                  Deskripsi
                @endslot
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
  <script src="{{ asset('js') }}/new/ceknik.js"></script>
  <!--end::Page Scripts-->
@endpush
