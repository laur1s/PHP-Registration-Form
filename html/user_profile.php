<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['Update'])) {

    $user_id = trim($_POST['id']);
    $title = trim($_POST['title']);
    $first_name = trim($_POST['first_name']);
    $sir_name = trim($_POST['sir_name']);
    $email = trim($_POST['email']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);

    $fag = "I have run";
    // check email exist or not
    $stmt = $conn->prepare("SELECT email FROM users WHERE email=? AND id != ?");
    $stmt->bind_param("si", $email, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $fag = "I have run";

    $count = $result->num_rows;

    if ($count == 0) { // if email is not found update user

        $fag = "I have run";
        $update_stmt = $conn->prepare("UPDATE users SET title = ?, first_name = ?, sir_name = ?, email = ?, country = ?, city = ? WHERE id = ?");
        $update_stmt->bind_param("ssssssi", $title, $first_name, $sir_name, $email, $country, $city, $user_id);

        $result_statement = $update_stmt;
        $res = $update_stmt->execute();//get result

        $update_stmt->close();

        $_SESSION['user'] = $user_id;
        if (isset($_SESSION['user'])) {
            print_r($_SESSION);
            header("Location: user_profile.php?updated=true");
            exit;
        }
         else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again";
        } 

    } else {
        $errTyp = "warning";
        $errMSG = "Email is already used";
    }

}
else {
    // select logged in users detail
    $res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Profile</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
</head>

<body>
 
 <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Endava SoA SUT</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="users.php">Users</a></li>
                    <li><a href="#">Third Link</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">
                            <span
                                class="glyphicon glyphicon-user"></span>&nbsp;Logged
                            in: <?php echo $userRow['email']; ?>
                            &nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<p>&nbsp;</p>

<div class="container">

    <div id="update_user_form">
        <form method="post" autocomplete="off">

            <div class="col-md-12">

                <div class="form-group">
                <?php 
                    $header_title = (isset($_GET['updated']) && $_GET['updated'] == 'true') ? "Profile Updated" : "Update Profile"
                ?>
                    <h2 class=""><?php echo $header_title ?></h2>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <?php
                    if (isset($errMSG)) {

                        ?>
                        <div class="form-group">
                            <div class="alert alert-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                                <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                
                <input type="hidden" name="id" value = "<?php echo $userRow['id'] ?>" />
                <div class="form-group">
                    <div class="input-group">
                        <span>  Set Title: &nbsp; </span> 
                        <label class="radio-inline"><input type="radio" name="title" value="Mr."  <?php echo $userRow['title'] == 'Mr.' ? 'checked' : '' ?> >Mr.</label>
                        <label class="radio-inline"><input type="radio" name="title" value="Mrs." <?php echo $userRow['title'] == 'Mrs.' ? 'checked' : '' ?> >Mrs.</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $userRow['first_name'] ?>" required />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="sir_name" class="form-control" value="<?php echo $userRow['sir_name'] ?>" required />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" value="<?php echo $userRow['email'] ?>" required />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
                        <input type="text" name="country" class="form-control" value="<?php echo $userRow['country'] ?>" required />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
                        <input type="text" name="city" class="form-control" value="<?php echo $userRow['city'] ?>" required />
                    </div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn  btn-block btn-primary" name="Update" id="Update">Update</button>
                </div>

            </div>

        </form>
    </div>

</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/tos.js"></script>

</body>
</html>
