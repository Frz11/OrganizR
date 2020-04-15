<?php
require_once "master/db_config.php";

class site_stats
{
    public static function pageView($page)
    {
        $conn = DB::initializeDb();
        $sql = "update stats set pageviews = pageviews+1 where page=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $page);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}


?>