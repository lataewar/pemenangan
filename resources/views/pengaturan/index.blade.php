@extends('layouts.template')

@section('subheader')
  <x-subheader title="Pengaturan Perhitungan" route="pengaturan.index">
  </x-subheader>
@endsection

@section('content')
  <!--begin::Card-->
  <form action="{{ route('pengaturan.store') }}" class="row" method="POST">
    @csrf
    <div class="col-md-6">
      <div class="card card-custom card-stretch gutter-b">
        <div class="card-header">
          <h3 class="card-title">Data Pengaturan</h3>
        </div>
        <div class="card-body">

          <input type="hidden" name="id" value="{{ $data->id ?? null }}">
          <x-validation.txt-stack type="number" min="0" max="100" name="target_persentase"
            placeholder="Jumlah DPT" value="{{ old('target_persentase') ?? ($data->target_persentase ?? 0) }}"
            :messages="$errors->get('target_persentase')">Target
            Persentase</x-validation.txt-stack>

        </div>
        <x-form2.submit-group :route="route('pengaturan.index')" />
      </div>
    </div>
  </form>
  <!--end::Card-->
@endsection

@push('js')
  @include('sweetalert::alert')
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/new/app.js"></script>
  <!--end::Page Scripts-->
@endpush
