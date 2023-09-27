<div class="container">

<title>HALAMAN | EDIT | DEBITUR SINAS</title>

    <div class="page-header">
        <h1>HALAMAN | EDIT COSTUMER</h1>
    </div>

    <form action="<?php echo $action ?>" method="POST">
        <div class="container">
            <form action="<?php echo $action ?>" method="POST">
                <div class="card">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <div class="row row-cols-2">
                                <div class="col">
                                    <label for="costumer_name">CIF</label>
                                    <input type="number" class="form-control" name="CIF" id="CIF" placeholder="CIF" value="<?php echo $CIF ?>">
                                    <div class="help-block"><?php echo form_error('CIF', '<div class="text-danger">', '</div>') ?>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="costumer_kelamin">Kelamin</label>
                                    <input type="text" class="form-control" name="costumer_kelamin" id="costumer_kelamin" placeholder="Jenis Kelamin" value="<?php echo $costumer_kelamin ?>">
                                    <div class="help-block"><?php echo form_error('costumer_kelamin', '<div class="text-danger">', '</div>') ?></div>
                                </div>

                                <div class="col">
                                    <label for="costumer_name">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="costumer_nama" id="costumer_nama" placeholder="Masukkan Nama Lengkap" value="<?php echo $costumer_nama ?>">
                                    <div class="help-block"><?php echo form_error('costumer_nama', '<div class="text-danger">', '</div>') ?>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="costumer_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="costumer_lahir" id="costumer_lahir" placeholder="Masukkan Tanggal Lahir" value="<?php echo $costumer_lahir ?>">
                                    <div class="help-block"><?php echo form_error('costumer_lahir', '<div class="text-danger">', '</div>') ?></div>
                                </div>
                            </div>

                            <div class="row row-cols-2">
                                <div class="col">
                                    <label for="costumer_nik">NIK</label>
                                    <input type="text" class="form-control" name="costumer_nik" id="costumer_nik" placeholder="Masukan NIK" value="<?php echo $costumer_nik ?>">
                                    <div class="help-block"><?php echo form_error('costumer_nik', '<div class="text-danger">', '</div>') ?></div>
                                </div>

                                <div class="col">
                                    <label for="costumer_alamat">Alamat</label>
                                    <input type="text" class="form-control" name="costumer_alamat" id="costumer_alamat" placeholder="Masukkan Alamat" value="<?php echo $costumer_alamat ?>">
                                    <div class="help-block"><?php echo form_error('costumer_alamat', '<div class="text-danger">', '</div>') ?></div>
                                </div>
                            </div>
                        </thead>
                </div>
                </table>
        </div>
        <button type="submit" class="btn btn-success">SUBMIT</button>
        <a href="<?php echo site_url('dashboard/index') ?>" class="btn btn-warning">KEMBALI</a>
    </form>
</div>