<?php
include "../config/db.php";
include "../includes/header.php";

$id = $_GET['id'];

// Fetch existing patient data
$sql = "SELECT * FROM patients WHERE patient_id = $id";
$data = mysqli_fetch_assoc(mysqli_query($conn, $sql));

// Update logic
if (isset($_POST['update'])) {
    $name  = $_POST['name'];
    $dob   = $_POST['dob'];
    $join  = $_POST['join_date'];
    $phone = $_POST['phone'];
    $addr  = $_POST['address'];

    $updateSql = "
        UPDATE patients
        SET
            name = '$name',
            dob = '$dob',
            join_date = '$join',
            phone = '$phone',
            address = '$addr'
        WHERE patient_id = $id
    ";

    mysqli_query($conn, $updateSql);

    echo '<div class="alert alert-success">
            Patient details updated successfully
          </div>';

    // Refresh data after update
    $data = mysqli_fetch_assoc(mysqli_query($conn, $sql));
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Edit Patient</h3>
    <a href="list.php" class="btn btn-secondary btn-sm">← Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Patient Name</label>
                <input type="text" name="name" class="form-control"
                       value="<?= htmlspecialchars($data['name']) ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="dob" class="form-control"
                           value="<?= $data['dob'] ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Join Date</label>
                    <input type="date" name="join_date" class="form-control"
                           value="<?= $data['join_date'] ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control"
                       value="<?= $data['phone'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3"><?= $data['address'] ?></textarea>
            </div>

            <div class="text-end">
                <button type="submit" name="update" class="btn btn-primary">
                    Update Patient
                </button>
                <a href="list.php" class="btn btn-outline-secondary ms-2">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
