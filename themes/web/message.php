<?php $v->layout('_theme') ?>
<main>
    <!-- ================ message section start ================= -->

    <section class="contact-section d-flex justify-content-center align-items-center">

        <div class="container ">

            <div class="row d-flex justify-content-center align-items-center">

            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                    <img src="<?=theme($message->image, CONF_VIEW_WEB)?>" width="400px" height="300px" alt="">
                    <p class="text-center h2 text-danger"><?=$message->message;?></p>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ message section end ================= -->
</main>