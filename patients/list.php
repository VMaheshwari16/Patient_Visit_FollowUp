<?php
include "../config/db.php";
include "../includes/header.php";

$sql = "
SELECT
  p.patient_id,
  p.name,
  TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age_years,
  CONCAT(
    TIMESTAMPDIFF(YEAR, dob, CURDATE()), 'y ',
    MOD(TIMESTAMPDIFF(MONTH, dob, CURDATE()),12), 'm'
  ) AS full_age,
  COUNT(v.visit_id) AS total_visits
FROM patients p
LEFT JOIN visits v ON p.patient_id = v.patient_id
GROUP BY p.patient_id
";

$result = mysqli_query($conn, $sql);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Patients List</h3>
    <a href="add.php" class="btn btn-primary btn-sm">+ Add Patient</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-striped table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Total Visits</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= $row['full_age'] ?></td>
                    <td>
                        <span class="badge bg-info">
                            <?= $row['total_visits'] ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="view.php?id=<?= $row['patient_id'] ?>" class="btn btn-sm btn-outline-primary">View</a>
                        <a href="edit.php?id=<?= $row['patient_id'] ?>" class="btn btn-sm btn-outline-warning ms-1">Edit</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
