<div class="container">
    <div class="btn-group mt-3" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-danger btn-piilih-gambar" jg="paru">Palpasi</button>
    </div>
    <div class="tampilgambar">

    </div>
</div>
@if(count($gbr) > 0)
<div class="container mt-2">
    <form action="" class="formparuparu">
    <table class="table table-sm">
        <tr>
            <td class="text-bold">Inspeksi</td>
            <td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Inspeksi" id="Inspeksi" value="Simetris" @if($gbr[0]->Inspeksi == 'Simetris' )checked @endif>
                    <label class="form-check-label" for="inlineRadio1">Simetris</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Inspeksi" id="Inspeksi" value="Asimetris" @if($gbr[0]->Inspeksi == 'Asimetris' )checked @endif>
                    <label class="form-check-label" for="inlineRadio2">Asimetris</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-control" name="keteranganinspeksi" id="keteranganinspeksi" value="{{ $gbr[0]->keteranganinspeksi }}">
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-bold text-center bg-dark">Palpasi</td>
        </tr>
        <tr class="text-bold">
            <td>Sela Iga</td>
            <td><input type="text" class="form-control" name="selaiga" id="selaiga" value="{{ $gbr[0]->selaiga }}"></td>
        </tr>
        <tr class="text-bold">
            <td>Vocal fremitus</td>
            <td><input type="text" class="form-control" name="vocalfremitus" id="vocalfremitus" value="{{ $gbr[0]->vocalfremitus }}"></td>
        </tr>
        <tr class="text-bold text-center bg-dark">
            <td colspan="2">Perkusi</td>
        </tr>
        <tr class="text-bold">
            <td>Sonar</td>
            <td><input type="text" class="form-control" id="sonar" name="sonar" value="{{ $gbr[0]->sonar }}"></td>
        </tr>
        <tr class="text-bold">
            <td>Hipersonar</td>
            <td><input type="text" class="form-control" id="hipersonar" name="hipersonar" value="{{ $gbr[0]->hipersonar }}"></td>
        </tr>
        <tr class="text-bold text-center bg-dark">
            <td colspan="2">Auskultasi</td>
        </tr>
        <tr class="text-bold">
            <td>Vesikuler</td>
            <td><input type="text" class="form-control" name="vesikuler" id="vesikuler" value="{{ $gbr[0]->vesikuler }}"></td>
        </tr>
        <tr class="text-bold">
            <td>Ronchi</td>
            <td><input type="text" class="form-control" name="ronchi" id="ronchi" value="{{ $gbr[0]->ronchi }}"></td>
        </tr>
        <tr class="text-bold">
            <td>Wheezing</td>
            <td><input type="text" class="form-control" name="wheezing" id="wheezing" value="{{ $gbr[0]->wheezing }}"></td>
        </tr>
    </table>
    <button type="button" class="btn btn-success mb-3 simpanformparu">Simpan</button>
    </form>
</div>
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
<div class="container mt-2">
    <form action="" class="formparuparu">
    <table class="table table-sm">
        <tr>
            <td class="text-bold">Inspeksi</td>
            <td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Inspeksi" id="Inspeksi" value="Simetris" checked>
                    <label class="form-check-label" for="inlineRadio1">Simetris</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Inspeksi" id="Inspeksi" value="Asimetris">
                    <label class="form-check-label" for="inlineRadio2">Asimetris</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-control" name="keteranganinspeksi" id="keteranganinspeksi" value="Tidak Ada">
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-bold text-center bg-dark">Palpasi</td>
        </tr>
        <tr class="text-bold">
            <td>Sela Iga</td>
            <td><input type="text" class="form-control" name="selaiga" id="selaiga"></td>
        </tr>
        <tr class="text-bold">
            <td>Vocal fremitus</td>
            <td><input type="text" class="form-control" name="vocalfremitus" id="vocalfremitus"></td>
        </tr>
        <tr class="text-bold text-center bg-dark">
            <td colspan="2">Perkusi</td>
        </tr>
        <tr class="text-bold">
            <td>Sonar</td>
            <td><input type="text" class="form-control" id="sonar" name="sonar"></td>
        </tr>
        <tr class="text-bold">
            <td>Hipersonar</td>
            <td><input type="text" class="form-control" id="hipersonar" name="hipersonar"></td>
        </tr>
        <tr class="text-bold text-center bg-dark">
            <td colspan="2">Auskultasi</td>
        </tr>
        <tr class="text-bold">
            <td>Vesikuler</td>
            <td><input type="text" class="form-control" name="vesikuler" id="vesikuler"></td>
        </tr>
        <tr class="text-bold">
            <td>Ronchi</td>
            <td><input type="text" class="form-control" name="ronchi" id="ronchi"></td>
        </tr>
        <tr class="text-bold">
            <td>Wheezing</td>
            <td><input type="text" class="form-control" name="wheezing" id="wheezing"></td>
        </tr>
    </table>
    <button type="button" class="btn btn-success mb-3 simpanformparu">Simpan</button>
    </form>
</div>
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
        $('.simpanformparu').click(function() {
            spinner = $('#loader2');
            spinner.show();
            var data = $('.formparuparu').serializeArray();
            kodekunjungan = $('#kodekunjungan').val()
            data = JSON.stringify(data)
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data,
                    kodekunjungan
                },
                url: '<?= route('simpanformparu') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooops....',
                        text: 'Sepertinya ada masalah......',
                        footer: ''
                    })
                },
                success: function(data) {
                    spinner.hide()
                    if (data.kode == 500) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: data.message,
                            footer: ''
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'OK',
                            text: data.message,
                            footer: ''
                        })
                        cek_resume()
                    }
                }
            });
        })
    });
</script>