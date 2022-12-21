<div class="container-fluid mb-4">
    @if(count($gbr) > 0)
    <form action="" class="formkandungan">
        <table class="table table-sm">
            <tr>
                <td class="text-bold bg-dark" colspan="2">Riwayat Kesehatan</td>
            </tr>
            <tr>
                <td>Menarrche umur</td>
                <td><input type="text" class="form-control" id="menarcheumur" name="menarcheumur"></td>
            </tr>
            <tr>
                <td>Siklus</td>
                <td><input type="text" class="form-control" id="siklus" name="siklus"></td>
            </tr>
            <tr>
                <td>HPHT</td>
                <td><input type="text" class="form-control" id="hpht" name="hpht"></td>
            </tr>
            <tr>
                <td>TP</td>
                <td><input type="text" class="form-control" id="tp" name="tp"></td>
            </tr>
            <tr>
                <td>UK</td>
                <td><input type="text" class="form-control" id="uk" name="uk"></td>
            </tr>
            <tr>
                <td>Hamil Ke -</td>
                <td><input type="text" class="form-control" id="hamilke" name="hamilke"></td>
            </tr>
            <tr>
                <td>Riwayat KB</td>
                <td><input type="text" class="form-control" id="riwayatkb" name="riwayatkb"></td>
            </tr>
            <table class="table table-sm">
                <tr>
                    <td class="text-bold bg-dark">Riwayat Ginkeologi</td>
                </tr>
                <tr>
                    <td>
                        <textarea class="form-control" id="riwayatginkeologi" name="riwayatginkeologi"></textarea>
                    </td>
                </tr>
            </table>
        </table>
        <table class="table table-sm">
            <tr class="bg-dark">
                <td colspan="3" class="text-bold">Pemeriksaan Fisik</td>
            </tr>
            <tr class="text-bold bg-info">
                <td>Kepala</td>
                <td>Buah Dada</td>
                <td>Ekstremitas Bawah</td>
            </tr>
            <tr class="text-bold">
                <td>Kelopak Mata <input type="text" class="form-control" id="kelopakmata" name="kelopakmata"></td>
                <td>Puting <input type="text" class="form-control" id="puting" name="puting"></td>
                <td>
                    <div class="form-group form-check mt-4">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Tidak ada keluhan</label>
                    </div>
                </td>
            </tr>
            <tr class="text-bold">
                <td>Konjungtiva <input type="text" class="form-control" id="konjungtiva" name="konjungtiva"></td>
                <td>Asi <input type="text" class="form-control" id="asi" name="asi"></td>
                <td>
                    <div class="form-group form-check mt-4">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Oedema</label>
                    </div>
                </td>
            </tr>
            <tr class="text-bold">
                <td>Sclera <input type="text" class="form-control" id="sclera" name="sclera"></td>
                <td>Kebersihan <input type="text" class="form-control" id="kebersihan" name="kebersihan"></td>
                <td>
                    <div class="form-group form-check mt-4">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Varices</label>
                    </div>
                </td>
            </tr>
            <tr class="text-bold">
                <td>Lain - lain <input type="text" class="form-control" id="kepalalain" name="kepalalain"></td>
                <td>Lain - lain <input type="text" class="form-control" id="buahdadalain" name="buahdadalain"></td>
                <td>Lain - lain <input type="text" class="form-control" id="ekslain" name="ekslain"></td>
            </tr>
        </table>
        <table class="table table-sm">
            <tr class="text-bold bg-dark">
                <td colspan="2">Abdomen</td>
            </tr>
            <tr>
                <td>LEOPOLD I : Tinggi Fundus Uteri</td>
                <td><input type="text" class="form-control" id="leopold1" name="leopold1"></td>
            </tr>
            <tr>
                <td>LEOPOLD II</td>
                <td><input type="text" class="form-control" id="leopold2" name="leopold2"></td>
            </tr>
            <tr>
                <td>LEOPOLD III</td>
                <td><input type="text" class="form-control" id="leopold3" name="leopold3"></td>
            </tr>
            <tr>
                <td>LEOPOLD IV</td>
                <td><input type="text" class="form-control" id="leopold4" name="leopold4"></td>
            </tr>
        </table>
        <table class="table table-sm">
            <tr>
                <td colspan="2" class="text-bold bg-dark">PEMERIKSAAN GINKEOLOGI</td>
            </tr>
            <tr>
                <td>Palpasi</td>
                <td><input type="text" class="form-control" id="palpasi" name="palpasi"></td>
            </tr>
            <tr>
                <td>Inspekulo</td>
                <td><input type="text" class="form-control" id="inspekulo" name="inspekulo"></td>
            </tr>
            <tr>
                <td>Pemeriksaan dalam </td>
                <td><input type="text" class="form-control" id="pemeriksaandalam" name="pemeriksaandalam"></td>
            </tr>
        </table>
        <button type="button" class="btn btn-success simpanformobgyn">Simpan</button>
    </form>
    @else
    <form action="" class="formkandungan">
        <table class="table table-sm">
            <tr>
                <td class="text-bold bg-dark" colspan="2">Riwayat Kesehatan</td>
            </tr>
            <tr>
                <td>Menarrche umur</td>
                <td><input type="text" class="form-control" id="menarcheumur" name="menarcheumur"></td>
            </tr>
            <tr>
                <td>Siklus</td>
                <td><input type="text" class="form-control" id="siklus" name="siklus"></td>
            </tr>
            <tr>
                <td>HPHT</td>
                <td><input type="text" class="form-control" id="hpht" name="hpht"></td>
            </tr>
            <tr>
                <td>TP</td>
                <td><input type="text" class="form-control" id="tp" name="tp"></td>
            </tr>
            <tr>
                <td>UK</td>
                <td><input type="text" class="form-control" id="uk" name="uk"></td>
            </tr>
            <tr>
                <td>Hamil Ke -</td>
                <td><input type="text" class="form-control" id="hamilke" name="hamilke"></td>
            </tr>
            <tr>
                <td>Riwayat KB</td>
                <td><input type="text" class="form-control" id="riwayatkb" name="riwayatkb"></td>
            </tr>
            <table class="table table-sm">
                <tr>
                    <td class="text-bold bg-dark">Riwayat Ginkeologi</td>
                </tr>
                <tr>
                    <td>
                        <textarea class="form-control" id="riwayatginkeologi" name="riwayatginkeologi"></textarea>
                    </td>
                </tr>
            </table>
        </table>
        <table class="table table-sm">
            <tr class="bg-dark">
                <td colspan="3" class="text-bold">Pemeriksaan Fisik</td>
            </tr>
            <tr class="text-bold bg-info">
                <td>Kepala</td>
                <td>Buah Dada</td>
                <td>Ekstremitas Bawah</td>
            </tr>
            <tr class="text-bold">
                <td>Kelopak Mata <input type="text" class="form-control" id="kelopakmata" name="kelopakmata"></td>
                <td>Puting <input type="text" class="form-control" id="puting" name="puting"></td>
                <td>
                    <div class="form-group form-check mt-4">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Tidak ada keluhan</label>
                    </div>
                </td>
            </tr>
            <tr class="text-bold">
                <td>Konjungtiva <input type="text" class="form-control" id="konjungtiva" name="konjungtiva"></td>
                <td>Asi <input type="text" class="form-control" id="asi" name="asi"></td>
                <td>
                    <div class="form-group form-check mt-4">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Oedema</label>
                    </div>
                </td>
            </tr>
            <tr class="text-bold">
                <td>Sclera <input type="text" class="form-control" id="sclera" name="sclera"></td>
                <td>Kebersihan <input type="text" class="form-control" id="kebersihan" name="kebersihan"></td>
                <td>
                    <div class="form-group form-check mt-4">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Varices</label>
                    </div>
                </td>
            </tr>
            <tr class="text-bold">
                <td>Lain - lain <input type="text" class="form-control" id="kepalalain" name="kepalalain"></td>
                <td>Lain - lain <input type="text" class="form-control" id="buahdadalain" name="buahdadalain"></td>
                <td>Lain - lain <input type="text" class="form-control" id="ekslain" name="ekslain"></td>
            </tr>
        </table>
        <table class="table table-sm">
            <tr class="text-bold bg-dark">
                <td colspan="2">Abdomen</td>
            </tr>
            <tr>
                <td>LEOPOLD I : Tinggi Fundus Uteri</td>
                <td><input type="text" class="form-control" id="leopold1" name="leopold1"></td>
            </tr>
            <tr>
                <td>LEOPOLD II</td>
                <td><input type="text" class="form-control" id="leopold2" name="leopold2"></td>
            </tr>
            <tr>
                <td>LEOPOLD III</td>
                <td><input type="text" class="form-control" id="leopold3" name="leopold3"></td>
            </tr>
            <tr>
                <td>LEOPOLD IV</td>
                <td><input type="text" class="form-control" id="leopold4" name="leopold4"></td>
            </tr>
        </table>
        <table class="table table-sm">
            <tr>
                <td colspan="2" class="text-bold bg-dark">PEMERIKSAAN GINKEOLOGI</td>
            </tr>
            <tr>
                <td>Palpasi</td>
                <td><input type="text" class="form-control" id="palpasi" name="palpasi"></td>
            </tr>
            <tr>
                <td>Inspekulo</td>
                <td><input type="text" class="form-control" id="inspekulo" name="inspekulo"></td>
            </tr>
            <tr>
                <td>Pemeriksaan dalam </td>
                <td><input type="text" class="form-control" id="pemeriksaandalam" name="pemeriksaandalam"></td>
            </tr>
        </table>
        <button type="button" class="btn btn-success simpanformobgyn">Simpan</button>
    </form>
    @endif
</div>
<script>
    $('.simpanformobgyn').click(function() {
        spinner = $('#loader2');
        spinner.show();
        var data = $('.formkandungan').serializeArray();
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
            url: '<?= route('simpanformobgyn') ?>',
            error: function(data) {
                spinner.hide()
                console.log(data)
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                console.log(data)
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
</script>