<?php
// Require the shared header file
require "views/shared/header.php"
?>

<div class="container">
  <?php
  // If the session variable "documentNumber" is set, echo a welcome message with the user's documentNumber number
  if (isset($_SESSION['documentNumber'])) {
    echo "<p>Welcome to the system " . $_SESSION['documentNumber'] . "</p>";
  } else {
    echo "<p>You do not have access.<p/>";
  }
  ?>
</div>

<?php
// Require the shared footer file
require "views/shared/footer.php"
?>