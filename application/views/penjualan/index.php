<div class="content-wrapper" style="background-color: #f8f9fa;">
  <section class="content-header">
    <h1 class="text-dark">Kelola Penjualan</h1>
  </section>

  <section class="content">
    <div class="card shadow-sm" style="background-color: #ffffff;">
      <div class="card-header">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPenjualanModal">Tambah Penjualan</a>
      </div>

      <div class="card-body">
        <?php
        $grouped_penjualan = [];
        foreach ($penjualan as $p) {
          $tanggal = $p['tanggal_penjualan'];
          if (!isset($grouped_penjualan[$tanggal])) {
            $grouped_penjualan[$tanggal] = [];
          }
          $grouped_penjualan[$tanggal][] = $p;
        }

        foreach ($grouped_penjualan as $tanggal => $penjualan_group):
        ?>
        <h4><?= $tanggal ?></h4>
        <table class="table table-bordered table-hover mb-4">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Nama Negosiator</th>
              <th>Nama Sopir</th>
              <th>Tuan Rumah</th>
              <th>ID Tuan Rumah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 1;
              $total_transaksi = count($penjualan_group);
              $total_uang_akad = 0; 
              foreach ($penjualan_group as $p):
                $total_uang_akad += isset($p['uang_akad']) ? $p['uang_akad'] : 0;
              ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $p['nama_nego']; ?></td>
              <td><?= $p['nama_sopir']; ?></td>
              <td><?= $p['tuan_rumah']; ?></td>
              <td><?= $p['id_tuan_rumah']; ?></td>
              <td>
                <a href="<?= base_url('penjualan/detail/' . $p['id']); ?>" class="btn btn-info">Detail</a>
                <?php if (isset($p['id'])): ?>
                <a href="<?= base_url('penjualan/delete/' . $p['id']); ?>" class="btn btn-danger"
                  onclick="return confirm('Apakah Anda yakin ingin menghapus penjualan ini?');">Hapus</a>
                <?php else: ?>
                <span class="text-danger">ID tidak ditemukan</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <!-- <tr>
              <td colspan="6">
                <strong>Jumlah Transaksi: <?= $total_transaksi ?></strong><br>
                <strong>Total Uang Akad: Rp <?= number_format($total_uang_akad, 0, ',', '.') ?></strong>
              </td>
            </tr> -->
          </tfoot>
        </table>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</div>

<!-- Modal Tambah Penjualan -->
<div class="modal fade" id="addPenjualanModal" tabindex="-1" role="dialog" aria-labelledby="addPenjualanModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPenjualanModalLabel">Tambah Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('penjualan/add'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Tanggal Penjualan</label>
            <input type="date" class="form-control" name="tanggal_penjualan" required>
          </div>
          <div class="form-group">
            <label for="nego">Nego</label>
            <select name="id_negosiator" class="form-control" required>
              <option value="">Pilih Negosiator</option>
              <?php foreach ($negosiator as $user): ?>
              <option value="<?= $user['id_user']; ?>"><?= $user['nama_lengkap']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="sopir">Sopir</label>
            <select name="sopir" class="form-control" required>
              <option value="">Pilih Sopir</option>
              <?php foreach ($sopir as $sop): ?>
              <option value="<?= $sop['id_user']; ?>"><?= $sop['nama_lengkap']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tuan Rumah</label>
            <input type="text" class="form-control" name="tuan_rumah" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>