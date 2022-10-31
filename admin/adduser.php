<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
                if(!Session::get('role')=='0')
                {
                    echo "<script>window.location = 'index.php';</script>";}
                    ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New user</h2>
               <div class="block copyblock">
        <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$username = $fm->validation($_POST['username']);
            $password = $fm->validation(md5(($_POST['password'])));
            $email = $fm->validation($_POST['email']);
            $role = $fm->validation($_POST['role']);
           
			$username = mysqli_real_escape_string($db->link, $username);
            $password = mysqli_real_escape_string($db->link, $password);
            $email = mysqli_real_escape_string($db->link, $email);
            $role = mysqli_real_escape_string($db->link, $role);

			if(empty($username) ||empty($password) || empty($role) ||empty($email))
            {
              echo "<span class='error'>Field must not be empty..</span>";  
            }else
            {
            $mquery = "select * from user where email='$email' limit 1";
            $mailcheck = $db->select($mquery);
            if( $mailcheck!=false)
            {
                echo "<span class='error'>Mail already exists..</span>";
            }
					
            else
            {
                $query = "insert into user(username, password,  email, role) values('$username', '$password', '$email', '$role') ";
                $userinsert = $db->insert($query);
                if($userinsert)
                {
                    echo "<span class='success'>User inserted successfully..</span>"; 
                }
                else
                {
                    echo "<span class='error'>User not inserted successfully..</span>";   
                }
            }
        }
        }
        ?>         
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Username </label>
                            </td>
                            <td>
                                <input type="text" name = "username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password </label>
                            </td>
                            <td>
                                <input type="text" name = "password" placeholder="Enter password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name = "email" placeholder="Enter email address..." class="medium" />
                            </td>
                        </tr>
                      
                        <tr>
                            <td>
                                <label>Role</label>
                            </td>
                            <td>
                               <select id="select" name="role">
                                <option>
                                    Select User role
                                </option>
                                <option value="0">
                                    Admin
                                </option>
                                <option value="1">
                                    Author
                                </option>
                                <option value="2">
                                    Editor
                                </option>
                               </select>
                            </td>
                        </tr>
						<tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Done" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'inc/footer.php'; ?>
