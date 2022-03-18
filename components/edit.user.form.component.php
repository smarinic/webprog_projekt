<div class="card" style="border-radius: 15px;">
  <div class="card-body p-5">
    <h2 class="text-uppercase text-center mb-5">Promjena podataka</h2>
    <form action="profile.php" method="post">
      <div class="form-outline mb-4">
        <label class="form-label" for="firstNameInput">Ime</label>
        <input type="text" id="firstNameInput" name="first_name" class="form-control form-control-lg" value='<?= $_SESSION['first_name'] ?>' required>
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="lastNameInput">Prezime</label>
        <input type="text" id="lastNameInput" name="last_name" class="form-control form-control-lg" value='<?= $_SESSION['last_name'] ?>' required>
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="form3Example3cg">Email</label>
        <input type="email" id="emailInput" name="email" class="form-control form-control-lg" value='<?= $_SESSION['email'] ?>' required>
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="form3Example4cg">Lozinka</label>
        <input type="password" id="passwordInput" name="password" class="form-control form-control-lg" required>
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="form3Example4cg">Ponovi lozinku</label>
        <input type="password" id="passwordConfirmInput" name="password_confirm" class="form-control form-control-lg" required>
      </div>

      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success btn-block btn-lg">Spremi promjene</button>
        <a class="btn btn-secondary btn-block btn-lg ms-4" role=button href="index.php">Povratak</a>
      </div>
    </form>
  </div>
</div>
</div>
<div class="col col-md-3"></div>
</div>