<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if(!isset($_GET['editpid']) || $_GET['editpid'] == null)
    {
        echo "<script>window.location = 'postlist.php';</script>";//using js
        
        
    }
    else{
        $pid = $_GET['editpid'];
    }


?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
                <?php 


                     if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
                        $title = mysqli_real_escape_string($db->link, $_POST['title']);
                        $body = mysqli_real_escape_string($db->link, $_POST['body']);
                        $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
                        $author = mysqli_real_escape_string($db->link, $_POST['author']);
                        $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

                        $permited  = array('jpg', 'jpeg', 'png', 'gif', 'jfif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;

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
       cat = '$cat',
       title = '$title',
       body = '$body',
       image = '$uploaded_image',
       author = '$author',
       tags = '$tags',
       userid =' $userid'
       where id='$pid' ";

       $updated_row = $db->update($query);

       
       if ($updated_row) {
        echo "<span class='success'>Post updated Successfully.
        </span>";
       }else {
        echo "<span class='error'>Post Not updated !</span>";
       }
         }   
         
        }else{
            $query = "update post
            set 
            cat = '$cat',
            title = '$title',
            body = '$body',
          
            author = '$author',
            tags = '$tags',
           userid =' $userid'
            where id='$pid' ";
     
            $updated_row = $db->update($query);
     
            
            if ($updated_row) {
             echo "<span class='success'>Post updated Successfully.
             </span>";
            }else {
             echo "<span class='error'>Post Not updated !</span>";
            }
        }
    }
}
?>
                <div class="block">  
                    <?php 
                    $query = "select * from post where id = '$pid'";
                    $getpost = $db->select($query);
                    if($getpost){
                    while($presult = $getpost->fetch_assoc())
                    {
                    ?>             
                 <form action="editpost.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $presult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option 
                                    value="<?php echo $result['id']; ?>"></option>
                                    <?php 
                                    $query = "select * from category";
                                    $cat = $db->select($query);
                                    if($cat)
                                    {
                                        while($result = $cat->fetch_assoc())
                                        {

                                        
                                    
                                    ?>
                                    <option <?php 
                                        if($presult['cat'] == $result['id'])
                                        { ?>
                                        selected = "selected"
                                        <?php }
                                    ?>value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                 <?php } } ?>                   
                                </select>
                            </td>
                        </tr>
                   
                    
                     <!--   <tr>
                            <td>
                                <label>Date Picker</label>
                            </td>
                            <td>
                                <input type="text" id="date-picker" />
                            </td>
                        </tr>-->
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src = "<?php echo $presult['image']; ?>" height = "80px" width = "200px" /><br/>
                                <input type="file" name= "image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name= "body" >
                                <?php echo $presult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $presult['tags']; ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $presult['author']; ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get('userid');?>" class="medium" />
                            </td>
                        </tr>
                     
                     
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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

    