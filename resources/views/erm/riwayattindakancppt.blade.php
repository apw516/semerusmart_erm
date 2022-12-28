<table class="table table-sm table-bordered">
    <thead>
        <th>Nama Tindakan</th>
        <th>Jumlah Tindakan</th>
    </thead>
    <tbody>
        @if(count($tindakan) > 0)
        @foreach($tindakan as $t)
        <tr>
            <td>{{ $t->NAMA_TARIF }}</td>
            <td>{{ $t->jumlah_layanan }}</td>
        </tr>
        @endforeach
        @else
        Data Tidak Ditemukan !
        @endif
    </tbody>
</table>