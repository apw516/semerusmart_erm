<div class="container-fluid mb-4">
@if(count($gbr) > 0)

@else
<table class="table table-sm">
<tr>
    <td class="text-bold bg-dark" colspan="2">Riwayat Kesehatan</td>
</tr>
<tr>
    <td>Menarrche umur</td>
    <td><input type="text" class="form-control"></td>
</tr>
<tr>
    <td>Siklus</td>
    <td><input type="text" class="form-control"></td>
</tr>
<tr>
    <td>HPHT</td>
    <td><input type="text" class="form-control"></td>
</tr>
<tr>
    <td>TP</td>
    <td><input type="text" class="form-control"></td>
</tr>
<tr>
    <td>UK</td>
    <td><input type="text" class="form-control"></td>
</tr>
<tr>
    <td>Hamil Ke -</td>
    <td><input type="text" class="form-control"></td>
</tr>
<tr>
    <td>Riwayat KB</td>
    <td><input type="text" class="form-control"></td>
</tr>
<table class="table table-sm">
    <tr>
        <td class="text-bold bg-dark">Riwayat Ginkeologi</td>
    </tr>
    <tr>
        <td>
            <textarea class="form-control"></textarea>
        </td>
    </tr>
</table>
</table>
<table class="table table-sm">
    <tr class="bg-dark">
        <td colspan="3"  class="text-bold">Pemeriksaan Fisik</td>
    </tr>
    <tr class="text-bold bg-info">
        <td>Kepala</td>
        <td>Buah Dada</td>
        <td>Ekstremitas Bawah</td>
    </tr>
    <tr class="text-bold">
        <td>Kelopak Mata <input type="text" class="form-control"></td>
        <td>Puting <input type="text" class="form-control"></td>
        <td>
            <div class="form-group form-check mt-4">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Tidak ada keluhan</label>
            </div>
        </td>
    </tr>
    <tr class="text-bold">
        <td>Konjungtiva <input type="text" class="form-control"></td>
        <td>Asi <input type="text" class="form-control"></td>
        <td>
        <div class="form-group form-check mt-4">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Oedema</label>
            </div>
        </td>
    </tr>
    <tr class="text-bold">
        <td>Sclera <input type="text" class="form-control"></td>
        <td>Kebersihan <input type="text" class="form-control"></td>
        <td>
        <div class="form-group form-check mt-4">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Varices</label>
            </div>
        </td>
    </tr>
    <tr class="text-bold">
        <td>Lain - lain <input type="text" class="form-control"></td>
        <td>Lain - lain <input type="text" class="form-control"></td>
        <td>Lain - lain <input type="text" class="form-control"></td>
    </tr>
</table>
<table class="table table-sm">
    <tr class="text-bold bg-dark">
        <td colspan="2">Abdomen</td>
    </tr>
    <tr>
        <td>LEOPOLD I : Tinggi Fundus Uteri</td>
        <td><input type="text" class="form-control"></td>
    </tr>
    <tr>
        <td>LEOPOLD II</td>
        <td><input type="text" class="form-control"></td>
    </tr>
    <tr>
        <td>LEOPOLD III</td>
        <td><input type="text" class="form-control"></td>
    </tr>
    <tr>
        <td>LEOPOLD IV</td>
        <td><input type="text" class="form-control"></td>
    </tr>
</table>
<table class="table table-sm">
    <tr>
        <td colspan="2" class="text-bold bg-dark">PEMERIKSAAN GINKEOLOGI</td>
    </tr>
    <tr>
        <td>Palpasi</td>
        <td><input type="text" class="form-control"></td>
    </tr>
    <tr>
        <td>Inspekulo</td>
        <td><input type="text" class="form-control"></td>
    </tr>
    <tr>
        <td>Pemeriksaan dalam </td>
        <td><input type="text" class="form-control"></td>
    </tr>
</table>
<button class="btn btn-success">Simpan</button>
@endif
</div>