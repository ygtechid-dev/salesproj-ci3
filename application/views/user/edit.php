<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit <?= $title; ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Kelola <?= $title; ?></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Edit <?= $title; ?>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url($link . '/' . $data['id']); ?>" method="post" enctype="multipart/form-data">
                            <input type='hidden' name='_method' value='PUT' />
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" disabled placeholder="Username" value="<?= $data['username']; ?>">
                            </div>
                            <?= form_error('username', '<div class="error text-danger mb-2" style="margin-top: -15px">', '</div>'); ?>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <?= form_error('password', '<div class="error text-danger mb-2" style="margin-top: -15px">', '</div>'); ?>
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $data['nama_lengkap']; ?>" required placeholder="nama_lengkap">
                            </div>
                            <?= form_error('nama_lengkap', '<div class="error text-danger mb-2" style="margin-top: -15px">', '</div>'); ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $data['email']; ?>" required placeholder="email">
                            </div>
                            <?= form_error('email', '<div class="error text-danger mb-2" style="margin-top: -15px">', '</div>'); ?>
                            <div class="form-group">
                                <label for="email">Role</label>
                                <select name="id_role" id="id_role" required class="form-control">
                                    <?php foreach ($role as $d) : ?>
                                        <?php if ($d['id'] == $data['id_role']) : ?>
                                            <option selected value="<?= $d['id']; ?>"><?= $d['nama_role']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $d['id']; ?>"><?= $d['nama_role']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div id="imagePreview">
                                    <img class="rounded-circle img-thumbnail d-block mb-2" width="120" src="<?= base_url(); ?>assets/uploads/users/<?= $data['image']; ?>" alt="">
                                </div>
                                <input type="file" class="form-control" id="image" name="image" onchange="previewImage(this, '#imagePreview')">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url($link); ?>" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>