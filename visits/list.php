<?php
include "../config/db.php";
include "../includes/header.php";

$sql = "
SELECT
  p.patient_id,
  p.name,
  v.visit_date,
  v.follow_up_due,
  DATEDIFF(CURDATE(), v.visit_date) AS days_since,
  CASE
    WHEN v.follow_up_due < CURDATE() THEN 'Overdue'
    WHEN v.follow_up_due BETWEEN CURDATE()
      AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) THEN 'Upcoming'
    ELSE 'OK'
  END AS status
FROM visits v
JOIN patients p ON v.patient_id = p.patient_id
";

$result = mysqli_query($conn, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Visits</h3>
    <a href="add.php" class="btn btn-success btn-sm">+ Add Visit</a>
</div>


<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-bordered table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Patient</th>
                    <th>Visit Date</th>
                    <th>Days Since</th>
                    <th>Follow-Up Date</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($r = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= $r['visit_date'] ?></td>
                    <td><?= $r['days_since'] ?></td>
                    <td><?= $r['follow_up_due'] ?></td>
                    <td class="text-center">
                        <?php if ($r['status'] === 'Overdue') { ?>
                            <span class="badge bg-danger">Overdue</span>
                        <?php } elseif ($r['status'] === 'Upcoming') { ?>
                            <span class="badge bg-warning text-dark">Upcoming</span>
                        <?php } else { ?>
                            <span class="badge bg-success">OK</span>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <a href="../visits/patient_visits.php?patient_id=<?= $r['patient_id'] ?>" class="btn btn-sm btn-outline-primary">
                        Visit History
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
