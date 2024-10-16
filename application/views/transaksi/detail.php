<?php if ($transaksi): ?>
    <p><strong>Nama Tuan Rumah:</strong> <?= $transaksi['nama_tuan_rumah']; ?></p>
    <p><strong>Alamat Tuan Rumah:</strong> <?= $transaksi['alamat_tuan_rumah']; ?></p>
    <p><strong>Kontak Tuan Rumah:</strong> <?= $transaksi['kontak_tuan_rumah']; ?></p>
    <p><strong>Customer:</strong> <?= $transaksi['customer']; ?></p>
    <p><strong>Alamat Customer:</strong> <?= $transaksi['alamat_customer']; ?></p>
    <p><strong>Kontak Customer:</strong> <?= $transaksi['kontak_customer']; ?></p>
    <p><strong>Harga:</strong> <?= number_format($transaksi['harga'], 2, ',', '.'); ?></p>
    <p><strong>Uang Akad:</strong> <?= number_format($transaksi['uang_akad'], 2, ',', '.'); ?></p>
    <p><strong>Tanggal Jatuh Tempo:</strong> <?= $transaksi['tanggal_jatuh_tempo']; ?></p>
    <p><strong>Termin 1:</strong> <?= number_format($transaksi['termin1'], 2, ',', '.'); ?></p>
    <p><strong>Termin 2:</strong> <?= number_format($transaksi['termin2'], 2, ',', '.'); ?></p>
    <p><strong>Termin 3:</strong> <?= number_format($transaksi['termin3'], 2, ',', '.'); ?></p>
    <p><strong>Termin 4:</strong> <?= number_format($transaksi['termin4'], 2, ',', '.'); ?></p>
    <p><strong>Prosentase Sales:</strong> <?= $transaksi['prosentase_sales']; ?>%</p>
    <p><strong>Prosentase Negosiator:</strong> <?= $transaksi['prosentase_negosiator']; ?>%</p>
    <p><strong>Prosentase Kolektor:</strong> <?= $transaksi['prosentase_kolektor']; ?>%</p>
<?php else: ?>
    <p>Data transaksi tidak ditemukan.</p>
<?php endif; ?>
