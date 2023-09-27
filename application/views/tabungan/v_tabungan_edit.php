<div class="container">
    <title>HALAMAN | EDIT TABUNGAN DEBITUR | SINAS</title>

    <div class="page-header">
        <h1><?php echo $judul ?></h1>
    </div>

    <form action="<?php echo $action ?>" method="POST">

    
        <div class="form-group">
            <label for="tab_rek">Nomor Rekenening</label>
            <input type="text" class="form-control" name="tab_rek" id="tab_rek" placeholder="Nomor Rekening" value="<?php echo $tab_rek ?>">
            <div class="help-block"><?php echo form_error('tab_rek', '<div class="text-danger">', '</div>') ?></div>
        </div>
        
        <div class="form-group">
            <label for="nama_tab">Nama Tabungan</label>
            <input type="text" class="form-control" name="nama_tab" id="nama_tab" placeholder="Masukkan Nama Tabungan" value="<?php echo $nama_tab ?>">
            <div class="help-block"><?php echo form_error('nama_tab', '<div class="text-danger">', '</div>') ?></div>
        </div>

        <div class="form-group">
            <label for="saldo">Saldo</label>
            <input type="text" class="form-control" name="saldo" id="saldo" placeholder="Masukkan Balance" value="<?php echo $saldo ?>">
            <div class="help-block"><?php echo form_error('saldo', '<div class="text-danger">', '</div>') ?></div>
        </div>

        <div class="form-group">
            <label for="tab_buka">Buka Tabungan</label>
            <input type="date" class="form-control" name="tab_buka" id="tab_buka" placeholder="" value="<?php echo $tab_buka ?>">
            <div class="help-block"><?php echo form_error('tab_buka', '<div class="text-danger">', '</div>') ?></div>
        </div>

        <div class="form-group">
            <label for="tab_tutup">Tutup Tabungan</label>
            <input type="date" class="form-control" name="tab_tutup" id="tab_tutup" placeholder="" value="<?php echo $tab_tutup ?>">
            <div class="help-block"><?php echo form_error('tab_tutup', '<div class="text-danger">', '</div>') ?></div>
        </div>

        <div class="form-group">
            <label for="CIF">CIF - Nama Debitur</label>
            <?php echo $this->AppModel->get_dd_costumer('costumer_nama','CIF',$CIF) ?>
            <!-- <input type="text" class="form-control" name="CIF" id="CIF" placeholder="Masukkan CIF" value="<?php echo $CIF ?>"> -->
            <div class="help-block"><?php echo form_error('CIF', '<div class="text-danger">', '</div>') ?></div>
        </div>

        <button type="submit" class="btn btn-success">SUBMIT</button>
        <a href="<?php echo site_url('tabungan/index') ?>" class="btn btn-warning">KEMBALI</a>
    </form>
</div>
