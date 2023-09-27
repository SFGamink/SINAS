  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="<?php echo base_url(); ?>dist_dashboard/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <title>HALAMAN | TABUNGAN DEBITUR | SINAS</title>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Halaman | TABUNGAN DEBITUR</h1>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="card">
          <div class="card-header">
              <caption>
                  <a href="<?php echo site_url('tabungan/add') ?>" class="btn btn-xs btn-primary">
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
                      <th class="text-left">Nama Debitur</th>
                      <th class="text-left">Nomor Rekening</th>
                      <th class="text-left">Nama Tabungan</th>
                      <th class="text-left">Tanggal Pembukaan</th>
                      <th class="text-left">Tanggal Penutupan</th>
                      <th class="text-left">Saldo</th>
                      <th class="text-center">Aksi</th>
                  </tr>
                  <?php
                    foreach ($tbng as $value) { ?>
                      <tr>
                          <td class="text-left"><?php echo $value['costumer_nama'] ?></td>
                          <td class="text-left"><?php echo $value['tab_rek'] ?></td>
                          <td class="text-left"><?php echo $value['nama_tab'] ?></td>
                          <td class="text-left"><?php echo $value['tab_buka'] ?></td>
                          <td class="text-left"><?php echo $value['tab_tutup'] ?></td>
                          <td class="text-left"><?php echo $value['saldo'] ?></td>
                          <td class="text-center">
                              <a href="<?php echo site_url('tabungan/edit/' . $value['CIF']) ?>" class="btn btn-xs btn-warning">EDIT</a>
                              <a href="<?php echo site_url('tabungan/delete/' . $value['CIF']) ?>" class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda Yakin DATA Akan Di Hapus?')">DELETE</a>
                          </td>
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