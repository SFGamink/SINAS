  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="<?php echo base_url(); ?>dist_dashboard/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <title>HALAMAN | TRANSAKSI DEBITUR | SINAS</title>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Halaman | TRANSAKSI DEBITUR</h1>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="card">
          <div class="card-header">
              <caption>
                  <a href="<?php echo site_url('transaksi/add') ?>" class="btn btn-xs btn-primary">
                      <span class="glyphicon glyphicon-plus-sign"></span> TAMBAH</a>
              </caption>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Copy</span></button>
              <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>CSV</span></button>
              <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Excel</span></button>
              <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>PDF</span></button>
              <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button"><span>Print</span></button>
          </div>
          <table id="example1" class="table table-bordered table-striped">
              <div class="col">
                  <div id="example1_filter" class="dataTables_filter">
                      <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>
                  </div>
              </div>
              <thead>
                  <tr>
                      <th class="text-center">CIF - Nama Tabungan</th>
                      <th class="text-left">Nomor Rekening</th>
                      <th class="text-left">Tanggal</th>
                      <th class="text-left">Nominal</th>
                      <th class="text-left">Jenis Transaksi</th>
                      <th class="text-left">Keterangan</th>
                  </tr>
                  <?php
                    foreach ($trns as $value) { ?>
                      <tr>
                      <td class="text-center"><?php echo $value['CIF'] ?> - <?php echo $value['nama_tab'] ?></td>
                          <td class="text-left"><?php echo $value['tab_rek'] ?></td>
                          <td class="text-left"><?php echo $value['tanggal_transaksi'] ?></td>
                          <td class="text-left"><?php echo number_format($value['nominal']) ?></td>
                          <td class="text-left"><?php echo $value['transaksi_jen'] ?></td>
                          <td class="text-left"><?php echo $value['jenis'] ?></td>
                      </tr>
                  <?php } ?>
              </thead>
          </table>
      </div>
      <script>
          $(function() {
              $("#example1").DataTable({
                  "responsive": true,
                  "lengthChange": false,
                  "autoWidth": false,
                  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
              $('#example2').DataTable({
                  "paging": true,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": true,
                  "info": true,
                  "autoWidth": false,
                  "responsive": true,
              });
          });
      </script>
      <!-- END MAIN CONTECNT -->