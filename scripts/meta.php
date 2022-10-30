<?php
	if(isset($_GET['pageid']))
	{

					$ptid = $_GET['pageid'];
	
                    $query = "select * from page where id = '$ptid '";
                    $page_blog = $db->select($query);
                    if($page_blog )
                    {
                        while($result= $page_blog ->fetch_assoc())
                        {
							?>
				<title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title>			
							
		<?php }	} }
	elseif(isset($_GET['id']))
	{
						
					$postid = $_GET['id'];
							
					$query = "select * from post where id = '$postid '";
					$post_blog = $db->select($query);
					if($post_blog )
						{
							while($result= $post_blog ->fetch_assoc())
								{
									?>
					<title><?php echo $result['title']; ?>-<?php echo TITLE; ?></title>			
								<?php }	} }
	else
							{?>
							
								<title><?php echo $fm->title(); ?>-<?php echo TITLE; ?></title>
								<?php } ?>
	
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php if(isset($_GET['id']))
	{
		$key = $_GET['id'];
		$query = "select * from post where id = '$key '";
					$keywords = $db->select($query);
					if($keywords)
					{
						while($result= $keywords ->fetch_assoc())
						{ ?>
						<meta name="keywords" content="<?php echo $result['tags']; ?>">
<?php } 
						}
					}
					else
					{
?>
<meta name="keywords" content="<?php echo KEYWORDS; ?>">
				<?php	}
	?>

	<meta name="author" content="Sanjida">