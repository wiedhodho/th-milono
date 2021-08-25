<table class="table">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="20%">Nama Barang</th>
            <th width="15%">QTY</th>
            <th>Pekerjaan</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($item as $i) : ?>
            <tr>
                <td><?= $nomor++ ?></td>
                <td><?= $i->barang_nama ?></td>
                <td><?= $i->barang_qty . ' ' . $i->satuan_nama ?></td>
                <td><?= $i->barang_pekerjaan ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>