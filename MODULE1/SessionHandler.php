<?php
/*
Filename : SessionHandler.php
Purpose : To handle login information and create a session for that user.
*/
//Start session
session_start();

//Validation error flag
$errflag = false;

//Input Validations 
if ($_POST ['uname']== '') {
    $errmsg_arr[] = 'Login ID missing';
    $errflag = true;    
}
if ($_POST [ 'pword' ] == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
}

//If there are input validations, redirect back to the login form 
if ($errflag) {
    $_SESSION [' ERRMSG ARR'] = $errmsg_arr;
    session_write_close ();
    header ("location: Login.php");
    exit() ;
}   
    
//to make a connection with database
$conn = mysqli_connect ("localhost","root","") or die (mysqli_connect_error()) ;

//to select the targeted database 
mysqli_select_db ($conn,"userprofile") or die (mysqli_error($conn)) ;

//to create a query to be executed in sql
$katanama = $_POST ['uname'];
$katalaluan = $_POST['pword'];
$jenispengguna = $_POST['typeuser'];

$query = "SELECT * FROM user WHERE username = '$katanama' AND password = '$katalaluan' AND usertype = '$jenispengguna'";

//to run sql query in database
$result = mysqli_query ($conn,$query) or die (mysqli_error());

//Check whether the query was successful or not 
if (isset ($result)) {
    if (mysqli_num_rows ($result) == 1) {
       //Login Successful
        session_regenerate_id() ;
        $member = mysqli_fetch_assoc($result);
        $_SESSION['SESS_MEMBER_ID'] = $member['id'];
        $_SESSION ['SESS_FIRST_NAME'] = $member['firstname'];
        $_SESSION ['SESS_LAST_NAME'] = $member ['lastname'];
        $_SESSION ['SESS_USER_NAME'] = $member ['username'];
        $_SESSION ['STATUS'] = true;
        session_write_close();

        if ($jenispengguna=="Admin"){
            header ("location: AdminHomepage.php");
        }
        else if($jenispengguna=="Expert"){
            header ("location: ExpertHomepage.php");
        }
        else{
            header ("location: UserHomepage.php");
        }
        exit(); 
    }
    else {
        //Login failed 
        echo '<script>alert("Wrong Username or Password!");
        window.location.href= "Login.php"</script>';
        exit();
    }
}
else {
    die("Query failed");
}

?>