<?php include 'includes/header.php'; ?>
<?php
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$id = strip_tags($id);
    $id = mysql_real_escape_string($id);
    $id = htmlspecialchars($id);

	$db= new Database();
	
	// get one post
	$query = "SELECT * FROM posts WHERE id = ".$id;
	$post = $db->select($query);
	if($post) {
		$post = $db->select($query)->fetch_assoc();
		// get categories
		$query = "SELECT * FROM categories";
		$categories = $db->select($query);
	}
	else {
		$post =false;
		$categories = false;
	}
	
}
?>
	<div class="blog-post">
		<h2 class="blog-post-title">
		<?php 
		if($post) :
		echo $post['title'];?>
		</h2>
        <p class="blog-post-meta">
        <?php echo formatDate($post['date']); ?> by <a href="#">
        <?php echo $post['author']; ?></a></p>
        <?php echo $post['body']; ?>
        <?php else: ?>
		<p>There are no posts </p>
	<?php endif;?>
	</div>
	
<?php include 'includes/footer.php'; ?>