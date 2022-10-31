<?php 
include '../lib/Session.php';
Session::checkSession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/database.php'; ?>
<?php include "../helpers/format.php";?>

<?php 
$db=new database();

?>

<?php 
    if(!isset($_GET['delpid']) || $_GET['delpid'] == null)
    {
        echo "<script>window.location = 'postlist.php';</script>";//using js
        
        
    }
    else{
        $pid = $_GET['delpid'];
        $query = "select * from post where id = '$pid'";
        $getdata = $db->select($query);
        if($getdata)
        {
            while($dimage = $getdata->fetch_assoc())
            {
                $dlink = $dimage['image'];
                unlink($dlink);
            }
        }
        $delquery = "delete from post where id='$pid' ";
        $ddata = $db->delete($delquery);
        if($ddata)
        {
            echo "<script>alert('Data deleted successfully.')</script>";//js
            echo "<script>window.location = 'postlist.php';</script>";
    }else
    {
        echo "<script>alert('Data  not deleted successfully.')</script>";//js
            echo "<script>window.location = 'postlist.php';</script>";
    }

    }

?>