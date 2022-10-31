<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if(!isset($_GET['viewpid']) || $_GET['viewpid'] == null)
    {
        echo "<script>window.location = 'postlist.php';</script>";//using js
        
        
    }
    else{
        $pid = $_GET['viewpid'];
    }


?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
                <?php 

                     if($_SERVER['REQUEST_METHOD'] == 'POST'){
                       
}
?>
                <div class="block">  
                    <?php 
                    $query = "select * from post where id = '$pid' order by id desc";
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
                                <input type="text" readonly value="<?php echo $presult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select">
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
                                <label>Image</label>
                            </td>
                            <td>
                                <img src = "<?php echo $presult['image']; ?>" height = "80px" width = "200px" /><br/>
                                
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
                                <input type="text" readonly value="<?php echo $presult['tags']; ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $presult['author']; ?>" class="medium" />
                                
                            </td>
                        </tr>
                     
                     
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
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

    