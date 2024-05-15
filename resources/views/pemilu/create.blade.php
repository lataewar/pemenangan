@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/filepond/filepond.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets') }}/filepond/filepond-plugin-image-preview.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Perhitungan" route="pemilu.index">
    <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('pemilu.index') }}"
      class="btn-sm btn-light-primary mr-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <input type="hidden" id="file_url" value="{{ URL('') }}">
  <input type="hidden" id="tps_url" value="{{ URL('selecttps') }}">
  <form action="{{ route('pemilu.store') }}" class="row" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-md-6">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Data TPS</h3>
        </div>
        <div class="card-body">

          <x-validation.select-stack-with-default class="select2" id='kt_select2_6' name="tps_id" :items="[]"
            :messages="$errors->get('tps_id')">
            TPS <x-redstar />
          </x-validation.select-stack-with-default>

          <x-validation.txt-stack type="text" name="jml_dpt" placeholder="Jumlah DPT" value="{{ old('jml_dpt') }}"
            oninput="formatRupiah(this, '.')" :messages="$errors->get('jml_dpt')">Jumlah DPT <x-redstar />
          </x-validation.txt-stack>

          <div class="row">
            <div class="col-md-6">
              <x-validation.txt-stack type="text" name="jml_suara" placeholder="Jumlah Suara"
                value="{{ old('jml_suara') }}" oninput="formatRupiah(this, '.')" :messages="$errors->get('jml_suara')">Jumlah Suara
                <x-redstar />
              </x-validation.txt-stack>
            </div>
            <div class="col-md-6">
              <x-validation.txt-stack type="text" name="jml_suara_batal" placeholder="Jumlah Suara Batal"
                value="{{ old('jml_suara_batal') }}" oninput="formatRupiah(this, '.')" :messages="$errors->get('jml_suara_batal')">Jumlah Suara
                Batal <x-redstar />
              </x-validation.txt-stack>
            </div>
          </div>


          <x-validation.txtarea-stack name="desc" placeholder="Deskripsi" :messages="$errors->get('desc')">
            @slot('title')
              Deskripsi
            @endslot
            {{ old('desc') }}
          </x-validation.txtarea-stack>

          <div class="form-group">
            <label>Foto</label>
            <input type="file" class="filepond" name="file">
          </div>

        </div>
      </div>

      {{-- <div class="card card-custom card-stretch gutter-b"> --}}
      <div class="card card-custom bgi-no-repeat gutter-b">
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Alokasi Suara</h3>
        </div>
        <div class="card-body">

          {{-- @if ($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
          @endif --}}

          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col" width="35%">Nama Calon</th>
                <th scope="col" width="15%">No Urut</th>
                <th scope="col" width="15%">Status</th>
                <th scope="col" width="30%">Jumlah Suara</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($calons as $item)
                <tr @if ($item->is_selected) class="table-primary" @endif>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->no_urut }}</td>
                  <td>
                    @if ($item->is_selected)
                      <span class="label label-inline label-light-primary font-weight-bold">
                        didukung
                      </span>
                    @else
                      <span class="label label-inline label-light-danger font-weight-bold">
                        lain
                      </span>
                    @endif
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text"
                        class="form-control form-control-sm @if ($errors->get('suara.' . $item->id)) is-invalid @endif"
                        name="suara[{{ $item->id }}]" value="{{ old('suara')[$item->id] ?? '' }}"
                        oninput="formatRupiah(this, '.')" placeholder="Jumlah Suara" />
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
        <x-form2.submit-group :route="route('pemilu.index')" />
      </div>

      {{-- <div class="card card-custom card-stretch gutter-b"> --}}
      <div class="card card-custom bgi-no-repeat gutter-b">
      </div>
    </div>
  </form>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('assets') }}/filepond/filepond.min.js"></script>
  <script src="{{ asset('assets') }}/filepond/filepond.jquery.js"></script>
  <script src="{{ asset('assets') }}/filepond/filepond-plugin-image-preview.min.js"></script>
  <script src="{{ asset('assets') }}/filepond/filepond-plugin-file-validate-size.min.js"></script>
  <script src="{{ asset('assets') }}/filepond/filepond-plugin-file-validate-type.min.js"></script>
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/new/app.js"></script>
  <script src="{{ asset('js') }}/new/select-search.js"></script>
  <script src="{{ asset('js') }}/filepond.js"></script>
  <!--end::Page Scripts-->
@endpush
