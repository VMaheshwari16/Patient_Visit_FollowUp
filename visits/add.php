<?php
include "../config/db.php";
include "../includes/header.php";

if (isset($_POST['submit'])) {
    $pid  = $_POST['patient_id'];
    $date = $_POST['visit_date'];
    $cf   = $_POST['consultation_fee'];
    $lf   = $_POST['lab_fee'];

    $sql = "
    INSERT INTO visits (patient_id, visit_date, consultation_fee, lab_fee, follow_up_due)
    VALUES ($pid, '$date', $cf, $lf, DATE_ADD('$date', INTERVAL 7 DAY))
    ";

    mysqli_query($conn, $sql);

    echo '<div class="alert alert-success">
            Visit added successfully
          </div>';
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Add Visit</h3>
    <a href="list.php" class="btn btn-secondary btn-sm">← Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Patient ID</label>
                <input type="number" name="patient_id" class="form-control" required>
                <div class="form-text">
                    Enter the patient ID from Patients List
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Visit Date</label>
                <input type="date" name="visit_date" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Consultation Fee</label>
                    <input type="number" name="consultation_fee" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Lab Fee</label>
                    <input type="number" name="lab_fee" class="form-control">
                </div>
            </div>

            <div class="alert alert-info">
                Follow-up date will be automatically generated after 7 days.
            </div>

            <div class="text-end">
                <button type="submit" name="submit" class="btn btn-success">
                    Save Visit
                </button>
                <a href="list.php" class="btn btn-outline-secondary ms-2">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
