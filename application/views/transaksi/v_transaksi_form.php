<div class="container">
    <title>HALAMAN | TAMBAH TRANSAKSI DEBITUR | SINAS</title>

    <div class="page-header">
        <h1><?php echo $judul ?></h1>
    </div>

    <form action="<?php echo $action ?>" method="POST">

    
        <div class="form-group">
            <label for="nominal">Nominal</label>
            <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Masukkan Nominal" value="<?php echo $nominal ?>">
            <div class="help-block"><?php echo form_error('nominal', '<div class="text-danger">', '</div>') ?></div>
        </div>
        
        <div class="form-group">
            <label for="tanggal_transaksi">Tanggal</label>
            <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" placeholder="Masukkan Tanggal" value="<?php echo $tanggal_transaksi ?>">
            <div class="help-block"><?php echo form_error('tanggal_transaksi', '<div class="text-danger">', '</div>') ?></div>
        </div>

        <div class="form-group">
            <label for="transaksi_jen">Jenis Transaksi</label>
            <input type="text" class="form-control" name="transaksi_jen" id="transaksi_jen" placeholder="Masukkan Balance" value="<?php echo $transaksi_jen ?>">
            <div class="help-block"><?php echo form_error('transaksi_jen', '<div class="text-danger">', '</div>') ?></div>
        </div>

        <div class="form-group">
            <label for="jenis">Keterangan</label>
            <input type="text" class="form-control" name="jenis" id="jenis" placeholder="" value="<?php echo $jenis ?>">
            <div class="help-block"><?php echo form_error('jenis', '<div class="text-danger">', '</div>') ?></div>
        </div>

        <div class="form-group">
            <label for="CIF">CIF</label>
            <?php echo $this->AppModel->get_dd_costumer('costumer_nama','CIF') ?>
            <!-- <input type="text" class="form-control" name="CIF" id="CIF" placeholder="Masukkan CIF" value="<?php echo $CIF ?>"> -->
            <div class="help-block"><?php echo form_error('CIF', '<div class="text-danger">', '</div>') ?></div>
        </div>

        <button type="submit" class="btn btn-success">SUBMIT</button>
        <a href="<?php echo site_url('transaksi/index') ?>" class="btn btn-warning">KEMBALI</a>
    </form>
</div>
