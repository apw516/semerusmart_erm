<div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-8">
        
    </div>
</div>

<div class="btn-group mt-3" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="gigi">Pemeriksaan Gigi</button>
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
    @if($gbr[0]->gigi != (NULL))
    <div class="col-md-12">
        <p class="text-lg">Pemeriksaan Gigi</p>
        <img src="{{ $gbr[0]->gigi }}" alt="">
    </div>
    @endif
</div>
@else
Belum ada gambar yang ditandai...!<br>
@endif

