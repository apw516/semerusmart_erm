   <h5 class="text-bold mb-3">Data Order Farmasi</h5>
   @if(count($riwayatorder) > 0)
   <table id="tableorder" class="table table-sm table-bordered">
       <thead>
           <th>Tanggal order</th>
           <th>Unit</th>
           <th>Nama Obat</th>
           <th>Jumlah</th>
           <th>Jenis</th>
           <th>Signa</th>
           <th>Status</th>
           <th>pilih</th>
       </thead>
       <tbody>
           @foreach($riwayatorder as $a)
           <tr>
               <td>{{ $a->tgl_entry}}</td>
               <td>
               @if($a->unit == 4008)
                   DEPO 2 ( BPJS )
                   @elseif($a->unit == 4002)
                   DEPO FARMASI ( UMUM )
                   @endif
               </td>
               <td>{{ $a->nama_barang}}</td>
               <td>{{ $a->jumlah}}</td>
               <td>
                   @if($a->jenisresep == 80)
                   Reguler
                   @elseif($a->jenisresep == 81)
                   Kronis
                   @elseif($a->jenisresep == 82)
                   Kemotherapi
                   @endif
               </td>
               <td>{{ $a->signa}}</td>
               <td>
                   @if($a->status_order == 1)
                   On Proses
                   @elseif($a->status_order == 0)
                   Batal
                   @endif
               </td>
               <td>
                   <button class="badge badge-warning">retur</button>
                   <button class="badge badge-danger">batal</button>
               </td>
           </tr>
           @endforeach
       </tbody>
   </table>
   @else
   <h5>Tidak ada order farmasi yang dikirim !</h5>
   @endif

   <script>
       $(function() {
           $("#tableorder").DataTable({
               "responsive": false,
               "lengthChange": false,
               "pageLength": 3,
               "autoWidth": false,
               "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
           });
       });
   </script>