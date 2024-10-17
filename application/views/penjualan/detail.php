<div class="content-wrapper bg-white">
  <section class="content p-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow">
            <div class="card-header bg-primary text-white">
              <h3 class="card-title">Detail Penjualan</h3>
            </div>
            <div class="card-body">
              <!-- Detail Penjualan -->
              <div class="row mb-4">
                <div class="col-md-6">
                  <table class="table table-borderless">
                    <tr>
                      <th width="150">Negosiator</th>
                      <td>: <?= $penjualan['nama_nego'] ?? 'N/A' ?></td>
                    </tr>
                    <tr>
                      <th>Sopir</th>
                      <td>: <?= $penjualan['nama_sopir'] ?? 'N/A' ?></td>
                    </tr>
                    <tr>
                      <th>Tanggal</th>
                      <td>:
                        <?= isset($penjualan['tanggal_penjualan']) ? date('d-m-Y', strtotime($penjualan['tanggal_penjualan'])) : 'N/A' ?>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>

              <!-- Tabel Transaksi -->
              <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                  <h4 class="card-title">Data Transaksi</h4>
                  <button type="button" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#modalTambahTransaksi">
                    <i class="fas fa-plus"></i> Tambah Transaksi
                  </button>
                </div>
                <div class="card-body">
                  <!-- Flash Message -->
                  <?php if (isset($_SESSION['flashdata']['success'])) : ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['flashdata']['success'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php endif; ?>

                  <?php if (isset($_SESSION['flashdata']['error'])) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['flashdata']['error'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php endif; ?>

                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Nama Sales</th>
                          <th>Barang</th>
                          <th>Harga</th>
                          <th>Customer</th>
                          <th>Uang Akad</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($transaksis)): ?>
                        <?php foreach ($transaksis as $t): ?>
                        <tr>
                          <td class="border border-gray-300 px-4 py-2"><?= $t['nama_sales']; ?></td>
                          <td class="border border-gray-300 px-4 py-2"><?= $t['nama_barang']; ?></td>
                          <td class="border border-gray-300 px-4 py-2"><?= number_format($t['harga'], 0, ',', '.'); ?>
                          </td>
                          <td class="border border-gray-300 px-4 py-2"><?= $t['customer']; ?></td>
                          <td class="border border-gray-300 px-4 py-2">
                            <?= number_format($t['uang_akad'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                          <td colspan="6" class="text-center">Belum ada data transaksi</td>
                        </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal Tambah Transaksi -->
  <div class="modal fade" id="modalTambahTransaksi" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Tambah Transaksi</h5>
          <button type="button" class="close text-white" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('penjualan/add_transaksi') ?>" method="post">
          <div class="modal-body">
            <input type="hidden" name="penjualan_id" value="<?= $penjualan['id'] ?>">
            <input type="hidden" name="unique_string" value="<?= $penjualan['unique_string'] ?>">

            <div class="form-group">
              <label>Nama Sales</label>
              <select name="nama_sales" class="form-control" required>
                <option value="">Pilih Sales</option>
                <?php foreach ($sales as $s) : ?>
                <option value="<?= $s['id_user'] ?>"><?= $s['nama_lengkap'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="barang">Barang</label>
              <select class="form-control" id="barang" name="barang" required>
                <option value="">Pilih Barang</option>
                <?php if (isset($barang) && is_array($barang)): ?>
                <?php foreach ($barang as $b) : ?>
                <option value="<?= $b['id_barang'] ?>"><?= $b['nama_barang'] ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>

            <div class="form-group">
              <label>Harga</label>
              <input type="number" name="harga" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Nama Pembeli</label>
              <input type="text" name="nama_pembeli" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Uang Akad</label>
              <input type="number" name="uang_akad" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>