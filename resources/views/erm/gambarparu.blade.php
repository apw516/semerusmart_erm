<div class="container">
    <div class="btn-group mt-3" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-danger btn-piilih-gambar" jg="paru">Palpasi</button>
    </div>
    <div class="tampilgambar">

    </div>
</div>
<div class="container mt-2">
    <table class="table table-sm">
        <tr>
            <td class="text-bold">Inspeksi</td>
            <td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Simetris</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">Asimetris</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-control" >
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-bold text-center bg-dark">Palpasi</td>
        </tr>
        <tr class="text-bold">
            <td>Sela Iga</td>
            <td><input type="text" class="form-control"></td>
        </tr>
        <tr class="text-bold">
            <td>Vocal fremitus</td>
            <td><input type="text" class="form-control"></td>
        </tr>
        <tr class="text-bold text-center bg-dark">
            <td colspan="2">Perkusi</td>
        </tr>
        <tr class="text-bold">
            <td>Sonar</td>
            <td><input type="text" class="form-control"></td>
        </tr>
        <tr class="text-bold">
            <td>Hipersonar</td>
            <td><input type="text" class="form-control"></td>
        </tr>
        <tr class="text-bold text-center bg-dark">
            <td colspan="2">Auskultasi</td>
        </tr>
        <tr class="text-bold">
            <td>Vesikuler</td>
            <td><input type="text" class="form-control"></td>
        </tr>
        <tr class="text-bold">
            <td>Ronchi</td>
            <td><input type="text" class="form-control"></td>
        </tr>
        <tr class="text-bold">
            <td>Wheezing</td>
            <td><input type="text" class="form-control"></td>
        </tr>
    </table>
    <button class="btn btn-success mb-3">Simpan</button>
</div>
@if(count($gbr) > 0)
<div class="row mt-3">
    @if($gbr[0]->paruparu != (NULL))
    <div class="col-md-12">
        <p class="text-lg">Posisi dan Pergerakan Bola Mata</p>
        <img src="{{ $gbr[0]->paruparu }}" alt="">
    </div>
    @else
    <div class="container mt-3">
        <h5 class="text-danger">
            Belum ada gambar yang ditandai...!<br>
        </h5>
    </div>
    @endif
</div>
@else
Belum ada gambar yang ditandai...!<br>
@endif

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