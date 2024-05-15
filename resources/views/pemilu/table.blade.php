<div class="card card-custom gutter-b viewtable">
  <div class="card-body">
    <form action="{{ route('pemilu.multdelete') }}" id="form-multdelete">
      @csrf
      <!--begin: Datatable-->
      <table class="table table-hover table-bordered" id="KTDatatable">
        <thead>
          <tr>
            <th width="5%">
              <label class="checkbox checkbox-single">
                <input type="checkbox" id="check-all" />
                <span></span>
              </label>
            </th>
            <th width="5%">No</th>
            <th width="30%">TPS</th>
            <th width="20%">Desa / Kelurahan</th>
            <th width="30%">Alokasi Suara</th>
            <th width="10%" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
      <!--end: Datatable-->
    </form>
  </div>
</div>
