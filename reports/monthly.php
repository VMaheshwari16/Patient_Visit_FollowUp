<?php
include "../config/db.php";
include "../includes/header.php";

$sql = "
SELECT
  DATE_FORMAT(visit_date, '%Y-%m') AS month,
  COUNT(*) AS total_visits
FROM visits
GROUP BY month
ORDER BY month DESC
";

$result = mysqli_query($conn, $sql);
?>

<h3 class="mb-3">Monthly Visit Report</h3>

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-bordered table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Month</th>
                    <th>Total Visits</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($r = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $r['month'] ?></td>
                    <td>
                        <span class="badge bg-primary">
                            <?= $r['total_visits'] ?>
                        </span>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
