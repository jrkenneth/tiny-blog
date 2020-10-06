<?php require getViewPath() . '/admin/include/header.php'; ?>

<body class="text-center">

  <div class="row">
    <div class="col-md-5 mx-auto p-5">

      <nav class="nav">
        <a class="nav-link active" href="#">Add Post</a>
        <a class="nav-link" href="#">Manage Post</a>
        <a class="nav-link" href="<?= URL_ROOT; ?>/logout">Logout</a>
      </nav>

    </div>
  </div>

  <?php require getViewPath() . '/admin/include/footer.php'; ?>