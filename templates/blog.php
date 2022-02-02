<div class="posts-wrapper">
  <?php foreach ($posts as $post): ?>
    <div class="post">
      <h2>
        <a href="<?php echo $post['url']; ?>">
          <?php echo $post['title']; ?>
        </a>
      </h2>

      <div class="date"><?php echo date('d F Y', $post['date']); ?></div>

      <div class="body"><?php echo $post['content']; ?></div>
    </div>
  <?php endforeach; ?>
</div>
