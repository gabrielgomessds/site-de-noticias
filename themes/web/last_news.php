<?php $v->layout('_theme')?>
    

    <section class="blog_area">
        <!-- <div class="heading-news mb-30 text-center">
            <h3 style="background-color: #27b464;color:white;padding:20px;">Esporte</h3>
        </div> -->
    
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <?php if($searchNotFound):?>
                                    <div class="heading-news mb-30 text-center mt-5">
                                    <h3 style="color:#1e3056;">Não encontramos resultados</h3>
                                </div>
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="<?=theme("/assets/img/img/search_result.png", CONF_VIEW_WEB)?>" alt="">
                                    
                                </div>
                                <h1 class="text-center mb-3">Veja outras noticias:</h1>
                             <?php endif;?>
                     </article>
                            
                       
                        <?php foreach($listNews as $news):?>
                            <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="<?=url("/storage/{$news->image}");?>" width="650px" height="420px" alt="">
                              
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="<?= url("/noticia/{$news->uri}") ;?>">
                                    <h2><?=$news->title;?></h2>
                                </a>
                                
                                <p><?=str_limit_words(filter_var($news->content, FILTER_SANITIZE_STRIPPED), 20);?></p>
                                <ul class="blog-info-link">
                                    <li class="font-basic"><i class="fa fa-user"></i>Por <?=$news->admin()->fullName();?></li>
                                    <li class="font-basic"><i class="fa flaticon-calendar"></i> <?=date_fmt_back_br($news->updated_at);?></li>
                                    <li class="font-basic"> <span class="span_info" style="background-color: <?=$news->category()->color;?>;"><?=$news->category()->name;?></span></li>
                                </ul>
                            </div>
                        </article>
                        <?php endforeach;?>
                        
                        <?=$paginator;?>
                      
                    </div>
                </div>

                

            <?php $v->insert("_sidebar.php"); ?>

   