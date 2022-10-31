<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/add.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
				<?php
				if(isset($_GET['deluser']))
				{
					$deluser = $_GET['deluser'];
					$dquery = "delete from user where id ='$deluser' ";
					$deldata = $db->delete($dquery);
					if($deldata)
					{
						echo "<span class='success'>User deleted successfully..</span>"; 
					}
					else
					{
						echo "<span class='error'>User not deleted..</span>";   
					}
				}
				
				 ?>

                <div class="block">  

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Username</th>
                            <th>Email</th>
                            <th>Details</th>
                            <th>role</th>
                            <th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php 
					$query = "select * from user order by id desc";
					$users = $db->select($query);
					if($users)
					{
						$i = 0;
						while($result = $users->fetch_assoc())
						{
							$i++;
					

					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['username']; ?></td>
                            <td><?php echo $result['email']; ?></td>
                            <td><?php echo $fm->textshorten($result['details'], 30); ?></td>
                            <td><?php 
                            if($result['role']=='0')
                            {
                                echo "Admin";
                            }elseif($result['role']=='1')
                            {
                                echo "Author";
                            }
                            elseif($result['role']=='2')
                            {
                                echo "Editor";
                            }
                             
                            ?></td>

							<td><a href="viewuser.php?userid=<?php echo $result['id']; ?>">View</a> 
							<?php 
                if(Session::get('role')=='0')
                {?>
						|| 	<a onclick = "return confirm('Are you sure to delete?');" href="?deluser=<?php echo $result['id']; ?>">Delete</a>
						<?php } ?></td>
						</tr>
					<?php } } ?>	
					</tbody>
				</table>
               </div>
            </div>
        </div>
        
   
        <?php include 'inc/footer.php'; ?>
