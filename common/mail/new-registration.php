<div class="content" style="margin-left: 40px;">
        <h2 style="text-align: center;">New User Registration</h2>
        <div style="text-align: center">
                <p>Dear <?= $model->distributor_name ?>,</p>
                <p>Thankyou for registering with smartway.You can login into your account with your login details.</p>
                <p>Here is your login access details : </p>
                <p><b>Usename  : <?= $model->user_name ?></b></p>
                <p><b>Password : <?= $not_encrypted_password ?></b></p>
        </div>

</div>