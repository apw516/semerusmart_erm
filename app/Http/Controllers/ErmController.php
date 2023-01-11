<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\assesmenawal;
use App\Models\assesmenawal_dokter;
use App\Models\ts_layanan_header;
use App\Models\ts_layanan_detail;
use App\Models\mt_kode_header;
use App\Models\erm_order_header;
use App\Models\erm_order_detail;
use App\Models\gambartht;
use App\Models\gambarmata;
use App\Models\gambarparu;
use App\Models\gambargigi;
use App\Models\erm_header_order_farmasi;
use App\Models\erm_detail_order_farmasi;
use App\Models\assemenawalmedis;

class ErmController extends Controller
{
    public function indexPerawat()
    {
        return view('perawat.index', [
            'title' => 'Semerusmart | E-RM',
        ]);
    }
    public function indexDokter()
    {
        return view('dokter.index', [
            'title' => 'Semerusmart | E-RM',
        ]);
    }
    public function ambildatapasien()
    {
        $tipe = auth()->user()->hak_akses;
        $date = date('Y-m-d');
        // $date = '2022-11-25';
        if ($tipe == 2) {
            //perawat
            $unit = auth()->user()->unit;
            $pasien_poli = DB::select('select a.kode_kunjungan,fc_nama_px(a.no_rm) as nama,a.no_rm,fc_umur(a.no_rm) as umur, fc_alamat4(a.no_rm) as alamat , fc_nama_unit1(a.kode_unit) as unit,a.tgl_masuk, a.kelas, a.counter,a.diagx, b.kode_kunjungan as kj
            ,fc_nama_unit1(a.ref_unit) as asalunit,(SELECT COUNT(id) FROM erm_hasil_assesmen_keperawatan_rajal WHERE no_rm = a.no_rm ) AS data_erm from ts_kunjungan a left outer join erm_hasil_assesmen_keperawatan_rajal b on b.kode_kunjungan = a.kode_kunjungan where a.kode_unit = ? and a.status_kunjungan = ? and date(a.tgl_masuk) = ?', [$unit, 1, $date]);
            return view('perawat.datapasien', [
                'pasien' => $pasien_poli
            ]);
        } else {
            //dokter
            $unit = auth()->user()->unit;
            $pasien_poli = DB::select('select a.kode_kunjungan,fc_nama_px(a.no_rm) as nama,a.no_rm,fc_umur(a.no_rm) as umur, fc_alamat4(a.no_rm) as alamat , fc_nama_unit1(a.kode_unit) as unit,a.tgl_masuk, a.kelas, a.counter,a.diagx, b.kode_kunjungan as kj
            ,fc_nama_unit1(a.ref_unit) as asalunit,(SELECT COUNT(id) FROM erm_hasil_assesmen_keperawatan_rajal WHERE no_rm = a.no_rm ) AS data_erm
            ,(SELECT COUNT(id) FROM erm_hasil_assesmen_dokter_rajal WHERE kode_kunjungan = a.kode_kunjungan ) AS erm_medis from ts_kunjungan a left outer join erm_hasil_assesmen_keperawatan_rajal b on b.kode_kunjungan = a.kode_kunjungan where a.kode_unit = ? and a.status_kunjungan = ? and date(a.tgl_masuk) = ?', [$unit, 1, $date]);
            return view('dokter.datapasien', [
                'pasien' => $pasien_poli
            ]);
        }
    }
    public function indexErmPerawat($kodekunjungan)
    {
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        return view('perawat.index_erm', [
            'title' => $datapasien[0]->nama_px . ' | ' . $datapasien[0]->no_rm,
            'pasien' => $datapasien,
            'datakunjungan' => $datakunjungan,
        ]);
    }
    public function indexErmDokter($kodekunjungan)
    {
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        return view('perawat.index_erm', [
            'title' => $datapasien[0]->nama_px . ' | ' . $datapasien[0]->no_rm,
            'pasien' => $datapasien,
            'datakunjungan' => $datakunjungan,
        ]);
    }
    public function detailpasien(Request $request)
    {
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        $counter = $datakunjungan[0]->counter - 1;
        $lastrajal = DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit FROM ts_kunjungan WHERE no_rm = ? AND SUBSTR(kode_unit,1,1) = ? AND counter = ? ORDER BY counter DESC LIMIT 1
        ', [$rm, 1, $counter]);
        if (count($lastrajal) > 0) {
            $detail = DB::select('SELECT DISTINCT a.id,fc_nama_unit1(a.kode_unit) as nama_unit,d.`NAMA_TARIF` as nama_tarif FROM ts_layanan_header a  
        LEFT OUTER JOIN ts_layanan_detail b ON a.id = b.row_id_header
        LEFT OUTER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        LEFT OUTER JOIN mt_tarif_header d ON  c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?', [$lastrajal[0]->kode_kunjungan]);
            $hasilperiksa_perawat = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$lastrajal[0]->kode_kunjungan]);
        } else {
            $detail = 0;
            $hasilperiksa_perawat = 0;
        }
        return view('perawat.detailpasien', [
            'title' => $datapasien[0]->nama_px . ' | ' . $datapasien[0]->no_rm,
            'pasien' => $datapasien,
            'datakunjungan' => $datakunjungan,
            'last_rajal' => $lastrajal,
            'last_rajal_detail' => $detail,
            'last_rajal_asskep' => $hasilperiksa_perawat,
            'last_ranap' => DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit FROM ts_kunjungan WHERE no_rm = ? AND SUBSTR(kode_unit,1,1) = ? ORDER BY counter DESC LIMIT 1
            ', [$rm, 2])
        ]);
    }
    public function formperawat(Request $request)
    {
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ?', [$rm]);
        if (count($cek_rm) == 0) {
            $counter = 1;
        } else {
            foreach ($cek_rm as $c)
                $arr_counter[] = array(
                    'counter' => $c->counter
                );
            $last_count = max($arr_counter);
            $counter = $last_count['counter'] - 1;
        }
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        $hasil = count($cek_hasil_periksa);
        if ($hasil > 0) {
            return view('perawat.formperawat_edit', [
                'pasien' => $datapasien,
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'hasil' => $cek_hasil_periksa,
                'last_counter' => DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit,fc_NAMA_PARAMEDIS1(kode_paramedis) AS dokter FROM ts_kunjungan WHERE no_rm = ? AND counter = ? ORDER BY counter DESC LIMIT 1
            ', [$rm, $counter])
            ]);
        } else {
            return view('perawat.formperawat', [
                'pasien' => $datapasien,
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'last_counter' => DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit,fc_NAMA_PARAMEDIS1(kode_paramedis) AS dokter FROM ts_kunjungan WHERE no_rm = ? AND counter = ? ORDER BY counter DESC LIMIT 1
            ', [$rm, $counter])
            ]);
        }
    }
    public function formdokter(Request $request)
    {
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ?', [$rm]);
        if (count($cek_rm) == 0) {
            $counter = 1;
        } else {
            foreach ($cek_rm as $c)
                $arr_counter[] = array(
                    'counter' => $c->counter
                );
            $last_count = max($arr_counter);
            $counter = $last_count['counter'] - 1;
        }
        $asskep = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        $hasil = count($cek_hasil_periksa);
        if ($hasil > 0) {
            return view('dokter.formdokter_edit', [
                'pasien' => $datapasien,
                'asskep' => DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'icd' => DB::select('select * from mt_icd10'),
                'hasil' => $cek_hasil_periksa,
                'last_counter' => DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit,fc_NAMA_PARAMEDIS1(kode_paramedis) AS dokter FROM ts_kunjungan WHERE no_rm = ? AND counter = ? ORDER BY counter DESC LIMIT 1
            ', [$rm, $counter])
            ]);
        } else {
            return view('dokter.formdokter', [
                'pasien' => $datapasien,
                'asskep' => DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'icd' => DB::select('select * from mt_icd10'),
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'last_counter' => DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit,fc_NAMA_PARAMEDIS1(kode_paramedis) AS dokter FROM ts_kunjungan WHERE no_rm = ? AND counter = ? ORDER BY counter DESC LIMIT 1', [$rm, $counter])
            ]);
        }
    }
    public function simpanformperawat(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        //validasiform
        if ($dataSet['tekanandarah'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'tekanan darah pasien belum diisi ...'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['frekuensinadi'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Frekuensi nadi pasien belum diisi ...'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['frekuensinapas'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Frekuensi Napas pasien belum diisi ...'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['suhutubuh'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Suhu tubuh pasien belum diisi ...'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['Riwayatpsikologi'] == 'LAINNYA' && $dataSet['keterangan_rp'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Keterangan riwayat psikologi belum diisi ...'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['penggunaanalatbantu'] == 'Lainnya' && $dataSet['keterangan_ab'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Keterangan pemakaian alat bantu belum diisi ...'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['cacattubuh'] == 'Ya') {
            if ($dataSet['keterangancacattubuh'] == 'Tidak Ada' || $dataSet['keterangancacattubuh'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Isi Keterangan cacat tubuh ...'
                ];
                echo json_encode($data);
                die;
            }
        }
        if ($dataSet['cacattubuh'] == 'Ya') {
            if ($dataSet['keterangancacattubuh'] == 'Tidak Ada' || $dataSet['keterangancacattubuh'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Isi Keterangan cacat tubuh ...'
                ];
                echo json_encode($data);
                die;
            }
        }
        if ($dataSet['Keluhannyeri'] == 'Ya') {
            if ($dataSet['skalenyeripasien'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Isi skala nyeri pasien ...'
                ];
                echo json_encode($data);
                die;
            }
        }


        //endof validasi
        if ($dataSet['Riwayatpsikologi'] == 'LAINNYA') {
            $keterangan_riwayat_psikologis = $dataSet['keterangan_rp'];
        } else {
            $keterangan_riwayat_psikologis = '';
        }

        if ($dataSet['penggunaanalatbantu'] == 'Lainnya') {
            $keterangan_alat_bantu = $dataSet['keterangan_ab'];
        } else {
            $keterangan_alat_bantu = '';
        }
        $data = [
            'counter' => $dataSet['counter'],
            'no_rm' => $dataSet['nomorrm'],
            'kode_unit' => $dataSet['unit'],
            'kode_kunjungan' => $dataSet['kodekunjungan'],
            'tanggalkunjungan' => $dataSet['tanggalkunjungan'],
            'tanggalperiksa' => $dataSet['tanggalperiksa'], //sementara
            'sumberdataperiksa' => $dataSet['sumberdataperiksa'],
            'keluhanutama' => $dataSet['keluhanutama'],
            'tekanandarah' => $dataSet['tekanandarah'],
            'frekuensinadi' => $dataSet['frekuensinadi'],
            'frekuensinapas' => $dataSet['frekuensinapas'],
            'suhutubuh' => $dataSet['suhutubuh'],
            'Riwayatpsikologi' => $dataSet['Riwayatpsikologi'],
            'keterangan_riwayat_psikolog' => $keterangan_riwayat_psikologis,
            'penggunaanalatbantu' => $dataSet['penggunaanalatbantu'],
            'keterangan_alat_bantu' => $keterangan_alat_bantu,
            'cacattubuh' => $dataSet['cacattubuh'],
            'keterangancacattubuh' => $dataSet['keterangancacattubuh'],
            'Keluhannyeri' => $dataSet['Keluhannyeri'],
            'skalenyeripasien' => $dataSet['skalenyeripasien'],
            'resikojatuh' => $dataSet['resikojatuh'],
            'Skrininggizi' => $dataSet['Skrininggizi'],
            'skorskrininggizi' => $dataSet['skorskrininggizi'],
            'beratskrininggizi' => $dataSet['beratskrininggizi'],
            'status_asupanmkanan' => $dataSet['status_asupanmkanan'],
            'skorasupanmkanan' => $dataSet['skorasupanmkanan'],
            'totalskorgizi' => $dataSet['totalskorgizi'],
            'penyakitlainpasien' => $dataSet['penyakitlainpasien'],
            'diagnosakhusus' => $dataSet['diagnosakhusus'],
            'resikomalnutrisi' => $dataSet['resikomalnutrisi'],
            'tglpengkajianlanjutgizi' => $dataSet['tanggalkunjungan'], //sementara
            'diagnosakeperawatan' => $dataSet['diagnosakeperawatan'],
            'rencanakeperawatan' => $dataSet['rencanakeperawatan'],
            'tindakankeperawatan' => $dataSet['tindakankeperawatan'],
            'evaluasikeperawatan' => $dataSet['evaluasikeperawatan'],
            'namapemeriksa' => auth()->user()->name,
            'idpemeriksa' => auth()->user()->id,
            'status' => 2,
            'signature' => ''
        ];
        try {
            $cek = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE tanggalkunjungan = ? AND no_rm = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
            if (count($cek) > 0) {
                $data = [
                    'counter' => $dataSet['counter'],
                    'no_rm' => $dataSet['nomorrm'],
                    'kode_unit' => $dataSet['unit'],
                    'kode_kunjungan' => $dataSet['kodekunjungan'],
                    'tanggalkunjungan' => $dataSet['tanggalkunjungan'],
                    'tanggalperiksa' => $dataSet['tanggalperiksa'], //sementara
                    'sumberdataperiksa' => $dataSet['sumberdataperiksa'],
                    'keluhanutama' => $dataSet['keluhanutama'],
                    'tekanandarah' => $dataSet['tekanandarah'],
                    'frekuensinadi' => $dataSet['frekuensinadi'],
                    'frekuensinapas' => $dataSet['frekuensinapas'],
                    'suhutubuh' => $dataSet['suhutubuh'],
                    'Riwayatpsikologi' => $dataSet['Riwayatpsikologi'],
                    'keterangan_riwayat_psikolog' => $keterangan_riwayat_psikologis,
                    'penggunaanalatbantu' => $dataSet['penggunaanalatbantu'],
                    'keterangan_alat_bantu' => $keterangan_alat_bantu,
                    'cacattubuh' => $dataSet['cacattubuh'],
                    'keterangancacattubuh' => $dataSet['keterangancacattubuh'],
                    'Keluhannyeri' => $dataSet['Keluhannyeri'],
                    'skalenyeripasien' => $dataSet['skalenyeripasien'],
                    'resikojatuh' => $dataSet['resikojatuh'],
                    'Skrininggizi' => $dataSet['Skrininggizi'],
                    'skorskrininggizi' => $dataSet['skorskrininggizi'],
                    'beratskrininggizi' => $dataSet['beratskrininggizi'],
                    'status_asupanmkanan' => $dataSet['status_asupanmkanan'],
                    'skorasupanmkanan' => $dataSet['skorasupanmkanan'],
                    'totalskorgizi' => $dataSet['totalskorgizi'],
                    'penyakitlainpasien' => $dataSet['penyakitlainpasien'],
                    'diagnosakhusus' => $dataSet['diagnosakhusus'],
                    'resikomalnutrisi' => $dataSet['resikomalnutrisi'],
                    'tglpengkajianlanjutgizi' => $dataSet['tanggalkunjungan'], //sementara
                    'diagnosakeperawatan' => $dataSet['diagnosakeperawatan'],
                    'rencanakeperawatan' => $dataSet['rencanakeperawatan'],
                    'tindakankeperawatan' => $dataSet['tindakankeperawatan'],
                    'evaluasikeperawatan' => $dataSet['evaluasikeperawatan'],
                    'namapemeriksa' => auth()->user()->name,
                    'idpemeriksa' => auth()->user()->id,
                    'status' => 2,
                    'signature' => ''
                ];
                assesmenawal::whereRaw('no_rm = ? and kode_unit = ? and tanggalkunjungan = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['tanggalkunjungan']))->update($data);
            } else {
                $erm_assesmen = assesmenawal::create($data);
            }
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanpemeriksaandokter(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        // tgljamkunjungan
        if (empty($dataSet['hipertensi'])) {
            $hipertensi = (NULL);
        } else {
            $hipertensi = $dataSet['hipertensi'];
        };

        if (empty($dataSet['kencingmanis'])) {
            $kencingmanis = (NULL);
        } else {
            $kencingmanis = $dataSet['kencingmanis'];
        };

        if (empty($dataSet['jantung'])) {
            $jantung = (NULL);
        } else {
            $jantung = $dataSet['jantung'];
        };

        if (empty($dataSet['stroke'])) {
            $stroke = (NULL);
        } else {
            $stroke = $dataSet['stroke'];
        };

        if (empty($dataSet['hepatitis'])) {
            $hepatitis = (NULL);
        } else {
            $hepatitis = $dataSet['hepatitis'];
        };

        if (empty($dataSet['asthma'])) {
            $asthma = (NULL);
        } else {
            $asthma = $dataSet['asthma'];
        };

        if (empty($dataSet['ginjal'])) {
            $ginjal = (NULL);
        } else {
            $ginjal = $dataSet['ginjal'];
        };

        if (empty($dataSet['tb'])) {
            $tb = (NULL);
        } else {
            $tb = $dataSet['tb'];
        };

        if (empty($dataSet['riwayatlain'])) {
            $riwayatlain = (NULL);
        } else {
            $riwayatlain = $dataSet['riwayatlain'];
            if ($dataSet['ketriwayatlain'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Isi keterangan riwayat lain ...'
                ];
                echo json_encode($data);
                die;
            }
        };

        $data = [
            'id_asskep' => $request->idasskep,
            'kode_unit' => auth()->user()->unit,
            'kode_kunjungan' => $request->kodekunjungan,
            'no_rm' => $request->rm,
            'tanggal_periksa' => $dataSet['tgljampemeriksaan'],
            'keluhan_utama' => $dataSet['keluhanutama'],
            'riwayat_kehamilan' => $dataSet['riwayatkehamilan'],
            'riwayat_kelahiran' => $dataSet['riwayatkelahiran'],
            'riwayat_penyakit' => $dataSet['riwayatpenyakitsekarang'],
            'hipertensi' => $hipertensi,
            'kencingmanis' => $kencingmanis,
            'jantung' => $jantung,
            'stroke' => $stroke,
            'hepatitis' => $hepatitis,
            'asthma' => $asthma,
            'ginjal' => $ginjal,
            'tbparu' => $tb,
            'riwayatlain' => $riwayatlain,
            'ket_riwayat_lain' => $dataSet['ketriwayatlain'],
            'alergi' => $dataSet['alergi'],
            'ket_alergi' => $dataSet['ketalergi'],
            'status_generalis' => $dataSet['statusgeneralis'],
            'keadaanumum' => $dataSet['keadaanumum'],
            'kesadaran' => $dataSet['kesadaran'],
            'diagnosakerja' => $dataSet['diagnosakerja'],
            'diagnosapembanding' => $dataSet['diagnosapembanding'],
            'rencanakerja' => $dataSet['rencanakerja'],
            'namadokter' => $dataSet['namapemeriksa'],
            'iddokter' => $dataSet['idpemeriksa'],
            'signature' => '',
            'status' => 2
        ];
        try {
            $cek = DB::select('SELECT * from erm_hasil_assesmen_dokter_rajal WHERE kode_kunjungan = ? AND no_rm = ? AND kode_unit = ?', [$request->kodekunjungan, $request->rm, auth()->user()->unit]);
            if (count($cek) > 0) {
                $data = [
                    'id_asskep' => $request->idasskep,
                    'kode_unit' => auth()->user()->unit,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'no_rm' => $request->rm,
                    'tanggal_periksa' => $dataSet['tgljampemeriksaan'],
                    'keluhan_utama' => $dataSet['keluhanutama'],
                    'riwayat_penyakit' => $dataSet['riwayatpenyakitsekarang'],
                    'hipertensi' => $hipertensi,
                    'kencingmanis' => $kencingmanis,
                    'jantung' => $jantung,
                    'stroke' => $stroke,
                    'hepatitis' => $hepatitis,
                    'asthma' => $asthma,
                    'ginjal' => $ginjal,
                    'tbparu' => $tb,
                    'riwayatlain' => $riwayatlain,
                    'keadaanumum' => $dataSet['keadaanumum'],
                    'kesadaran' => $dataSet['kesadaran'],
                    'diagnosakerja' => $dataSet['diagnosakerja'],
                    'rencanakerja' => $dataSet['rencanakerja'],
                    'namadokter' => $dataSet['namapemeriksa'],
                    'iddokter' => $dataSet['idpemeriksa'],
                    'signature' => '',
                    'status' => 2,
                    'riwayat_kehamilan' => $dataSet['riwayatkehamilan'],
                    'riwayat_kelahiran' => $dataSet['riwayatkelahiran'],
                    'ket_riwayat_lain' => $dataSet['ketriwayatlain'],
                    'alergi' => $dataSet['alergi'],
                    'ket_alergi' => $dataSet['ketalergi'],
                    'status_generalis' => $dataSet['statusgeneralis'],
                    'diagnosapembanding' => $dataSet['diagnosapembanding']
                ];
                assesmenawal_dokter::whereRaw('no_rm = ? and kode_unit = ? and kode_kunjungan = ?', array($request->rm,  auth()->user()->unit, $request->kodekunjungan))->update($data);
            } else {
                $erm_assesmen = assesmenawal_dokter::create($data);
            }
            $data = [
                'status' => 2,
                'signature' => ''
            ];
            assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function detaillast_kj(Request $request)
    {
        $id = $request->id;
        $detail = DB::select('SELECT DISTINCT a.id,fc_nama_unit1(a.kode_unit) as nama_unit,d.`NAMA_TARIF` as nama_tarif FROM ts_layanan_header a LEFT OUTER JOIN ts_layanan_detail b ON a.id = b.row_id_header LEFT OUTER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL` LEFT OUTER JOIN mt_tarif_header d ON  c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER` WHERE a.`kode_kunjungan` = ?', [$id]);
        $hasilperiksa_perawat = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$id]);
        return view('perawat.detailkunjungan_akhir', [
            'last_rajal_detail' => $detail,
            'last_rajal_asskep' => $hasilperiksa_perawat
        ]);
    }
    public function formcppt(Request $request)
    {
        $datakunjungan = DB::select('select *,fc_nama_unit1(kode_unit) as nama_unit,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where no_rm = ?', [$request->nomorrm]);
        $rm = $request->nomorrm;
        $datapasien = DB::select('select *,nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat from mt_pasien where no_rm = ?', [$rm]);
        return view('erm.cppt', [
            'datakunjungan' => $datakunjungan,
            'pasien' => $datapasien,
            'cppt' => DB::select('SELECT DISTINCT 
            A.*
            ,id_asskep
            ,B.kode_unit as kode_unitnya
            ,B.kode_kunjungan as kode_kunjungannya
            ,B.no_rm
            ,B.rencanakerja
            ,tanggal_periksa
            ,keluhan_utama
            ,riwayat_penyakit
            ,hipertensi
            ,kencingmanis
            ,jantung
            ,stroke
            ,hepatitis
            ,asthma
            ,ginjal
            ,tbparu
            ,riwayatlain
            ,keadaanumum
            ,kesadaran
            ,diagnosakerja
            ,tindaklanjut
            ,hasilpenunjang
            ,tanggalassesmen
            ,namadokter
            ,iddokter
            ,diagnosapembanding
            ,B.signature AS signature_DOKTER
            ,B.status
            ,B.riwayat_kehamilan
            ,B.riwayat_kelahiran
            ,B.alergi
            ,B.ket_alergi
            ,B.status_generalis
            ,B.tanggalassesmen as assdok
            ,gambar            
             ,fc_nama_unit1(a.kode_unit) AS namaunit 
            FROM `erm_hasil_assesmen_keperawatan_rajal` a
            LEFT OUTER JOIN `erm_hasil_assesmen_dokter_rajal` b ON B.id_asskep = A.ID 
            WHERE  a.no_rm = ?', [$rm])
            // 'orderpenunjang' =>  DB::select("SELECT a.id as id_header,b.id as id_detail,fc_nama_unit1(a.kode_unit) AS nama_unit_tujuan,d.`NAMA_TARIF`, b.jumlah_layanan FROM ts_layanan_header_order a LEFT OUTER JOIN ts_layanan_detail_order b ON a.`id` = b.`row_id_header` LEFT OUTER JOIN mt_tarif_detail c ON b.`kode_tarif_detail` = c.`KODE_TARIF_DETAIL` LEFT OUTER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER` WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]),
            // 'tindakan' => DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
            // RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
            // RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
            // RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
            // RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
            // WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan])
        ]);
    }
    public function Hasilpemeriksaanpenunjang(Request $request)
    {
        $rm = $request->nomorrm;
        return view('erm.testing');
    }
    public function riwayatpengobatan(Request $request)
    {
        return view('erm.orderobat', [
            'kode_penjamin' => $request->kodepenjamin,
            'riwayat' => DB::select('SELECT a.`counter`
            ,a.`tgl_entry`
            ,a.`unit_pengirim` AS pengirim
            ,a.`dokter_pengirim` AS dokter_pengirim 
            ,fc_nama_barang(b.`kode_barang`) AS nama_obat
            ,b.`jumlah_layanan` AS jumlah
            ,b.`aturan_pakai`
            ,b.`tipe_anestesi`
            ,c.`satuan`
            ,c.`satuan_besar`
            FROM ts_order_farmasi_header a 
            LEFT OUTER JOIN ts_order_farmasi_detail b ON a.id = b.`row_id_header`
            LEFT OUTER JOIN mt_barang c ON b.`kode_barang` = c.`kode_barang`
            WHERE no_cm = ? ORDER BY a.`counter` DESC', [$request->no_rm])
        ]);
    }
    public function cariobat(Request $request)
    {
        if ($request->penjamin == 1) {
            $depo = '4008'; //bpjs
        } else if ($request->penjamin == 2) {
            $depo = '4002'; //BPJS
        }
        $stokobat = DB::select('CALL sp_cari_obat_stok_all_erm(?,?)', [$request->nama, $depo]);
        return view('erm.tabelobat', [
            'STOK' => $stokobat
        ]);
    }
    public function simpanorderfarmasi(Request $request)
    {

        $request->no_rm;
        $request->jenisresep;
        // 1 reguler
        // 2 kronis
        // 3 kemo
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;

        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'signa') {
                $arrayindex[] = $dataSet;
            }
        }
        $dataheader = [
            'kodekunjungan' => $request->kodekunjungan,
            'tgl_entry' => $now,
            'kode_unit' => $arrayindex[0]['depo'],
            'kode_tipe_transaksi' => '2',
            'pic' => auth()->user()->kode_dpjp,
            'unit_pengirim' => auth()->user()->unit,
            'status_order' => '1',
            'no_cm' => $request->no_rm,
            'jenisresep' => $request->jenisresep,
        ];
        $idheader = erm_header_order_farmasi::create($dataheader);
        //simpan order header farmasi
        //simpan order farmasi detail
        foreach ($arrayindex as $ai) {
            $datadetail = [
                'kodebarang' => $ai['kodelayanan'],
                'id_header' => $idheader['id'],
                'jumlah' => $ai['jumlah'],
                'signa' => $ai['signa'],
                'unit' => $ai['depo'],
            ];
            erm_detail_order_farmasi::create($datadetail);
        }
        // dd($arrayindex);
        $data = [
            'kode' => 200,
            'message' => 'a'
        ];
        echo json_encode($data);
        die;
    }
    public function cariorderobat(Request $request)
    {
        $request->kodekunjungan;
        return view('erm.orderfarmasi_today', [
            'riwayatorder' => DB::select('SELECT a.id AS id_header,b.`id` AS id_detail
            ,a.`tgl_entry`,b.`unit` AS unit 
            ,a.`pic`
            ,a.`status_order`
            ,a.`jenisresep`
            ,b.jumlah
            ,b.signa
            ,fc_nama_barang(b.`kodebarang`) nama_barang
            ,b.`kodebarang` FROM erm_order_farmasi_header a
            LEFT OUTER JOIN erm_order_farmasi_detail b ON a.`id` = b.`id_header` WHERE a.`kodekunjungan` = ?', [$request->kodekunjungan])
        ]);
    }
    public function lihatriwayatresep(Request $request)
    {
    }
    public function penandaangambar(Request $request)
    {
        $cek_awal_medis = DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        if (count($cek_awal_medis) > 0) {
            if (auth()->user()->unit == 1014) {
                $gbr = DB::select('select * from erm_tanda_gambar_mata where kodekunjungan = ? ', [$request->kodekunjungan]);
                return view('erm.gambarmata', [
                    'gbr' => $gbr,
                    'kodekunjungan' => $request->kodekunjungan,
                ]);
            } else if (auth()->user()->unit == 1019) {
                $gbr = DB::select('select * from erm_tanda_gambar_tht where kodekunjungan = ? ', [$request->kodekunjungan]);
                return view('erm.gambartht', [
                    'gbr' => $gbr,
                    'kodekunjungan' => $request->kodekunjungan,
                ]);
            } else if (auth()->user()->unit == 1012) {
                $gbr = DB::select('select * from erm_tanda_gambar_kandungan where kodekunjungan = ? ', [$request->kodekunjungan]);
                return view('erm.gambarkandungan', [
                    'gbr' => $gbr,
                    'kodekunjungan' => $request->kodekunjungan,
                ]);
            } else if (auth()->user()->unit == 1024) {
                $gbr = DB::select('select * from erm_tanda_gambar_paru where kodekunjungan = ? ', [$request->kodekunjungan]);
                return view('erm.gambarparu', [
                    'gbr' => $gbr,
                    'kodekunjungan' => $request->kodekunjungan,
                ]);
            } else if (auth()->user()->unit == 1007) {
                $gbr = DB::select('select * from erm_tanda_gambar_gigi where kodekunjungan = ? ', [$request->kodekunjungan]);
                return view('erm.gambargigi', [
                    'gbr' => $gbr,
                    'kodekunjungan' => $request->kodekunjungan,
                ]);
            } else {
                echo "<h5 class='mt-3 text-danger'>Tidak ada form pemeriksaan khusus ...</h5>";
            }
        } else {
            echo "<h5 class='mt-3 text-danger'>Form assesmen awal medis belum diisi ...</h5>";
        }
    }
    public function terapitindakan(Request $request)
    {
        $unit = auth()->user()->unit;
        $layanan = $request->layanan;
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $kelas = $datakunjungan[0]->kelas;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);

        $riwayat_tindakan_tdy = DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
        LEFT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        LEFT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        LEFT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        LEFT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('erm.order', [
            'tindakan' => $layanan,
            'riwayat' => $riwayat_tindakan_tdy,
            'cek_asmed' => count($cek_hasil_periksa)
        ]);
    }
    public function tindakanhariini(Request $request)
    {
        $riwayat_tindakan_tdy = DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('erm.riwayattindakan_tdy', [
            'riwayat' => $riwayat_tindakan_tdy
        ]);
    }
    public function orderhariini(Request $request)
    {
        $riwayat_tindakan_tdy = DB::connection('mysql3')->select("
        SELECT a.id as id_header,b.id as id_detail,fc_nama_unit1(a.kode_unit) AS nama_unit_tujuan,d.`NAMA_TARIF`, b.jumlah_layanan FROM ts_layanan_header a LEFT OUTER JOIN ts_layanan_detail b ON a.`id` = b.`row_id_header` LEFT OUTER JOIN mt_tarif_detail c ON b.`kode_tarif_detail` = c.`KODE_TARIF_DETAIL` LEFT OUTER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER` WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('erm.order_tdy', [
            'riwayat' => $riwayat_tindakan_tdy
        ]);
    }
    public function ambillayanan(Request $request)
    {
        $unit = $request->kode;
        $layanan = $request->layanan;
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $kelas = $datakunjungan[0]->kelas;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        return view('erm.layananpenunjang', [
            'tindakan' => $layanan,
        ]);
    }
    public function orderpenunjang(Request $request)
    {
        $unit = DB::select('select * from mt_unit where SUBSTR(kode_unit,1,1) = ? AND kelas_unit = ?', ['3', '3']);
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);

        // $layanan = $this->carilayanan($kelas,$layanan,$unit);
        return view('erm.orderpenunjang', [
            'unit' => $unit,
            'cek_asmed' => count($cek_hasil_periksa)
        ]);
    }
    public function tindaklanjut(Request $request)
    {
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('erm.tindaklanjut', [
            'cek_assmed' => $cek_hasil_periksa
        ]);
    }
    public function detail_asskep(Request $request)
    {
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        $hasil = count($cek_hasil_periksa);
        if ($hasil > 0) {
            return view('perawat.detail_asskep', [
                'hasil' => $cek_hasil_periksa
            ]);
        } else {
            echo "<h4 class='text-danger'> Perawat Belum mengisi ...</h4>";
        }
    }
    public function carilayanan($kelas, $nama, $unit)
    {
        $layanan = DB::select("CALL SP_PANGGIL_TARIF_TINDAKAN_RS('$kelas','$nama','$unit')");
        return $layanan;
    }
    public function simpanlayanan(Request $request)
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;

        $cek_layanan_header = count(DB::connection('mysql2')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$request->kodekunjungan]));
        if ($cek_layanan_header > 0) {
            $back = [
                'kode' => 500,
                'message' => 'Layanan sudah diinput, silahkan cek riwayat tindakan !'
            ];
            echo json_encode($back);
            die;
        }
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('SELECT * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $penjamin = $kunjungan[0]->kode_penjamin;
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kunjungan[0]->kode_unit]);
        $prefix_kunjungan = $unit[0]->prefix_unit;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'cyto') {
                $arrayindex[] = $dataSet;
            }
        }
        try {
            $kode_unit = $kunjungan[0]->kode_unit;
            $r = DB::select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                DB::select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
            }
            $data_layanan_header = [
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' =>   $now,
                'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                'kode_unit' => $kunjungan['0']->kode_unit,
                'kode_tipe_transaksi' => 2,
                'pic' => auth()->user()->id,
                'status_layanan' => '3',
                'status_retur' => 'OPN',
                'status_pembayaran' => 'OPN'
            ];
            //data yg diinsert ke ts_layanan_header
            //simpan ke layanan header
            $ts_layanan_header = ts_layanan_header::create($data_layanan_header);
            $grand_total_tarif = 0;
            foreach ($arrayindex as $d) {
                if ($penjamin == 'P01') {
                    $tagihanpenjamin = 0;
                    $tagihanpribadi = $d['tarif'] * $d['qty'];
                } else {
                    $tagihanpenjamin = $d['tarif'] * $d['qty'];
                    $tagihanpribadi = 0;
                }
                $id_detail = $this->createLayanandetail();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $d['kodelayanan'],
                    'total_tarif' => $d['tarif'],
                    'jumlah_layanan' => $d['qty'],
                    'diskon_layanan' => $d['disc'],
                    'total_layanan' => $d['tarif'] * $d['qty'],
                    'grantotal_layanan' => $d['tarif'] * $d['qty'],
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_penjamin' => $tagihanpenjamin,
                    'tagihan_pribadi' => $tagihanpribadi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail::create($save_detail);
                $grand_total_tarif = $grand_total_tarif + $d['tarif'];
            }
            if ($penjamin == 'P01') {
                ts_layanan_header::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
            } else {
                ts_layanan_header::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
            }
            $data = [
                'status' => 2,
                'signature' => ''

            ];
            assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update($data);
            $back = [
                'kode' => 200,
                'message' => ''
            ];
            echo json_encode($back);
            die;
        } catch (\Exception $e) {
            $back = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
    }
    public function simpanorder(Request $request)
    {
        //insert langsung ke ts_layanan_header dan ts_layanan_detail
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;

        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('SELECT * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $penjamin = $kunjungan[0]->kode_penjamin;
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$request->kodepenunjang]);
        $prefix_kunjungan = $unit[0]->prefix_unit;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'cyto') {
                $arrayindex[] = $dataSet;
            }
        }
        try {
            $id_header = $this->createOrderHeader($prefix_kunjungan);
            $save_header = [
                'kode_header' => $id_header,
                'tgl_header' => date('Y-m-d')
            ];
            $header = mt_kode_header::create($save_header);
            if ($penjamin == 'P01') {
                $kode_tipe_transaksi = '1';
            } else {
                $kode_tipe_transaksi = '2';
            }
            $data_layanan_header = [
                'kode_layanan_header' => $id_header,
                'no_rm' => $request->no_rm,
                'tgl_entry' => $now,
                'kode_kunjungan' => $kodekunjungan,
                'status_layanan' => 3,
                'status_order' => 'order',
                'kode_unit' => $request->kodepenunjang,
                'kode_tipe_transaksi' => $kode_tipe_transaksi,
                'kode_penjaminx' => $penjamin,
                'dok_kirim' => auth()->user()->kode_dpjp,
                'unit_pengirim' => auth()->user()->unit,
                'pic' => auth()->user()->kode_dpjp,
                'status_order' => 0
            ];
            $hed = erm_order_header::create($data_layanan_header);
            $total_layanan_header = 0;
            foreach ($arrayindex as $arr) {
                if($arr['tarif'] == '1'){
                    $disc = 100;
                }else{
                    $disc = $arr['disc'];
                }
                $totallayanan = $arr['tarif'] * $arr['qty'];
                $diskon = $disc / 100 * $totallayanan;
                $totalakhir = $totallayanan - $diskon;
                if($kode_tipe_transaksi == 1){
                    $tagihan_pribadi = $totalakhir;
                    $tagihan_penjamin = 0;
                }else{
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $totalakhir;
                }
                $id_detail = $this->createLayanandetail();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $id_header,
                    'kode_tarif_detail' => $arr['kodelayanan'],
                    'total_tarif' => $arr['tarif'],
                    'jumlah_layanan' => $arr['qty'],
                    'diskon_dokter' => $disc,
                    'cyto' => $arr['cyto'],
                    'total_layanan' =>$totallayanan,
                    'grantotal_layanan' => $totalakhir,
                    'status_layanan_detail' => 'CCL',
                    'kode_dokter1' => auth()->user()->kode_dpjp,
                    'tgl_layanan_detail' => $now,
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $hed['id']
                ];
                erm_order_detail::create($save_detail);
                $total_layanan_header2 = $totalakhir;
                $total_layanan_header = $total_layanan_header2 + $total_layanan_header;
            }
            if($kode_tipe_transaksi == 1){
                $tagihan_pribadi_header = $total_layanan_header;
                $tagihan_penjamin_header = 0;
            }else{
                $tagihan_pribadi_header = 0;
                $tagihan_penjamin_header = $total_layanan_header;
            }
            erm_order_header::whereRaw('id = ?', array($hed->id))->update(['total_layanan' => $total_layanan_header,'tagihan_pribadi' => $tagihan_pribadi_header, 'tagihan_penjamin' => $tagihan_penjamin_header]);
            $data = [
                'status' => 2,
                'signature' => ''
            ];
            assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update($data);
            $back = [
                'kode' => 200,
                'message' => ''
            ];
            echo json_encode($back);
            die;
        } catch (\Exception $e) {
            $back = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
    }
    public function createOrderHeader($unit)
    {
        $date = date('Y-m-d');
        $q = DB::connection('mysql3')->select('SELECT id,kode_header,RIGHT(kode_header,6) AS kd_max  FROM mt_kode_order_header 
        WHERE DATE(tgl_header) = ?
        ORDER BY id DESC
        LIMIT 1',[$date]);
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $unit . date('ymd') . $kd;
    }
    public function createLayanandetail()
    {
        $q = DB::connection('mysql2')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail
        WHERE DATE(tgl_layanan_detail) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'DET' . date('ymd') . $kd;
    }
    public function batalorder(Request $request)
    {
        $id = $request->idheader;
        DB::connection('mysql3')->select('DELETE FROM ts_layanan_detail WHERE row_id_header = ?', [$request->idheader]);
        DB::connection('mysql3')->select('DELETE FROM ts_layanan_header WHERE id = ?', [$request->idheader]);
        $data = [
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        $back = [
            'kode' => 200,
            'message' => 'order dibatalkan !'
        ];
        echo json_encode($back);
        die;
    }
    public function returorder(Request $request)
    {
        $id = $request->idheader;
        $data = [
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        DB::connection('mysql3')->select('DELETE FROM ts_layanan_detail WHERE id = ?', [$request->iddetail]);
        $back = [
            'kode' => 200,
            'message' => 'order diretur !'
        ];
        echo json_encode($back);
        die;
    }
    public function bataltindakan(Request $request)
    {
        //untuk batal semua tindakan
        $id = $request->idheader;
        $data = [
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        DB::connection('mysql2')->select('DELETE FROM ts_layanan_detail WHERE row_id_header = ?', [$request->idheader]);
        DB::connection('mysql2')->select('DELETE FROM ts_layanan_header WHERE id = ?', [$request->idheader]);
        $back = [
            'kode' => 200,
            'message' => 'order dibatalkan !'
        ];
        echo json_encode($back);
        die;
    }
    public function returtindakan(Request $request)
    {
        //untuk retur 1 tindakan
        $id = $request->idheader;
        $data = [
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        DB::connection('mysql2')->select('DELETE FROM ts_layanan_detail WHERE id = ?', [$request->iddetail]);
        $back = [
            'kode' => 200,
            'message' => 'order diretur !'
        ];
        echo json_encode($back);
        die;
    }
    public function formtindaklanjut(Request $request)
    {
        $id = $request->id;
        if ($id == 1) {
            return view('erm.tindaklanjut.dirujuk', []);
        } else if ($id == 2) {
            return view('erm.tindaklanjut.konsul', []);
        } else if ($id == 3) {
            return view('erm.tindaklanjut.rawatinap', []);
        } else if ($id == 4) {
            return view('erm.tindaklanjut.pulang', []);
        }
    }
    public function resumemedis(Request $request)
    {
        $datakunjungan = DB::select('select *,fc_nama_unit1(kode_unit) as nama_unit,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        //ambil gambar berdasarkan unit login
        if (auth()->user()->unit == '1019') {
            $gambar = DB::select('select * from erm_tanda_gambar_tht where kodekunjungan = ?', [$request->kodekunjungan]);
        } else if (auth()->user()->unit == '1014') {
            $gambar = DB::select('select * from erm_tanda_gambar_mata where kodekunjungan = ?', [$request->kodekunjungan]);
            // gambarmata::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($data);
        } else if (auth()->user()->unit == '1024') {
            $gambar = DB::select('select * from erm_tanda_gambar_paru where kodekunjungan = ?', [$request->kodekunjungan]);
            // gambarparu::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($data);
        } else if (auth()->user()->unit == '1007') {
            $gambar = DB::select('select * from erm_tanda_gambar_gigi where kodekunjungan = ?', [$request->kodekunjungan]);
            // gambargigi::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($data);
        } else {
            $gambar = [];
        }
        $farmasi = DB::select('SELECT a.tgl_entry
        ,a.jenisresep
        ,a.`status_order`
        ,fc_nama_barang(b.`kodebarang`) AS nama_barang
        ,b.kodebarang
        ,b.signa
        ,b.`jumlah` FROM erm_order_farmasi_header a
        INNER JOIN erm_order_farmasi_detail b ON  a.id = b.id_header
        WHERE a.kodekunjungan = ?', [$request->kodekunjungan]);
        if (auth()->user()->hak_akses == 2) {
            return view('erm.resume_perawat', [
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'pasien' => $datapasien,
                'asskep' => DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'assmed' => DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'orderpenunjang' =>  DB::select("SELECT a.id as id_header,b.id as id_detail,fc_nama_unit1(a.kode_unit) AS nama_unit_tujuan,d.`NAMA_TARIF`, b.jumlah_layanan FROM ts_layanan_header_order a LEFT OUTER JOIN ts_layanan_detail_order b ON a.`id` = b.`row_id_header` LEFT OUTER JOIN mt_tarif_detail c ON b.`kode_tarif_detail` = c.`KODE_TARIF_DETAIL` LEFT OUTER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER` WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]),
                'tindakan' => DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
            RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
            RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
            RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
            RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
            WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]),
                'gambar' => $gambar,
                'farmasi' => $farmasi
            ]);
        } else {
            return view('erm.resume', [
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'pasien' => $datapasien,
                'asskep' => DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'assmed' => DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'orderpenunjang' =>  DB::select("SELECT a.id as id_header,b.id as id_detail,fc_nama_unit1(a.kode_unit) AS nama_unit_tujuan,d.`NAMA_TARIF`, b.jumlah_layanan FROM ts_layanan_header_order a LEFT OUTER JOIN ts_layanan_detail_order b ON a.`id` = b.`row_id_header` LEFT OUTER JOIN mt_tarif_detail c ON b.`kode_tarif_detail` = c.`KODE_TARIF_DETAIL` LEFT OUTER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER` WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]),
                'tindakan' => DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
            RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
            RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
            RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
            RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
            WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]),
                'gambar' => $gambar,
                'farmasi' => $farmasi
            ]);
        }
    }
    public function pasienpulang(Request $request)
    {
        $data = [
            'tindaklanjut' => 'Pasien dipulangkan',
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Tindak Lanjut pasien dipulangkan ...'
        ];
        echo json_encode($data);
        die;
    }
    public function pasienranap(Request $request)
    {
        $data = [
            'tindaklanjut' => 'Pasien dirawat inap',
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Tindak Lanjut pasien rawat inap ...'
        ];
        echo json_encode($data);
        die;
    }
    public function simpansignature(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $tglassesmen = $request->tglassesmen;
        $namapemeriksa = $request->namapemeriksa;
        $idpemeriksa = $request->idpemeriksa;
        $signature = $request->signature;
        $data = [
            'tanggalassesmen' => $tglassesmen,
            // 'namadokter' => $namapemeriksa,
            // 'iddokter' => $idpemeriksa,
            'signature' => $signature,
            'status' => 1
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Assemen awal medis sudah disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpangambar(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $img = $request->img;
        $id = $request->id;

        //jika poli tht
        if (auth()->user()->unit == '1019') {
            $cek_gbr = DB::select('select * from erm_tanda_gambar_tht where kodekunjungan = ? ', [$kodekunjungan]);
        } else if (auth()->user()->unit == '1014') {
            $cek_gbr = DB::select('select * from erm_tanda_gambar_mata where kodekunjungan = ? ', [$kodekunjungan]);
        } else if (auth()->user()->unit == '1024') {
            $cek_gbr = DB::select('select * from erm_tanda_gambar_paru where kodekunjungan = ? ', [$kodekunjungan]);
        } else if (auth()->user()->unit == '1007') {
            $cek_gbr = DB::select('select * from erm_tanda_gambar_gigi where kodekunjungan = ? ', [$kodekunjungan]);
        }

        if (count($cek_gbr) == 0) {
            if ($id == 'telingakanan') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'telingakanan' => $img,
                ];
            }
            if ($id == 'telingakiri') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'telingakiri' => $img,
                ];
            }
            if ($id == 'laring') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'laring' => $img,
                ];
            }
            if ($id == 'faring') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'faring' => $img,
                ];
            }
            if ($id == 'leher') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'leherkepala' => $img,
                ];
            }
            if ($id == 'maksilofasial') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'maksilofasial' => $img,
                ];
            }
            if ($id == 'bolamata') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'bolamata' => $img,
                ];
            }
            if ($id == 'paruparu') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'paruparu' => $img,
                ];
            }
            if ($id == 'gigi') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'gigi' => $img,
                ];
            }
            if (auth()->user()->unit == '1019') {
                $gambartht = gambartht::create($data);
            } else if (auth()->user()->unit == '1014') {
                $gambarmata = gambarmata::create($data);
            } else if (auth()->user()->unit == '1024') {
                $gambarparu = gambarparu::create($data);
            } else if (auth()->user()->unit == '1007') {
                $gambargigi = gambargigi::create($data);
            }
        } else {
            if ($id == 'telingakanan') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'telingakanan' => $img,
                ];
            }
            if ($id == 'telingakiri') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'telingakiri' => $img,
                ];
            }
            if ($id == 'laring') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'laring' => $img,
                ];
            }
            if ($id == 'faring') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'faring' => $img,
                ];
            }
            if ($id == 'leher') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'leherkepala' => $img,
                ];
            }
            if ($id == 'maksilofasial') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'maksilofasial' => $img,
                ];
            }
            if ($id == 'bolamata') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'bolamata' => $img,
                ];
            }
            if ($id == 'paruparu') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'paruparu' => $img,
                ];
            }
            if ($id == 'gigi') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'gigi' => $img,
                ];
            }
            if (auth()->user()->unit == '1019') {
                gambartht::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($data);
            } else if (auth()->user()->unit == '1014') {
                gambarmata::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($data);
            } else if (auth()->user()->unit == '1024') {
                gambarparu::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($data);
            } else if (auth()->user()->unit == '1007') {
                gambargigi::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($data);
            }
        }
        $data = [
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Assemen awal medis sudah disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpansignature_perawat(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $tglassesmen = $request->tglassesmen;
        $namapemeriksa = $request->namapemeriksa;
        $idpemeriksa = $request->idpemeriksa;
        $signature = $request->signature;
        $data = [
            'tanggalassemen' => $tglassesmen,
            // 'namapemeriksa' => $namapemeriksa,
            // 'idpemeriksa' => $idpemeriksa,
            'signature' => $signature,
            'status' => 1
        ];
        assesmenawal::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Assemen awal keperawatan sudah disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function cekresume(Request $request)
    {
        if (auth()->user()->hak_akses == 3) {
            $cek_resume = DB::select("select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?", [$request->kodekunjungan]);
        } else {
            $cek_resume = DB::select("select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?", [$request->kodekunjungan]);
        }
        if (count($cek_resume) > 0) {
            $data = [
                'kode' => 200,
                'data' => $cek_resume[0]->signature
            ];
        } else {
            $data = [
                'kode' => 500,
                'data' => 0
            ];
        }
        echo json_encode($data);
        die;
    }
    public function ambilgambar(Request $request)
    {
        $id = $request->id;
        $kodekunjungan = $request->kodekunjungan;
        if (auth()->user()->unit == '1019') {
            $gbr = DB::select('select * from erm_tanda_gambar_tht where kodekunjungan = ? ', [$kodekunjungan]);
        } else if (auth()->user()->unit == '1014') {
            $gbr = DB::select('select * from erm_tanda_gambar_mata where kodekunjungan = ? ', [$kodekunjungan]);
        } else if (auth()->user()->unit == '1012') {
            $gbr = DB::select('select * from erm_tanda_gambar_kandungan where kodekunjungan = ? ', [$kodekunjungan]);
        } else if (auth()->user()->unit == '1024') {
            $gbr = DB::select('select * from erm_tanda_gambar_paru where kodekunjungan = ? ', [$kodekunjungan]);
        } else if (auth()->user()->unit == '1007') {
            $gbr = DB::select('select * from erm_tanda_gambar_gigi where kodekunjungan = ? ', [$kodekunjungan]);
        }
        if ($id == 'lar') {
            return view('erm.gambar_laring', [
                'gbr' => $gbr
            ]);
        } else if ($id == 'tkan') {
            return view('erm.gambar_telingakanan', [
                'gbr' => $gbr,
            ]);
        } else if ($id == 'tkir') {
            return view('erm.gambar_telingakiri', [
                'gbr' => $gbr,
            ]);
        } else if ($id == 'far') {
            return view('erm.gambar_faring', [
                'gbr' => $gbr,
            ]);
        } else if ($id == 'maks') {
            return view('erm.gambar_maks', [
                'gbr' => $gbr,
            ]);
        } else if ($id == 'leh') {
            return view('erm.gambar_leh', [
                'gbr' => $gbr
            ]);
        } else if ($id == 'mata') {
            return view('erm.bolamata', [
                'gbr' => $gbr
            ]);
        } else if ($id == 'paru') {
            return view('erm.paruparu', [
                'gbr' => $gbr
            ]);
        } else if ($id == 'gigi') {
            return view('erm.gigi', [
                'gbr' => $gbr
            ]);
        }
    }
    public function hapusgambar(Request $request)
    {
        if ($request->kode == 'telingakanan') {
            $data = [
                'telingakanan' => (NULL)
            ];
        }
        if ($request->kode == 'telingakiri') {
            $data = [
                'telingakiri' => (NULL)
            ];
        }
        if ($request->kode == 'faring') {
            $data = [
                'faring' => (NULL)
            ];
        }
        if ($request->kode == 'laring') {
            $data = [
                'laring' => (NULL)
            ];
        }
        if ($request->kode == 'maksilofasial') {
            $data = [
                'maksilofasial' => (NULL)
            ];
        }
        if ($request->kode == 'leherkepala') {
            $data = [
                'leherkepala' => (NULL)
            ];
        }
        if ($request->kode == 'bolamata') {
            $data = [
                'bolamata' => (NULL)
            ];
        }
        if ($request->kode == 'paruparu') {
            $data = [
                'paruparu' => (NULL)
            ];
        }
        if ($request->kode == 'gigi') {
            $data = [
                'gigi' => (NULL)
            ];
        }
        if (auth()->user()->unit == '1019') {
            gambartht::whereRaw('kodekunjungan = ?', array($request->kodekunjungan))->update($data);
        } else if (auth()->user()->unit == '1014') {
            gambarmata::whereRaw('kodekunjungan = ?', array($request->kodekunjungan))->update($data);
        } else if (auth()->user()->unit == '1007') {
            gambargigi::whereRaw('kodekunjungan = ?', array($request->kodekunjungan))->update($data);
        } else if (auth()->user()->unit == '1024') {
            gambarparu::whereRaw('kodekunjungan = ?', array($request->kodekunjungan))->update($data);
        }
        echo json_encode('ok');
    }
    public function ambilgambar_cppt(Request $request)
    {
        if ($request->kodeunit == '1019') {
            $gambar = DB::select('select * from erm_tanda_gambar_tht where kodekunjungan = ?', [$request->kode]);
            return view('erm.garmbarcppt', [
                'gbr' => $gambar
            ]);
        }
        if ($request->kodeunit == '1014') {
            $gambar = DB::select('select * from erm_tanda_gambar_mata where kodekunjungan = ?', [$request->kode]);
            return view('erm.garmbarcppt_mata', [
                'gbr' => $gambar
            ]);
        }
        if ($request->kodeunit == '1024') {
            $gambar = DB::select('select * from erm_tanda_gambar_paru where kodekunjungan = ?', [$request->kode]);
            return view('erm.garmbarcppt_paru', [
                'gbr' => $gambar
            ]);
        }
        if ($request->kodeunit == '1007') {
            $gambar = DB::select('select * from erm_tanda_gambar_gigi where kodekunjungan = ?', [$request->kode]);
            return view('erm.garmbarcppt_gigi', [
                'gbr' => $gambar
            ]);
        } else {
            echo 'Cooming Soon ...';
        }
    }
    public function simpanformmata(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $cek = DB::select('select * from erm_tanda_gambar_mata where kodekunjungan = ?', [$kodekunjungan]);
        $jlh = count($cek);
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $isi = [
            'kodekunjungan' => $kodekunjungan,
            'od_visus_dasar' => $dataSet['od_visus_dasar'],
            'od_pinhole_visus_dasar' => $dataSet['od_pinhole_visus_dasar'],
            'os_visus_dasar' => $dataSet['os_visus_dasar'],
            'os_pinhole_visus_dasar' => $dataSet['os_pinhole_visus_dasar'],
            'od_sph_refraktometer' => $dataSet['od_sph_refraktometer'],
            'od_cyl_refraktometer' => $dataSet['od_cyl_refraktometer'],
            'od_x_refraktometer' => $dataSet['od_x_refraktometer'],
            'os_sph_refraktometer' => $dataSet['os_sph_refraktometer'],
            'os_cyl_refraktometer' => $dataSet['os_cyl_refraktometer'],
            'os_x_refraktometer' => $dataSet['os_x_refraktometer'],
            'od_sph_Lensometer' => $dataSet['od_sph_Lensometer'],
            'od_cyl_Lensometer' => $dataSet['od_cyl_Lensometer'],
            'od_x_Lensometer' => $dataSet['od_x_Lensometer'],
            'os_sph_Lensometer' => $dataSet['os_sph_Lensometer'],
            'os_cyl_Lensometer' => $dataSet['os_cyl_Lensometer'],
            'os_x_Lensometer' => $dataSet['os_x_Lensometer'],
            'vod_sph_kpj' => $dataSet['vod_sph_kpj'],
            'vod_cyl_kpj' => $dataSet['vod_cyl_kpj'],
            'vod_x_kpj' => $dataSet['vod_x_kpj'],
            'vos_sph_kpj' => $dataSet['vos_sph_kpj'],
            'vos_cyl_kpj' => $dataSet['vos_cyl_kpj'],
            'vos_x_kpj' => $dataSet['vos_x_kpj'],
            'penglihatan_dekat' => $dataSet['penglihatan_dekat'],
            'tekanan_intra_okular' => $dataSet['tekanan_intra_okular'],
            'catatan_pemeriksaan_lainnya' => $dataSet['catatan_pemeriksaan_lainnya'],
            'palpebra' => $dataSet['palpebra'],
            'konjungtiva' => $dataSet['konjungtiva'],
            'kornea' => $dataSet['kornea'],
            'bilik_mata_depan' => $dataSet['bilik_mata_depan'],
            'pupil' => $dataSet['pupil'],
            'iris' => $dataSet['iris'],
            'lensa' => $dataSet['lensa'],
            'funduskopi' => $dataSet['funduskopi'],
            'oftamologis' => $dataSet['oftamologis'],
            'masalahmedis' => $dataSet['masalahmedis'],
            'prognosis' => $dataSet['prognosis'],
        ];
        try {
            if ($jlh > 0) {
                gambarmata::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($isi);
            } else {
                $gambarmata = gambarmata::create($isi);
            }
            $data = [
                'kode' => 200,
                'message' => 'Form pemeriksaan khusus berhasil disimpan ...'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanformparu(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $cek = DB::select('select * from erm_tanda_gambar_paru where kodekunjungan = ?', [$kodekunjungan]);
        $jlh = count($cek);
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $isi = [
            'kodekunjungan' => $kodekunjungan,
            'Inspeksi' => $dataSet['Inspeksi'],
            'keteranganinspeksi' => $dataSet['keteranganinspeksi'],
            'selaiga' => $dataSet['selaiga'],
            'vocalfremitus' => $dataSet['vocalfremitus'],
            'sonar' => $dataSet['sonar'],
            'hipersonar' => $dataSet['hipersonar'],
            'vesikuler' => $dataSet['vesikuler'],
            'ronchi' => $dataSet['ronchi'],
            'wheezing' => $dataSet['wheezing'],
            'tgl_entry' => carbon::now()->timezone('Asia/jakarta')
        ];
        try {
            if ($jlh > 0) {
                gambarparu::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($isi);
            } else {
                $gambarparu = gambarparu::create($isi);
            }
            $data = [
                'kode' => 200,
                'message' => 'Form pemeriksaan khusus berhasil disimpan ...'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanformobgyn(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $cek = DB::select('select * from erm_tanda_gambar_paru where kodekunjungan = ?', [$kodekunjungan]);
        $jlh = count($cek);
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $isi = [
            'kodekunjungan' => $kodekunjungan,
            'Inspeksi' => $dataSet['Inspeksi'],
            'keteranganinspeksi' => $dataSet['keteranganinspeksi'],
            'selaiga' => $dataSet['selaiga'],
            'vocalfremitus' => $dataSet['vocalfremitus'],
            'sonar' => $dataSet['sonar'],
            'hipersonar' => $dataSet['hipersonar'],
            'vesikuler' => $dataSet['vesikuler'],
            'ronchi' => $dataSet['ronchi'],
            'wheezing' => $dataSet['wheezing'],
            'tgl_entry' => carbon::now()->timezone('Asia/jakarta')
        ];
        try {
            if ($jlh > 0) {
                gambarparu::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($isi);
            } else {
                $gambarparu = gambarparu::create($isi);
            }
            $data = [
                'kode' => 200,
                'message' => 'Form pemeriksaan khusus berhasil disimpan ...'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function riwayatfarmasi(Request $request)
    {
        $kodekunjungan = $request->kode;
        $farmasi = DB::select('SELECT a.tgl_entry
        ,a.jenisresep
        ,a.`status_order`
        ,fc_nama_barang(b.`kodebarang`) AS nama_barang
        ,b.kodebarang
        ,b.signa
        ,b.`jumlah` FROM erm_order_farmasi_header a
        INNER JOIN erm_order_farmasi_detail b ON  a.id = b.id_header
        WHERE a.kodekunjungan = ?', [$kodekunjungan]);
        echo $farmasi[0]->nama_barang;
    }
    public function riwayattindakan(Request $request)
    {
        $riwayat_tindakan = DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kode]);
        return view('erm.riwayattindakancppt', [
            'tindakan' => $riwayat_tindakan
        ]);
    }
    public function hasilpenunjang(Request $request)
    {
        echo 'Data Not Found';
    }
    public function carikodeicd(Request $request)
    {
        
    }
}
