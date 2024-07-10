<?php
    session_start();
?>
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Siswa</h2>
                        <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enis quis massa lobortis rutrum.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">List Siswa</h4>
                            <p>berikut adalah list siswa yang ada.</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if ($mhs): ?>
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($mhs as $content): ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $content[0] ?></td>
                                                    <td><?= $content[1] ?></td>
                                                    <td><?= $content[2] ?></td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" onclick="openUpdateModal('<?= $content[0] ?>', '<?= $content[1] ?>', '<?= $content[2] ?>')">Update</button>
                                                        <button class="btn btn-danger btn-sm" onclick="openDeleteModal('<?= $content[0] ?>')">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php $no++; endforeach; ?>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary" onclick="openAddModal()">Tambah</button>
                                <?php endif; ?>
                                <?php
$no = count($mhs);
$_SESSION['studentNumber'] = $no;
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addForm" action="<?= base_url('mahasiswa/submit') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add_nis">NIS</label>
                        <input type="text" class="form-control" id="add_nis" name="var[nis]" required>
                    </div>
                    <div class="form-group">
                        <label for="add_nama">Nama</label>
                        <input type="text" class="form-control" id="add_nama" name="var[nama]" required>
                    </div>
                    <div class="form-group">
                        <label for="add_alamat">Alamat</label>
                        <input type="text" class="form-control" id="add_alamat" name="var[alamat]" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateForm" action="<?= base_url('mahasiswa/update') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="old_nis" id="update_old_nis">
                    <div class="form-group">
                        <label for="update_nis">NIS</label>
                        <input type="text" class="form-control" id="update_nis" name="var[nis]" required>
                    </div>
                    <div class="form-group">
                        <label for="update_nama">Nama</label>
                        <input type="text" class="form-control" id="update_nama" name="var[nama]" required>
                    </div>
                    <div class="form-group">
                        <label for="update_alamat">Alamat</label>
                        <input type="text" class="form-control" id="update_alamat" name="var[alamat]" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteForm" action="<?= base_url('mahasiswa/delete') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="nis" id="delete_nis">
                    <p>Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="<?= base_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.js') ?>"></script>
    
<script>
function openUpdateModal(nis, nama, alamat) {
    $('#update_old_nis').val(nis);
    $('#update_nis').val(nis);
    $('#update_nama').val(nama);
    $('#update_alamat').val(alamat);
    $('#updateModal').modal('show');
}

function openDeleteModal(nis) {
    $('#delete_nis').val(nis);
    $('#deleteModal').modal('show');
}

function openAddModal() {
    $('#addModal').modal('show');
}
</script>
