@if(count($gbr) > 0)
<div class="row">
    @if($gbr[0]->telingakanan != NULL)
    <div class="col-md-2">
        <label for="" class="text-md">Telinga Kanan</label>
        <img src="{{ $gbr[0]->telingakanan }}" alt="">
    </div>
    @endif
    @if($gbr[0]->telingakiri != NULL)
    <div class="col-md-2">
        <label for="" class="text-md">Telinga Kiri</label>
        <img src="{{ $gbr[0]->telingakiri }}" alt="">
    </div>
    @endif
    @if($gbr[0]->faring != NULL)
    <div class="col-md-2">
        <label for="" class="text-md">Faring</label>
        <img src="{{ $gbr[0]->faring }}" alt="">
    </div>
    @endif
    @if($gbr[0]->laring != NULL)
    <div class="col-md-2">
        <label for="" class="text-md">Laring</label>
        <img src="{{ $gbr[0]->laring }}" alt="">
    </div>
    @endif
    @if($gbr[0]->leherkepala != NULL)
    <div class="col-md-2">
        <label for="" class="text-md">Leher dan Kepala</label>
        <img src="{{ $gbr[0]->leherkepala }}" alt="">
    </div>
    @endif
    @if($gbr[0]->maksilofasial != NULL)
    <div class="col-md-2">
        <label for="" class="text-md">Maksilofasial</label>
        <img src="{{ $gbr[0]->maksilofasial }}" alt="">
    </div>
    @endif
</div>
@else
Tidak ada penandaan gambar
@endif