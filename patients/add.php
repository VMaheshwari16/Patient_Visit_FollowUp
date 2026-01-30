<?php
include "../config/db.php";
include "../includes/header.php";

if (isset($_POST['submit'])) {
    $name  = $_POST['name'];
    $dob   = $_POST['dob'];
    $join  = $_POST['join_date'];
    $phone = $_POST['phone'];
    $addr  = $_POST['address'];

    $sql = "INSERT INTO patients (name, dob, join_date, phone, address)
            VALUES ('$name','$dob','$join','$phone','$addr')";

    mysqli_query($conn, $sql);

    echo '<div class="alert alert-success">
            Patient added successfully
          </div>';
}
?>

<h3 class="mb-4">Add Patient</h3>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Patient Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Join Date</label>
                    <input type="date" name="join_date" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3"></textarea>
            </div>

            <div class="text-end">
                <button type="submit" name="submit" class="btn btn-primary">
                    Save Patient
                </button>
                <a href="list.php" class="btn btn-secondary ms-2">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
