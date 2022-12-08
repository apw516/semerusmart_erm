<input hidden type="text" id="imagestring">
<div style="align-items: left; padding-top: 40px;">
    <p class="text-xl mb-3">Telinga Kiri</p>
    @if(count($gbr) > 0)
    @if($gbr[0]->telingakiri != NULL )
    <button class="btn btn-success mt-2" onclick="saveimage()">Update</button>
    <button class="btn btn-danger mt-2 hapusgambar" gambar="telingakiri" onclick="hapustanda()">Hapus</button>
    <button class="btn btn-info mt-2" onclick="reloadgbr()">Batal</button>

    <img id="gambarnya" width="20%"   src="{{ $gbr[0]->telingakiri }}" onclick="showMarkerArea(this);" />
    @else
    <img id="gambarnya" width="340px"   src="{{ asset('public/img/telingakiri.png') }}" onclick="showMarkerArea(this);" />
    <button class="btn btn-success mt-2" onclick="saveimage()">Simpan</button>
    @endif
    @else
    <img id="gambarnya" width="340px"   src="{{ asset('public/img/telingakiri.png') }}" onclick="showMarkerArea(this);" />
    <button class="btn btn-success mt-2" onclick="saveimage()">Simpan</button>
    @endif
</div>

<canvas hidden id="myCanvas" width="340" height="450" style="border:1px solid #d3d3d3;">
    Your browser does not support the HTML5 canvas tag.
</canvas>

<script>
    function saveimage() {
        var canvas = document.getElementById("myCanvas");
        var ctx = canvas.getContext("2d");
        var img = document.getElementById("gambarnya");
        ctx.drawImage(img, 10, 10);
        var canvas = document.getElementById("myCanvas");
        var dataUrl = canvas.toDataURL();
        $('#imagestring').val(dataUrl)
        img = $('#imagestring').val()
        kodekunjungan = $('#kodekunjungan').val()
        id= 'telingakiri'
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                img,
                kodekunjungan,
                id
            },
            url: '<?= route('simpangambar') ?>',
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
                Swal.fire({
                    icon: 'success',
                    title: 'OK',
                    text: 'Gambar sudah disimpan !',
                    footer: ''
                })
                reloadgbr()
            }
        });
    }
</script>
<script>
    $('.hapusgambar').click(function() {
        kodekunjungan = $('#kodekunjungan').val()
        kode = $(this).attr('gambar')
        Swal.fire({
            title: 'Gambar dihapus ?',
            text: "Gambar yang ditandai akan dihapus ...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus !'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode,
                        kodekunjungan
                    },
                    url: '<?= route('hapusgambar') ?>',
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
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        reloadgbr()
                    }
                });
            }
        })
    })
</script>