<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Kehadiran - {{ $event->nama_event }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Daftar Kehadiran</h2>
        <p>{{ $event->nama_event }}</p>
        <p>Tanggal: {{ $tanggal }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Angkatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kehadirans as $kehadiran)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kehadiran->nama }}</td>
                <td>{{ $kehadiran->nim }}</td>
                <td>{{ $kehadiran->angkatan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Kehadiran: {{ $kehadirans->count() }} orang</p>
    </div>
</body>
</html>