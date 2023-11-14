<?php include_once "views/shared/loginHeader.php" ?>

<h1 class="text-center"><?= $data['title'] ?></h1>


<div class="container text-center">
    <?php
        if(isset($data['error'])) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo $data['error'];
            echo "</div>";
        }
    ?>
    <div class="form-signin">
        <form action="index.php?controller=developer&action=login" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="documentNumber" placeholder="0123456789" maxlength="10" >
                <label for="documentNumber">Document Number</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" >
                <label for="password">Password</label>
            </div>
            <button type="submit" class="btn btn-primary">LogIn</button>
        </form>
        <a href="index.php?controller=developer&action=insert" class="btn btn-secondary">Register</a>
    </div>
</div>

<?php include_once "views/shared/footer.php" ?>