<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan</title>
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
    <h1>REKAP TAGIHAN</h1>
    <h1><?= $transaksi[0]->customer_nama ?></h1>
    <h3>Per <?= strftime('%d %b %Y', strtotime($mulai)) ?> s/d <?= strftime('%d %b %Y', strtotime($selesai)) ?></h3>
    <table class="table table-bordered">
        <thead>
            <tr style="background-color: #eeeeee;">
                <th>No</th>
                <th>Pekerjaan</th>
                <th>No. OK</th>
                <th>Tgl</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1;
            $total = 0;
            foreach ($transaksi as $u) :
                $total += $u->transaksi_total;
            ?>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $u->barang_pekerjaan; ?></td>
                    <td><?= $u->transaksi_id; ?></td>
                    <td><?= strftime('%d %b %Y', strtotime($u->transaksi_created)); ?></td>
                    <td class="text-right"><?= number_format($u->transaksi_total); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="bold">
                <td class="text-center" colspan="4">TOTAL</td>
                <td class="text-right"><?= number_format($total) ?></td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <tr>
            <td width="33%">&nbsp;</td>
            <td width="33%">&nbsp;</td>
            <td width="33%" class="text-center" style="border-bottom: 1px solid #555555;">
                Hormat Kami,<br />
                <br /><br /><br /><br />
            </td>
        </tr>
    </table>
</body>

</html>