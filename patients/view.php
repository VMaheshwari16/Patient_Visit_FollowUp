<?php
include "../config/db.php";
include "../includes/header.php";

$id = $_GET['id'];

$sql = "
SELECT
  p.name,
  TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age,
  MAX(v.visit_date) AS last_visit,
  DATEDIFF(CURDATE(), MAX(v.visit_date)) AS days_since_last_visit,
  MAX(v.follow_up_due) AS next_follow_up,
  CASE
    WHEN MAX(v.follow_up_due) < CURDATE() THEN 'Overdue'
    ELSE 'Not Overdue'
  END AS status
FROM patients p
LEFT JOIN visits v ON p.patient_id = v.patient_id
WHERE p.patient_id = $id
GROUP BY p.patient_id
";

$data = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Patient Details</h3>
    <a href="list.php" class="btn btn-secondary btn-sm">← Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <h5 class="card-title mb-3">
            <?= htmlspecialchars($data['name']) ?>
        </h5>

        <div class="row mb-2">
            <div class="col-md-4 fw-semibold">Age</div>
            <div class="col-md-8"><?= $data['age'] ?> years</div>
        </div>

        <div class="row mb-2">
            <div class="col-md-4 fw-semibold">Last Visit</div>
            <div class="col-md-8">
                <?= $data['last_visit'] ?? 'No visits yet' ?>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-4 fw-semibold">Days Since Last Visit</div>
            <div class="col-md-8">
                <?= $data['days_since_last_visit'] ?? '-' ?>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-4 fw-semibold">Next Follow-Up</div>
            <div class="col-md-8">
                <?= $data['next_follow_up'] ?? '-' ?>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-4 fw-semibold">Status</div>
            <div class="col-md-8">
                <?php if ($data['status'] === 'Overdue') { ?>
                    <span class="badge bg-danger">Overdue</span>
                <?php } else { ?>
                    <span class="badge bg-success">Not Overdue</span>
                <?php } ?>
            </div>
        </div>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
