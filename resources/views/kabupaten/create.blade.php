@extends('layouts.template')

@section('subheader')
  <x-subheader title="Kabupaten" route="kabupaten.index">
    <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('kabupaten.index') }}"
      class="btn-sm btn-light-primary mr-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('kabupaten.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Tambah Kabupaten</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 bgi-no-repeat"
              style="background-position: center; background-size: 80% auto; background-image: url({{ asset('assets/media/bg/working.png') }})">
            </div>
            <div class="col-md-6">
              <x-validation.txt-stack type="text" name="name" placeholder="Nama Daerah" value="{{ old('name') }}"
                :messages="$errors->get('name')">Nama
                Daerah
                <x-redstar /></x-validation.txt-stack>
              <x-validation.select-stack name="status" :items="$status" :old="old('status')" :messages="null">
                Status <x-redstar />
              </x-validation.select-stack>

              <x-validation.txt-stack type="text" name="jumlah_dpt" placeholder="Jumlah DPT"
                oninput="formatRupiah(this, '.')" value="{{ old('jumlah_dpt') }}" :messages="$errors->get('jumlah_dpt')">Jumlah
                DPT</x-validation.txt-stack>

            </div>
          </div>
        </div>
        <x-form2.submit-group :route="route('kabupaten.index')" />
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
  <script src="{{ asset('js') }}/new/app.js"></script>
  <!--end::Page Scripts-->
@endpush
