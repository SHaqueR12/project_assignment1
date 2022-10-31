<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/add.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
						<th width = "5%">No</th>
							<th width = "15%">Post Title</th>
							<th width = "20%">Description</th>
							<th width = "10%">Category</th>
							<th width = "10%">Image</th>
							<th width = "10%">Author</th>
							<th width = "10%">Tags</th>
							<th width = "10%">Date</th>
							<th width = "10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$query = "select post.*,category.name from post
							inner join category On post.cat = category.id
							order by post.title desc";
							
							$post = $db->select($query);

							if($post)
							{
								$i = 0;
								while($result = $post->fetch_assoc()){
										$i++;
								
							
						?>
						<tr class="odd gradeX">
							<td><?Php echo $i;?></td>
							<td><?Php echo $result['title'];?></a></td>
							<td><?Php echo $fm->textshorten($result['body'], 50);?></td>
							<td><?php echo $result['name']; ?></td>
							<td><img src = "<?Php echo $result['image'];?>" height = "40px" width = "60px"/></td>
							<td><?Php echo $result['author'];?></td>
							<td><?Php echo $result['tags'];?></td>
							<td><?Php echo $fm->formatdate($result['date']);?></td>
							
							<td>
							<a href="viewpost.php?viewpid=<?php echo $result['id'];?>">View</a>  
							<?php 
								if(Session::get('userid')== $result['userid']
								|| Session::get('role') == '0')
								{ ?> ||

<a href="editpost.php?editpid=<?php echo $result['id'];?>">Edit</a>
							 ||
							
							 <a onclick= "return confirm('Are you sure to delete?');" href="deletepost.php?delpid=<?php echo $result['id'];?>">Delete</a>
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