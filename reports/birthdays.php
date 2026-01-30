<?php
include "../config/db.php";
include "../includes/header.php";

$sql = "
SELECT
  name,
  dob,
  TIMESTAMPDIFF(YEAR, dob, CURDATE()) + 1 AS upcoming_age
FROM patients
WHERE DATE_FORMAT(dob, '%m-%d')
BETWEEN DATE_FORMAT(CURDATE(), '%m-%d')
AND DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 30 DAY), '%m-%d')
";

$result = mysqli_query($conn, $sql);
?>

<h3 class="mb-3">Upcoming Birthdays (Next 30 Days)</h3>

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-bordered table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Turning Age</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($r = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= $r['dob'] ?></td>
                    <td><?= $r['upcoming_age'] ?></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
