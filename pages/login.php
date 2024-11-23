<script src="../scripts/form_validation.js"></script>

<div class="container my-5">
  <h1 class="my-5 text-center text-uppercase fw-bold text-main-pink">Log In</h1>

  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="bg-white rounded">

        <form action="../server/login_processing.php" method="post" class="p-5 mb-5" id="login_form">
          
          <!-- Display error message if login failed -->
          <?php if (isset($_SESSION['login_error'])): ?>
            <div class="alert alert-danger">
              <?php 
                echo $_SESSION['login_error'];
                unset($_SESSION['login_error']); // Clear the error message after displaying it
              ?>
            </div>
          <?php endif; ?>
          
          <div class="mb-3">
            <label for="email" class="form-label">Username</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                   value="<?php echo htmlspecialchars($_SESSION['submitted_email'] ?? ''); ?>" required>
            <span id="email-error" class="text-danger" style="display: none; font-size: 0.9em;">Please enter a valid email!</span>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
          </div>

          <button type="submit" class="mt-2 btn btn-primary">Log In</button>

          <p class="mt-4">Haven't got an account?
            <a href="?page=signup" class="text-main-pink fw-bold">Sign up</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</div>
