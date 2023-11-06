<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Booking</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mt-0 {
            margin-top: 0;
        }

        .mt-3 {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <h2 class="mt-0 mb-0">PT. PRIMA INTI NUSA</h2>
    <h2 class="mt-0 mb-0">PERUMAHAN {{ strtoupper($bookings[0]->perumahan->name) }}</h2>
    <h2 class="mt-0 mb-0"> 01 {{ date('F', strtotime($month)) }} s/d 31 {{ date('F', strtotime($month)) }}</h2>
    <table class="mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Tanggal Booking</th>
                <th>Tanggal Akad</th>
                <th>Type/Blok</th>
                <th>Token Listrik</th>
                <th>IMB</th>
                <th>PDAM</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->akad_at ? date('Y-m-d', strtotime($item->akad_at)) : '' }}</td>
                    <td>{{ $item->perumahanBlok->name }} - {{ $item->perumahanBlok->no }}</td>
                    <td>{{ $item->perumahanBlok->no_token_listrik ? '' : 'OK' }}</td>
                    <td>{{ $item->perumahanBlok->no_imb ? '' : 'OK' }}</td>
                    <td>{{ $item->perumahanBlok->no_id_pdam ? '' : 'OK' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.print();
        window.onafterprint = function() {
            window.history.back();
        };
    </script>
</body>

</html>
