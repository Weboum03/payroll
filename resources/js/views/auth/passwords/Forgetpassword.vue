<template>
    <div class="container1 d-flex">
        <div class="container d-flex flex-column justify-content-center align-items-center" style="background-color: #D9D9D9;gap: 7rem;height: 100vh;">

        <div class="content">
            <h1 class="Unic"></h1>
            <h2 class="Aven"></h2>
        </div>
        <div class="image"></div>
        </div>

        <div class="container d-flex flex-column justify-content-center align-items-start"
        style="gap: 1rem;padding: 0px 117px;">

            <div class="Welcome gy-20">
                <h1 class="hadding1">Welcome to Uaven</h1>
                <h6 class="hadding2">Aenean feugiat tempus nunc, a comodo tortor feugiat</h6>
                <h6 class="hadding3"> quis. Duis finis sodlar aliquam</h6>
            </div>

            <span class="singnIn">Find your account</span>

            <div class="flex-column" id="emailFields" style="gap: 1.5rem;">
                <div class="row">
                    <div class="col input-group-fname">
                        <input placeholder="Email*" required type="email" autocomplete="off" class="input"
                            id="Email">
                        <label class="user-label">Email*</label>
                    </div>

                </div>
                <div class="d-flex justify-content-end">
                    <router-link style="font-size: 16px;font-weight: 500;line-height: 24px;font-family:Poppins,sans-serif; color: #03A9F3;" :to="{name: 'auth.login'}">Log In?</router-link>
                </div>
            </div>

            <div class="flex-column" id="passwordFields" style="gap: 1.5rem; display: none;">
                <div class="row">
                    <div class="col input-group-fname">
                        <input placeholder="New Password*" required type="password" autocomplete="off" class="input"
                            id="newPassword">
                        <label class="user-label"> New Password*</label>
                        <i class="fas fa-eye" id="togglePassword2"
                            style="color: #848484;position:relative;top: -32px;left: 363px;"></i>
                    </div>
                    <div class="col input-group-fname">
                        <input placeholder="Conform Password*" required="" type="password" autocomplete="off"
                            class="input" id="confirmPassword">
                        <label class="user-label">Conform Password*</label>
                        <i class="fas fa-eye" id="togglePassword3"
                            style="color:#848484;position:relative;top: -32px; left: 363px;"></i>
                    </div>
                    <div class="col input-group-fname">
                        <input placeholder="OTP*" required type="text" autocomplete="off" class="input"
                            id="confirmPassword">
                        <label class="user-label">OTP*</label>
                    </div>

                </div>
                <a href="/login" class="btn btn-primary savenext" data-toggle="modal" data-target="#SuccessBackdrop"
                    style=" margin-top: 20px;">Submit</a>
            </div>

            <a href="" class="btn btn-primary go" data-toggle="modal" data-target="#ForgetBackdrop">Go</a>
        </div>







    </div>
</template>

<style scoped>
@import '@/assets/css/Forgetpassword.css';

.signup {
    font-size: small !important;
    width: 403px;
    padding: 10px !important;
    display: block;
    text-decoration: none;
    text-align: center;
    outline: none;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: 0.3s;
    border-color: rgb(193, 188, 188) !important;
    background-color: #278d27e6 !important;
}
</style>