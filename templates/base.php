<?php
  $styles = $styles ?? [];
  $scripts = $scripts ?? [];
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="/public/css/styles.css" />
  <?php foreach ($styles as $style): ?>
    <link rel="stylesheet" href="<?php echo $style; ?>" />
  <?php endforeach; ?>

  <?php foreach ($scripts as $script): ?>
    <script src="<?php echo $script; ?>" defer></script>
  <?php endforeach; ?>

  <title><?php echo $title ?? 'Home'; ?> • pdiao</title>
</head>
<body>
  <script>NekoType="spooky"</script>
  <h1 id="nl">
    <script src="https://webneko.net/n20171213.js"></script>
    <a href="https://webneko.net">Neko</a>
  </h1>

  <div class="wrap">
    <main>
      <?php echo $content; ?>
    </main>

    <aside>
      <div class="title-wrapper">
        <div class="title">
          <div class="title-part-zero">&nbsp;</div>
          <div class="title-part-one">p</div>
          <div class="title-part-two">diao</div>
        </div>
      </div>

      <nav>
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/about-me">About</a></li>
        </ul>
      </nav>
    </aside>
  </div>
</body>
</html>
