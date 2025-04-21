<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

    <h2>Laporan Pembayaran</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Kontrol</th>
                <th>Nama Pelanggan</th>
                <th>Bulan/Tahun</th>
                <th>Total Bayar</th>
                <th>Tanggal Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($pembayaran instanceof \App\Models\Pemakaian)
                <!-- If only a single record is returned -->
                <tr>
                    <td>1</td>
                    <td>{{ $pembayaran->no_kontrol }}</td>
                    <td>{{ $pembayaran->pelanggan->name }}</td>
                    <td>{{ $pembayaran->bulan }}/{{ $pembayaran->tahun }}</td>
                    <td>Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y') }}</td>
                    <td>{{ ucfirst($pembayaran->status) }}</td>
                </tr>
            @else
                <!-- If multiple records are returned -->
                @foreach ($pembayaran as $index => $pembayaranItem)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pembayaranItem->no_kontrol }}</td>
                        <td>{{ $pembayaranItem->pelanggan->name }}</td>
                        <td>{{ $pembayaranItem->bulan }}/{{ $pembayaranItem->tahun }}</td>
                        <td>Rp {{ number_format($pembayaranItem->total_bayar, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($pembayaranItem->tanggal_bayar)->format('d M Y') }}</td>
                        <td>{{ ucfirst($pembayaranItem->status) }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Generated on: {{ \Carbon\Carbon::now()->format('d M Y H:i:s') }}</p>
    </div>

</body>
</html>
