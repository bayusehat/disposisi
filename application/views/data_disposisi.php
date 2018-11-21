
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><span class="fa fa-mail-forward"></span> Disposisi Surat</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

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
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" id="box">
                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_add" id="btnTambahSurat"><span class="fa fa-plus"></span> Tambah Disposisi</a> | <a href="#" id="btnPrint" onclick="printReport('box')" class="btn btn-info btn-sm"><span class="fa fa-print"></span> Print</a> | No. Surat : <?php echo $data_surat->nomor_surat;?>  
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" >
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>PENGIRIM</th>
                                    <th>TUJUAN PEGAWAI</th>
                                    <th>TGL.DISPOSISI</th>
                                    <th>KETERANGAN</th>
                                    <th id="rowAction">AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="dataSuratMasuk">
                                <?php
                                $no =0;
                                foreach ($data_disposisi as $disposisi) {
                                echo'
                                            <tr>
                                                <td>'.++$no.'</td>
                                                <td>'.$disposisi->nama_jabatan.'</td>
                                                <td>'.$disposisi->nama.'</td>
                                                <td>'.$disposisi->tgl_disposisi.'</td>
                                                <td>'.$disposisi->keterangan.'</td>

                                                <td>
                                                    <a href="'.base_url('uploads/'.$disposisi->file_surat).'" class="btn btn-info btn-sm btn-block" target="_blank">Lihat Surat</a>
                                                      <!-- Button ubah dan hapus hanya aktif bagi user yang membuat disposisi -->
                                                    <a href="'.base_url('index.php/surat/hapus_disposisi/'.$this->uri->segment(3).'/'. $disposisi->id_disposisi).'" class="btn btn-danger btn-sm btn-block">Hapus</a>
                                                </td>
                                            </tr>';
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

    <!--  MODAL tambah disposisi surat -->
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('index.php/surat/add_disposisi/'.$this->uri->segment(3)) ?>" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_addLabel">Tambah Disposisi Surat</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tujuan Unit</label>
                            <select class="form-control" name="tujuan_unit" onchange="get_pegawai(this.value)">
                                <option value="">-- Pilih Tujuan Unit --</option>
                                <?php 
                                foreach ($dropdown as $data) {
                                    if($data->id_jabatan != $this->session->userdata('id_jabatan') && $data->id_jabatan > $this->session->userdata('id_jabatan')){
                                    echo '
                                         <option value="'.$data->id_jabatan.'">'.$data->nama_jabatan.'</option> ';

                                     }
                                }
                            ?>      
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tujuan Pegawai</label>
                            <select class="form-control" name="tujuan_pegawai" id="tujuan_pegawai">
                                <option value="">-- Pilih Nama Pegawai --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        function get_pegawai(id_jabatan)
        {
            $('#tujuan_pegawai').empty();

            $.getJSON('<?php echo base_url() ?>index.php/surat/get_pegawai_by_jabatan/'+id_jabatan, function(data){
                $.each(data, function(index,value){
                    $('#tujuan_pegawai').append('<option value="'+value.id_pegawai+'">'+value.nama+'</option>');
                })
            });
        }


        function printReport(printR){
            var oC = document.body.innerHTML;

            $('#btnTambahSurat').css('display','none');
            $('#btnPrint').css('display','none');
            $('#rowAction').css('display','none');
            $('#dataSuratMasuk td:nth-child(6)').css('display','none');

            var pC = document.getElementById(printR).outerHTML;

            document.body.innerHTML;

            window.print();

            document.body.innerHTML = oC;


        }
    </script>