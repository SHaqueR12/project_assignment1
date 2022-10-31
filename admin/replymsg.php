<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if(!isset($_GET['msgid']) || $_GET['msgid'] == null)
    {
        echo "<script>window.location = 'inbox.php';</script>";//using js
        //another way: header("Location:catlist.php");
        
    }
    else{
        $id=$_GET['msgid'];
    }


?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Reply</h2>
                <?php 
                     if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $to = $fm->validation($_POST['toEmail']);
                        $from = $fm->validation($_POST['fromEmail']);
                        $subject = $fm->validation($_POST['subject']);
                        $message = $fm->validation($_POST['msg']);
                        $reply= mail($to,$from, $subject,$message);
                        if($reply)
                        {
                            echo "<span class='success'>Message sent successfully.</span>";
                        }
                        else{
                            
                            echo "<span class='error'>Message not sent .</span>";
                        }
                     }
  
?>
                <div class="block">               
                 <form action="" method="post" >
                 <?php 
					$query = "select * from contact where id='$id'";
					$msg = $db->select($query);
					if($msg)
					{
						$i = 0;
						while($result = $msg->fetch_assoc())
						{
							
					

					?>
                    <table class="form">
                       
                         
                   
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>  
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text"  name="fromEmail" placeholder="Enter your email address" class="medium" />
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text"  name="subject" placeholder="Enter subject" class="medium" />
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce"  name= "msg" >
                            </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly name="email" value="<?php echo $fm->formatdate($result['date']); ?>" class="medium" />
                            </td>
                        </tr>  
                       
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>
                    <?php }} ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
     <!-- Load TinyMCE -->
 <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
    <?php include 'inc/footer.php'; ?>

    