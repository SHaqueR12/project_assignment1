<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style>
    .leftside{
        float: left;
        width: 70%;
    }
    .rightside{
        float: left;
        width: 20%;
    }
    .rightside img{
        height:100px;
        width:100px;
    }
</style>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
    $title = $fm->validation($_POST['title']);
    $slogan = $fm->validation($_POST['slogan']);//line 22

   $title = mysqli_real_escape_string($db->link,$title);
   $slogan = mysqli_real_escape_string($db->link, $slogan);
   
   $permited  = array('jpg', 'jpeg', 'png', 'gif', 'jfif');

$file_name = $_FILES['logo']['name'];
$file_size = $_FILES['logo']['size'];
$file_temp = $_FILES['logo']['tmp_name'];

$div = explode('.', $file_name);
$file_ext = strtolower(end($div));
$same_image = 'logo'.'.'.$file_ext;
$uploaded_image = "upload/".$same_image;

if($title == "" || $slogan == "" )
{
echo "<span class='error'>Field must not be empty..</span>";  
}
else{
if(!empty($file_size))
{
if ($file_size >1048567) {
echo "<span class='error'>logo Size should be less then 1MB!</span>";
} 
elseif (in_array($file_ext, $permited) === false) {
echo "<span class='error'>You can upload only:-"
.implode(', ', $permited)."</span>";
} 
else{     
move_uploaded_file($file_temp, $uploaded_image);
$query = "update title_slogan
set 

title = '$title',
slogan = '$slogan',
logo  = '$uploaded_image'
where id = '1' ";

$updated_row = $db->update($query);


if ($updated_row) {
echo "<span class='success'>Data updated Successfully.
</span>";
}else {
echo "<span class='error'>Data Not updated !</span>";
}
}   

}else{
$query = "update post
set 
title = '$title',
slogan = '$slogan'
where id = '1' ";

$updated_row = $db->update($query);


if ($updated_row) {
echo "<span class='success'>Data updated Successfully.
</span>";
}else {
echo "<span class='error'>Data Not updated !</span>";
}
}
}
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <?php 
                    $query = "select * from title_slogan where id = '1' ";
                    $title_blog = $db->select($query);
                    if($title_blog)
                    {
                        while($result= $title_blog->fetch_assoc())
                        {
                    
                    ?> 
                <div class="block sloginblock"> 
                   
                    <div class =  "leftside">
                 <form action = "" method = "post" enctype = "multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value = "<?php echo $result['title']; ?> " name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value = "<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo"  />
                            </td>
                        </tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    </div> 
                   
                    <div class = "rightside"><img src = "<?php echo $result['logo']; ?>" alt="logo"/></div>            
                </div>
                <?php }} ?>
            </div>
        </div>
        <?php include 'inc/footer.php'; ?>


