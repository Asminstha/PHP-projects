<?php
include('header.php');
include('dbconnection.php');

$update_msg = ""; // Initialize update message variable

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = "SELECT * FROM `students` WHERE `id` = ?";
  $stmt = mysqli_prepare($connection, $query);
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (!$result) {
    die("Query Failed: " . mysqli_error($connection));
  } else {
    $row = mysqli_fetch_assoc($result);
  }
}

if (isset($_POST['update_student'])) {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }
  $fname = $_POST['f_name'];
  $lname = $_POST['l_name'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];

  $query = "UPDATE `students` SET `first_name` = ?, `last_name` = ?, `age` = ?, `gender` = ? WHERE `id` = ?";
  $stmt = mysqli_prepare($connection, $query);
  mysqli_stmt_bind_param($stmt, "ssisi", $fname, $lname, $age, $gender, $id);
  $result = mysqli_stmt_execute($stmt);

  if (!$result) {
    die("Query Failed: " . mysqli_error($connection));
  } else {
    $update_msg = "Data has been Updated"; // Set update message
    // Redirect to update page with update message
    header("Refresh: 5; URL=update_page1.php?id=$id");
    // Clear input fields and redirect to home page after 5 seconds
    echo "<script>
                setTimeout(function() {
                    document.getElementById('update_form').reset();
                    window.location.href = 'index.php';
                }, 5000);
            </script>";
  }
}
?>

<form id="update_form" action="update_page1.php?id=<?php echo $id; ?>" method="post">
  <div class="form-group">
    <label for="f_name">First Name</label>
    <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>">
  </div>
  <div class="form-group">
    <label for="l_name">Last Name</label>
    <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>">
  </div>
  <div class="form-group">
    <label for="age">Age</label>
    <input type="number" name="age" class="form-control" value="<?php echo $row['age'] ?>">
  </div>
  <div class="form-group">
    <label for="gender">Gender</label>
    <select name="gender" class="form-control">
      <option value="M" <?php if ($row['gender'] == 'M')
        echo 'selected' ?>>Male</option>
        <option value="F" <?php if ($row['gender'] == 'F')
        echo 'selected' ?>>Female</option>
      </select>
    </div>
    <input type="submit" class="btn btn-success" name="update_student" value="UPDATE">
  </form>

  <div id="update_msg">
  <?php echo $update_msg; ?>
</div>

<?php include('footer.php'); ?>