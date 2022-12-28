<table id="tablestok" class="table table-sm table-borderd table-hover table-stripped mt-3 text-sm">
    <thead class="bg-secondary">
        <th>Nama</th>
        <th>Stok Current</th>
        <th>Dosis</th>
        <th>Satuan</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        @foreach($STOK as $s )
        <tr class="pilihobat" kodebarang="{{ $s->kode_barang }}" namabarang="{{ $s->nama_barang }}">
            <td>{{ $s->nama_barang }}</td>
            <td>{{ $s->stok_current }}</td>
            <td>{{ $s->dosis }}</td>
            <td>{{ $s->satuan }}</td>
            <td>
                Obat Pasien @if($s->kode_unit == '4008') BPJS @else Umum @endif <br>
                @if($s->narkotika == 1)NARKOTIKA <br>@endif
                @if($s->Psikotropika == 1)PSIKOTROPIKA <br>@endif
                @if($s->obat_generik == 1)OBAT GENERIK <br>@endif
                @if($s->prekusor == 1)PREKUSOR <br>@endif
                @if($s->antibiotik == 1)ANTIBIOTIK <br>@endif
                @if($s->morphin == 1)MORPHIN <br>@endif
                @if($s->formularium == 1)Formularium <br>@endif
                @if($s->non_formularium == 1)Non Formularium <br>@endif
                <br>
                <p class="text-bold ">Aturan Pakai</p>
                {{ $s->aturan_pakai }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tablestok").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 3,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tablestok').on('click', '.pilihobat', function() {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap2"); //Fields wrapper
        var x = 1; //initlal text box count
        kode = $(this).attr('kodebarang')
        namabarang = $(this).attr('namabarang')
        // e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-4"><label for="">Nama Obat</label><input readonly type="" class="form-control form-control-sm" id="" name="namaobat" value="' +
                namabarang +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                kode +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="jumlah" value="0"></div><div class="form-group col-md-4"><label for="inputPassword4">Signa</label><input type="" class="form-control form-control-sm col-md-3" id="signa" name="signa" value=""></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger"></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove 
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });
</script>