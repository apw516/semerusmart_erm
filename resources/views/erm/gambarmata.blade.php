<div class="container">
    <div class="btn-group mt-3" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-danger btn-piilih-gambar" jg="mata">Posisi dan Pergerakan Bola Mata</button>
    </div>
    <div class="tampilgambar">

    </div>
</div>

@if(count($gbr) > 0)
<div class="container mt-2">
    <form action="" class="form-mata">
        <table class="table table-sm">
            <tr>
                <td rowspan="2">Visus Dasar</td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OD</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="od_visus_dasar" name="od_visus_dasar" value="{{ $gbr[0]->od_visus_dasar}}">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">PINHOLE</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="od_pinhole_visus_dasar" id="od_pinhole_visus_dasar" value="{{ $gbr[0]->od_pinhole_visus_dasar}}">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OS</span>
                        </div>
                        <input name="os_visus_dasar" id="os_visus_dasar" value="{{ $gbr[0]->os_visus_dasar}}" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">PINHOLE</span>
                        </div>
                        <input name="os_pinhole_visus_dasar" id="os_pinhole_visus_dasar" type="text" class="form-control" value="{{ $gbr[0]->os_pinhole_visus_dasar}}" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Refraktometer / streak</td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OD : Sph</span>
                        </div>
                        <input name="od_sph_refraktometer" value="{{ $gbr[0]->od_sph_refraktometer}}" id="od_sph_refraktometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input type="text" value="{{ $gbr[0]->od_cyl_refraktometer}}" id="od_cyl_refraktometer" name="od_cyl_refraktometer" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="od_x_refraktometer" value="{{ $gbr[0]->od_x_refraktometer}}" name="od_x_refraktometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OS : Sph</span>
                        </div>
                        <input id="os_sph_refraktometer" value="{{ $gbr[0]->os_sph_refraktometer}}" name="os_sph_refraktometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="os_cyl_refraktometer" value="{{ $gbr[0]->os_cyl_refraktometer}}" name="os_cyl_refraktometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="os_x_refraktometer" value="{{ $gbr[0]->os_x_refraktometer}}" name="os_x_refraktometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Lensometer</td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OD : Sph</span>
                        </div>
                        <input id="od_sph_Lensometer" value="{{ $gbr[0]->od_sph_Lensometer}}" name="od_sph_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="od_cyl_Lensometer" value="{{ $gbr[0]->od_cyl_Lensometer}}" name="od_cyl_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="od_x_Lensometer" value="{{ $gbr[0]->od_x_Lensometer}}" name="od_x_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OS : Sph</span>
                        </div>
                        <input id="os_sph_Lensometer" value="{{ $gbr[0]->os_sph_Lensometer}}" name="os_sph_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="os_cyl_Lensometer" value="{{ $gbr[0]->os_cyl_Lensometer}}" name="os_cyl_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="os_x_Lensometer" value="{{ $gbr[0]->os_x_Lensometer}}" name="os_x_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Koreksi penglihatan jauh</td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">VOD : Sph</span>
                        </div>
                        <input id="vod_sph_kpj" value="{{ $gbr[0]->vod_sph_kpj}}" name="vod_sph_kpj" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="vod_cyl_kpj" value="{{ $gbr[0]->vod_cyl_kpj}}" name="vod_cyl_kpj" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="vod_x_kpj" value="{{ $gbr[0]->vod_x_kpj}}" name="vod_x_kpj" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">VOS : Sph</span>
                        </div>
                        <input type="text" id="vos_sph_kpj" value="{{ $gbr[0]->vos_sph_kpj}}" name="vos_sph_kpj" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="vos_cyl_kpj" value="{{ $gbr[0]->vos_cyl_kpj}}" name="vos_cyl_kpj" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="vos_x_kpj" value="{{ $gbr[0]->vos_x_kpj}}" name="vos_x_kpj" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Tajam penglihatan dekat</td>
                <td colspan="3"><textarea class="form-control" value="" id="penglihatan_dekat" name="penglihatan_dekat">{{ $gbr[0]->penglihatan_dekat}}</textarea></td>
            </tr>
            <tr>
                <td>Tekanan Intra Okular</td>
                <td colspan="3"><textarea class="form-control" value="" id="tekanan_intra_okular" name="tekanan_intra_okular">{{ $gbr[0]->tekanan_intra_okular}}</textarea></td>
            </tr>
            <tr>
                <td>Catatan Pemeriksaan Lainnya</td>
                <td colspan="3"><textarea class="form-control" value="" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya">{{ $gbr[0]->catatan_pemeriksaan_lainnya}}</textarea></td>
            </tr>
            <tr>
                <td>Palpebra</td>
                <td colspan="3"><input class="form-control" value="{{ $gbr[0]->palpebra}}" id="palpebra" name="palpebra"></input></td>
            </tr>
            <tr>
                <td>Konjungtiva</td>
                <td colspan="3"><input class="form-control" value="{{ $gbr[0]->konjungtiva}}" id="konjungtiva" name="konjungtiva"></input></td>
            </tr>
            <tr>
                <td>Kornea</td>
                <td colspan="3"><input class="form-control" value="{{ $gbr[0]->kornea}}" name="kornea" id="kornea"></input></td>
            </tr>
            <tr>
                <td>Bilik Mata Depan</td>
                <td colspan="3"><input class="form-control" value="{{ $gbr[0]->bilik_mata_depan}}" name="bilik_mata_depan" id="bilik_mata_depan"></input></td>
            </tr>
            <tr>
                <td>Pupil</td>
                <td colspan="3"><input class="form-control" value="{{ $gbr[0]->pupil}}" id="pupil" name="pupil"></input></td>
            </tr>
            <tr>
                <td>Iris</td>
                <td colspan="3"><input class="form-control" value="{{ $gbr[0]->iris}}" name="iris" id="iris"></input></td>
            </tr>
            <tr>
                <td>Lensa</td>
                <td colspan="3"><input class="form-control" value="{{ $gbr[0]->lensa}}" name="lensa" id="lensa"></input></td>
            </tr>
            <tr>
                <td>Funduskopi</td>
                <td colspan="3"><input class="form-control" value="{{ $gbr[0]->funduskopi}}" name="funduskopi" id="funduskopi"></input></td>
            </tr>
            <tr>
                <td>Status Oftalmologis Khusus</td>
                <td colspan="3"><textarea class="form-control" value="" name="oftamologis" id="oftamologis">{{ $gbr[0]->oftamologis}}</textarea></td>
            </tr>
            <tr>
                <td>Masalah Medis</td>
                <td colspan="3"><textarea class="form-control" value="" name="masalahmedis" id="masalahmedis">{{ $gbr[0]->masalahmedis}}</textarea></td>
            </tr>
            <tr>
                <td>Prognosis</td>
                <td colspan="3"><textarea class="form-control" value="" name="prognosis" id="prognosis">{{ $gbr[0]->prognosis}}</textarea></td>
            </tr>
        </table>
        <button type="button" class="btn btn-success mb-3 simpanform">Simpan</button>
    </form>
