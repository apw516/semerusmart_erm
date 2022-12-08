<div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-8">
        
    </div>
</div>

<div class="btn-group mt-3" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="tkan">Telinga Kanan</button>
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="tkir">Telinga Kiri</button>
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="far">Faring</button>
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="lar">Laring</button>
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="maks">Maksilofasiall</button>
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="leh">Leher Dan Kepala</button>
</div>
<script>
    $(document).ready(function() {
        $('.btn-piilih-gambar').click(function() {
            spinner = $('#loader2');
            spinner.show();
            id = $(this).attr('jg')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id,
                    kodekunjungan: $('#kodekunjungan').val()
                },
                url: '<?= route('ambilgambar') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooops....',
                        text: 'Sepertinya ada masalah......',
                        footer: ''
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.tampilgambar').html(response)
                }
            });
        });
    });
</script>
<div class="tampilgambar">

</div>
@if(count($gbr) > 0)
<div class="row mt-3">
    @if($gbr[0]->telingakanan != (NULL))
    <div class="col-md-2">
        <p class="text-lg">Telinga Kanan</p>
        <img src="{{ $gbr[0]->telingakanan }}" alt="">
    </div>
    @endif
    @if($gbr[0]->telingakiri != (NULL))
    <div class="col-md-2">
    <p class="text-lg">Telinga Kiri</p>
        <img src="{{ $gbr[0]->telingakiri }}" alt="">
    </div>
    @endif
    @if($gbr[0]->faring != (NULL))
    <div class="col-md-2">
    <p class="text-lg">Faring</p>
        <img src="{{ $gbr[0]->faring }}" alt="">
    </div>
    @endif
    @if($gbr[0]->laring != (NULL))
    <div class="col-md-2">
    <p class="text-lg">Laring</p>
        <img src="{{ $gbr[0]->laring }}" alt="">
    </div>
    @endif
    @if($gbr[0]->leherkepala != (NULL))
    <div class="col-md-2">
    <p class="text-lg">Leher dan Kepala</p>
        <img src="{{ $gbr[0]->leherkepala }}" alt="">
    </div>
    @endif
    @if($gbr[0]->maksilofasial != (NULL))
    <div class="col-md-2">
    <p class="text-lg">Maksilofasial</p>
        <img src="{{ $gbr[0]->maksilofasial }}" alt="">
    </div>
    @endif
</div>
@else
Belum ada gambar yang ditandai...!<br>
@endif

