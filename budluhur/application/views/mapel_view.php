<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Mata Pelajaran</h2>
                    </div>
                </div>
            </div>

            <!-- nis Selection Form -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Select NIS</h5>
                        </div>
                        <div class="card-body">
                            <form id="nisForm" action="<?= base_url('mapel') ?>" method="post">
                                <div class="form-group">
                                    <label for="select_nis">NIS - Nama</label>
                                    <select class="form-control" id="select_nis" name="nis" required>
                                        <?php foreach ($mhs as $m): ?>
                                            <option value="<?= $m[0] ?>" <?= isset($selected_nis) && $selected_nis == $m[0] ? 'selected' : '' ?>><?= $m[0] ?> - <?= $m[1] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" onclick="retainSelectednis()">Select</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($selected_nis): ?>
                <!-- Mapel Table -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Tabel Mata Pelajaran<br>NIS : <?= $selected_nis ?></h5>
                                <button class="btn btn-primary" onclick="openAddModal()">Tambah Data</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Matapelajaran</th>
                                                <th>Semester</th>
                                                <th>AKM</th>
                                                <!-- <th>Nilai</th>
                                                <th>Keterangan</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($mapel): ?>
                                                <?php $no = 1; foreach ($mapel as $content): ?>
                                                    <tr>
                                                        <td><?= $no ?></td>
                                                        <td><?= $content['nis'] ?></td>
                                                        <td><?= $content['mahasiswa_nama'] ?></td>
                                                        <td><?= $content['matapelajaran'] ?></td>
                                                        <td><?= $content['semester'] ?></td>
                                                        <td><?= $content['akm'] ?></td>
                                                        <!-- <td><?= $content['nilai'] ?></td>
                                                        <td><?= $content['keterangan'] ?></td> -->
                                                        <td>
                                                        <button class="btn btn-success" onclick="openUpdateModal('<?= $content['nis'] ?>', '<?= $content['matapelajaran'] ?>', '<?= $content['nis'] ?>', '<?= $content['matapelajaran'] ?>', '<?= $content['semester'] ?>', '<?= $content['akm'] ?>')">Update</button>

                                                        <button class="btn btn-danger" onclick="openDeleteModal('<?= $content['nis'] ?>', '<?= $content['matapelajaran'] ?>')">Delete</button>

                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">No data available for the selected nis.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <p>halo</p>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Modal -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="addForm" action="<?= base_url('mapel/submit') ?>" method="post" onsubmit="retainSelectednis()">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Add Mapel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="add_nis">NIS</label>
                                        <input type="text" class="form-control" id="add_nis" name="var[nis]" value="<?= $selected_nis ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="add_matapelajaran">Matapelajaran</label>
                                        <input type="text" class="form-control" id="add_matapelajaran" name="var[matapelajaran]" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="add_semester">Semester</label>
                                        <input type="text" class="form-control" id="add_semester" name="var[semester]" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="add_akm">AKM</label>
                                        <input type="number" class="form-control" id="add_akm" name="var[akm]" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="add_nilai">Nilai</label>
                                        <input type="number" class="form-control" id="add_nilai" name="var[nilai]" required>
                                    </div>
                                    <input type="hidden" id="add_keterangan" name="var[keterangan]"> -->
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
                            <!-- Update Modal Form -->
<form id="updateForm" action="<?= base_url('mapel/update') ?>" method="post">
    <input type="hidden" name="old_nis" id="update_old_nis">
    <input type="hidden" name="old_matapelajaran" id="update_old_matapelajaran">
    <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Mapel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="update_nis">NIS</label>
            <input type="text" class="form-control" id="update_nis" name="var[nis]" readonly>
        </div>
        <div class="form-group">
            <label for="update_matapelajaran">Matapelajaran</label>
            <input type="text" class="form-control" id="update_matapelajaran" name="var[matapelajaran]" required>
        </div>
        <div class="form-group">
            <label for="update_semester">Semester</label>
            <input type="text" class="form-control" id="update_semester" name="var[semester]" required>
        </div>
        <div class="form-group">
            <label for="update_akm">AKM</label>
            <input type="number" class="form-control" id="update_akm" name="var[akm]" required>
        </div>
        <!-- <div class="form-group">
            <label for="update_nilai">Nilai</label>
            <input type="number" class="form-control" id="update_nilai" name="var[nilai]" required>
        </div>
        <input type="hidden" id="update_keterangan" name="var[keterangan]"> -->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form id="deleteForm" action="<?= base_url('mapel/delete') ?>" method="post">
    <input type="hidden" name="nis" id="delete_nis">
    <input type="hidden" name="matapelajaran" id="delete_matapelajaran">
    <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Mapel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <p>Are you sure you want to delete this mapel?</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
</form>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>


<script>
function openUpdateModal(oldnis, oldMatapelajaran, nis, matapelajaran, semester, akm) { 
    //tadi ada nilai pada function
    $('#update_old_nis').val(oldnis);
    $('#update_old_matapelajaran').val(oldMatapelajaran);
    $('#update_nis').val(nis);
    $('#update_matapelajaran').val(matapelajaran);
    $('#update_semester').val(semester);
    $('#update_akm').val(akm);
    //$('#update_nilai').val(nilai);
    //$('#update_keterangan').val(nilai >= akm ? 'terpenuhi' : 'tidak terpenuhi');
    $('#updateModal').modal('show');
}


function openDeleteModal(nis, matapelajaran) {
    $('#delete_nis').val(nis);
    $('#delete_matapelajaran').val(matapelajaran);
    $('#deleteModal').modal('show');
}



function openAddModal() {
    $('#addModal').modal('show');
}

// Function to retain the selected nis after form submission
function retainSelectednis() {
    var selectednis = $('#select_nis').val();
    localStorage.setItem('selectednis', selectednis);
    var akm = $('#add_akm').val();
    //var nilai = $('#add_nilai').val();
    //$('#add_keterangan').val(nilai >= akm ? 'terpenuhi' : 'tidak terpenuhi');
}

// Function to load the retained nis on page load
$(document).ready(function() {
    var retainednis = localStorage.getItem('selectednis');
    if (retainednis) {
        $('#select_nis').val(retainednis);
    }
});
</script>
