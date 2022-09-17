<?php $v->layout('_theme') ?>
<main>
    <!-- ================ contact section start ================= -->
    <div class="ajax_load" style="z-index: 999;">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <p class="ajax_load_box_title">Aguarde, carregando...</p>
        </div>
    </div>

    
    <section class="contact-section d-flex justify-content-center align-items-center">

        <div class="container ">

            <div class="row d-flex justify-content-center align-items-center">


                <div class="col-12">
                    <div class="ajax_response"><?= flash(); ?></div>
                    <h2 class="contact-title text-center">Fale Conosco</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="<?= url("/contato/enviar") ?>" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control input_form" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Assunto'" placeholder="Assunto">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100 input_form" name="content" id="message" cols="50" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Menssagem'" placeholder=" Mensagem"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <div class="form-group">
                                    <input class="form-control valid input_form" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Seu nome'" placeholder="Insira seu nome">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <div class="form-group">
                                    <input class="form-control valid input_form" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Seu email'" placeholder="Insira seu e-mail">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Enviar mensagem</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
</main>