<div class="card card-custom gutter-b viewtable">
  <div class="card-body">
    <form action="{{ route('dpt.multdelete') }}" id="form-multdelete">
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
            <th>Nama DPT</th>
            <th>Desa/Kelurahan</th>
            <th>TPS</th>
            <th>Alamat</th>
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