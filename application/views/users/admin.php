

<h4 class="center-align"><?= $title ?></h4><br>
<table class="white hoverable centered z-depth-5">
<thead>
    <tr> 
        <td colspan="2"><h5 class="center-align">Manage Users</h5></td>
    </tr>
</thead>
<tbody>
<!-- loop through the categories array and get each category  -->
<?php foreach($users as $user): ?>
<tr>
	<!-- column with shows category names -->
    <td><h6><?php echo ucfirst($user['pencil_db_users_name']); ?></h6></td>

	<!-- if a creater of any category is logged in, show another column with delete button to delete the category -->
	<form action="<?php echo base_url(); ?>users/delete/<?php echo $user['pencil_db_users_id'] ?>" method="POST">
        <td><button type="submit" class="btn red waves-effect waves-light"><i class="fas fa-trash"></i></button></td>
    </form>
</tr>
<?php endforeach; ?>
<!-- loop ends -->
</tbody>
</table>

