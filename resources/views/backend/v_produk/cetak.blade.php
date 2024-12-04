<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ccc;
    }

    table tr td {
        padding: 6px;
        font-weight: normal;
        border: 1px solid #ccc;
    }

    table th {
        border: 1px solid #ccc
    }
</style>
<table>
    <tr>
        <td align="left">
            Perihal: {{ $judul }} <br />
            Tanggal Awal: {{ $tanggalAwal }} s/d Tanggal Akhir: {{ $tanggalAkhir }}
        </td>
    </tr>
</table>
<br />
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cetak as $row)
        <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {{ $row->kategori->nama_kategori }} </td>
            <td>
                @if ($row->status == 0)
                    Publis
                @elseif($row->role == 1)
                    Blok
                @endif
            </td>
            <td> {{ $row->nama_produk }} </td>
            <td> Rp. {{ number_format($row->harga, 0, ',', '.') }} </td>
            <td> {{ $row->stok }} </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    window.onload = function() {
        printStruk();
    }

    function printStruk() {
        window.print();
    }
</script>