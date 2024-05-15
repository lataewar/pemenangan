<div class="col-md-11 mt-1 mb-2">
  <div class="row border-bottom bg-secondary">
    <div class="col-sm-3 font-size-sm">No. Urut</div>
    <div class="col-sm-5 font-size-sm">Nama Calon</div>
    <div class="col-sm-4 font-size-sm text-right">Jumlah Suara</div>
  </div>
  @foreach ($data as $item)
    <div class="row border-bottom @if ($item->is_selected) bg-primary text-white @endif">
      <div class="col-sm-3 font-size-sm">{{ $item->no_urut }}</div>
      <div class="col-sm-5 font-size-sm">{{ $item->name }}</div>
      <div class="col-sm-4 font-size-sm text-right">{{ formatNomor($item->pivot->suara) }}</div>
    </div>
  @endforeach
</div>
