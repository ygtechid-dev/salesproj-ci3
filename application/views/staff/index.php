<div class="content-wrapper" style="background-color: #f8f9fa;">
    <section class="content-header">
        <h1 class="text-dark">Kelola Staff</h1>
    </section>

    <section class="content">
        <div class="card shadow-sm" style="background-color: #ffffff;">
            <div class="card-header">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addStaffModal">Tambah Staff</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Posisi</th>
                            <th>Alamat</th>
                            <th>Nomor Telpon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($staff as $s) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $s['nama_lengkap']; ?></td>
                                <td><?= $s['nama_posisi']; ?></td> <!-- Tampilkan nama_posisi -->
                                <td><?= $s['alamat']; ?></td>
                                <td><?= $s['nomor_telpon']; ?></td>
                                <td>
                                    <a href="<?= base_url('staff/edit/') . $s['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('staff/delete/') . $s['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>


<!-- Modal Tambah Staff -->
<div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('staff/add'); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStaffModalLabel">Tambah Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <select class="form-control" name="posisi" required>
                            <option value="">Pilih Posisi</option>
                            <?php foreach ($posisi as $p) : ?>
                                <option value="<?= $p['id_posisi']; ?>"><?= $p['nama_posisi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telpon</label>
                        <input type="text" class="form-control" name="nomor_telpon" required>
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
