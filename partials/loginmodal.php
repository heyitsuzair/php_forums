<!-- Modal -->
<div class="modal fade" id="loginmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Login To Fellow Coders</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="partials/login.php" method="post">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="loginemail" name="loginemail"
                            placeholder="name@example.com">
                        <label for="floatingInput">Email Address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="loginPassword" name="loginpass"
                            placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="btn btn btn-primary my-3">Login</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>