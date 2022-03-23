<div class="card" style="border-radius: 15px;">
  <div class="card-body p-5">
    <h2 class="text-uppercase text-center mb-5">Registracija korisnika</h2>
    <form action="register.php" method="post">
      <div class="form-outline mb-4">
        <label class="form-label" for="firstNameInput">Ime</label>
        <input type="text" id="firstNameInput" name="first_name" class="form-control form-control-lg" required>
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="lastNameInput">Prezime</label>
        <input type="text" id="lastNameInput" name="last_name" class="form-control form-control-lg" required>
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="emailInput">Email</label>
        <input type="email" id="emailInput" name="email" class="form-control form-control-lg" required>
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="passwordInput">Lozinka</label>
        <input type="password" id="passwordInput" name="password" class="form-control form-control-lg" required>
      </div>

      <div class="form-outline mb-4">
        <label class="form-label" for="passwordConfirmInput">Ponovi lozinku</label>
        <input type="password" id="passwordConfirmInput" name="password_confirm" class="form-control form-control-lg" required>
      </div>

      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success btn-block btn-lg">Registriraj se</button>
      </div>
    </form>
  </div>
</div>
</div>
<div class="col col-md-3"></div>
</div>