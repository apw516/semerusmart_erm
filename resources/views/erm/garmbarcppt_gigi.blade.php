@if(count($gbr) > 0)
<div class="row">
    @if($gbr[0]->gigi != NULL)
    <div class="col-md-12">
        <label for="" class="text-md">Pemeriksaan Gigi</label>
        <img src="{{ $gbr[0]->gigi }}" alt="">
    </div>
    @endif
</div>
@else
Tidak ada penandaan gambar
@endif