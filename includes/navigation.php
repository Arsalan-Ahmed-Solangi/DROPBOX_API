 <nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom">
  <button class="btn btn-dark" id="menu-toggle"><i class="fa fa-bars"></i></button>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <li class="nav-item active">
        <a class="nav-link text-light"><i class="fa fa-user"></i>  <?php echo $_SESSION['user']['username'] ?? null?> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="process.php?logout=true"><i class="fa fa-power-off"></i>  Logout</a>
      </li>
    </ul>
  </div>
</nav>