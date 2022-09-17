<?php $v->layout('_theme')?>
    

    <section class="blog_area">

        <?php if($categoryNews):?> 
                <div class="heading-news mb-30 text-center">
                    <h3 style="background-color: <?=$categoryNews->color?>;color:white;padding:20px;"><?=$categoryNews->name?></h3>
                </div>
           <?php else:?>
            <div class="heading-news mb-30 text-center">
                    <h3 style="background-color: #2d4051;color:white;padding:20px;">A categoria "<?=$nameCategory;?>" não existe</h3>
                </div>
        <?php endif;?>

        <div class="heading-news mb-30 text-center mt-5">
            <!-- <h3 style="color:#1e3056;">Não encontramos resultados para "Noticias de Saúde"</h3> -->
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <!-- <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="<?=theme("/assets/img/img/search_result.png", CONF_VIEW_WEB)?>" alt="">
                                
                            </div>
                     </article>

                        <h1 class="text-center mb-3">Veja outras noticias:</h1> -->
                        <?php foreach($listNews as $news):?>
                            <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="<?=url("/storage/{$news->image}");?>" width="650px" height="420px"  alt="<?=$news->title;?>">
                              
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2><?=$news->title;?></h2>
                                </a>
                                <p><?=str_limit_words(filter_var($news->content, FILTER_SANITIZE_STRIPPED), 30);?></p>
                                <ul class="blog-info-link">
                                    <li class="font-basic"><i class="fa fa-user"></i>Por <?=$news->admin()->fullName();?></li>
                                    <li class="font-basic"><i class="fa flaticon-calendar"></i> <?=date_fmt_back_br($news->updated_at);?></li>
                                </ul>
                            </div>
                        </article>
                        <?php endforeach;?>
                        

                       

                        <nav class="blog-pagination justify-content-center d-flex p-5">
                            <?=$paginator;?>
                        </nav>
                    </div>
                </div>

            <?php $v->insert("_sidebar.php"); ?>

        </section>