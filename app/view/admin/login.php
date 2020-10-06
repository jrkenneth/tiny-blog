<?php require getViewPath() . '/admin/include/header.php'; ?>

<body class="text-center">

  <div class="row">
    <div class="col-md-5 mx-auto p-5">
      <form id="login_form">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="email" class="sr-only">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>

        <br>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

        <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
      </form>

      <a href="<?= URL_ROOT; ?>/admin/signup">Signup</a>
    </div>
  </div>


  <?php require getViewPath() . '/admin/include/footer.php'; ?>

  <script src="<?= URL_ROOT ?>/public/js/login.js"></script>