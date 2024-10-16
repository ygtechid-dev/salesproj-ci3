<div class="content-wrapper" style="background-color: #f8f9fa;">
    <section class="content-header">
        <h1 class="text-dark">Kelola Setting</h1>
    </section>

    <section class="content">
        <div class="card shadow-sm" style="background-color: #ffffff;">
            <div class="card-header">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addSettingModal">Tambah Setting</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Lama Tempo</th>
                            <th>Prosentase Sales</th>
                            <th>Prosentase Kolektor</th>
                            <th>Prosentase Negosiator</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($settings as $s) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $s['lama_tempo']; ?></td>
                                <td><?= $s['prosentase_sales']; ?></td>
                                <td><?= $s['prosentase_kolektor']; ?></td>
                                <td><?= $s['prosentase_negosiator']; ?></td>
                                <td>
                                    <a href="<?= base_url('setting/edit/') . $s['id_setting']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('setting/delete/') . $s['id_setting']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Setting -->
<div class="modal fade" id="addSettingModal" tabindex="-1" role="dialog" aria-labelledby="addSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('setting/add'); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSettingModalLabel">Tambah Setting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Lama Tempo</label>
                        <input type="text" class="form-control" name="lama_tempo" required>
                    </div>
                    <div class="form-group">
                        <label>Prosentase Sales</label>
                        <input type="number" class="form-control" name="prosentase_sales" required>
                    </div>
                    <div class="form-group">
                        <label>Prosentase Kolektor</label>
                        <input type="number" class="form-control" name="prosentase_kolektor" required>
                    </div>
                    <div class="form-group">
                        <label>Prosentase Negosiator</label>
                        <input type="number" class="form-control" name="prosentase_negosiator" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
