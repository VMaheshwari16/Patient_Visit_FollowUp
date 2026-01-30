<?php
include "../config/db.php";
include "../includes/header.php";

$sql = "
SELECT
  p.name,
  TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age,
  COUNT(v.visit_id) AS total_visits,
  MAX(v.visit_date) AS last_visit,
  DATEDIFF(CURDATE(), MAX(v.visit_date)) AS days_since_last_visit,
  MAX(v.follow_up_due) AS next_follow_up
FROM patients p
LEFT JOIN visits v ON p.patient_id = v.patient_id
GROUP BY p.patient_id
";

$result = mysqli_query($conn, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Full Summary Report</h3>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-bordered table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Total Visits</th>
                    <th>Last Visit</th>
                    <th>Days Since</th>
                    <th>Next Follow-Up</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($r = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= $r['age'] ?></td>
                    <td>
                        <span class="badge bg-info">
                            <?= $r['total_visits'] ?>
                        </span>
                    </td>
                    <td><?= $r['last_visit'] ?? '-' ?></td>
                    <td><?= $r['days_since_last_visit'] ?? '-' ?></td>
                    <td><?= $r['next_follow_up'] ?? '-' ?></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
