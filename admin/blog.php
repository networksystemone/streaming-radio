<?php include 'includes/header.php'; ?>
<?php

$db = new Database();

$query = "SELECT posts.*, categories.name FROM posts
		  INNER JOIN categories
		  ON posts.category = categories.id
		  ORDER BY posts.title DESC";
$posts = $db->select($query);


$query = "SELECT * FROM categories
		  ORDER BY name DESC";
$categories = $db->select($query);

?>
<table class="table table-striped">
	<tr>
		<th>Post ID#</th>
		<th>Post Title</th>
		<th>Category</th>
		<th>Author</th>
		<th>Date</th>
	</tr>
	
	<?php 

	if($posts) :
	 while($row = $posts->fetch_assoc()) : ?>
	<tr>
		<td><?php echo $row['id']; ?></td>
		<td><a href="edit_post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></td>
		<td><?php echo $row['name']; ?></td>
		<td><?php echo $row['author']; ?></td>
		<td><?php echo formatDate($row['date']); ?></td>
	</tr>
	<?php endwhile;?>
	<?php else: ?>
	<p>There are no posts yet</p>
<?php endif; ?>
</table>


<table class="table table-striped">
	<tr>
		<th>Category ID#</th>
		<th>Category Name</th>
	</tr>
	
	<?php 
	if($categories) :
	while($row = $categories->fetch_assoc()) : ?>
	<tr>
		<td><?php echo $row['id']; ?></td>
		<td><a href="edit_category.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></td>
	</tr>
	<?php endwhile; ?>
	<?php else: ?>
	<p>There are no categories yet</p>
<?php endif; ?>
</table>
		
<?php include 'includes/footer.php'; ?>