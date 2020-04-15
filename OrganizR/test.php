
<?php
require_once "master/db_config.php";
$id = 1;
$comments = array();
$comment = [
    "id" => "",
    "user_id" => "",
    "comment" => ""
];
$conn = Db::initializeDb();
$stmt = $conn->prepare("Select comment_id,user_id,comment FROM comments where event_id=?");
$stmt->bind_param("d",$id);
$stmt->execute();
$res = $stmt->get_result();
while($row = $res->fetch_assoc()){
    array_push($comments,["id" => $row["comment_id"], "user_id" => $row["user_id"],"comment" => $row["comment"]]);
    var_dump($comment);
}
$stmt->close();
$conn->close();
    print_r($comments);
?>
