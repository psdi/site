<div class="blog-wrapper">
  <div class="posts-wrapper">
    <?php foreach ($posts as $post): ?>
      <div class="post">
        <h2>
          <a href="<?php echo $post['url']; ?>">
            <?php echo $post['title']; ?>
          </a>
        </h2>

        <div class="date"><?php echo date('d F Y', $post['date']); ?></div>

        <?php if (isset($isPreview) && $isPreview): ?>
          <div class="body"><?php echo $post['preview']; ?></div>

          <div class="post-link">
            <a href="<?php echo $post['url']; ?>">Read more...</a>
          </div>
        <?php else: ?>
          <div class="body"><?php echo $post['content']; ?></div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="pagination-wrapper">
    <div>
      <?php if (isset($pagination['prev']) && isset($page) && $pagination['prev']): ?>
        <a href="/blog/<?php echo $page - 1; ?>">← Previous</a>
      <?php endif; ?>
    </div>

    <div>
      <?php if (isset($pagination['next']) && isset($page) && $pagination['next']): ?>
        <a href="/blog/<?php echo $page + 1; ?>">Next →</a>
      <?php endif; ?>
    </div>
  </div>
</div>
