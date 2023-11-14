<?php require "views/shared/header.php" ?>

  <div class="container">
    <h1 class="text-center my-5"><?= $data['title'] ?></h1>
    <form action="index.php?controller=developer&accion=update" method="post">
      <input type="hidden" name="id" value="<?= $data['id'] ?>">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $data['developer']['name'] ?>">
        <label for="name">Developer's name</label>
      </div>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="name@mail.com" value="<?= $data['developer']['email'] ?>">
        <label for="email">Developer's Email Address</label>
      </div>
      <div class="form-floating mb-3">
        <input type="number" class="form-control" id="phone" name="phone" placeholder="0" value="<?= $data['developer']['phone'] ?>">
        <label for="phone">Developer's Phone Number</label>
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
            <input type="number" class="form-control" id="documentNumber" name="documentNumber" placeholder="0" value="<?= $data['developer']['documentNumber'] ?>">
            <label for="documentNumber">Developer's Document Number</label>
        </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
  </div>
  
<?php require "views/shared/footer.php" ?>