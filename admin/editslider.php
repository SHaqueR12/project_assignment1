<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if(!isset($_GET['sliderid']) || $_GET['sliderid'] == null)
    {
        echo "<script>window.location = 'sliderlist.php';</script>";//using js
        
        
    }
    else{
        $sliderid= $_GET['sliderid'];
    }


?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update slider</h2>
                <?php 


                     if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $title = mysqli_real_escape_string($db->link, $_POST['title']);
                    
                        $permited  = array('jpg', 'jpeg', 'png', 'gif', 'jfif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/slider".$unique_image;

    if($title == "" || $cat == "" || $body == ""|| $tags == ""||$author == "")
    {
        echo "<span class='error'>Field must not be empty..</span>";  
      }
      else{
      if(!empty($file_size))
      {
      if ($file_size >1048567) {
        echo "<span class='error'>Image Size should be less then 1MB!
        </span>";
       } elseif (in_array($file_ext, $permited) === false) {
        echo "<span class='error'>You can upload only:-"
        .implode(', ', $permited)."</span>";
       } else{     
        move_uploaded_file($file_temp, $uploaded_image);
       $query = "update post
       set 
       title = '$title',
       image = '$uploaded_image',
       where id='$sliderid' ";
       $updated_row = $db->update($query);

       
       if ($updated_row) {
        echo "<span class='success'>Slider updated Successfully.
        </span>";
       }else {
        echo "<span class='error'>Slider Not updated !</span>";
       }
         }   
         
        }else{
            $query = "update slider
            set
            title = '$title'
            where id='$sliderid' ";
     
            $updated_row = $db->update($query);
     
            
            if ($updated_row) {
             echo "<span class='success'>Slider updated Successfully.
             </span>";
            }else {
             echo "<span class='error'>Slider Not updated !</span>";
            }
        }
    }
}
?>
                <div class="block">  
                    <?php 
                    $query = "select * from slider where id = '$sliderid'";
                    $getslider = $db->select($query);
                    if($getslider){
                    while($sliderresult = $getslider->fetch_assoc())
                    {
                    ?>             
                 <form action="editpost.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $sliderresult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                       
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src = "<?php echo $sliderresult['image']; ?>" height = "100px" width = "250px" /><br/>
                                <input type="file" name= "image" />
                            </td>
                        </tr>
                        
                     
                     
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
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

    