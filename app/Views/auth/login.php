<?php require_once __DIR__ . '/../header.php'; ?>
<!-- Main Content -->
<div class="container-fluid text-center bg-dark text-white p-5">
    <h1>Welcome</h1>
    <p>Please log in or sign up to continue</p>

    <!-- Buttons to Trigger Modals -->
    <button type="button" class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
        Login
    </button>
    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#signupModal">
        Sign Up
    </button>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/login">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary bg-dark w-100">Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="mb-0">Don't have an account?
                    <button type="button" class="btn btn-link p-0" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</button>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Sign Up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/register" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input  class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="signupEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="signupEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="signupPassword" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="signupPassword" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="signupConfirmPassword" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="signupConfirmPassword" name="confirm_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="profileImage" class="form-label">Profile Image:</label>
                        <input type="file" class="form-control" id="profileImage" name="avatar" accept="image/*">
                    </div>
                    <div id="passwordError" class="text-danger" style="display: none;">Passwords do not match.</div>
                    <button type="submit" class="btn btn-primary bg-dark w-100">Sign Up</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="mb-0">Already have an account?
                    <button type="button" class="btn btn-link p-0" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                </p>
            </div>
        </div>
    </div>
</div>
<script src="/js/login.js"></script>

<?php require_once __DIR__ . '/../footer.php'; ?>
