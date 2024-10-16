<div class="content-wrapper" style="background-color: #f8f9fa;">
    <section class="content-header">
        <h1 class="text-dark">Kelola Transaksi</h1>
    </section>

    <section class="content">
        <div class="card shadow-sm" style="background-color: #ffffff;">
            <div class="card-header">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addTransaksiModal">Tambah Transaksi</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Tuan Rumah</th>
                            <th>Customer</th>
                            <th>Harga</th>
                            <th>Uang Akad</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($transaksi as $t) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $t['nama_tuan_rumah']; ?></td>
                                <td><?= $t['customer']; ?></td>
                                <td><?= number_format($t['harga'], 2, ',', '.'); ?></td>
                                <td><?= number_format($t['uang_akad'], 2, ',', '.'); ?></td>
                                <td>
                                    <a href="<?= base_url('transaksi/edit/') . $t['id_transaksi']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('transaksi/delete/') . $t['id_transaksi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailTransaksiModal" onclick="showDetail(<?= $t['id_transaksi']; ?>)">Detail</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Transaksi -->
<!-- Modal Tambah Transaksi -->
<div class="modal fade" id="addTransaksiModal" tabindex="-1" role="dialog" aria-labelledby="addTransaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTransaksiModalLabel">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transaksi/add'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Tuan Rumah</label>
                        <input type="text" class="form-control" name="nama_tuan_rumah" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Tuan Rumah</label>
                        <input type="text" class="form-control" name="alamat_tuan_rumah" required>
                    </div>
                    <div class="form-group">
                        <label>Kontak Tuan Rumah</label>
                        <input type="text" class="form-control" name="kontak_tuan_rumah" required>
                    </div>
                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" class="form-control" name="customer" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Customer</label>
                        <input type="text" class="form-control" name="alamat_customer" required>
                    </div>
                    <div class="form-group">
                        <label>Kontak Customer</label>
                        <input type="text" class="form-control" name="kontak_customer" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control" name="tanggal_jatuh_tempo" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="harga" id="harga" required oninput="calculateTermin()">
                    </div>
                    <div class="form-group">
                        <label>Uang Akad</label>
                        <input type="number" class="form-control" name="uang_akad" id="uang_akad" required oninput="calculateTermin()">
                    </div>
                    <div class="form-group">
                        <label>Termin 1</label>
                        <input type="text" class="form-control" name="termin1" id="termin1" readonly>
                    </div>
                    <div class="form-group">
                        <label>Termin 2</label>
                        <input type="text" class="form-control" name="termin2" id="termin2" readonly>
                    </div>
                    <div class="form-group">
                        <label>Termin 3</label>
                        <input type="text" class="form-control" name="termin3" id="termin3" readonly>
                    </div>
                    <div class="form-group">
                        <label>Termin 4</label>
                        <input type="text" class="form-control" name="termin4" id="termin4" readonly>
                    </div>
        <!-- Inside your modal -->
        <div class="form-group">
    <label>Sales</label>
    <select name="id_sales" class="form-control" required>
        <option value="">Pilih Sales</option>
        <?php foreach ($users['sales'] as $user): ?>
            <option value="<?= $user['id_user']; ?>"><?= $user['nama_lengkap']; ?></option>
        <?php endforeach; ?>
    </select>
</div>


<div class="form-group">
    <label>Negosiator</label>
    <select name="id_negosiator" class="form-control" required>
        <option value="">Pilih Negosiator</option>
        <?php foreach ($users['negosiator'] as $user): ?>
            <option value="<?= $user['id_user']; ?>"><?= $user['nama_lengkap']; ?></option>
        <?php endforeach; ?>
    </select>
</div>


<div class="form-group">
    <label>Kolektor</label>
    <select name="id_kolektor" class="form-control" required>
        <option value="">Pilih Kolektor</option>
        <?php foreach ($users['kolektor'] as $user): ?>
            <option value="<?= $user['id_user']; ?>"><?= $user['nama_lengkap']; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="form-group">
    <label>Sopir</label>
    <select name="id_sopir" class="form-control" required>
        <option value="">Pilih Sopir</option>
        <?php foreach ($users['sopir'] as $user): ?>
            <option  value="<?= $user['id_user']; ?>"><?= $user['nama_lengkap']; ?></option>
        <?php endforeach; ?>
    </select>
</div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal Detail Transaksi -->
<div class="modal fade" id="detailTransaksiModal" tabindex="-1" role="dialog" aria-labelledby="detailTransaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTransaksiModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-transaksi-content">
                <!-- Detail data will be populated here via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetail(id) {
        $.ajax({
            url: "<?= base_url('transaksi/get_detail/') ?>" + id,
            method: "GET",
            success: function(data) {
                $('#detail-transaksi-content').html(data);
            }
        });
    }

    function calculateTermin() {
        var harga = parseFloat(document.getElementById('harga').value) || 0;
        var uangAkad = parseFloat(document.getElementById('uang_akad').value) || 0;
        var sisa = harga - uangAkad;

        if (sisa > 0) {
            var termin = sisa / 4;
            document.getElementById('termin1').value = termin.toFixed(2);
            document.getElementById('termin2').value = termin.toFixed(2);
            document.getElementById('termin3').value = termin.toFixed(2);
            document.getElementById('termin4').value = termin.toFixed(2);
        } else {
            document.getElementById('termin1').value = 0;
            document.getElementById('termin2').value = 0;
            document.getElementById('termin3').value = 0;
            document.getElementById('termin4').value = 0;
        }
    }
</script>
