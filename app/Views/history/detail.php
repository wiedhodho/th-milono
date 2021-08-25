<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Status</th>
            <th>Tgl</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($item as $i) : ?>
            <tr>
                <td><?= $nomor++ ?></td>
                <td><span class="badge badge-pill badge-<?= $status[$i->history_status]['warna'] ?>"><?= $status[$i->history_status]['label'] ?></span></td>
                <td><?= $i->history_tanggal ?></td>
                <td><?= $i->users_nama ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>