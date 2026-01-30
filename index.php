<?php include "includes/header.php"; ?>

<h3 class="mb-4">Dashboard</h3>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Patients</h5>
                <p class="card-text text-muted">Manage patient records</p>
                <a href="patients/add.php" class="btn btn-primary btn-sm mb-2">Add Patient</a><br>
                <a href="patients/list.php" class="btn btn-outline-primary btn-sm">View Patients</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Visits</h5>
                <p class="card-text text-muted">Patient visit history</p>
                <a href="visits/add.php" class="btn btn-success btn-sm mb-2">Add Visit</a><br>
                <a href="visits/list.php" class="btn btn-outline-success btn-sm">View Visits</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Reports</h5>
                <p class="card-text text-muted">Follow-ups & summaries</p>
                <a href="reports/followups.php" class="btn btn-warning btn-sm mb-2">Follow-Up Report</a><br>
                <a href="reports/summary.php" class="btn btn-success btn-sm">Full Summary</a>
                <a href="reports/monthly.php" class="btn btn-info btn-sm">Monthly</a>
                <a href="reports/birthdays.php" class="btn btn-primary btn-sm">Birthdays</a>
            </div>
        </div>
    </div>

</div>

<?php include "includes/footer.php"; ?>
