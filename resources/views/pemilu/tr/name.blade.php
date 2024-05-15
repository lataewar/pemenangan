<div class="font-weight-bold text-primary">{{ $data->tps->name }}</div>
<div class="text-muted">Alamat : {{ $data->tps->alamat }}</div>

<div class="col-md-11 mt-1">
  <div class="row border-bottom">
    <div class="col-sm-8 font-size-sm">Jumlah DPT</div>
    <div class="col-sm-4 text-right font-size-sm">{{ formatNomor($data->jml_dpt) }}</div>
  </div>
  <div class="row border-bottom">
    <div class="col-sm-8 font-size-sm">Jumlah Suara</div>
    <div class="col-sm-4 text-sm-right font-size-sm">{{ formatNomor($data->jml_suara) }}</div>
  </div>
  <div class="row border-bottom">
    <div class="col-sm-8 font-size-sm">Jumlah Suara Batal</div>
    <div class="col-sm-4 text-right font-size-sm">
      <div class="text-right">{{ formatNomor($data->jml_suara_batal) }}</div>
    </div>
  </div>
</div>
