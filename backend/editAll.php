    <?php
require('../config.php');
$p = null;

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $error = '';
    if (isset($_POST['submit'])) {

        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $matno = isset($_POST['matno']) ? $_POST['matno'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        //$name = isset($_POST['name']) ? $_POST['name'] : '';
        $department = isset($_POST['department']) ? $_POST['department'] : '';
        $degree = isset($_POST['degree']) ? $_POST['degree'] : '';
        $date_of_graduation = isset($_POST['date_of_graduation']) ? $_POST['date_of_graduation'] : '';

        $usersColl = $db->users;
        $cert_coll = $db->certificates;
        $users = $usersColl->updateOne(
            ['id' => $id],
            ['$set' => [
                'name' => $name,
                'gender' => $gender,
                'matno' => $matno,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'username' => $username,
                'password' => $password
            ]]

        );
        $cert_coll = $db->certificates;
        $certificates = $cert_coll->updateOne(
            ['id' => $id],
            ['$set' => [
                'name' => $name,
                'department' => $department,
                'degree' => $degree,
                'date_of_graduation' => $date_of_graduation
            ]]

        );
        if ($users & $certificates ) {
            $_SESSION['success'] = "User updated successfully";
            header("Location: viewAllregistered.php");
        }
    }

} else {
    echo "error encountered";
}
?>
<?php

$p = $db->users->findOne(array('id' => $_GET['id']));

$error = '';

$id = $p->_id;
$name = $p->name;
$gender = $p->gender;
$matno = $p->matno;
$email = $p->email;
$phone = $p->phone;
$address = $p->address;
$username =  $p->username;
$password = $p->password;
?>

<?php

$p = $db->certificates->findOne(array('id' => $_GET['id']));

$error = '';

$id = $p->_id;
$name = $p->name;
$department = $p->department;
$degree = $p->degree;
$date_of_graduation = $p->date_of_graduation;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>edit</title>

    <style>
        body {
            position: relative;
            background: url('./img/st.jpg') no-repeat;
            background-size: cover;
            background-position: center;
            height: 140vh;
            color: #fff;
        }


        .dark-overlay {
            background-color: rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 116%;
        }

        .heading {
            background-color: #f4f8f5;
            color: green;
        }

        .bg {
            background-color: white;
            color: green;
            padding: 10px;
        }

        .bg h4 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="dark-overlay">
        <div class="container" align="center">

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 bg" style="padding-top: 50px;">

                <h4>Edit both Users and their Certificates Info</h4>
                    <small><a href="viewAllregistered.php">Back?</a></small>

                    <form method="POST" action="editAll.php?id=<?php echo $_GET['id']; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" required class="form-control" placeholder="Enter full name" value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            Male<input type="radio" name="gender" value="Male"  <?php if ($gender=="Male") echo "checked='checked'"; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Female<input type="radio" name="gender" value="Female"<?php if ($gender="Female") echo "checked='checked'"; ?> />
                        </div>
                        <div class="form-group">
                            <label for="matno">Matric number</label>
                            <input type="matno" name="matno" required class="form-control" placeholder="Enter Matric number" value="<?php echo $matno; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" required class="form-control" placeholder="Enter email" value="<?php echo $email; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" required class="form-control" placeholder="Enter phone number" value="<?php echo $phone; ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Permanent Home Address</label>
                            <textarea name="address" id="address" class="form-control" rows="2" value="<?php echo $address; ?>" required readonly ><?php echo $address; ?></textarea >
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="username" name="username" required class="form-control" placeholder="Enter username" value="<?php echo $username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" required class="form-control" placeholder="Enter password" value="<?php echo $password; ?>">
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" name="department" required class="form-control" placeholder="Enter department" value="<?php echo $department; ?>">
                        </div>

                        <div class="form-group">
                            <label for="degree">Degree/Class</label>
                            <textarea name="degree" id="degree" class="form-control" rows="2" value="<?php echo $address; ?>" required><?php echo $degree; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="date_of_graduationn">Date of graduation</label>
                            <input type="text" name="date_of_graduation" required class="form-control" placeholder="Enter date of graduation" value="<?php echo $date_of_graduation; ?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <button type="submit" name="submit" value="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>