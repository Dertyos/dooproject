<?php
require "views/shared/header.php"
?>

<div class="container">
  <?php
  if (isset($_SESSION['documentNumber'])) {
    echo "<p>Welcome to the system " . $_SESSION['documentNumber'] . "</p>";
  } else {
    echo "<p>You do not have access.</p>";
  }
  ?>
  <a href="views/devs/index.php">Devs</a>
  <a href="views/"></a>
</div>

<?php
require "views/shared/footer.php"
?>