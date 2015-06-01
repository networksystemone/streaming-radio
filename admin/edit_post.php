<?php include 'includes/header.php'; ?>
<?php
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$id = strip_tags($id);
    $id = mysql_real_escape_string($id);
    $id = htmlspecialchars($id);
	
	$db = new Database();
	
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

<?php if(isset($_POST['submit'])){
		//assign vars
		$title = mysqli_real_escape_string($db->link, $_POST['title']);
		$body = mysqli_real_escape_string($db->link, $_POST['body']);
		$category = mysqli_real_escape_string($db->link, $_POST['category']);
		$author = mysqli_real_escape_string($db->link, $_POST['author']);
		$tags = mysqli_real_escape_string($db->link, $_POST['tags']);
		//simple validation
		if($title == '' || $body == '' || $category == '' || $author == '' || $tags == ''){
			//set error
			$error = 'Please fill out all required fields.';
		} else {
			$query = "UPDATE posts SET
					  title = '$title',
					  body = '$body',
					  category = '$category',
					  author = '$author',
					  tags = '$tags'
					  WHERE id =".$id;
			$update_row = $db->update($query);
		}
	}
?>

<!-- delete post -->
<?php if(isset($_POST['delete'])){
	$query = "DELETE FROM posts WHERE id = ".$id;
	
	$delete_row = $db->delete($query);	
}?>

<form role="form" method="post" action="edit_post.php?id=<?php echo $id; ?>">

	<div class="form-group">
		<label>Post Title</label>
		<input name="title" type="text" class="form-control" placeholder="Enter Title" value="<?php echo $post['title']; ?>">
	</div>
	
	<div class="form-group">
		<label>Post Body</label>
	   <noscript>
	      <p>
	         <strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript support, like yours, you should still see the contents (HTML data) and you should be able to edit it normally, without a rich editor interface.
	      </p>
	   </noscript>

	   <textarea cols="40" class="ckeditor" id="editeur" name="body" rows="10">
	   	<?php echo $post['body']; ?>
	   </textarea>
	</div>
	
	<div class="form-group">
		<label>Category</label>
		<select name="category" class="form-control">
			<?php while($row = $categories->fetch_assoc()) : ?>
			<?php if($row['id'] == $post['category']) {
				$selected = 'selected';
			} else {
				$selected = '';
			}?>
			<option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['name']?></option>
			<?php endwhile; ?>
		</select>
	</div>
	
	<div class="form-group">
		<label>Author</label>
		<input name="author" type="text" class="form-control" placeholder="Enter Author Name" value="<?php echo $post['author']; ?>">
	</div>
	
	<div class="form-group">
		<label>Tags</label>
		<input name="tags" type="text" class="form-control" placeholder="Enter Tags" value="<?php echo $post['tags']; ?>">
	</div>
	
	<div>
	<input name="submit" type="submit" class="btn btn-default" value="Submit" />
	<a href="index.php" class="btn btn-default">Cancel</a>
	<input name="delete" type="submit" class="btn btn-danger" value="Delete" />
	</div>
	<br>
</form>

<?php include 'includes/footer.php'; ?>