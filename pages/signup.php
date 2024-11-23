<script src="../scripts/form_validation.js"></script>

<div class="container my-5">
  <h1 class="my-5 text-center text-uppercase fw-bold text-main-pink">Sign Up</h1>

  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="bg-white rounded">
        <form action="../server/signup_processing.php" method="post" class="p-5 mb-5" id="signup_form">

          <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
          </div>

          <div class="mb-3">
            <p>Gender</p>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="radioMale">
              <label class="form-check-label" for="radioMale" value="M">
                Male
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="radioFemale" value="F" checked>
              <label class="form-check-label" for="radioFemale">
                Female
              </label>
            </div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            <div id="password-error" class="text-danger mt-3" style="display: none; font-size: 0.9em;">
              Password must meet the criteria below:
            </div>
          </div>

          <div class="mb-3">
            <label for="userRole" class="form-label">User Role</label>
            <select class="form-select" id="userRole" name="userRole" required>
              <option value="" disabled selected>Select your role</option>
              <option value="Admin">Admin</option>
              <option value="Seller">Seller</option>
              <option value="Customer">Customer</option>
            </select>
          </div>

          <div class="mb-3">
            <p>Address</p>
            <div class="mb-2">
              <label for="province" class="text-main-pink">Province</label>
              <select id="province" name="province" class="form-select" required>
                <option value="">Select a province</option>
              </select>
            </div>

            <div class="mb-2">
              <label for="district" class="text-main-pink">District</label>
              <select id="district" name="district" class="form-select" disabled required>
                <option value="">Select a district</option>
              </select>
            </div>

            <div class="mb-2">
              <label for="commune" class="text-main-pink">Commune</label>
              <select id="commune" name="commune" class="form-select" disabled required>
                <option value="">Select a commune</option>
              </select>
            </div>

            <div class="mb-2">
              <label for="address" class="text-main-pink">Street address</label>
              <input type="text" class="form-control" id="address" name="streetAddress" placeholder="Enter your street address" required>
            </div>
          </div>


          <button type="submit" class="mt-2 btn btn-primary">Sign Up</button>

          <p class="mt-4">Already have an account?
            <a href="?page=login" class="text-main-pink fw-bold">Log in</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</div>