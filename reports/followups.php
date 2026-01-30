<?php
include "../config/db.php";
include "../includes/header.php";

$sql = "
SELECT
  p.name,
  v.follow_up_due,
  CASE
    WHEN v.follow_up_due < CURDATE() THEN 'Overdue'
    ELSE 'Upcoming'
  END AS status
FROM visits v
JOIN patients p ON v.patient_id = p.patient_id
WHERE v.follow_up_due < DATE_ADD(CURDATE(), INTERVAL 7 DAY)
ORDER BY v.follow_up_due
";

$result = mysqli_query($conn, $sql);
?>

<h3 class="mb-3">Follow-Up Report</h3>

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-bordered table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Patient</th>
                    <th>Follow-Up Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($r = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= $r['follow_up_due'] ?></td>
                    <td>
                        <?php if ($r['status'] == 'Overdue') { ?>
                            <span class="badge bg-danger">Overdue</span>
                        <?php } else { ?>
                            <span class="badge bg-warning text-dark">Upcoming</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
