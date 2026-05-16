<?php if (isset($_GET['msg']) && $_GET['msg'] == 'logout') { ?>
    <div class="alert alert-success">
        Anda berhasil logout
    </div>
<?php } ?>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'error') { ?>
    <div class="alert alert-danger">
        Login gagal
    </div>
<?php } ?>

<h3>Form Login</h3>

<form method="POST" action="controller/memberController.php">

<div class="mb-3">
  <label>Username</label>
  <input type="text" name="username" class="form-control">
</div>

<div class="mb-3">
  <label>Password</label>
  <input type="password" name="password" class="form-control">
</div>

<button class="btn btn-primary">Login</button>

</form>