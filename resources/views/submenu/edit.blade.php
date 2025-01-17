<form action="{{ route('submenu.update', ['menu' => $menu, 'submenu' => $data->id]) }}" class="row editform" id="editform" method="POST">
  @method('PUT')
  @csrf
  <div class="col-md-12">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header">
        <h3 class="card-title">Edit SubMenu</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <x-form.txt-stack name="name" id="name" placeholder="Nama" value="{{ $data->name }}" >Nama SubMenu <x-redstar /></x-form.txt-stack>
            <x-form.txt-stack name="route" id="route" placeholder="Route" value="{{ $data->route }}" >Route </x-form.txt-stack>
          </div>
          <div class="col-md-6">
            <x-form.txt-stack name="icon" id="icon" placeholder="Icon" value="{{ $data->icon }}" >Icon </x-form.txt-stack>
            <x-form.txtarea-stack name="desc" id="desc" placeholder="Keterangan">
              @slot('title') Keterangan @endslot
              {{ $data->desc }}
            </x-form.txtarea-stack>
          </div>
        </div>
      </div>
      <x-form.submit-group2 />
    </div>
  
    {{-- <div class="card card-custom card-stretch gutter-b"> --}}
    <div class="card card-custom bgi-no-repeat gutter-b" >
    </div>
  </div>
  <script src="{{ asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-switch.js"></script>


</form>