<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

     <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Change Theme</h2>
               <div class="block copyblock">
        <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//$name = $fm->validation($_POST['theme']);
           
			$theme = mysqli_real_escape_string($db->link, $_POST['theme']);
        
                $query = "update theme set theme= '$theme' where id = '1' ";
                $updatecat = $db->update($query);
                if($updatecat)
                {
                    echo "<span class='success'>Theme updated successfully..</span>"; 
                }
                else
                {
                    echo "<span class='error'>Theme not updated..</span>";   
                }
            }
        
        ?>    
        <?php 
            $query = "select * from theme where id='1' order by 'id' desc";
            $themes = $db->select($query);
            while($result = $themes->fetch_assoc())
            { 

            
        ?>     
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                             <input <?php if($result['theme']=='default')
                             {
                                echo "checked";
                             }
                             
                             
                             ?> type="radio" name="theme" value="default"/>Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                             <input <?php if($result['theme']=='color')
                             {
                                echo "checked";
                             }
                             
                             
                             ?> type="radio" name="theme" value="color"/>Colorful
                            </td>
                        </tr>
                        <tr>
                            <td>
                             <input <?php if($result['theme']=='red')
                             {
                                echo "checked";
                             }
                             
                             
                             ?>  type="radio" name="theme" value="red"/>Red
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php include 'inc/footer.php'; ?>
