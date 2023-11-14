<?php include_once "views/shared/loginHeader.php" ?>

<h1 class="text-center"><?= $data['title'] ?></h1>

<div class="container text-center">
    <div class="form-signin">
        <form action="index.php?controller=user&action=register" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" placeholder="Name" >
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="documentNumber" placeholder="0123456789" maxlength="10" >
                <label for="documentNumber">Document Number</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" placeholder="name@gmail.com" >
                <label for="email">Email Address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" >
                <label for="password">Password</label>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>

<?php include_once "views/shared/footer.php" ?>