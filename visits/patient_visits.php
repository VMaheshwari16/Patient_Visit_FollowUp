<?php
include "../config/db.php";
include "../includes/header.php";

$pid = $_GET['patient_id'];

$sql = "
SELECT
  visit_date,
  consultation_fee,
  lab_fee,
  follow_up_due,
  DATEDIFF(CURDATE(), visit_date) AS days_since
FROM visits
WHERE patient_id = $pid
ORDER BY visit_date DESC
";

$result = mysqli_query($conn, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Patient Visit History</h3>
    <a href="../patients/list.php" class="btn btn-secondary btn-sm">← Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-bordered table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Visit Date</th>
                    <th>Days Since</th>
                    <th>Consultation Fee</th>
                    <th>Lab Fee</th>
                    <th>Follow-Up Due</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($r = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $r['visit_date'] ?></td>
                    <td><?= $r['days_since'] ?></td>
                    <td><?= $r['consultation_fee'] ?></td>
                    <td><?= $r['lab_fee'] ?></td>
                    <td><?= $r['follow_up_due'] ?></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
