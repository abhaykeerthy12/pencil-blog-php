<h4 class="center-align"><?= $title ?></h4><br>
<table class="white hoverable centered z-depth-5">
<tbody>
<!-- loop through the categories array and get each category  -->
<?php foreach ($categories as  $category): ?>
<tr>
	<!-- column with shows category names -->
	<td><h6><a href="<?php echo site_url('/categories/posts/'.$category['pencil_db_categories_id']); ?>"><div style="height:100%;width:100%"><?php echo  ucfirst($category['pencil_db_categories_name']); ?></div></a></h6></td>

	<!-- if a creater of any category is logged in, show another column with delete button to delete the category -->
	<?php if($this->session->userdata('user_id') == $category['pencil_db_categories_user_id']): ?>
		<form action="categories/delete/<?php echo $category['pencil_db_categories_id'] ?>" method="POST">
			<td><input type="submit" class="btn deep-purple" value="delete"></td>
		</form>		
	<?php endif; ?>
</tr>
<?php endforeach; ?>
<!-- loop ends -->
</tbody>
</table>
