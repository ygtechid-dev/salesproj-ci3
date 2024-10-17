<!DOCTYPE html>
<html>
<head>
    <title>Form Penjualan</title>
</head>
<body>
    <h1>Form Penjualan</h1>
    <?= validation_errors(); ?>
    <?= form_open('penjualan/store'); ?>
        <label for="tanggal_penjualan">Tanggal Penjualan:</label>
        <input type="date" name="tanggal_penjualan" id="tanggal_penjualan"><br>

        <label for="nama_nego">Nama Nego:</label>
        <select name="nama_nego" id="nama_nego">
            <?php foreach ($nego as $n): ?>
                <option value="<?= $n->id ?>"><?= $n->nama ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="nama_sopir">Nama Sopir:</label>
        <select name="nama_sopir" id="nama_sopir">
            <?php foreach ($sopir as $s): ?>
                <option value="<?= $s->id ?>"><?= $s->nama ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="tuan_rumah">Tuan Rumah:</label>
        <input type="text" name="tuan_rumah" id="tuan_rumah"><br>

        <button type="submit">Simpan</button>
    <?= form_close(); ?>
</body>
</html>