<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>
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

<body>
    <table class="table">
        <tr>
            <td width="50%" class="text-center">
                <table class="table">
                    <tr>
                        <td width="15%">
                            <img src="data:image/<?= $extension . ';base64,' . $logo; ?>" height="70px" />
                        <td class="small text-center">
                            <h1 class="p-0 m-0">BENGKEL HARAPAN</h1>
                            Jl. Milono RT. 11 Kel. Gayam Kec. Tg. Redeb<br />
                            Hp. 0812-5074-5638<br />
                        </td>
                        <td width="10%"></td>
                    </tr>
                </table>
            </td>
            <td width="10%"></td>
            <td>
                <table class="table">
                    <tr>
                        <td width="30%">Tgl Masuk</td>
                        <td>: <?= strftime('%d %b %Y', strtotime($item->transaksi_created)) ?></td>
                    </tr>
                    <tr>
                        <td>OK No.</td>
                        <td>: <?= $item->transaksi_id ?></td>
                    </tr>
                    <tr>
                        <td>Customer</td>
                        <td>: <?= $item->customer_nama ?></td>
                    </tr>
                    <tr>
                        <td>Hp</td>
                        <td>: <?= $item->customer_telp ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="table table-bordered">
        <thead>
            <tr style="background-color: #eeeeee;">
                <th width="5%">NO</th>
                <th width="20%">NAMA BARANG</th>
                <th>JENIS PEKERJAAN</th>
                <th width="12%">QTY</th>
                <th width="13%">HRG SATUAN</th>
                <th width="15%">TOTAL HARGA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = 1;
            foreach ($barang as $b) : ?>
                <tr>
                    <td class="text-center"><?= $nomor++ ?></td>
                    <td><?= $b->barang_nama ?></td>
                    <td><?= $b->barang_pekerjaan ?></td>
                    <td><?= $b->barang_qty . ' ' . $b->satuan_nama ?></td>
                    <td class="text-right"><?= number_format($b->barang_harga, 0, ',', '.') ?></td>
                    <td class="text-right"><?= number_format($b->barang_qty * $b->barang_harga, 0, ',', '.') ?></td>
                </tr>
            <?php
            endforeach;
            for ($i = $nomor; $i < 8; $i++) {
                echo '<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>';
            }
            ?>
            <tr>
                <td colspan="5" class="text-center bold">GRAND TOTAL</td>
                <td class="text-right bold"><?= number_format($item->transaksi_total, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <tr>
            <td width="30%" class="text-center" style="border-bottom: 1px solid #555555;">
                Diambil,<br />
            </td>
            <td width="10%"></td>
            <td>
                <table class="table table-bordered" style="margin-bottom: 0.50rem">
                    <tr>
                        <td class="small-x text-center">
                            DALAM TEMPO 3 BULAN<br />
                            BARANG TIDAK DIAMBIL<br />
                            BUKAN TANGGUNG JAWAB KAMI
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered" style="margin-bottom: 0.50rem">
                    <tr>
                        <td class="small-x text-center">
                            <h3 class="m-0 p-0">
                                NO. REK BANK MANDIRI<br />
                                An. Manika<br />
                                AC. 148-000-426-555-2
                            </h3>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="10%"></td>
            <td width="30%" class="text-center" style="border-bottom: 1px solid #555555;">
                Diterima,<br />
            </td>
        </tr>
    </table>
</body>

</html>