@if(count($gbr) > 0)
<div class="row">
    @if($gbr[0]->paruparu != NULL)
    <div class="col-md-12">
        <label for="" class="text-md">Pergerakan bola mata</label>
        <img src="{{ $gbr[0]->paruparu }}" alt="">
    </div>
    <div class="col-md-12">
        
    </div>
    @endif
</div>
@else
Tidak ada penandaan gambar
@endif