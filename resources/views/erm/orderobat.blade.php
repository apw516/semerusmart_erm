<div class="container mt-4">
    <div class="btn-group mr-2 mt-2 mb-3" role="group" aria-label="First group">
        <button type="button" class="btn btn-warning lihatriwayat_resep" id="lihatriwayat_resep" data-toggle="modal" data-target="#riwayatresep">Riwayat Resep</button>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="tabelorder_today">

            </div>
        </div>
    </div>
    <div class="row">
        <!-- <div class="col-md-6 mt-4">
            <h5 class="text-bold mb-3">
                Riwayat Obat
            </h5>
            <table id="riwayatobat" class="table table-sm table-bordered text-xs">
                <thead>
                    <th>Tanggal</th>
                    <th>Kunjungan</th>
                    <th>Pengirim</th>
                    <th>Dokter</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Satuan Besar</th>
                </thead>
                <tbody>
                    @foreach($riwayat as $r)
                    <tr>
                        <td>{{ $r->tgl_entry }}</td>
                        <td>{{ $r->counter }}</td>
                        <td>{{ $r->pengirim }}</td>
                        <td>{{ $r->dokter_pengirim }}</td>
                        <td>{{ $r->nama_obat }}</td>
                        <td>{{ $r->jumlah }}</td>
                        <td>{{ $r->satuan }}</td>
                        <td>{{ $r->satuan_besar }}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div> -->
        <div class="col-md-5 mt-4">
            <h5 class="text-bold mb-3">
                Jenis Penjamin
            </h5>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="penjamin" id="penjamin" value="1" @if($kode_penjamin !='P01' ) checked @endif>
                <label class="form-check-label" for="inlineRadio1">BPJS</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="penjamin" id="penjamin" value="2" @if($kode_penjamin=='P01' ) checked @endif>
                <label class="form-check-label" for="inlineRadio2">UMUM</label>
            </div>
            <div class="input-group mt-3">
                <input type="text" class="form-control col-md-4" placeholder="Cari Nama Obat" aria-label="Recipient's username" aria-describedby="basic-addon2" oninput="cariobat()" id="namaobat">
                <div class="input-group-append">
                    <span class="input-group-text bg-secondary" id="basic-addon2">Pencarian Obat</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="hasilpencarian">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card-header text-bold">
                <h2>ORDER OBAT FARMASI</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Jenis Resep</label>
                    <select class="form-control" id="jenisresep">
                        <option value="80">Reguler</option>
                        <option value="81">Kronis</option>
                        <option value="82">Kemotherapi</option>
                    </select>
                </div>
                <form action="" method="post" class="formorderobat">
                    <div class="input_fields_wrap2">
                        <div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-warning mb-2 simpanorder" id="simpanorder">Simpan Order</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="riwayatresep" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Riwayat Resep</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vriwayatresep2">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        kodekunjungan = $('#kodekunjunganpasien').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
            },
            url: '<?= route('cariorderobat') ?>',
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(response) {
                $('.tabelorder_today').html(response)
            }
        });
    });

    function reload_riwayat() {
        kodekunjungan = $('#kodekunjunganpasien').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
            },
            url: '<?= route('cariorderobat') ?>',
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(response) {
                $('.tabelorder_today').html(response)
            }
        });
    }
    $(function() {
        $("#riwayatobat").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
</script>
<script>
    function cariobat() {
        penjamin = $('#penjamin:checked').val()
        nama = $('#namaobat').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                penjamin,
                nama
            },
            url: '<?= route('cariobat') ?>',
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(response) {
                $('.hasilpencarian').html(response)
            }
        });
    }
    $(".simpanorder").click(function() {
        var data = $('.formorderobat').serializeArray();
        var kodekunjungan = $('#kodekunjungan').val()
        no_rm = $('#rmdaripasien').val()
        jenisresep = $('#jenisresep').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodekunjungan: kodekunjungan,
                no_rm,
                jenisresep
            },
            url: '<?= route('simpanorderfarmasi') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sepertinya ada masalah ...',
                    footer: ''
                })
            },
            success: function(data) {
                console.log(data)
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
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
                    reload_riwayat()
                }
            }
        });
    });
    $(".lihatriwayat_resep").click(function() {
        no_rm = $('#rmdaripasien').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                no_rm
            },
            url: '<?= route('lihatriwayatresep') ?>',
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sepertinya ada masalah ...',
                    footer: ''
                })
            },
            success: function(response) {
                $('.vriwayatresep2').html(response)
            }
        });
    })
</script>