</div>
<div class="row mt-3">
    @if($gbr[0]->bolamata != (NULL))
    <div class="col-md-12">
        <p class="text-lg">Posisi dan Pergerakan Bola Mata</p>
        <img src="{{ $gbr[0]->bolamata }}" alt="">
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
    <form action="" class="form-mata">
        <table class="table table-sm">
            <tr>
                <td rowspan="2">Visus Dasar</td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OD</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="od_visus_dasar" name="od_visus_dasar">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">PINHOLE</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="od_pinhole_visus_dasar" id="od_pinhole_visus_dasar">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OS</span>
                        </div>
                        <input name="os_visus_dasar" id="os_visus_dasar" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">PINHOLE</span>
                        </div>
                        <input name="os_pinhole_visus_dasar" id="os_pinhole_visus_dasar" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Refraktometer / streak</td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OD : Sph</span>
                        </div>
                        <input name="od_sph_refraktometer" id="od_sph_refraktometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input type="text" id="od_cyl_refraktometer" name="od_cyl_refraktometer" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="od_x_refraktometer" name="od_x_refraktometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OS : Sph</span>
                        </div>
                        <input id="os_sph_refraktometer" name="os_sph_refraktometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="os_cyl_refraktometer" name="os_cyl_refraktometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="os_x_refraktometer" name="os_x_refraktometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Lensometer</td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OD : Sph</span>
                        </div>
                        <input id="od_sph_Lensometer" name="od_sph_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="od_cyl_Lensometer" name="od_cyl_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="od_x_Lensometer" name="od_x_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OS : Sph</span>
                        </div>
                        <input id="os_sph_Lensometer" name="os_sph_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="os_cyl_Lensometer" name="os_cyl_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="os_x_Lensometer" name="os_x_Lensometer" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Koreksi penglihatan jauh</td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">VOD : Sph</span>
                        </div>
                        <input id="vod_sph_kpj" name="vod_sph_kpj" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="vod_cyl_kpj" name="vod_cyl_kpj" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="vod_x_kpj" name="vod_x_kpj" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">VOS : Sph</span>
                        </div>
                        <input type="text" id="vos_sph_kpj" name="vos_sph_kpj" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="vos_cyl_kpj" name="vos_cyl_kpj" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="vos_x_kpj" name="vos_x_kpj" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Tajam penglihatan dekat</td>
                <td colspan="3"><textarea class="form-control" id="penglihatan_dekat" name="penglihatan_dekat"></textarea></td>
            </tr>
            <tr>
                <td>Tekanan Intra Okular</td>
                <td colspan="3"><textarea class="form-control" id="tekanan_intra_okular" name="tekanan_intra_okular"></textarea></td>
            </tr>
            <tr>
                <td>Catatan Pemeriksaan Lainnya</td>
                <td colspan="3"><textarea class="form-control" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya"></textarea></td>
            </tr>
            <tr>
                <td>Palpebra</td>
                <td colspan="3"><input class="form-control" id="palpebra" name="palpebra"></input></td>
            </tr>
            <tr>
                <td>Konjungtiva</td>
                <td colspan="3"><input class="form-control" id="konjungtiva" name="konjungtiva"></input></td>
            </tr>
            <tr>
                <td>Kornea</td>
                <td colspan="3"><input class="form-control" name="kornea" id="kornea"></input></td>
            </tr>
            <tr>
                <td>Bilik Mata Depan</td>
                <td colspan="3"><input class="form-control" name="bilik_mata_depan" id="bilik_mata_depan"></input></td>
            </tr>
            <tr>
                <td>Pupil</td>
                <td colspan="3"><input class="form-control" id="pupil" name="pupil"></input></td>
            </tr>
            <tr>
                <td>Iris</td>
                <td colspan="3"><input class="form-control" name="iris" id="iris"></input></td>
            </tr>
            <tr>
                <td>Lensa</td>
                <td colspan="3"><input class="form-control" name="lensa" id="lensa"></input></td>
            </tr>
            <tr>
                <td>Funduskopi</td>
                <td colspan="3"><input class="form-control" name="funduskopi" id="funduskopi"></input></td>
            </tr>
            <tr>
                <td>Status Oftalmologis Khusus</td>
                <td colspan="3"><textarea class="form-control" name="oftamologis" id="oftamologis"></textarea></td>
            </tr>
            <tr>
                <td>Masalah Medis</td>
                <td colspan="3"><textarea class="form-control" name="masalahmedis" id="masalahmedis"></textarea></td>
            </tr>
            <tr>
                <td>Prognosis</td>
                <td colspan="3"><textarea class="form-control" name="prognosis" id="prognosis"></textarea></td>
            </tr>
        </table>
        <button type="button" class="btn btn-success mb-3 simpanform">Simpan</button>
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
        $('.simpanform').click(function() {
            spinner = $('#loader2');
            spinner.show();
            var data = $('.form-mata').serializeArray();
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
                url: '<?= route('simpanformmata') ?>',
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
    });
</script>