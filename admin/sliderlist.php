<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/add.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
						<th>No</th>
							<th>Slider Title</th>
							<th>Slider Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query = "select * from slider";
							
							$slider = $db->select($query);

							if($slider)
							{
								$i = 0;
								while($result = $slider->fetch_assoc()){
										$i++;
								
							
						?>
						<tr class="odd gradeX">
							<td><?Php echo $i;?></td>
							<td><?Php echo $result['title'];?></td>
							<td><img src = "<?Php echo $result['image'];?>" height = "40px"  width = "60px"/></td>
							
                            <td>
			 				<?php 
								if(Session::get('role') == '0')
								{ ?> 

<a href="editslider.php?sliderid=<?php echo $result['id'];?>">Edit</a>
							 ||
							
							 <a onclick= "return confirm('Are you sure to delete?');" href="delslider.php?sliderid=<?php echo $result['id'];?>">Delete</a>
						<?php }	?>
							
								
							</td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
		<?php include 'inc/footer.php'; ?>