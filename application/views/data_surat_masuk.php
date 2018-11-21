 <head>
     <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url();?>assets/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>assets/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url();?>assets/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 </head>
 <br>        
 <div class="row">
    <div class="col-lg-12">
                <?php 
                    $notif = $this->session->flashdata('notif');
                    if($notif != NULL){
                        echo '
                            <div class="alert alert-info">'.$notif.'</div>
                        ';
                    }
                ?>
            </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_add"><span class="fa fa-plus"></span> Tambah Surat Masuk</a> | <a href="#" onclick="window.print()"> Print </a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NO.SURAT</th>
                                        <th>TGL.KIRIM</th>
                                        <th>TGL.TERIMA</th>
                                        <th>PENGIRIM</th>
                                        <th>PENERIMA</th>
                                        <th>PERIHAL</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 0;
                                    foreach ($surat_masuk as $data) {
                                        echo '
                                    
                                    <tr>
                                        <td>'.++$no.'</td>
                                        <td>'.$data->nomor_surat.'</td>
                                        <td>'.$data->tgl_kirim.'</td>
                                        <td>'.$data->tgl_terima.'</td>
                                        <td>'.$data->pengirim.'</td>
                                        <td>'.$data->penerima.'</td>
                                        <td>'.$data->perihal.'</td>
                                        <td>
                                            <a href="'.base_url('./uploads/'.$data->file_surat).'" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="#" class="btn btn-warning btn-sm" onclick="update_surat('.$data->id_surat.')" data-toggle="modal" data-target="#modal_ubah">Ubah</a>
                                             <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_ubah_isi" onclick="update_surat('.$data->id_surat.')">Ubah isi surat</a>
                                            <a href="'.base_url().'index.php/surat/disposisi/'.$data->id_surat.'" class="btn btn-primary btn-sm">Disposisi</a>
                                            <a href="'.base_url().'index.php/surat/hapus_surat_masuk/'.$data->id_surat.'" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                    ';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!--  MODAL tambah surat keluar -->
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('index.php/surat/tambah_surat_masuk'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_addLabel">Tambah Surat Masuk</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="no_surat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tgl.Kirim</label>
                            <input type="date" name="tgl_kirim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tgl.Terima</label>
                            <input type="date" name="tgl_terima" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Pengirim</label>
                            <input type="text" name="pengirim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Penerima</label>
                            <input type="text" name="penerima" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" name="perihal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Unggah Surat (*.pdf)</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--  MODAL ubah surat keluar -->
    <div class="modal fade" id="modal_ubah" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('index.php/surat/ubah_surat_masuk'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_addLabel">Ubah Surat Masuk</h4>
                    </div>
                    <div class="modal-body">

                         <input type="hidden" name="edit_id_surat" id="edit_id_surat">

                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="no_surat" id="edit_no_surat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tgl.Kirim</label>
                            <input type="date" name="tgl_kirim" id="edit_tgl_kirim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tgl.Terima</label>
                            <input type="date" name="tgl_terima" id="edit_tgl_terima" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Pengirim</label>
                            <input type="text" name="pengirim" id="edit_pengirim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Penerima</label>
                            <input type="text" name="penerima" id="edit_penerima" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" name="perihal" id="edit_perihal" class="form-control">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <div class="modal fade" id="modal_ubah_isi" tabindex="-1" role="dialog" aria-labelledby="modal_ubah_suratLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('index.php/surat/ubah_file_surat_masuk'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_ubahsuratLabel">Ubah File Surat</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="edit_file_surat" id="edit_file_surat">
                        <div class="form-group">
                            <label>Unggah Surat (*.pdf)</label>
                            <input type="file" name="edit_file_surat" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">

        function update_surat(id_surat){
            $('#edit_file_surat').empty();
            $('#edit_id_surat').empty();
            $('#edit_no_surat').empty();
            $('#edit_tgl_terima').empty();
            $('#edit_tgl_kirim').empty();
            $('#edit_penerima').empty();
            $('#edit_pengirim').empty();
            $('#edit_perihal').empty();

            $.getJSON('<?php echo base_url();?>index.php/surat/get_surat_masuk_id/' + id_surat , function(data){
                $('#edit_file_surat').val(data.id_surat);
                $('#edit_id_surat').val(data.id_surat);
                $('#edit_no_surat').val(data.nomor_surat);
                $('#edit_tgl_terima').val(data.tgl_terima);
                $('#edit_tgl_kirim').val(data.tgl_kirim);
                $('#edit_penerima').val(data.penerima);
                $('#edit_pengirim').val(data.pengirim);
                $('#edit_perihal').val(data.perihal);
            });
        }
    </script>