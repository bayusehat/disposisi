<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><span class="fa fa-mail-forward"></span> Disposisi Masuk</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>UNIT PENGIRIM</th>
                                    <th>NAMA PENGIRIM</th>
                                    <th>TGL.DISPOSISI</th>
                                    <th>KETERANGAN</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    foreach ($data_disposisi as $disposisi) {
                                        echo '
                                            <tr>
                                                <td>'.++$no.'</td>
                                                <td>'.$disposisi->nama_jabatan.'</td>
                                                <td>'.$disposisi->nama.'</td>
                                                <td>'.$disposisi->tgl_disposisi.'</td>
                                                <td>'.$disposisi->keterangan.'</td>
                                            ';

                                        if($disposisi->id_pegawai_penerima == $this->session->userdata('id_pegawai')){
                                            echo '<td><label class="label label-success">Disposisi masuk</label></td>';
                                        }

                                        echo '
                                                <td>
                                                    <a href="'.base_url('uploads/'.$disposisi->file_surat).'" class="btn btn-info btn-sm btn-block" target="_blank">Lihat Surat</a>';

                                                    if($this->session->userdata('jabatan') != 'Pegawai'){
                                                    echo'
                                                    <a href="'.base_url('index.php/surat/dis_keluar/'.$disposisi->id_surat).'" class="btn btn-info btn-sm btn-block">Tambah disposisi</a>';
                                                }
                                                echo'
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
    
   