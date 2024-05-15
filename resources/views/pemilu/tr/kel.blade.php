<div class="font-weight-bold mb-1">
  {{ $kel->status == 'Desa' ? $kel->status . ' ' . $kel->name : 'Kel. ' . $kel->name }}
</div>
<div class="text-muted">Kec. {{ $kec->name }}</div>
<div class="text-muted">
  {{ $kab->status == 'Kota' ? $kab->status . ' ' . $kab->name : 'Kab. ' . $kab->name }}
</div>
