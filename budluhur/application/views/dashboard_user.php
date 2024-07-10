
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <?php
session_start(); // Start the session if not already started

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $usernis = $_SESSION['user_id'];
    // Check if count is already set, if not initialize it
    // if (!isset($_SESSION['unique_matapelajaran_count'])) {
    //     // Calculate unique subject count and set it to session
    //     $unique_matapelajaran_count = $this->mapel_model->count_unique_subjects($username); // Assuming a method in your model to count unique subjects
    //     $_SESSION['unique_matapelajaran_count'] = $unique_matapelajaran_count;
    // } else {
    //     // Count is already set in session, use it
    //     $unique_matapelajaran_count = $_SESSION['unique_matapelajaran_count'];
    // }
} else {
    // Handle case where username is not in session (e.g., redirect to login)
}

?>
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Dashboard</h2>
                                <p class="pageheader-text">
                                    Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.
                                </p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Welcome <?php echo $username . " (" . $usernis . ")"; ?></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0" style="padding: 10px;">Profil Siswa</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if ($mhs): ?>
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td><?= $mhs['nis'] ?></td>
                                                    <td><?= $mhs['nama'] ?></td>
                                                    <td><?= $mhs['alamat'] ?></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
</body>
 
</html>