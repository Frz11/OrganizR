<?php
require_once "master/db_config.php";
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
define('GUSER', 'deathranger15@gmail.com');
define('GPWD', 'prototipe201');   global $error;
session_start();



$action = (isset($_POST["action"]) && $_POST["action"] != "" )?$_POST["action"] :$_GET["action"];


switch ($action){
    case "register":
        register();
        break;
    case "confirm":
        confirm();
        break;
    case "logIn":
        logIn();
        break;
    case "getEvents":
        getEvents();
        break;
    case "getEventMainPhoto":
        getEventMainPhoto();
        break;
    case "registerOrganiser":
        registerOrganiser();
        break;
    case "updateOrganiser":
        updateOrganiser();
        break;
    case "rate":
        rate();
        break;
    case "uploadPhoto":
        uploadPhoto();
        break;
    case "deletePhoto":
        deletePhoto();
        break;
    case "addEvent":
        addEvent();
        break;
    case "changeProfilePicture":
        changeProfilePicture();
        break;
    case "addComent":
        addComment();
        break;
    case "sendContact":
        sendContact();
        break;
    case "deleteComment":
        deleteComment();
        break;
    case "deleteEvent":
        deleteEvent();
        break;
    case "editEvent":
        editEvent();
        break;
}



//actions

function deleteEvent(){
    if(!checkGroupAccess($_SESSION["user_id"],$_POST["org_id"])){
        die("No Access!");
    }
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("DELETE FROM Events WHERE id = ?");
    $stmt->bind_param("d",$_POST["id"]);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    return;
}
function deleteComment(){
    $commnet_id = $_POST["id"];
    $comment = getCommentInfo($commnet_id);
    if(checkCommentsRights($comment["event_id"],$commnet_id)){
        $conn = DB::initializeDb();
        $stmt = $conn->prepare("DELETE FROM COMMENTS WHERE comment_id=?");
        $stmt->bind_param("d",$commnet_id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        $Result["ok"] = true;
        echo json_encode($Result);
    } else {
        $Result["error"] = "You don't have rights to do this!";
        $Result["ok"] = false;
        echo json_encode($Result);
    }
}
function editEvent(){
    $Result = [
        "ok" => true,
        "error" => ""
    ];

    $user_id = $_SESSION["user_id"];
    if(!isset($user_id)){
        $Result["ok"] = false;
        $Result["error"] = "Session expired! Please log in again!";
    }

    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $price = isset($_POST["price"])?$_POST["price"]:0;
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $organiser_id = $_POST["organiser_id"];
    $mainphoto = (isset($_POST["mainphoto"]) && $_POST["mainphoto"] != "")?$_POST["mainphoto"]:0;

    if(!isset($name) || $name == "" || strlen($name) < 7 || strlen($name) > 50){
        $Result["error"] = "Name field is required and must pe at least 7 characters long!";
        $Result["ok"] = false;
    } elseif(!isset($country) || $country == ""){
        $Result["ok"] = false;
        $Result["error"] = "Country field is required!";
    } elseif(!isset($city) || $city == ""){
        $Result["ok"] = false;
        $Result["error"] = "City field is required!";
    } elseif(!isset($start_date) || $start_date == ""){
        $Result["ok"] = false;
        $Result["error"] = "Start date field is required!";
    } elseif (!isset($end_date) || $end_date == ""){
        $Result["ok"] = false;
        $Result["error"] = "End date field is required!";
    } elseif (!isset($organiser_id) || $organiser_id == ""){
        $Result["ok"] = false;
        $Result["error"] = "Select an organiser group for this event!";
    } elseif(!checkGroupAccess($user_id,$organiser_id)){
        $Result["ok"] = false;
        $Result["error"] = "You are not a member of this group!";
    }

    if(!$Result["ok"]) {
        echo json_encode($Result);
        return;
    }

    $conn = DB::initializeDb();
    $stmt = $conn->prepare("UPDATE Events set name=?, description=?, organiser_id=?, country = ?, city=?, price=?, start_date=?, end_date=?, main_photo=? WHERE id=?");
    $stmt->bind_param("ssdssdssdd",$name,$description,$organiser_id,$country,$city,$price,$start_date,$end_date,$mainphoto,$id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo json_encode($Result);
}
function addEvent(){
    $Result = [
        "ok" => true,
        "error" => ""
    ];

    $user_id = $_SESSION["user_id"];
    if(!isset($user_id)){
        $Result["ok"] = false;
        $Result["error"] = "Session expired! Please log in again!";
    }

    $name = $_POST["name"];
    $description = $_POST["description"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $price = isset($_POST["price"])?$_POST["price"]:0;
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $organiser_id = $_POST["organiser_id"];
    $mainphoto = (isset($_POST["mainphoto"]) && $_POST["mainphoto"] != "")?$_POST["mainphoto"]:0;

    if(!isset($name) || $name == "" || strlen($name) < 7 || strlen($name) > 50){
        $Result["error"] = "Name field is required and must pe at least 7 characters long!";
        $Result["ok"] = false;
    } elseif(!isset($country) || $country == ""){
        $Result["ok"] = false;
        $Result["error"] = "Country field is required!";
    } elseif(!isset($city) || $city == ""){
        $Result["ok"] = false;
        $Result["error"] = "City field is required!";
    } elseif(!isset($start_date) || $start_date == ""){
        $Result["ok"] = false;
        $Result["error"] = "Start date field is required!";
    } elseif (!isset($end_date) || $end_date == ""){
        $Result["ok"] = false;
        $Result["error"] = "End date field is required!";
    } elseif (!isset($organiser_id) || $organiser_id == ""){
        $Result["ok"] = false;
        $Result["error"] = "Select an organiser group for this event!";
    } elseif(!checkGroupAccess($user_id,$organiser_id)){
        $Result["ok"] = false;
        $Result["error"] = "You are not a member of this group!";
    }

    if(!$Result["ok"]) {
        echo json_encode($Result);
        return;
    }

    $conn = DB::initializeDb();
    $stmt = $conn->prepare("INSERT INTO Events(name,description,organiser_id,country,city,price,start_date,end_date,main_photo) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssdssdssd",$name,$description,$organiser_id,$country,$city,$price,$start_date,$end_date,$mainphoto);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo json_encode($Result);
}
function deletePhoto(){
    $id = $_POST["id"];
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("SELECT location from Photo where id = ?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->bind_result($location);
    $stmt->fetch();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM Photo where id = ?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->close();
    unlink("images/".$location);
}
function uploadPhoto(){
    $Result = [
        "ok" => true,
        "location" => "",
        "photo_id" => "",
        "error" => ""
    ];
    $inserted = false;
    $file = $_FILES["file"]['tmp_name'];
    $ext = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    //check extension
    if($ext != "png" && $ext != "jpg" && $ext != "jpeg"){
        $Result["ok"] = false;
        $Result["error"] = "Allowed extensions are png, jpg, jpeg!";
        echo json_encode($Result);
        return;
    }

    //check size
    if($_FILES['file']['size'] > 10485760) { //10 MB (size is also in bytes)
        $Result["ok"] = false;
        $Result["error"] = "Max size is 10mb!";
        echo json_encode($Result);
        return;
    }
    $uniq = uniqid();
    $targ = "images/tmp/img-".$uniq.".".$ext;
    $location = "tmp/img-".$uniq.".".$ext;
    move_uploaded_file($file,$targ);
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("INSERT INTO Photo(location) VALUES (?)");
    $stmt->bind_param("s",$location);
    $stmt->execute();
    if($stmt->error == ""){
        $Result["location"] = $targ;
        $Result["photo_id"] = $stmt->insert_id;
    } else {
        $Result["ok"] = false;
        $Result["error"] = "Something went wrong";
    }

    $stmt->close();
    $conn->close();
    echo json_encode($Result);
    return;

}

function changeProfilePicture(){
    $Result = [
        "ok" => true,
        "error" => ""
    ];
    $file = $_FILES["file"]['tmp_name'];
    $ext = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    //check extension
    if($ext != "png" && $ext != "jpg" && $ext != "jpeg"){
        $Result["ok"] = false;
        $Result["error"] = "Allowed extensions are png, jpg, jpeg!";
        echo json_encode($Result);
        return;
    }

    //check size
    if($_FILES['file']['size'] > 10485760) { //10 MB (size is also in bytes)
        $Result["ok"] = false;
        $Result["error"] = "Max size is 10mb!";
        echo json_encode($Result);
        return;
    }
    $uniq = uniqid();
    $targ = "images/profiles/prof-".$uniq.".".$ext;
    $location = "profiles/prof-".$uniq.".".$ext;
    move_uploaded_file($file,$targ);
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("INSERT INTO Photo(location) VALUES (?)");
    $stmt->bind_param("s",$location);
    $stmt->execute();

    if($stmt->error != "") {
        $Result["ok"] = false;
        $Result["error"] = "Something went wrong";
        echo json_encode($Result);
        $stmt->close();
        $conn->close();
        return;
    }
    $last_id = $stmt->insert_id;
    $stmt->close();

    $stmt = $conn->prepare("UPDATE Users set profile_photo=? where id=?");
    $stmt->bind_param("dd",$last_id,$_SESSION["user_id"]);
    $stmt->execute();
    if($stmt->error != "") {
        $Result["ok"] = false;
        $Result["error"] = "Something went wrong";
    }
    $stmt->close();
    $conn->close();
    echo json_encode($Result);
    return;
}
function rate(){
    if(!$_SESSION["user_id"]){
        die("Not logged in!");
    }
    $event_id = $_POST["event_id"];
    $user_id = $_SESSION["user_id"];
    $stars = $_POST["stars"];


    $conn = DB::initializeDb();
    $stmt = $conn->prepare("INSERT INTO RATING (event_id,stars,user_id) VALUES (?,?,?) ON DUPLICATE KEY UPDATE stars = ?");
    $stmt->bind_param("dddd",$event_id,$stars,$user_id,$stars);
    $stmt->execute();
    $stmt->close();
    $conn->close();

}
function updateOrganiser(){
    $Result = array("ok" => true,"error" => "");
    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $members = $_POST["members"];
    $group = (sizeof($group = getOrganisersGroupInfo(array($id))) > 0)?$group[0]:null;
    if(!isset($group)){
        $Result["ok"] = false;
        $Result["error"] = "This group wasn't found in the database!";
        echo json_encode($Result);
        return;
    }
    if(!checkIfGroupOwner($_SESSION["user_id"],$group["admin_id"])){
        $Result["ok"] = false;
        $Result["error"] = "You are not the admin of this group! You can't edit the group!";
        echo json_encode($Result);
        return;
    }
    //updating info in Organiser table
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("UPDATE Organiser SET name=?,description=? WHERE id=?");

    $stmt->bind_param("ssd",$name,$description,$id);
    $stmt->execute();
    $stmt->close();

    //deleting all members in Organiser_Members and adding them again
    $stmt = $conn->prepare("Delete from Organiser_Members WHERE organiser_id = ? AND member_id <> ?");
    $stmt->bind_param("dd",$id,$_SESSION["user_id"]);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("Insert into Organiser_Members (member_id,organiser_id) Values(?,?)");
    if(isset($members)) {
        foreach ($members as $member) {
            $stmt->bind_param("dd", $member, $id);
            $stmt->execute();
        }
    }
    $stmt->close();
    $conn->close();
    echo json_encode($Result);
    return;


}

function registerOrganiser(){
    $Result = ["ok" => true,"error" =>""];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $members = $_POST["members"];

    if(!isset($name) || $name == ""){
        $Result["error"] = "Name cannot be empty!";
        $Result["ok"] = false;
    } else if (!isset($description) || $description == ""){
        $Result["error"] = "Please enter a description for your group, let the attenders know who you are!";
        $Result["ok"] = false;
    }
    if(!$Result["ok"]){
        echo json_encode($Result);
        return;
    }
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("Select 1 from Organiser WHERE name=?");
    $stmt->bind_param("s",$name);
    $stmt->execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    $stmt->close();
    if(isset($found)){
        $Response["ok"] = false;
        $Response["error"] = "A group with this name has been found! Use another name!";
        echo json_encode($Response);
        return;
    }

    $stmt = $conn->prepare("INSERT INTO Organiser (name,description,admin_id) values (?,?,?)");
    $stmt->bind_param("ssd",$name,$description,$_SESSION["user_id"]);
    $stmt->execute();
    $inserted_id = $stmt->insert_id;
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO Organiser_Members(member_id,organiser_id) values (?,?)");
    $stmt->bind_param("dd",$_SESSION["user_id"],$inserted_id);
    $stmt->execute();
    $stmt->close();
    if(isset($members)) {
        foreach ($members as $member) {
            $stmt = $conn->prepare("INSERT INTO Organiser_Members(member_id,organiser_id) values (?,?)");
            $stmt->bind_param("dd", $member, $inserted_id);
            $stmt->execute();
            $stmt->close();
        }
        $stmt = $conn->prepare("INSERT INTO Organiser_Members(member_id,organiser_id) values (?,?)");
        $stmt->bind_param("dd", $_SESSION["user_id"], $inserted_id);
        $stmt->execute();
        $stmt->close();
    }
    $conn->close();
    echo json_encode($Result);

}
function getEventMainPhoto(){
    $photo = "";
    $photoId = $_POST["photoId"];
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("Select location FROM Photo where id = ?");
    $stmt->bind_param("d",$photoId);
    $stmt->execute();
    $stmt->bind_result($photo);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    echo $photo;

}
function getEvents(){
    $conn = DB::initializeDb();
    $events = $conn->query("Select * from Events limit 5");
    $Response = ["error" => 0,"events" => []];
    if($events->num_rows > 0){
        while($row = $events->fetch_assoc()){
            $elem = ["id" => $row["id"],"name" => $row["name"],"description" => $row["description"],"main_photo" => $row["main_photo"]];
            array_push($Response["events"],$elem);
        }
    } else {
        $Response["error"] = 1;
    }
    echo json_encode($Response);
    return;
}
function logIn(){
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $Response = ["ok" => true,"error" => ''];
    if($email == "" || $pwd == ""){
        $Response["ok"] = false;
        $Response["error"] = "Complete both fields!";
        echo json_encode($Response);
        return;
    }
    $conn = DB::initializeDb();
    $sql = "SELECT email,verified,id FROM Users where email=? and pwd=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$email,$pwd);
    $stmt->execute();
    $stmt->bind_result($emailr,$verified,$id);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    if(!$emailr){
        $Response["ok"] = false;
        $Response["error"] = "Wrong email or password!";
        echo json_encode($Response);
        return;
    }
    if($verified === 0){
        $Response["ok"] = false;
        $Response["error"] = "Your account has not been activated yet, check your email to activate it!";
        echo json_encode($Response);
        return;
    }
    $_SESSION["authenticated"] = true;
    $_SESSION["user_id"] = $id;
    $Response["ok"] = true;
    echo json_encode($Response);
}
function confirm(){


    $auth_code = $_GET["code"];
    $conn = DB::initializeDb();
    $sql = "Update Users set verified=1 where auth_code=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$auth_code);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo "<script>setTimeout(function(){location.href='Events.php';},3000);</script>";
    echo "Your account has been successfully confirmed";


}
function register(){
    $Response = ["ok" => true,"error" => ''];

    $uname = $_POST['uname'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $now = new DateTime('now');
    $birthdayobj = new DateTime($birthday);
    $diff = $now->diff($birthdayobj);


    if(!isset($uname) || $uname === ''){

        $Response["ok"] = false;
        $Response["error"] = "Username field cannot be blank!";
        echo json_encode($Response);
        return;

    } else if(!isset($pass) || $pass === ''){

        $Response["ok"] = false;
        $Response["error"] = "Password field cannot be blank!";
        echo json_encode($Response);
        return;

    } else  if(!isset($confirm) || $confirm === ''){

        $Response["ok"] = false;
        $Response["error"] = "Confirm password field cannot be blank!";
        echo json_encode($Response);
        return;

    } else if(!isset($email) || $email === ''){

        $Response["ok"] = false;
        $Response["error"] = "Email field cannot be blank!";
        echo json_encode($Response);
        return;

    } else if(!isset($birthday) || $birthday === ''){

        $Response["ok"] = false;
        $Response["error"] = "Birthday field cannot be blank!";
        echo json_encode($Response);
        return;

    } else if(strlen($uname) < 6){

        $Response["ok"] = false;
        $Response["error"] = "Username should be at least 6 characters long";
        echo json_encode($Response);
        return;

    } else if(strlen($pass) < 8 || !preg_match('~[0-9]~', $pass)){

        $Response["ok"] = false;
        $Response["error"] = "Password should be at least 8 characters long and contain a number!";
        echo json_encode($Response);
        return;

    } else if($diff->y < 16){

        $Response["ok"] = false;
        $Response["error"] = "You must be at least 16 y/o to use this OrganizR!";
        echo json_encode($Response);
        return;
    }

    $conn = DB::initializeDb();
    $sql = "SELECT 1 FROM Users WHERE uname=?";
    //die($uname);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$uname);
    $stmt->execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    $stmt->close();
    if(isset($found)){
        $Response["ok"] = false;
        $Response["error"] = "An account with this username was found!";
        echo json_encode($Response);
        return;
    }
    $sql = "SELECT 1 FROM Users WHERE email=?";
    //die($uname);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    $stmt->close();
    if(isset($found)) {
        $Response["ok"] = false;
        $Response["error"] = "An account with this email was found!";
        echo json_encode($Response);
        return;
    }
    $auth_code=uniqid("auth_");

    $sql = "INSERT INTO Users (uname,pwd,email,birthday,newsletter,verified,auth_code) VALUES (?,?,?,?,0,0,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss",$uname,$pass,$email,$birthdayobj->format("Y-m-d"),$auth_code);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $subject = "OrganizR new account!";
    $message = "Hello $uname ! We are thanking you for choosing our event organiser platform. To confirm your account click the following link: http://localhost/OrganizR/Actions.php?action=confirm&code=$auth_code";
    sendmail($email,$subject,$message);


    echo json_encode($Response);
}






//aux funtions;
function getEventDetails($id){
    $event = [
        "id"         => '',
        "name"       => '',
        "desc"       => '',
        "org_id"     => '',
        "country"    => '',
        "city"       => '',
        "price"      => 0,
        "start_date" => '',
        "end_date"   => '',
        "main_photo" => ''];
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("SELECT * FROM Events WHERE id = ?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->bind_result($event["id"],$event["name"],$event["desc"],$event["org_id"],$event["country"],$event["city"],$event["price"],$event["start_date"],$event["end_date"],$event["main_photo"]);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    return $event;
}
function getUsers(){
    $users = array();
    $conn = DB::initializeDb();
    $result = $conn->query("SELECT * FROM Users;");
    while($row = $result->fetch_assoc()){
        array_push($users,["username" => $row["uname"],"id" => $row["id"]]);
    }
    return $users;
}
function sendmail($to,$subject,$message){
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->SMTPAutoTLS = false;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->Username = GUSER;
    $mail->Password = GPWD;
    $mail->SetFrom("Organizr@gmail.com", "Organizr");
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress($to);
    if(!$mail->Send()) {
        $error = 'Mail error: '.$mail->ErrorInfo;
        return false;
    } else {
        $error = 'Message sent!';
        return true;
    }

}
function checkIfOrganiser(){
    $id = $_SESSION["user_id"];
    if(checkAdmin($id)){
        return true;
    }
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("SELECT 1 FROM Organiser_Members WHERE member_id=?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    if(isset($found)){
        return true;
    }
    return false;
}
function getProfile(){
    $user = [
        "id" => $_SESSION["user_id"],
        "uname" => '',
        "pwd" => '',
        "email" => '',
        "birthday" => '',
        "newsletter" => '',
        "profile_photo" => ''
        ];
    $id = $_SESSION["user_id"];
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("SELECT uname,pwd,email,birthday,newsletter,profile_photo FROM Users WHERE id=?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->bind_result($user["uname"],$user["pwd"],$user["email"],$user["birthday"],$user["newsletter"],$user["profile_photo"]);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    if($user["profile_photo"] == 0 || $user["profile_photo"] == ""){
        $user["profile_photo"] = "no-image-profile.png";
    } else {
        $user["profile_photo"] = getPhoto($user["profile_photo"]);
    }

    $user["profile_photo"] = "images/".$user["profile_photo"];
    $Result["user"] = $user;
    return $Result;
}
function getPhoto($id,$is_profile = false){
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("Select location from Photo where id=?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->bind_result($profile_photo);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    if($is_profile && $profile_photo == ""){
        return "no-image-profile.png";
    }
    return $profile_photo;
}
function getGroups($id) {
    $organisers = array();
    $db = DB::initializeDb();
    $stmt = $db->prepare("SELECT organiser_id FROM Organiser_Members where member_id = ?");
    $stmt->bind_param("d",$id);

    $stmt->execute();
    $stmt->bind_result($result);
    while($stmt->fetch()){
        array_push($organisers,$result);
    }
    $stmt->close();
    $db->close();
    return $organisers;
}
function getOrganisersGroupInfo($ids) {
    $db = DB::initializeDb();
    $groups = array();

    foreach($ids as $id) {
        $result = array();
        $stmt = $db->prepare("SELECT id,name,rating,description,admin_id FROM Organiser WHERE id=?");
        $stmt->bind_param("d", $id);
        $stmt->execute();
        $stmt->bind_result($result["id"],$result["name"], $result["rating"], $result["description"], $result["admin_id"]);
        $stmt->fetch();
        if(isset($result["name"])) {
            array_push($groups, $result);
        }

        $stmt->close();
    }
    $db->close();
    return $groups;
}
function getGroupMembers($group_id){

    $members = array();
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("SELECT member_id FROM Organiser_Members WHERE organiser_id=?");
    $stmt->bind_param("d",$group_id);
    $stmt->execute();
    $stmt->bind_result($member_id);
    while($stmt->fetch()) {
        array_push($members, $member_id);
    }
    $stmt->close();
    $conn->close();
    return $members;
}
function checkGroupAccess($user_id,$group_id){
    if(checkAdmin($_SESSION["user_id"])){
        return true;
    }
    if(in_array($group_id,getGroups($user_id))){
        return true;
    } else {
        return false;
    }
}
function getRating($event_id){

    $stars = 0;
    $starsNo = 0;
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("SELECT stars FROM RATING WHERE event_id = ?");
    $stmt->bind_param("d",$event_id);
    $stmt->execute();
    $stmt->bind_result($result);
    while($stmt->fetch()){
        $starsNo++;
        $stars += $result;
    }
    $stmt->close();
    $conn->close();
    if($starsNo !== 0){
        return array("rating" => round($stars/$starsNo,1),"reviews" => $starsNo);
    } else{
        return array("rating" => 0,"reviews" => 0);
    }
}
function getUserRating($event_id){
    $user_id = $_SESSION["user_id"];
    if(!isset($user_id) || $user_id == ""){
        return null;
    }
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("SELECT stars FROM RATING WHERE event_id = ? AND user_id = ?");
    $stmt->bind_param("dd",$event_id,$user_id);
    $stmt->execute();
    $stmt->bind_result($stars);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    return $stars;
}
function getComments($id){
    $comments = array();

    $conn = Db::initializeDb();
    $stmt = $conn->prepare("Select comment_id FROM comments where event_id=?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->bind_result($id);
    while($stmt->fetch()){
        array_push($comments,$id);
    }
    $stmt->close();
    $conn->close();
    return $comments;
}
function getCommentInfo($id){
    $comment = ["user_id" => 0,"comment" => "","event_id" => ""];
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("Select user_id,comment,event_id,created_at FROM comments where comment_id=?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->bind_result($comment["user_id"],$comment["comment"],$comment["event_id"],$comment["created_at"]);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    return $comment;
}

function getProfileInfo($id){
    $user = ["uname" => "","photo" => ""];
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("SELECT uname,profile_photo FROM Users WHERE id=?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->bind_result($user["uname"],$user["photo"]);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    $user["photo"] = getPhoto($user["photo"],true);
    return $user;
}
function addComment(){
    if(!$_SESSION["authenticated"]){
        die("Log in!");
    }
    $event_id = $_POST["event_id"];
    $comment  = $_POST["comment"];
    $user_id  = $_SESSION["user_id"];
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("INSERT INTO Comments (user_id,event_id,comment) values (?,?,?)");
    $stmt->bind_param("dds",$user_id,$event_id,$comment);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: Event.php?eventId=".$event_id);
    exit();
}
function sendContact(){
    $Result = ["ok" => true,"error" => ""];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $subject = $_POST["subject"];

    if(empty($name) || empty($email) || empty($message) || empty($subject)){
        $Result["error"] = "All fields are required!";
        $Result["ok"] = false;
        echo json_encode($Result);
        return;
    }

    $mail_body = "Name: $name\n Email: $email\n Message: \n $message \n This is an automatic message, please do not respond!";
    sendmail("supp.organizr@gmail.com",$subject,$mail_body);
    echo json_encode($Result);
    return;
}

//get events from events.ro
function getExternalEvents(){
    $curl = curl_init();
// Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://www.events.ro/evenimente/',
        CURLOPT_SSL_VERIFYPEER => false,
    ));
// Send the request & save response to $resp
    $resp = curl_exec($curl);
// Close request to clear up some resources
    curl_close($curl);
    preg_match_all('#<h4>(.+?)</h4>#',$resp,$matches_events);
    preg_match_all('#href="(.+?)"#',$resp,$matches_links);
    $links = array();
    foreach ($matches_links[1] as $link){
        if(strpos($link,"/event/")){
            array_push($links,$link);
        }
    }

    return ["events" => $matches_events[1], "links" => $links];

}
function checkCommentsRights($event_id = 0,$comment_id = 0){

    if(checkAdmin($_SESSION["user_id"])){
        return true;
    }
    //check if it's the users comment
    $comment = getCommentInfo($comment_id);
    if($_SESSION["user_id"] == $comment["user_id"]){
        return true;
    }

    //check if the user is the organiser of this event
    $organisers = getGroups($_SESSION["user_id"]);
    $event_organiser = getEventDetails($event_id)["org_id"];

    if(in_array($event_organiser,$organisers)){
        return true;
    }
    return false;

}
function getOrganiserEvents($id){
    $events = array();
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("SELECT id FROM Events where organiser_id = ?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->bind_result($event_id);
    while($stmt->fetch()){
        array_push($events,getEventDetails($event_id));
    }
    $stmt->close();
    $conn->close();
    return $events;
}
function checkAdmin($id){
    $conn = DB::initializeDb();
    $stmt = $conn->prepare("SELECT super_admin FROM users where id=?");
    $stmt->bind_param("d",$id);
    $stmt->execute();
    $stmt->bind_result($admin);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    return $admin;
}
function checkEventRights($id){


    if(checkAdmin($_SESSION["user_id"])){
        return true;
    }
    $event = getEventDetails($id);
    $groups = getGroups($_SESSION["user_id"]);
    if(in_array($event["org_id"],$groups)){
        return true;
    }
    return false;
}
function checkIfGroupOwner($id,$group){
    if(checkAdmin($id)){
        return true;
    }
    if($id == $group){
        return true;
    }
    return false;
}

?>