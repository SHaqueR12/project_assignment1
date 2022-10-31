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
    if(!isset($_GET['sliderid']) || $_GET['sliderid'] == null)
    {
        echo "<script>window.location = 'sliderlist.php';</script>";//using js
        
        
    }
    else{
        $sliderid = $_GET['sliderid'];
        $query = "select * from slider where id = '$sliderid'";
        $getdata = $db->select($query);
        if($getdata)
        {
            while($dimage = $getdata->fetch_assoc())
            {
                $dlink = $dimage['image'];
                unlink($dlink);
            }
        }
        $delquery = "delete from slider where id='$sliderid' ";
        $ddata = $db->delete($delquery);
        if($ddata)
        {
            echo "<script>alert('Slider deleted successfully.')</script>";//js
            echo "<script>window.location = 'sliderlist.php';</script>";
    }else
    {
        echo "<script>alert('Slider not deleted successfully.')</script>";//js
            echo "<script>window.location = 'sliderlist.php';</script>";
    }

    }

?>