
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
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Raport</h2>
                    </div>
                </div>
            </div>

            <!-- Semester Selection Form -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Select Semester</h5>
                        </div>
                        <div class="card-body">
                            <form id="raportForm" action="<?= base_url('userraport') ?>" method="post">
                                <div class="form-group">
                                    <label for="select_semester">Semester</label>
                                    <select class="form-control" id="select_semester" name="semester" required>
                                        <option value="">Select Semester</option>
                                        <?php foreach ($semesters as $s): ?>
                                            <option value="<?= $s['semester'] ?>" <?= isset($selected_semester) && $selected_semester == $s['semester'] ? 'selected' : '' ?>><?= $s['semester'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Select</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($selected_semester): ?>
                <!-- Raport Table -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Raport Table<br>NIS : <?= $selected_nis ?><br>Semester : <?= $selected_semester ?></h5>
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
                                                    </tr>
                                                    <?php $no++; endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8">No data available.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td><strong>Total</strong></td>
                                                <td><?= $total_nilai ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td><strong>Rata-rata</strong></td>
                                                <td><?= $rata_rata ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectedSemester = localStorage.getItem('selectedSemester');
        if (selectedSemester) {
            document.getElementById('select_semester').value = selectedSemester;
        }

        // Custom function for copying the table content
        function customCopyFunction() {
            const table = document.getElementById('example');
            let range, selection;
            if (document.createRange && window.getSelection) {
                range = document.createRange();
                selection = window.getSelection();
                selection.removeAllRanges();
                try {
                    range.selectNodeContents(table);
                    selection.addRange(range);
                } catch (e) {
                    range.selectNode(table);
                    selection.addRange(range);
                }
                document.execCommand('copy');
                selection.removeAllRanges();
                alert('Table copied to clipboard');
            }
        }

        // Custom function for printing the table content
        function customPrintFunction() {
            const printContents = document.getElementById('example').outerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload();  // Reload the page to ensure all event listeners are reattached
        }

        // Custom function to export table to Excel
        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            
            filename = filename ? filename + '.xls' : 'excel_data.xls';
            
            downloadLink = document.createElement('a');
            document.body.appendChild(downloadLink);
            
            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                downloadLink.download = filename;
                downloadLink.click();
            }
        }

        // Custom function to export table to CSV
        function exportTableToCSV(tableID, filename = '') {
            var csv = [];
            var rows = document.querySelectorAll(`#${tableID} tr`);
            
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");
                
                for (var j = 0; j < cols.length; j++)
                    row.push(cols[j].innerText);
                
                csv.push(row.join(","));        
            }

            var csvString = csv.join("\n");
            var downloadLink = document.createElement("a");
            downloadLink.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvString);
            downloadLink.download = filename ? filename + '.csv' : 'csv_data.csv';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }

        // Custom function to export table to PDF
        function exportTableToPDF(tableID, filename = '') {
            var { jsPDF } = window.jspdf;
            var doc = new jsPDF();

            doc.autoTable({ html: `#${tableID}` });

            doc.save(filename ? filename + '.pdf' : 'pdf_data.pdf');
        }

        // Initialize DataTable with buttons
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Copy',
                    action: function (e, dt, node, config) {
                        customCopyFunction();
                    }
                },
                {
                    text: 'Excel',
                    action: function (e, dt, node, config) {
                        exportTableToExcel('example', 'raport_table');
                    }
                },
                {
                    text: 'CSV',
                    action: function (e, dt, node, config) {
                        exportTableToCSV('example', 'raport_table');
                    }
                },
                {
                    text: 'PDF',
                    action: function (e, dt, node, config) {
                        exportTableToPDF('example', 'raport_table');
                    }
                },
                {
                    text: 'Print',
                    action: function (e, dt, node, config) {
                        customPrintFunction();
                    }
                }
            ]
        });
    });
</script>
