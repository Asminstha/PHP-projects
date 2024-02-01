<?php include('header.php');  /* including header file dynamically to the pages*/?>
<?php include('dbconnection.php'); ?>

<div class="box1">
  <h2> Students Details</h2>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Students</button>
</div>
<table class="table table-hover table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Age</th>
      <th>Gender</th>
      <th>Update</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <!-- reading data from database -->
    <?php
    // $query ="select everything (*) from Table_name"
    $query = "select * from `students`";
    //To execute the query ----      $result =mysqli_query(connection_variable_name,$query);  -----hold the entire set up of data that the query will return
    $result = mysqli_query($connection, $query);
    // to check if the connection is made or not ---- or whether the query is success or failed...
    if (!$result) {
      die("Query Failed: " . mysqli_error($connection));
    } else {
      // print_r($result);
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
          <td>
            <?php echo $row['id']; ?>
          </td>
          <td>
            <?php echo $row['first_name']; ?>
          </td>
          <td>
            <?php echo $row['last_name']; ?>
          </td>
          <td>
            <?php echo $row['age']; ?>
          </td>
          <td>
            <?php echo $row['gender']; ?>
          </td>
          <td><a href="update_page1.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Update</a></td>
          <td><a href="delete_page.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>

        </tr>

        <?php


      }
    }
    ?>


  </tbody>
</table>
<?php
//to show alert msg when requirements doesnot meet 
if (isset($_GET['message'])) {
  echo "<h6>" . $_GET['message'] . "</h6>";
}
?>
<?php
//to show alert msg when requirements doesnot meet 
if (isset($_GET['insert_msg'])) {
  echo "<h6>" . $_GET['insert_msg'] . "</h6>";
}
?>
<!-- Modal  --- To create pop up menu for form-->
<form action="insert_data.php" method="post">
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD STUDENTS</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="f_name">First Name </label>
            <input type="text" name="f_name" class="form-control">
          </div>
          <div class="form-group">
            <label for="l_name">Last Name </label>
            <input type="text" name="l_name" class="form-control">
          </div>
          <div class="form-group">
            <label for="age">Age </label>
            <input type="text" name="age" class="form-control">
          </div>
          <div class="form-group">
            <label for="gender">Gender </label>
            <input type="text" name="gender" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="add_students" value="ADD">
        </div>
      </div>
    </div>
  </div>
</form>
<?php include('footer.php'); ?>