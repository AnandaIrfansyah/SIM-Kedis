<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak QR Code Kendaraan</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            margin: 10px;
        }
        .grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .row {
            display: table-row;
        }
        .cell {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            padding: 15px;
            width: 33.33%;
            border: 0.5px solid #000;
        }
        .qr {
            margin-bottom: 8px;
        }
        img {
            width: 130px;
            height: 130px;
        }
        .plat {
            font-size: 20px;
            font-weight: bold;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <h2>Daftar QR Code Kendaraan</h2>
    <div class="grid">
        @foreach($kendaraans->chunk(3) as $chunk)
            <div class="row">
                @foreach($chunk as $kendaraan)
                    <div class="cell">
                        <div class="qr">
                            @php
                                $qrPath = 'storage/qr_code/' . $kendaraan->qr_code . '.png';
                            @endphp
                            @if(file_exists(public_path($qrPath)))
                                <img src="{{ public_path($qrPath) }}" alt="QR {{ $kendaraan->no_polisi }}">
                            @endif
                        </div>
                        <div class="plat">{{ $kendaraan->no_polisi }}</div>
                    </div>
                @endforeach
                @for ($i = $chunk->count(); $i < 3; $i++)
                    <div class="cell"></div>
                @endfor
            </div>
        @endforeach
    </div>
</body>
</html>
