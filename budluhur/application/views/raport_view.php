<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Raport</h2>
                    </div>
                </div>
            </div>

            <!-- nis and Semester Selection Form -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Select NIS and Semester</h5>
                        </div>
                        <div class="card-body">
                            <form id="raportForm" action="<?= base_url('raport') ?>" method="post">
                                <div class="form-group">
                                    <label for="select_nis">NIS - Nama</label>
                                    <select class="form-control" id="select_nis" name="nis" required onchange="fetchSemesters(this.value)">
                                        <option value="">Select NIS</option>
                                        <?php foreach ($mhs as $m): ?>
                                            <option value="<?= $m[0] ?>" <?= isset($selected_nis) && $selected_nis == $m[0] ? 'selected' : '' ?>><?= $m[0] ?> - <?= $m[1] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="select_semester">Semester</label>
                                    <select class="form-control" id="select_semester" name="semester" required>
                                        <option value="">Select Semester</option>
                                        <?php if (isset($selected_semester)): ?>
                                            <option value="<?= $selected_semester ?>" selected><?= $selected_semester ?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" onclick="retainSelectednisSemester()">Select</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($selected_nis && $selected_semester): ?>
                <!-- Raport Table -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Raport Table<br>NIS : <?= $selected_nis ?><br>Semester : <?= $selected_semester ?></h5>
                                <button class="btn btn-primary" onclick="openAddModal()">Add Data</button>
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
                                                <th>Nilai</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($raport): ?>
                                                <?php $no = 1; foreach ($raport as $content): ?>
                                                    <tr>
                                                        <td><?= $no ?></td>
                                                        <td><?= $content['nis'] ?></td>
                                                        <td><?= $content['mahasiswa_nama'] ?></td>
                                                        <td><?= $content['matapelajaran'] ?></td>
                                                        <td><?= $content['semester'] ?></td>
                                                        <td><?= $content['akm'] ?></td>
                                                        <td><?= $content['nilai'] ?></td>
                                                        <td><?= $content['keterangan'] ?></td>
                                                        <td>
                                                            <button class="btn btn-primary" onclick="openUpdateModal('<?= $content['nis'] ?>', '<?= $content['matapelajaran'] ?>', '<?= $content['semester'] ?>', '<?= $content['akm'] ?>', '<?= $content['nilai'] ?>', '<?= $content['keterangan'] ?>')">Update</button>
                                                            <button class="btn btn-danger" onclick="openDeleteModal('<?= $content['nis'] ?>', '<?= $content['matapelajaran'] ?>', '<?= $content['semester'] ?>')">Delete</button>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="9">No data available.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <!-- <tr>
                                                <th>No.</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Matapelajaran</th>
                                                <th>Semester</th>
                                                <th>AKM</th>
                                                <th>Nilai</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr> -->
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Add Modal -->
            <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Raport Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="addForm" action="<?= base_url('raport/submit') ?>" method="post">
                            <div class="modal-body">
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
                                    <input type="text" class="form-control" id="add_akm" name="var[akm]" required>
                                </div>
                                <div class="form-group">
                                    <label for="add_nilai">Nilai</label>
                                    <input type="text" class="form-control" id="add_nilai" name="var[nilai]" required>
                                </div>
                                
                                <input type="hidden" id="add_nis" name="var[nis]" value="<?= $selected_nis ?>">
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
<div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Raport Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateForm" action="<?= base_url('raport/update') ?>" method="post">
                <div class="modal-body">
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
                        <input type="text" class="form-control" id="update_akm" name="var[akm]" required>
                    </div>
                    <div class="form-group">
                        <label for="update_nilai">Nilai</label>
                        <input type="text" class="form-control" id="update_nilai" name="var[nilai]" required>
                    </div>
                    <input type="hidden" id="update_nis" name="var[nis]" value="<?= $selected_nis ?>">
                    <input type="hidden" id="update_old_nis" name="old_nis">
                    <input type="hidden" id="update_old_matapelajaran" name="old_matapelajaran">
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
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Raport Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" action="<?= base_url('raport/delete') ?>" method="post">
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
                    <input type="hidden" id="delete_nis" name="nis">
                    <input type="hidden" id="delete_matapelajaran" name="matapelajaran">
                    <input type="hidden" id="delete_semester" name="semester">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


        </div>
    </div>
</div>

<script>
    function fetchSemesters(nis) {
        $.ajax({
            url: '<?= base_url('raport/get_semesters') ?>',
            type: 'POST',
            data: {nis: nis},
            dataType: 'json',
            success: function(response) {
                let semesterDropdown = $('#select_semester');
                semesterDropdown.empty();
                semesterDropdown.append('<option value="">Select Semester</option>');
                response.forEach(function(semester) {
                    semesterDropdown.append('<option value="' + semester.semester + '">' + semester.semester + '</option>');
                });
            }
        });
    }

    function retainSelectednisSemester() {
        const nis = document.getElementById('select_nis').value;
        const semester = document.getElementById('select_semester').value;
        localStorage.setItem('selectednis', nis);
        localStorage.setItem('selectedSemester', semester);
    }

    function openAddModal() {
        $('#addModal').modal('show');
    }

    function openUpdateModal(nis, matapelajaran, semester, akm, nilai) {
    document.getElementById('update_old_nis').value = nis;
    document.getElementById('update_old_matapelajaran').value = matapelajaran;
    document.getElementById('update_matapelajaran').value = matapelajaran;
    document.getElementById('update_akm').value = akm;
    document.getElementById('update_nilai').value = nilai;
    document.getElementById('update_nis').value = nis;
    document.getElementById('update_semester').value = semester;
    $('#updateModal').modal('show');
}

function openDeleteModal(nis, matapelajaran, semester) {
    document.getElementById('delete_nis').value = nis;
    document.getElementById('delete_matapelajaran').value = matapelajaran;
    document.getElementById('delete_semester').value = semester;
    $('#deleteModal').modal('show');
}


    document.addEventListener('DOMContentLoaded', function() {
        const selectednis = localStorage.getItem('selectednis');
        const selectedSemester = localStorage.getItem('selectedSemester');
        if (selectednis) {
            document.getElementById('select_nis').value = selectednis;
            fetchSemesters(selectednis);
        }
        if (selectedSemester) {
            document.getElementById('select_semester').value = selectedSemester;
        }
    });
</script>
