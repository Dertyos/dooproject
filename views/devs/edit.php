<?php require "views/shared/header.php" ?>

  <div class="container">
    <h1 class="text-center my-5"><?= $data['title'] ?></h1>
    <form action="index.php?controller=developer&action=update" method="post">
      <input type="hidden" name="id" value="<?= $data['id'] ?>">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="name"  >
        <label for="name">Name</label>
      </div>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="name@mail.com" >
        <label for="email">email</label>
      </div>
      <div class="form-floating mb-3">
        <input type="phone" class="form-control" id="phone" name="phone" placeholder="3123456789" >
        <label for="phone">Phone Number</label>
      </div>
      <div class="form-floating mb-3">
        <select class="form-select" id="rol" name="rol" aria-label="Floating label select example">
          <option value="Developer">Developer</option>
          <option value="ProductOwner">ProductOwner</option>
          <option value="ScrumMaster">ScrumMaster</option>
        </select>
        <label for="floatingSelect">Choose your Rol</label>
      </div>
      <div class="form-floating mb-3">
        <select class="form-select" id="scrumTeamId" name="scrumTeamId" aria-label="Floating label select example">
            <?php foreach($data['scrumTeams'] as $item) { ?>
                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
            <?php } ?>
        </select>
        <label for="floatingSelect">Assign your Scrum Team</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="documentNumber" placeholder="0123456789" maxlength="10" >
        <label for="documentNumber">Document Number</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password" >
        <label for="password">Password</label>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
  
<?php require "views/shared/footer.php" ?>