@if(count($gbr) > 0)
<div class="row">
    @if($gbr[0]->bolamata != NULL)
    <div class="col-md-12">
        <label for="" class="text-md">Pergerakan bola mata</label>
        <img src="{{ $gbr[0]->bolamata }}" alt="">
    </div>
    <div class="col-md-12">
        <table class="table table-sm table-bordered">
            <tr>
                <td class="text-bold text-center bg-info" colspan="3">Visus Dasar</td>
            </tr>
            <tr>
                <td>OD : {{ $gbr[0]->od_visus_dasar }}</td>
                <td colspan="2">PINHOLE : {{ $gbr[0]->od_pinhole_visus_dasar }}</td>
            </tr>
            <tr>
                <td>OS : {{ $gbr[0]->os_visus_dasar }}</td>
                <td colspan="2">PINHOLE : {{ $gbr[0]->os_pinhole_visus_dasar }}</td>
            </tr>
            <tr>
                <td class="text-bold text-center bg-info" colspan="3">Refraktometer /streak</td>
            </tr>
            <tr>
                <td>OD : SPH : {{ $gbr[0]->od_sph_refraktometer }}</td>
                <td>Cyl : {{ $gbr[0]->od_cyl_refraktometer }}</td>
                <td>X : {{ $gbr[0]->od_x_refraktometer }}</td>
            </tr>
            <tr>
                <td>OS : SPH : {{ $gbr[0]->os_sph_refraktometer }}</td>
                <td>Cyl : {{ $gbr[0]->os_cyl_refraktometer }}</td>
                <td>X : {{ $gbr[0]->os_x_refraktometer }}</td>
            </tr>
            <tr>
                <td class="text-bold text-center bg-info" colspan="3">Lensometer</td>
            </tr>
            <tr>
                <td>OD : SPH {{ $gbr[0]->od_sph_Lensometer }}</td>
                <td>Cyl : {{ $gbr[0]->od_cyl_Lensometer }}</td>
                <td>X : {{ $gbr[0]->od_x_Lensometer }}</td>
            </tr>
            <tr>
                <td>OS : SPH : {{ $gbr[0]->os_sph_Lensometer }}</td>
                <td>Cyl : {{ $gbr[0]->os_cyl_Lensometer }}</td>
                <td>X : {{ $gbr[0]->os_x_Lensometer }}</td>
            </tr>
            <tr>
                <td class="text-bold text-center bg-info" colspan="3">Koreksi Penglihatan Jauh</td>
            </tr>
            <tr>
                <td>VOD : SPH : {{ $gbr[0]->vod_sph_kpj }}</td>
                <td>Cyl : {{ $gbr[0]->vod_cyl_kpj }}</td>
                <td>X : {{ $gbr[0]->vod_x_kpj }}</td>
            </tr>
            <tr>
                <td>VOS : SPH : {{ $gbr[0]->vos_sph_kpj }}</td>
                <td>Cyl : {{ $gbr[0]->vos_cyl_kpj }}</td>
                <td>X : {{ $gbr[0]->vos_x_kpj }}</td>
            </tr>
            <tr>
                <td class="text-bold">Tajam Penglihatan Dekat</td>
                <td colspan="2">{{ $gbr[0]->penglihatan_dekat }}</td>
            </tr>
            <tr>
                <td class="text-bold">Tekanan Intra Okular</td>
                <td colspan="2">{{ $gbr[0]->tekanan_intra_okular }}</td>
            </tr>
            <tr>
                <td class="text-bold">Catatan Pemeriksaan Lainnya</td>
                <td colspan="2">{{ $gbr[0]->catatan_pemeriksaan_lainnya }}</td>
            </tr>
            <tr>
                <td class="text-bold">Palpebra</td>
                <td colspan="2">{{ $gbr[0]->palpebra }}</td>
            </tr>
            <tr>
                <td class="text-bold">Konjungtiva</td>
                <td colspan="2">{{ $gbr[0]->konjungtiva }}</td>
            </tr>
            <tr>
                <td class="text-bold">Kornea</td>
                <td colspan="2">{{ $gbr[0]->kornea }}</td>
            </tr>
            <tr>
                <td class="text-bold">Bilik Mata Depan</td>
                <td colspan="2">{{ $gbr[0]->bilik_mata_depan }}</td>
            </tr>
            <tr>
                <td class="text-bold">Pupil</td>
                <td colspan="2">{{ $gbr[0]->pupil }}</td>
            </tr>
            <tr>
                <td class="text-bold">Iris</td>
                <td colspan="2">{{ $gbr[0]->iris }}</td>
            </tr>
            <tr>
                <td class="text-bold">Lensa</td>
                <td colspan="2">{{ $gbr[0]->lensa }}</td>
            </tr>
            <tr>
                <td class="text-bold">Funduskopi</td>
                <td colspan="2">{{ $gbr[0]->funduskopi }}</td>
            </tr>
            <tr>
                <td class="text-bold">STATUS OFTALMOLOGIS KHUSUS</td>
                <td colspan="2">{{ $gbr[0]->oftamologis }}</td>
            </tr>
            <tr>
                <td class="text-bold">MASALAH MEDIS</td>
                <td colspan="2">{{ $gbr[0]->masalahmedis }}</td>
            </tr>
            <tr>
                <td class="text-bold">PROGNOSIS</td>
                <td colspan="2">{{ $gbr[0]->prognosis }}</td>
            </tr>
        </table>
    </div>
    @endif
</div>
@else
Tidak ada penandaan gambar
@endif