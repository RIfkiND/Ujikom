<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemakaian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }
        .header h1 {
            font-size: 26px;
            margin: 0;
            color: #2c3e50;
        }
        .header p {
            font-size: 16px;
            margin: 5px 0;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            color: #2c3e50;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .details, .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .details td {
            padding: 10px;
            font-size: 16px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }
        .table th {
            background-color: #f4f4f4;
            font-size: 16px;
            color: #2c3e50;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            border-top: 2px solid #ddd;
            padding-top: 10px;
        }
        .highlight {
            font-weight: bold;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Detail Pemakaian</h1>
        <p><strong>No Kontrol:</strong> {{ $pemakaian->no_kontrol }}</p>
        <p><strong>Nama Pelanggan:</strong> {{ $pemakaian->pelanggan->name }}</p>
        <p><strong>Alamat:</strong> {{ $pemakaian->pelanggan->alamat }}</p>
        <p><strong>Jenis Pelanggan:</strong> {{ $pemakaian->pelanggan->tarif->jenis_plg }}</p>
    </div>

    <div class="section-title">Informasi Pemakaian</div>
    <table class="details">
        <tr>
            <td><strong>Tahun:</strong></td>
            <td>{{ $pemakaian->tahun }}</td>
        </tr>
        <tr>
            <td><strong>Bulan:</strong></td>
            <td>{{ \Carbon\Carbon::create()->month($pemakaian->bulan)->translatedFormat('F') }}</td>
        </tr>
        <tr>
            <td><strong>Meter Awal:</strong></td>
            <td>{{ $pemakaian->meter_awal }}</td>
        </tr>
        <tr>
            <td><strong>Meter Akhir:</strong></td>
            <td>{{ $pemakaian->meter_akhir }}</td>
        </tr>
        <tr>
            <td><strong>Pakai (kWh):</strong></td>
            <td>{{ $pemakaian->jumlah_pakai }}</td>
        </tr>
    </table>

    <div class="section-title">Rincian Biaya</div>
    <table class="details">
        <tr>
            <td><strong>Biaya Beban:</strong></td>
            <td class="highlight">Rp {{ number_format($pemakaian->biaya_beban_pemakaian, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><strong>Biaya Pemakaian:</strong></td>
            <td class="highlight">Rp {{ number_format($pemakaian->biaya_pemakaian, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><strong>Total Bayar:</strong></td>
            <td class="highlight">Rp {{ number_format($pemakaian->total_bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><strong>Status:</strong></td>
            <td>{{ ucfirst($pemakaian->status) }}</td>
        </tr>
        @if ($pemakaian->status === 'lunas')
            <tr>
                <td><strong>Tanggal Bayar:</strong></td>
                <td>{{ $pemakaian->tanggal_bayar }}</td>
            </tr>
        @endif
    </table>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Ujikom. All rights reserved.</p>
    </div>
</body>
</html>
