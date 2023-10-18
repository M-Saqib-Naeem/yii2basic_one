<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <h3>Saqib, you can update your profile here</h3>
            <h1>Edit Profile</h1>
        </div>


        <?= $this->render( '_update-profile-form', [
            'user' => $user
        ] ) ?>
    </div>
</div>