<?php $v->layout('_theme')?>

<main>
   
    <div class="about-area2 gray-bg pt-60 pb-60">
        <div class="container">
                <div class="row">
                <div class="col-lg-8">
                    <div class="whats-news-wrapper">
                        <!-- Heading & Nav Button -->
                            <div class="row justify-content-between align-items-end mb-15">
                                <div class="col-xl-4">
                                    <div class="section-tittle mb-30">
                                        <h4>Categorias</h4>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-md-9">
                                    <div class="properties__button">
                                        <!--Nav Button  -->                                            
                                        <nav>                                                 
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <?php foreach($listCategorys as $categorys): ?>
                                                <a class="nav-item nav-link <?=$lastCategorys[0]->id == $categorys->id ? 'active' : null ;?>" id="nav-home-tab" data-toggle="tab" href="#nav-<?=$categorys->id?>" role="tab" aria-controls="nav-home" aria-selected="true"><?= $categorys->name ;?></a>

                                            
                                        <?php endforeach;?>
                                            </div>
                                        </nav>
                                        <!--End Nav Button  -->
                                    </div>
                                </div>
                            </div>
                            <!-- Tab content -->
                            <div class="row">
                                <div class="col-12">
                                    <!-- Nav Card -->
                                    <div class="tab-content" id="nav-tabContent">
                                        <!-- card one -->
                                        <?php foreach($listCategorys as $categorys): ?>

                                                <div class="tab-pane fade  
                                                <?=$lastCategorys[0]->id == $categorys->id ? 'show' : null ;?> 
                                                <?=$lastCategorys[0]->id == $categorys->id ? 'active' : null ;?>" 
                                                id="nav-<?=$categorys->id?>" role="tabpanel" 
                                                aria-labelledby="nav-home-tab">   

                                            <div class="row">
                                            <?php foreach($listNews as $news):?>
                                                <?php if($news->category_id == $categorys->id):?>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="whats-news-single mb-40 mb-40">
                                                        <div class="whates-img">
                                                            <img src="<?=url("/storage/{$news->image}");?>" title="<?= $news->title ;?>" alt="<?= $news->title ;?>">
                                                        </div>
                                                        <div class="whates-caption whates-caption2">
                                                            <h4><a href="<?= url("/noticia/{$news->uri}") ;?>"> <?=$news->title;?></a></h4>
                                                            <span>Por <?=$news->admin()->fullName();?> -   <?=date_fmt_back_br($news->update_at);?></span>
                                                            <p><?=str_limit_words(filter_var($news->content, FILTER_SANITIZE_STRIPPED), 20);?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                               
                                            </div>
                                        </div>
                                       
                                        <?php endforeach;?>
                                    </div>
                                <!-- End Nav Card -->
                                </div>
                            </div>
                    </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog_right_sidebar">
                               
                            <aside class="single_sidebar_widget post_category_widget ">
                               <h4 class="widget_title">Todas as Categorias</h4>
                               <ul class="list cat-list ">
                                <?php foreach($listCategorys as $category):?>
                                    <li>
                                     <a href="<?=url("/categoria/".strtolower ($category->name));?>" id="nav-home-tab"  class="d-flex link">
                                        <p><?=$category->name;?> (<?=$category->countNewsForCategory()?>)</p>
                                     </a>
                                  </li>
                                <?php endforeach;?>
                                  
                               </ul>
                            </aside>
                     
                           
                         </div>
                       
                    </div>                  
                </div>
        </div>
    </div>

    
    <div class="banner-area gray-bg pt-60 pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10">
                    <div class="banner-one">
                        <a href="<?= $adsLong->link ;?>" target="_blank">
                            <img src="<?=url("/storage/{$adsLong->image}")?>" height="300px" style="border-radius: 6px;" title="<?= $adsLong->name ;?>" alt="<?= $adsLong->name ;?>">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End pagination  -->
</main>
