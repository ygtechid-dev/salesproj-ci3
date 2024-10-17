<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Penjualan</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <h2>Tambah Data Penjualan</h2>
    <form action="<?= site_url('penjualan/store'); ?>" method="POST">
      <div class="form-group">
        <label for="tanggal_penjualan">Tanggal Penjualan</label>
        <input type="date" name="tanggal_penjualan" class="form-control" required>
      </div>
      d
      <div class="form-group">
        <label for="tuan_rumah">Tuan Rumah</label>
        <input type="text" name="tuan_rumah" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</body>

</html>