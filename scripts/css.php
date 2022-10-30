<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="font-awesome-4.5.0/css/own.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
  <?php 
            $query = "select * from theme where id='1' order by 'id' desc";
            $themes = $db->select($query);
            while($result = $themes->fetch_assoc())
            { 
              if($result['theme']=='default')
              { ?>
<link rel="stylesheet" href="theme/default.css">
 <?php } else if($result['theme']=='color') {?>
 <link rel="stylesheet" href="theme/color.css">
 <?php } else if($result['theme']=='red') {?>  
  <link rel="stylesheet" href="theme/red.css">

              <?php } } ?>  
            
        
            