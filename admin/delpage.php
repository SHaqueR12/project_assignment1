<?php 
include '../lib/Session.php';
Session::checkSession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/database.php'; ?>


<?php 
$db=new database();

?>

<?php 
    if(!isset($_GET['delid']) || $_GET['delid'] == null)
    {
        echo "<scrip>window.location = 'index.php';</scrip>";//using js
        
        
    }
    else{
        $pid = $_GET['delid'];
       
        $delquery = "delete from page where id='$pid' ";
        $ddata = $db->delete($delquery);
        if($ddata)
        {
            echo "<script>alert('Page deleted successfully.')</script>";//js
            echo "<scrip>window.location = 'index.php';</scrip>";
    }else
    {
        echo "<script>alert('Page  not deleted successfully.')</script>";//js
            echo "<scrip>window.location = 'index.php';</scrip>";
    }

    }

?>