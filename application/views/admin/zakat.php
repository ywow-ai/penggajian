<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="judul"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" id="form_id">
                    <input name="id_zakat" type="hidden" id="id_zakat">
                    <div class="mb-3">
                        <label for="nama_zakat" class="form-label">Jenis Zakat</label>
                        <input name="nama_zakat" type="text" class="form-control" id="nama_zakat" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_potongan" class="form-label">Jumlah Potongan Dalam Bentuk Persen (%)</label>
                        <input name="jumlah_potongan" type="number" class="form-control" id="jumlah_potongan" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombol"></button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Area Profile -->
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Setting Zakat</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <button onclick="tambah()" type="button" class="tambah btn-sm btn-success mb-3" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Tambah Potongan Zakat</button>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Zakat</th>
                                    <th>Jumlah Potongan</th>
                                    <th colspan='2'>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($zakat as $z) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no++ ?></td>
                                        <td class="text-center"><?php echo $z->nama_zakat ?></td>
                                        <td class="text-center"><?php echo $z->potongan ?> %</td>
                                        <td>
                                            <center>
                                                <button onclick="edit('<?php echo $z->id ?>','<?php echo $z->nama_zakat ?>','<?php echo $z->potongan ?>')" class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i></button>
                                                <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/zakat/hapus/' . $z->id) ?>"><i class="fas fa-trash"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
    function tambah() {
        document.getElementById('judul').innerText = 'Tambah Zakat'
        document.getElementById('nama_zakat').value = ''
        document.getElementById('jumlah_potongan').value = ''
        document.getElementById('tombol').innerText = 'Tambah'
        document.getElementById('form_id').action = '<?php echo base_url('admin/zakat/tambah') ?>'
    }

    function edit(id, jenis, jumlah) {
        document.getElementById('judul').innerText = 'Edit Zakat'
        document.getElementById('id_zakat').value = id
        document.getElementById('nama_zakat').value = jenis
        document.getElementById('jumlah_potongan').value = jumlah
        document.getElementById('tombol').innerText = 'Simpan'
        document.getElementById('form_id').action = '<?php echo base_url('admin/zakat/edit') ?>'
    }
</script>