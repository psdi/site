<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="public/css/styles.css" />

  <title><?php echo $title ?? 'Home'; ?> • pdiao</title>
</head>
<body>
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
          <li><a href="/home">Home</a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/about-me">About</a></li>
        </ul>
      </nav>
    </aside>
  </div>
</body>
</html>
