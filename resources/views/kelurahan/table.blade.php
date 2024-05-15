<div class="card card-custom gutter-b viewtable">
  <div class="card-body">
    <div class="col-xl-12">
      <!--begin:: Form-->
      <div class="form mb-5">
        <div class="row justify-content-center">
          <h3 class="text-dark font-weight-bold mb-10">Data Desa/Kelurahan</h3>
        </div>
        <input type="hidden" id="kec_url" value="{{ URL('getkec') }}">
        <div class="row d-flex">
          <div class="col-md-4">
            <div class="form-group">
              <label>Kabupaten
                <span class="text-danger">*</span></label>
              <select class="form-control" id="selector2">
                <option value="" hidden>Pilih Kabupaten/Kota...</option>
                @foreach ($kabs as $item)
                  @if ($kec && $kec->kabupaten_id == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                  @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Kecamatan
                <span class="text-danger">*</span></label>
              <select class="form-control" id="selector1">
                <option value="" hidden>Pilih Kecamatan...</option>
                @if ($kec)
                  @foreach ($kecs as $item)
                    @if ($id && $id == $item->id)
                      <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                  @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>&nbsp;
              </label>
              <button onclick="getSelected('{{ URL('kelurahan') }}')" class="btn btn-primary d-flex flex-nowrap">
                <i class="la la-refresh">
                </i>Proses
              </button>
            </div>
          </div>
        </div>
      </div>
      <!--end::Form-->
    </div>
    <hr />
    <form action="{{ route('kelurahan.multdelete', ['kec' => $id]) }}" id="form-multdelete">
      @csrf
      <!--begin: Datatable-->
      <table class="table table-hover" id="KTDatatable">
        <thead>
          <tr>
            <th>
              <label class="checkbox checkbox-single">
                <input type="checkbox" id="check-all" />
                <span></span>
              </label>
            </th>
            <th>No</th>
            <th>Nama Daerah</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
      <!--end: Datatable-->
    </form>
  </div>
</div>
<script>
  $(document).ready(function() {
    dataKec();
    $("#selector1").select2({
      placeholder: "Pilih salah satu..."
    });
    $("#selector2").select2({
      placeholder: "Pilih salah satu..."
    });
    if ($("#selector1").val()) {
      $(".default-btns").show();
    }
  });
</script>
