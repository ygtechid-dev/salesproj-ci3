<div class="content-wrapper" style="background-color: #f8f9fa;">
    <section class="content-header">
        <h1 class="text-dark">Kelola Posisi</h1>
    </section>

    <section class="content">
        <div class="card shadow-sm" style="background-color: #ffffff;">
            <div class="card-header">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPosisiModal">Tambah Posisi</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Posisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($posisi as $p) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $p['nama_posisi']; ?></td>
                                <td>
                                    <a href="<?= base_url('posisi/edit/') . $p['id_posisi']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('posisi/delete/') . $p['id_posisi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Posisi -->
<div class="modal fade" id="addPosisiModal" tabindex="-1" role="dialog" aria-labelledby="addPosisiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('posisi/add'); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPosisiModalLabel">Tambah Posisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Posisi</label>
                        <input type="text" class="form-control" name="nama_posisi" required>
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
