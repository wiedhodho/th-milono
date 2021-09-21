<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        html {
            margin: 30px 30px 0px 40px;
        }

        body {
            /* border: 1px solid #555555; */
            margin: 0px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8pt;
        }

        table {
            /* width: 100%; */
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
        }

        .table {
            width: 100%;
            margin-bottom: 0.75rem;
            background-color: transparent;

        }

        .table th,
        .table td {
            vertical-align: top;
            padding: 0.10rem;
        }

        .table thead th {
            vertical-align: bottom;
        }

        .table tbody+tbody {
            border-top: 2px solid #555555;
        }

        .table .table {
            background-color: #fff;
        }

        .table-bordered {
            border: 1px solid #555555;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #555555;
            padding: 0.30rem;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .small {
            font-size: 10px;
        }

        .small-x {
            font-size: 7px;
        }

        .p-0 {
            padding: 0px;
        }

        .m-0 {
            margin: 0px;
        }
    </style>
</head>

<body class="text-center">
    <h1>LAPORAN KEUANGAN</h1>
    <h3>Per <?= strftime('%d %b %Y', strtotime($mulai)) ?> s/d <?= strftime('%d %b %Y', strtotime($selesai)) ?></h3>
    <table class="table table-bordered">
        <thead>
            <tr style="background-color: #eeeeee;">
                <th>No</th>
                <th>Keterangan</th>
                <th>Transfer</th>
                <th style="width:18%">Tgl</th>
                <th class="text-right">Debet</th>
                <th class="text-right">Kredit</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1;
            $total_kredit = 0;
            $total_debet = 0;
            foreach ($keuangan as $u) :
                $u->keuangan_dk == 'D' ? $total_debet += $u->keuangan_nominal : $total_kredit += $u->keuangan_nominal;
            ?>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $u->keuangan_keterangan; ?></td>
                    <td><?= $u->keuangan_transfer == '1' ? 'Transfer' : ''; ?></td>
                    <td><?= strftime('%d %b %Y', strtotime($u->keuangan_created)); ?></td>
                    <td class="text-right"><?php if ($u->keuangan_dk == 'D') echo number_format($u->keuangan_nominal); ?></td>
                    <td class="text-right"><?php if ($u->keuangan_dk == 'K') echo number_format($u->keuangan_nominal); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="bold">
                <td class="text-center" colspan="4">TOTAL</td>
                <td class="text-right"><?= number_format($total_debet) ?></td>
                <td class="text-right"><?= number_format($total_kredit) ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>