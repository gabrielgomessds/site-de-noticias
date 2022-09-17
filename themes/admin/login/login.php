<?php $v->layout("_login");?>
    <div id="auth">

        <div class="row h-100 d-flex justify-content-center align-items-center">
            <div class="col-lg-5 col-12">
                
                    <a href="<?=url("/")?>"><img src="<?=theme("/assets/images/logo/logo.png", CONF_VIEW_ADMIN)?>" class="mb-4" width="160px" height="70px" alt="Logo"></a>
                    <h1 class="auth-title color_red_default">Login.</h1>
                    <div class="ajax_response"><?= flash(); ?></div>
                    <p class="auth-subtitle mb-5">Não reconhece essa tela?
                        <a href="<?=url("/");?>" class="color_red_default">Volte para o Site</a></p>
                        
                    <form action="<?=url("/admin/login");?>" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" required placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" required placeholder="Senha">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                      
                        <button class="btn btn-danger btn-block btn-lg shadow-lg mt-5">Login</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p><a class="font-bold color_red_default red_color" href="auth-forgot-password.html">Recuperar senha</a></p>
                    </div>
                </div>
                 </div>

    </div>

