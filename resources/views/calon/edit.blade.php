@extends('layouts.template')

@section('subheader')
  <x-subheader title="Calon" route="calon.index">
    <x-btn.a-weight-bold-svg svg="Navigation/Angle-left.svg" href="{{ route('calon.index') }}"
      class="btn-sm btn-light-primary mr-2">
      Kembali</x-btn.a-weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('calon.update', ['calon' => $data->id]) }}" class="row" method="POST">
    @method('PUT')
    @csrf
    <div class="col-md-12">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Ubah Calon</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 bgi-no-repeat"
              style="background-position: center; background-size: 80% auto; background-image: url({{ asset('assets/media/bg/working.png') }})">
            </div>
            <div class="col-md-6">
              <input type="hidden" name="id" value="{{ $data->id }}">
              <x-validation.txt-stack type="text" name="name" placeholder="Nama Calon"
                value="{{ old('name') ?? $data->name }}" :messages="$errors->get('name')">Nama Calon <x-redstar />
              </x-validation.txt-stack>
              <x-validation.txt-stack type="text" name="no_urut" placeholder="Nomor Urut"
                value="{{ old('no_urut') ?? $data->no_urut }}" :messages="$errors->get('no_urut')">Nomor Urut <x-redstar />
              </x-validation.txt-stack>

              <x-validation.txtarea-stack name="desc" placeholder="Deskripsi" :messages="$errors->get('desc')">
                @slot('title')
                  Deskripsi
                @endslot
                {{ old('desc') ?? $data->desc }}
              </x-validation.txtarea-stack>
            </div>
          </div>
        </div>
        <x-form2.submit-group :route="route('calon.index')" />
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