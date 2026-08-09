<?php
$name = $age = $email = $membership = $department = $phone = "";
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $age = trim($_POST['age']);
    $email = trim($_POST['email']);
    $membership = $_POST['membership'] ?? "";
    $department = $_POST['department'] ?? "";
    $phone = trim($_POST['phone']);

    if (empty($name)) {
        $errors['name'] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $errors['name'] = "Only letters and spaces are allowed.";
    }

    if (empty($age)) {
        $errors['age'] = "Age is required.";
    } elseif (!is_numeric($age) || $age < 18 || $age > 30) {
        $errors['age'] = "Age must be between 18 and 30.";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if (empty($membership)) {
        $errors['membership'] = "Please select a membership type.";
    }

    if (empty($department) || $department == "-- Select Department --") {
        $errors['department'] = "Please select your department.";
    }

    if (empty($phone)) {
        $errors['phone'] = "Phone number is required.";
    } elseif (!preg_match("/^[0-9]{11}$/", $phone)) {
        $errors['phone'] = "Phone number must contain exactly 11 digits.";
    }

    if (empty($errors)) {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Student Technology Club Registration</title>
</head>
<body>
<h2>Student Technology Club Registration Form</h2>

<?php if ($success) { ?>
    <p style="color:green;">Registration Successful! Welcome, <?php echo $name; ?></p>
<?php } ?>

<form method="POST" action="">

    Student Name: <br>
    <input type="text" name="name" value="<?php echo $name; ?>">
    <?php if (isset($errors['name'])) echo "<p style='color:red;'>".$errors['name']."</p>"; ?>
    <br><br>

    Student Age: <br>
    <input type="number" name="age" value="<?php echo $age; ?>">
    <?php if (isset($errors['age'])) echo "<p style='color:red;'>".$errors['age']."</p>"; ?>
    <br><br>

    University Email: <br>
    <input type="email" name="email" value="<?php echo $email; ?>">
    <?php if (isset($errors['email'])) echo "<p style='color:red;'>".$errors['email']."</p>"; ?>
    <br><br>

    Membership Type: <br>
    <input type="radio" name="membership" value="Regular Member" <?php if($membership=="Regular Member") echo "checked"; ?>> Regular Member
    <input type="radio" name="membership" value="Executive Member" <?php if($membership=="Executive Member") echo "checked"; ?>> Executive Member
    <input type="radio" name="membership" value="Volunteer" <?php if($membership=="Volunteer") echo "checked"; ?>> Volunteer
    <?php if (isset($errors['membership'])) echo "<p style='color:red;'>".$errors['membership']."</p>"; ?>
    <br><br>

    Department: <br>
    <select name="department">
        <option value="-- Select Department --">-- Select Department --</option>
        <option value="CSE" <?php if($department=="CSE") echo "selected"; ?>>CSE</option>
        <option value="EEE" <?php if($department=="EEE") echo "selected"; ?>>EEE</option>
        <option value="BBA" <?php if($department=="BBA") echo "selected"; ?>>BBA</option>
        <option value="English" <?php if($department=="English") echo "selected"; ?>>English</option>
        <option value="Architecture" <?php if($department=="Architecture") echo "selected"; ?>>Architecture</option>
    </select>
    <?php if (isset($errors['department'])) echo "<p style='color:red;'>".$errors['department']."</p>"; ?>
    <br><br>

    Contact Number: <br>
    <input type="text" name="phone" value="<?php echo $phone; ?>">
    <?php if (isset($errors['phone'])) echo "<p style='color:red;'>".$errors['phone']."</p>"; ?>
    <br><br>

    <input type="submit" value="Register">

</form>
</body>
</html>

