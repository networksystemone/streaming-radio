            </div>
            <div class="col-md-12 column">
				<h1>Categories</h1>
				<?php if($categories) : ?>
					<ol class="list-unstyled">
						<?php while($row = $categories->fetch_assoc()) : ?>
							<li><a href="posts.php?category=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
						<?php endwhile; ?>
					</ol>
				<?php else: ?>
					<p>There are no categories yet</p>
				<?php endif; ?>
          </div>
        </div>

      </div>
      
      <p>
        <a href="#">Back to top</a>
      </p>
  </div>
  </body>
</html>