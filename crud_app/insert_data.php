<?php
include 'dbconnection.php';
// to check whether the add students button is clicked or not...
if (isset($_POST['add_students'])) {
    // to abstract data ...variable name can be whatever 
    $firstname = $_POST['f_name'];
    $lastname = $_POST['l_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // to validate input data
    if (
        empty($firstname) || empty($lastname) || empty($age) || empty($gender) ||
        strlen($firstname) < 2 || strlen($firstname) > 8 ||
        !is_numeric($age) || $age < 0 || $age > 120 ||
        !in_array($gender, ['F', 'f', 'M', 'm'])
    ) {
        header('location:index.php?message=Please Fill the blanks Correctly!!');
        exit;
    }
    if (empty($firstname) || strlen($firstname) < 2 || strlen($firstname) > 8) {
        header('location:index.php?message=First name should be between 2 and 8 characters long!!');
        exit;
    }

    if (empty($lastname) || strlen($lastname) < 2 || strlen($lastname) > 10) {
        header('location:index.php?message=Last name should be between 2 and 10 characters long!!');
        exit;
    }

    if (empty($age) || !is_numeric($age) || $age < 18 || $age > 100) {
        header('location:index.php?message=Invalid age entered!!');
        exit;
    }

    if (empty($gender) || !in_array($gender, ['F', 'f', 'M', 'm'])) {
        header('location:index.php?message=Invalid gender selected!!');
        exit;
    }

    // to insert data
    else {

        // $query = "insert into `table_name` ('Columns_name_to_fill_data_volumn1','column2' ) values ('value1''value2')";
        $query = "insert into `students` (`first_name`,`last_name`,age,gender) values ('$firstname','$lastname','$age','$gender')";

        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Query Failed: " . mysqli_error($connection));
        } else {
            header('location:index.php?insert_msg=Your data has been added successfully!!');
        }
    }

}

?>
