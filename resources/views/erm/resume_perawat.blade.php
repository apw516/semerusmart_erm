<div class="row">
    <div class="col-md-12">
        <!-- Widget: user widget style 2 -->
        <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-info">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{ asset('public/img/user.jpg') }}" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{ $pasien[0]->nama_px }} | {{ $pasien[0]->no_rm }}</h3>
                <h5 class="widget-user-desc">{{ $datakunjungan[0]->nama_unit }} | {{ $pasien[0]->tgl_lahir }} | @if ($pasien[0]->jenis_kelamin == 'L' ) Laki - Laki @else Perempuan @endif | {{$datakunjungan[0]->nama_penjamin }} | Kunjungan ke - {{$datakunjungan[0]->counter }} | {{ $datakunjungan[0]->tgl_masuk }}</h5>
            </div>

        </div>
        <!-- /.widget-user -->
    </div>
</div>
<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Assesmen awal Keperawatan</a></li>
            <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Assesmen awal Medis</a></li>
        </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane" id="activity">
                @if(count($asskep) > 0)
                <table class="table">
                    <tr>
                        <td class="text-bold">Sumber Data Periksa</td>
                        <td style="font-style:italic">
                            <div class="direct-chat-text bg-light">
                                {{ $asskep[0]->sumberdataperiksa }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">Keluhan Utama </td>
                        <td style="font-style:italic">
                            <div class="direct-chat-text bg-light">
                                {{ $asskep[0]->keluhanutama }}
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered table-sm table-striped">
                    <thead class="bg-info">
                        <th>Tekanan Darah</th>
                        <th>Frekuensi Nadi</th>
                        <th>Frekuensi Nafas</th>
                        <th>Suhu Tubuh</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $asskep[0]->tekanandarah }}</td>
                            <td>{{ $asskep[0]->frekuensinadi }} x/Menit</td>
                            <td>{{ $asskep[0]->frekuensinapas }} x/Menit</td>
                            <td>{{ $asskep[0]->suhutubuh }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-striped">
                            <tr>
                                <td class="text-bold">Riwayat Psikologis</td>
                                <td style="font-style:italic">{{ $asskep[0]->Riwayatpsikologi }} | {{ $asskep[0]->keterangan_riwayat_psikolog }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Penggunaan Alat Bantu</td>
                                <td style="font-style:italic">{{ $asskep[0]->penggunaanalatbantu }} | {{ $asskep[0]->keterangan_alat_bantu }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Cacat Tubuh</td>
                                <td style="font-style:italic">{{ $asskep[0]->cacattubuh }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Keterangan Cacat Tubuh</td>
                                <td style="font-style:italic">{{ $asskep[0]->keterangancacattubuh }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-striped">
                            <tr>
                                <td class="text-bold">Keluhan Nyeri</td>
                                <td style="font-style:italic">{{ $asskep[0]->Keluhannyeri }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Skala Nyeri Pasien</td>
                                <td style="font-style:italic">{{ $asskep[0]->skalenyeripasien }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Resiko Jatuh</td>
                                <td style="font-style:italic">{{ $asskep[0]->resikojatuh }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-striped">
                            <tr>
                                <td class="text-bold">Skrining Gizi</td>
                                <td style="font-style:italic">{{ $asskep[0]->Skrininggizi }} | {{ $asskep[0]->skorskrininggizi }} </td>
                            </tr>
                            <tr>
                                <td class="text-bold">Berat Skrining Gizi</td>
                                <td style="font-style:italic">{{ $asskep[0]->beratskrininggizi }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Kekurangan Asupan Makanan</td>
                                <td style="font-style:italic">{{ $asskep[0]->status_asupanmkanan }} | {{ $asskep[0]->skorasupanmkanan }} </td>
                            </tr>
                            <tr>
                                <td class="text-bold">Skor Hasil Pengkajian Gizi</td>
                                <td style="font-style:italic">{{ $asskep[0]->totalskorgizi }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-striped">
                            <tr>
                                <td class="text-bold">Penyakit Lain / Diagnosa Khusus</td>
                                <td style="font-style:italic">{{ $asskep[0]->penyakitlainpasien }} | {{ $asskep[0]->diagnosakhusus }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Resiko Malnutrisi</td>
                                <td style="font-style:italic">{{ $asskep[0]->resikomalnutrisi }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Tgl Pengkajian Lanjut</td>
                                <td style="font-style:italic">{{ $asskep[0]->tglpengkajianlanjutgizi }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <th class="bg-info">Diagnosa Keperawatan</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $asskep[0]->diagnosakeperawatan }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <th class="bg-info">Rencana Keperawatan</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $asskep[0]->rencanakeperawatan }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <th class="bg-info">Tindakan Keperawatan</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $asskep[0]->tindakankeperawatan }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <th class="bg-info">Evaluasi Keperawatan</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $asskep[0]->evaluasikeperawatan }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table text-bold table-md text-md">
                    <thead>
                        <th class="text-center">Tanggal Assesmen Perawat/Bidan</th>
                        <th class="text-center">Nama Perawat/Bidan</th>
                        <th>Tanda Tangan Perawat/Bidan</th>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>
                                <input style="border:none" type="text" class="form-control" name="tanggalassemenperawat" id="tanggalassemenperawat" value="{{ $now }}">
                            </td>
                            <td>
                                <input style="border:none;background-color:white" readonly type="text" class="form-control text-center" value="{{ strtoupper(auth()->user()->name) }}" name="namapemeriksa">
                                <input hidden type="text" class="form-control" value="{{ strtoupper(auth()->user()->id) }}" name="idpemeriksa">
                            </td>
                            <td>
                                @if($asskep[0]->status == '2')
                                <div id="signature-pad">
                                    <div style="border:solid 1px teal; width:360px;height:110px;padding:3px;position:relative;">
                                        <div id="note" onmouseover="my_function();">tulis tanda tangan didalam box ...
                                        </div>
                                        <canvas id="the_canvas" width="350px" height="100px"></canvas>
                                    </div>
                                    <div style="margin:10px;">
                                        <input hidden type="" id="signature" name="signature">
                                        <button type="button" id="clear_btn" class="btn btn-danger" data-action="clear"><span class="glyphicon glyphicon-remove"></span>
                                            Clear</button>
                                    </div>
                                </div>
                                @else
                                <img src="{{ $asskep[0]->signature}}" alt="">
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                @if(auth()->user()->hak_akses == 2)
                <button @if($asskep[0]->status != 2) disabled @endif class="btn btn-success float-right simpanassesmen">Simpan Assesmen</button>
                @endif
                @else
                <h5 class="text-danger">Data tidak ditemukan...</h5>
                @endif
            </div>
            <div class="tab-pane active" id="timeline">
                @if(count($assmed) > 0)
                <table class="table table-sm">
                    <tr>
                        <td class="text-bold">Keluhan Utama</td>
                        <td style="font-style:italic">{{ $assmed[0]->keluhan_utama }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Riwayat Penyakit Sekarang</td>
                        <td style="font-style:italic">{{ $assmed[0]->riwayat_penyakit }}</td>
                    </tr>
                </table>
                <table class="table table-sm table-bordered">
                    <thead class="bg-info">
                        <th>Hipertensi</th>
                        <th>Kencing Manis</th>
                        <th>Jantung</th>
                        <th>Stroke</th>
                        <th>Hepatitis</th>
                        <th>Asthma</th>
                        <th>Ginjal</th>
                        <th>TB Paru</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>@if($assmed[0]->hipertensi == 1 ) Ya @else Tidak @endif</td>
                            <td>@if($assmed[0]->kencingmanis == 1 ) Ya @else Tidak @endif</td>
                            <td>@if($assmed[0]->jantung == 1 ) Ya @else Tidak @endif</td>
                            <td>@if($assmed[0]->stroke == 1 ) Ya @else Tidak @endif</td>
                            <td>@if($assmed[0]->hepatitis == 1 ) Ya @else Tidak @endif</td>
                            <td>@if($assmed[0]->asthma == 1 ) Ya @else Tidak @endif</td>
                            <td>@if($assmed[0]->ginjal == 1 ) Ya @else Tidak @endif</td>
                            <td>@if($assmed[0]->tbparu == 1 ) Ya @else Tidak @endif</td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-bold bg-info">Riwaat Penyakit Lain</td>
                        </tr>
                        <tr>
                            <td colspan="8">@if($assmed[0]->riwayatlain == 1) {{ $assmed[0]->ket_riwayat_lain }} @else Tidak Ada @endif</td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-bold bg-info">Riwayat Kehamilan Bagi Pasien Wanita</td>
                        </tr>
                        <tr>
                            <td colspan="8">{{ $assmed[0]->riwayat_kehamilan }}</td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-bold bg-info">Riwayat Kelahiran Bagi Pasien Anak</td>
                        </tr>
                        <tr>
                            <td colspan="8">{{ $assmed[0]->riwayat_kelahiran }}</td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-bold bg-info">Riwayat Alergi</td>
                        </tr>
                        <tr>
                            <td colspan="8">{{ $assmed[0]->alergi }} | Keterangan : {{ $assmed[0]->ket_alergi }}</td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-bold bg-info">Status Generalis</td>
                        </tr>
                        <tr>
                            <td colspan="8">{{ $assmed[0]->status_generalis }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th class="text-bold bg-info">Keadaan Umum</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $assmed[0]->keadaanumum }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th class="text-bold bg-info">Kesadaran</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $assmed[0]->kesadaran }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th class="text-bold bg-info">Diagnosa Kerja</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $assmed[0]->diagnosakerja }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th class="text-bold bg-info">Diagnosa banding</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $assmed[0]->diagnosapembanding }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th class="text-bold bg-info">Tindak Lanjut</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $assmed[0]->tindaklanjut }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th class="text-bold bg-info">Rencana Kerja</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $assmed[0]->rencanakerja }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th class="text-bold bg-info">Tindakan Medis</th>
                            </thead>
                            <tbody>
                                @foreach($tindakan as $t)
                                <tr>
                                    <td>{{ $t->NAMA_TARIF }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th colspan="5" class="text-bold bg-secondary">Order Farmasi</th>
                            </thead>
                            <tbody>
                                <tr class="bg-warning">
                                    <td>Nama Obat</td>
                                    <td>Jenis Resep</td>
                                    <td>Status Order</td>
                                    <td>Signa</td>
                                    <td>Jumlah</td>
                                </tr>
                                @if(count($farmasi) > 0)
                                @foreach($farmasi as $a)
                                <tr>
                                    <td>{{ $a->nama_barang }}</td>
                                    <td>{{ $a->jenisresep }}</td>
                                    <td>{{ $a->status_order }}</td>
                                    <td>{{ $a->signa }}</td>
                                    <td>{{ $a->jumlah }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th colspan="2" class="text-bold bg-info">Order Penunjang</th>
                            </thead>
                            <tbody>
                                @foreach($orderpenunjang as $op)
                                <tr>
                                    <td>{{ $op->NAMA_TARIF }}</td>
                                    <td>{{ $op->nama_unit_tujuan }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(count($gambar) > 0)
                @if(auth()->user()->unit == '1019')
                <div class="row">
                    @if($gambar[0]->telingakanan != NULL)
                    <div class="col-md-2">
                        <p>Telinga Kanan</p>
                        <img src="{{ $gambar[0]->telingakanan }}" alt="">
                    </div>
                    @endif
                    @if($gambar[0]->telingakiri != NULL)
                    <div class="col-md-2">
                        <p>Telinga Kiri</p>
                        <img src="{{ $gambar[0]->telingakiri }}" alt="">
                    </div>
                    @endif
                    @if($gambar[0]->faring != NULL)
                    <div class="col-md-2">
                        <p>Faring</p>
                        <img src="{{ $gambar[0]->faring }}" alt="">
                    </div>
                    @endif
                    @if($gambar[0]->laring != NULL)
                    <div class="col-md-2">
                        <p>Laring</p>
                        <img src="{{ $gambar[0]->laring }}" alt="">
                    </div>
                    @endif
                    @if($gambar[0]->leherkepala != NULL)
                    <div class="col-md-2">
                        <p>Leher dan Kepala</p>
                        <img src="{{ $gambar[0]->leherkepala }}" alt="">
                    </div>
                    @endif
                    @if($gambar[0]->maksilofasial != NULL)
                    <div class="col-md-2">
                        <p>Maksilofasial</p>
                        <img src="{{ $gambar[0]->maksilofasial }}" alt="">
                    </div>
                    @endif
                </div>
                @elseif(auth()->user()->unit == '1024')
                <table class="table table-sm table-bordered">
                    <tr>
                        <td colspan="2" class="bg-warning">Hasil Pemeriksaan Khusus</td>
                    </tr>
                    <tr>
                        <td>Gambar</td>
                        <td><img src="{{ $gambar[0]->paruparu }}" alt=""></td>
                    </tr>
                    <tr>
                        <td>Inspeksi</td>
                        <td>{{ strtoupper($gambar[0]->Inspeksi) }}</td>
                    </tr>
                    <tr>
                        <td>Keterangan Inspeksi</td>
                        <td>{{ strtoupper($gambar[0]->keteranganinspeksi) }}</td>
                    </tr>
                    <tr>
                        <td>Sela Iga</td>
                        <td>{{ strtoupper($gambar[0]->selaiga) }}</td>
                    </tr>
                    <tr>
                        <td>Vocalfremitus</td>
                        <td>{{ strtoupper($gambar[0]->vocalfremitus) }}</td>
                    </tr>
                    <tr>
                        <td>Sonar</td>
                        <td>{{ strtoupper($gambar[0]->sonar) }}</td>
                    </tr>
                    <tr>
                        <td>Hipersonar</td>
                        <td>{{ strtoupper($gambar[0]->hipersonar) }}</td>
                    </tr>
                    <tr>
                        <td>Vesikuler</td>
                        <td>{{ strtoupper($gambar[0]->vesikuler) }}</td>
                    </tr>
                    <tr>
                        <td>Ronchi</td>
                        <td>{{ strtoupper($gambar[0]->ronchi) }}</td>
                    </tr>
                    <tr>
                        <td>Wheezing</td>
                        <td>{{ strtoupper($gambar[0]->wheezing) }}</td>
                    </tr>
                </table>
                @elseif(auth()->user()->unit == '1014')
                <table class="table table-sm table-bordered">
                    <tr>
                        <td colspan="2" class="bg-warning text-bold">Hasil Pemeriksaan Khusus</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Gambar</td>
                        <td><img src="{{ $gambar[0]->bolamata }}" alt=""></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bg-warning">VISUS DASAR</td>
                    </tr>
                    <tr style="font-style:italic">
                        <td>OD : {{ strtoupper($gambar[0]->od_visus_dasar) }}</td>
                        <td>PINHOLE : {{ strtoupper($gambar[0]->od_pinhole_visus_dasar) }}</td>
                    </tr>
                    <tr style="font-style:italic">
                        <td>OS : {{ strtoupper($gambar[0]->os_visus_dasar) }}</td>
                        <td>PINHOLE : {{ strtoupper($gambar[0]->os_pinhole_visus_dasar) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bg-warning">Refraktometer /streak</td>
                    </tr>
                    <tr style="font-style:italic">
                        <td>OD : Sph : {{ strtoupper($gambar[0]->od_sph_refraktometer) }} Cyl : {{ strtoupper($gambar[0]->od_cyl_refraktometer) }} x : {{ strtoupper($gambar[0]->od_x_refraktometer) }}</td>
                        <td>OS : Sph : {{ strtoupper($gambar[0]->os_sph_refraktometer) }} Cyl : {{ strtoupper($gambar[0]->os_cyl_refraktometer) }} x : {{ strtoupper($gambar[0]->os_x_refraktometer) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bg-warning">Lensometer</td>
                    </tr>
                    <tr style="font-style:italic">
                        <td>OD : Sph : {{ strtoupper($gambar[0]->od_sph_Lensometer) }} Cyl : {{ strtoupper($gambar[0]->od_cyl_Lensometer) }} x : {{ strtoupper($gambar[0]->od_x_Lensometer) }}</td>
                        <td>OS : Sph : {{ strtoupper($gambar[0]->os_sph_Lensometer) }} Cyl : {{ strtoupper($gambar[0]->os_cyl_Lensometer) }} x : {{ strtoupper($gambar[0]->os_x_Lensometer) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bg-warning">Koreksi Penglihatan Jauh</td>
                    </tr>
                    <tr style="font-style:italic">
                        <td>VOD : Sph : {{ strtoupper($gambar[0]->vod_sph_kpj) }} Cyl : {{ strtoupper($gambar[0]->vod_cyl_kpj) }} x : {{ strtoupper($gambar[0]->vod_x_kpj) }}</td>
                        <td>VOS : Sph : {{ strtoupper($gambar[0]->vos_sph_kpj) }} Cyl : {{ strtoupper($gambar[0]->vos_cyl_kpj) }} x : {{ strtoupper($gambar[0]->vos_x_kpj) }}</td>
                    </tr>
                    <tr>
                        <td>Tajam Penglihatan Dekat</td>
                        <td style="font-style:italic">{{ $gambar[0]->penglihatan_dekat}}</td>
                    </tr>
                    <tr>
                        <td>Tekanan Intra Okular</td>
                        <td style="font-style:italic">{{ $gambar[0]->tekanan_intra_okular}}</td>
                    </tr>
                    <tr>
                        <td>Catatan Pemeriksaan Lainnya</td>
                        <td style="font-style:italic">{{ $gambar[0]->catatan_pemeriksaan_lainnya}}</td>
                    </tr>
                    <tr>
                        <td>Palpebra</td>
                        <td style="font-style:italic">{{ $gambar[0]->palpebra}}</td>
                    </tr>
                    <tr>
                        <td>Konjungtiva</td>
                        <td style="font-style:italic">{{ $gambar[0]->konjungtiva}}</td>
                    </tr>
                    <tr>
                        <td>Kornea</td>
                        <td style="font-style:italic">{{ $gambar[0]->kornea}}</td>
                    </tr>
                    <tr>
                        <td>Bilik Mata Depan</td>
                        <td style="font-style:italic">{{ $gambar[0]->bilik_mata_depan}}</td>
                    </tr>
                    <tr>
                        <td>Pupil</td>
                        <td style="font-style:italic">{{ $gambar[0]->pupil}}</td>
                    </tr>
                    <tr>
                        <td>Iris</td>
                        <td style="font-style:italic">{{ $gambar[0]->iris}}</td>
                    </tr>
                    <tr>
                        <td>Lensa</td>
                        <td style="font-style:italic">{{ $gambar[0]->lensa}}</td>
                    </tr>
                    <tr>
                        <td>Funduskopi</td>
                        <td style="font-style:italic">{{ $gambar[0]->funduskopi}}</td>
                    </tr>
                    <tr>
                        <td>Oftamologis</td>
                        <td style="font-style:italic">{{ $gambar[0]->oftamologis}}</td>
                    </tr>
                    <tr>
                        <td>Masalah Medis</td>
                        <td style="font-style:italic">{{ $gambar[0]->masalahmedis}}</td>
                    </tr>
                    <tr>
                        <td>Prognosis</td>
                        <td style="font-style:italic">{{ $gambar[0]->prognosis}}</td>
                    </tr>
                </table>
                @elseif(auth()->user()->unit == '1007')
                <div class="row">
                    <div class="col-md-12">
                        <p>Pemeriksaan Gigi</p>
                        <img src="{{ $gambar[0]->gigi }}" alt="">
                    </div>
                </div>
                @endif
                @endif
                <table class="table text-bold table-md text-md mt-4">
                    <thead class="bg-info">
                        <th class="text-center">Tanggal Assesmen Dokter</th>
                        <th class="text-center">Nama Dokter</th>
                        <th>Tanda Tangan Dokter</th>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>
                                <input style="border:none" type="text" class="form-control" name="tanggalassemen" id="tanggalassemen" value="{{ $now }}">
                            </td>

                            <td>
                                <input readonly style="border:none;background:white" type="text" class="form-control text-center" value="{{ strtoupper($assmed[0]->namadokter) }}" name="namapemeriksa" id="namapemeriksa">
                                <input hidden type="text" class="form-control" value="{{ strtoupper($assmed[0]->namadokter) }}" id="idpemeriksa" name="idpemeriksa">
                            </td>
                            <td>
                                <img src="{{ $assmed[0]->signature}}" alt="">
                            </td>
                        </tr>
                    </tbody>
                </table>
                @else
                <h5 class="text-danger">Data tidak ditemukan...</h5>
                @endif
            </div>
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>
<script>
    $('.simpanassesmen').click(function() {
        spinner = $('#loader2');
        spinner.show();
        var canvas = document.getElementById("the_canvas");
        var dataUrl = canvas.toDataURL();
        if (dataUrl ==
            'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAV4AAABkCAYAAADOvVhlAAADOklEQVR4Xu3UwQkAAAgDMbv/0m5xr7hAIcjtHAECBAikAkvXjBEgQIDACa8nIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECDweoABlt2MJjgAAAABJRU5ErkJggg=='
        ) {
            dataUrl = ''
        }
        document.getElementById("signature").value = dataUrl;
        kodekunjungan = $('#kodekunjungan').val()
        tglassesmen = $('#tanggalassemenperawat').val()
        namapemeriksa = $('#namapemeriksa').val()
        idpemeriksa = $('#idpemeriksa').val()
        signature = $('#signature').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                kodekunjungan,
                tglassesmen,
                namapemeriksa,
                idpemeriksa,
                signature,

            },
            url: '<?= route('simpansignature_perawat') ?>',
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
                    $('.notif').attr('Hidden', true)
                }
            }
        });
    });
    var wrapper = document.getElementById("signature-pad");
    var clearButton = wrapper.querySelector("[data-action=clear]");
    var canvas = wrapper.querySelector("canvas");
    var el_note = document.getElementById("note");
    var signaturePad;
    signaturePad = new SignaturePad(canvas);
    clearButton.addEventListener("click", function(event) {
        document.getElementById("note").innerHTML = "The signature should be inside box";
        signaturePad.clear();
    });

    function my_function() {
        document.getElementById("note").innerHTML = "";
    }
</script>