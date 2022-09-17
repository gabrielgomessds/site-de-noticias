<?php

use Source\Controllers\Web\Web;

 $v->layout("_theme"); ?>

<main>
    <div class="trending-area fix pt-25 gray-bg">
        <div class="container">
            <div class="trending-main">
                <div class="row">

                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <div class="slider-active">
                            <!-- news number one -->
                             <div class="single-slider">
                                <a href="<?=url("/noticia/{$newsMain["first"]->uri}")?>">
                                    <div class="trending-top mb-30">
                                        <div class="trend-top-img" title="<?= $newsMain["first"]->title ;?>">
                                            <img src="<?=url("/storage/{$newsMain["first"]->image}")?>" width="690px" height="610px"  alt="<?=$newsMain["first"]->title?>">
                                            <div class="trend-top-cap">
                                                <span class="bgr" style="background-color: <?= $newsMain["first"]->category()->color ;?>;"><?= $newsMain["first"]->category()->name ;?></span>
                                                <h2><a href="<?=url("/noticia/{$newsMain["first"]->uri}")?>">
                                                    <?= $newsMain["first"]->title ;?>
                                                </a></h2>
                                                <p>Por: <?=$newsMain['first']->admin()->fullName();?>   -   <?= date_fmt_br($newsMain["first"]->updated_at) ;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                          
                        </div>
                    </div>
                    <!-- Right content -->
                    <div class="col-lg-4">
                            <!-- Trending Top -->
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6">
                            <a href="<?=url("/noticia/{$newsMain["second"]->uri}")?>">
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img" title="<?= $newsMain["second"]->title ;?>">
                                            <img src="<?=url("/storage/{$newsMain["second"]->image}")?>" width="330px" height="353px"  alt="<?=$newsMain["second"]->title?>">
                                        <div class="trend-top-cap trend-top-cap2">
                                        <span class="bgr" style="background-color: <?= $newsMain["second"]->category()->color ;?>;"><?= $newsMain["second"]->category()->name ;?>
                                        </span>
                                            <h2><a href="<?=url("/noticia/{$newsMain["second"]->uri}")?>">
                                                    <?= $newsMain["second"]->title ;?>
                                                </a></h2>
                                                <p>Por: <?=$newsMain["second"]->admin()->fullName();?>   -   <?= date_fmt_br($newsMain["second"]->updated_at) ;?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            
                            <div class="col-lg-12 col-md-6 col-sm-6">
                            <a href="<?=url("/noticia/{$newsMain["third"]->uri}")?>">
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img" title="<?= $newsMain["third"]->title ;?>">
                                    <img src="<?=url("/storage/{$newsMain["third"]->image}")?>" width="330px" height="196px"  alt="<?=$newsMain["third"]->title?>">
                                        <div class="trend-top-cap trend-top-cap2">
                                        <span class="bgr" style="background-color: <?= $newsMain["third"]->category()->color ;?>;"><?= $newsMain["third"]->category()->name ;?>
                                        </span>
                                            <h5><a href="<?=url("/noticia/{$newsMain["third"]->uri}")?>">
                                                <b class="link_text"><?= $newsMain["third"]->title ;?></b>
                                             </a></h5>
                                             <p>Por: <?=$newsMain["third"]->admin()->fullName();?>   -   <?= date_fmt_br($newsMain["third"]->updated_at) ;?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->
    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20 gray-bg">
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
                                            <!-- Left Details Caption -->
                                        <?php foreach($listNews as $news):?>
                                            <?php if($news->category_id == $categorys->id):?>
                                            <div class="col-xl-6 col-lg-12">
                                                <a href="<?= url("/noticia/{$news->uri}") ;?>">
                                                    <div class="whats-news-single mb-40 mb-40">
                                                        <div class="whates-img">
                                                            <img src="<?=url("/storage/{$news->image}");?>" title="<?= $news->title ;?>" alt="<?= $news->title ;?>">
                                                        </div>
                                                        <div class="whates-caption">
                                                            <h4><a href="<?= url("/noticia/{$news->uri}") ;?>"> <?=$news->title;?></a></h4>
                                                            <span>Por <?=$news->admin()->fullName();?> -   <?=date_fmt_back_br($news->update_at);?></span>
                                                            <p><?=str_limit_words(filter_var($news->content, FILTER_SANITIZE_STRIPPED), 20);?></p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php break;?>
                                        <?php endif;?>
                                        
                                          <?php endforeach;?>
                                            <!-- Right single caption -->
                                            <div class="col-xl-6 col-lg-12">
                                                <div class="row">
                                                    <!-- single -->
                                                   
                                                    
                                                        <?php $newsList = ((new Web())->findNewsCategory($categorys->id));?>
                                                       <?php if($newsList != null):?>
                                                            <?php foreach($newsList as $categoryNews ):?>
                                                                    
                                                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-10">
                                                                    <a href="<?= url("/noticia/{$categoryNews->uri}") ;?>">
                                                                        <div class="whats-right-single mb-20">
                                                                            <div class="whats-right-img">
                                                                                <img src="<?=url("/storage/{$categoryNews->image}");?>" width="220px" height="85px" title="<?= $categoryNews->title ;?>" alt="<?= $categoryNews->title ;?>">
                                                                            </div>
                                                                            <div class="whats-right-cap">
                                                                                <h4><a href="<?= url("/noticia/{$categoryNews->uri}") ;?>"><?=str_limit_words($categoryNews->title, 12);?></a></h4>
                                                                                <p><?=date_fmt_back_br($categoryNews->update_at);?></p> 
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>                                                 
                                                                
                                                            <?php endforeach;?>  
                                                            <?php else:?>
                                                                <h4>Essa categoria possui apenas uma noticia</h4>
                                                        <?php endif;?>
                                                                              
                                                </div>
                                            </div>                                  

                                        </div>

                                    </div>
                                <?php endforeach ;?>
                               
                            </div>
                        <!-- End Nav Card -->
                        </div>
                    </div>
                </div>
                <!-- Banner -->
                
                <div class="banner-area gray-bg pt-20">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 col-md-10">
                                <div class="banner-one">
                                    <a href="<?= $adsLong->link ;?>" target="_blank">
                                        <img src="<?=url("/storage/{$adsLong->image}")?>" style="border-radius: 6px;" title="<?= $adsLong->name ;?>" alt="<?= $adsLong->name ;?>">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-4">
                   
                    <!-- Most Recent Area -->
                    <div class="most-recent-area">
                        <!-- Section Tittle -->
                        <div class="d-flex justify-content-between align-items-end p-2">
                            <div class="small-tittle mb-20">
                                <h4>Mais recente</h4>
                            </div>
                          
                        </div>
                        <!-- Details -->
                        <?php foreach($lastNews as $news):?>
                            <div class="most-recent mb-40">
                                <div class="most-recent-img">
                                    <img src="<?=url("/storage/{$news->image}")?>" alt="<?= $news->title ;?>">
                                    <div class="most-recent-cap">
                                        <span class="bgbeg" style="background-color: <?= $news->category()->color; ?> ;"><?= $news->category()->name; ?></span>
                                        <h4><a href="<?= url("/noticia/{$news->uri}") ;?>"><?= str_limit_words($news->title, 10) ;?>
                                           </a></h4>
                                        <p><?= date_fmt_back_br($news->update_at) ;?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <!-- Single -->
                            
                            <?php foreach($limitNewsCategory as $news):?>
                                <!-- Single -->
                                <div class="most-recent-single">
                                    <div class="most-recent-images">
                                        <img 
                                            src="<?=url("/storage/{$news->image}")?>" 
                                            width="85px"
                                            height="80px"
                                            alt="<?=$news->title?>">
                                    </div>
                                    <div class="most-recent-capt">
                                        <h4><a href="<?= url("/noticia/{$news->uri}") ;?>"><?= str_limit_words($news->title, 8) ;?></a></h4>
                                        <p><?=date_fmt_back_br($news->update_at);?></p>
                                    </div>
                                </div>
                            <?php endforeach;?>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
   

    <div class="weekly2-news-area pt-50 pb-30 gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <div class="row">
                    
                    <div class="col-lg-3">
                            <div class="home-banner2 d-none d-lg-block">
                                <a href="<?= $adsShort->link ;?>" target="_blank">
                                    <img src="<?=url("/storage/{$adsShort->image}");?>" style="border-radius:6px;" title="<?= $adsShort->name ;?>" alt="<?= $adsShort->name ;?>">
                                </a>
                            </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="slider-wrapper">
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="small-tittle mb-30">
                                        <h4>Mais Populares</h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="weekly2-news-active d-flex">
                                       
                                    <?php foreach($mostVisitedNews as $news):?>
                                        <div class="weekly2-single">
                                            <div class="weekly2-img">
                                                <img src="<?=url("/storage/{$news->image}")?>" alt="<?=$news->title?>">
                                            </div>
                                            <div class="weekly2-caption">
                                                <h4><a href="#"><?=$news->title;?></a></h4>
                                                <p><?=$news->admin()->fullName()?>  |  <?=date_fmt_back_br($news->update_at)?></p>
                                            </div>
                                        </div> 
                                    <?php endforeach;?>
 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>           
    

    <div class="trending-area fix pt-25 gray-bg">
        <div class="container">
            <div class="trending-main">
            <div class="row">

<div class="col-lg-8">
    <!-- Trending Top -->
    <div class="slider-active">
        <!-- news number one -->
         <div class="single-slider">
            <a href="<?=url("/noticia/{$newsMain["fourth"]->uri}")?>">
                <div class="trending-top mb-30">
                    <div class="trend-top-img" title="<?= $newsMain["fourth"]->title ;?>">
                        <img src="<?=url("/storage/{$newsMain["fourth"]->image}")?>" width="690px" height="610px"  alt="<?=$newsMain["fourth"]->title?>">
                        <div class="trend-top-cap">
                            <span class="bgr" style="background-color: <?= $newsMain["fourth"]->category()->color ;?>;"><?= $newsMain["fourth"]->category()->name ;?></span>
                            <h2><a href="<?=url("/noticia/{$newsMain["fourth"]->uri}")?>">
                                <?= $newsMain["fourth"]->title ;?>
                            </a></h2>
                            <p>Por: <?=$newsMain["fourth"]->admin()->fullName();?>   -   <?= date_fmt_br($newsMain["fourth"]->updated_at) ;?></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
      
    </div>
</div>
<!-- Right content -->
<div class="col-lg-4">
        <!-- Trending Top -->
    <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-6">
        <a href="<?=url("/noticia/{$newsMain["fifth"]->uri}")?>">
            <div class="trending-top mb-30">
                <div class="trend-top-img" title="<?= $newsMain["fifth"]->title ;?>">
                        <img src="<?=url("/storage/{$newsMain["fifth"]->image}")?>" width="330px" height="380px"  alt="<?=$newsMain["fifth"]->title?>">
                    <div class="trend-top-cap trend-top-cap2">
                    <span class="bgr" style="background-color: <?= $newsMain["fifth"]->category()->color ;?>;"><?= $newsMain["fifth"]->category()->name ;?>
                    </span>
                        <h2><a href="<?=url("/noticia/{$newsMain["fifth"]->uri}")?>">
                                <?= $newsMain["fifth"]->title ;?>
                            </a></h2>
                            <p>Por: <?=$newsMain["fifth"]->admin()->fullName();?>   -   <?= date_fmt_br($newsMain["fifth"]->updated_at) ;?></p>
                    </div>
                </div>
            </div>
        </a>
        </div>
        
        <div class="col-lg-12 col-md-6 col-sm-6">
        <a href="<?=url("/noticia/{$newsMain["sixth"]->uri}")?>">
            <div class="trending-top mb-30">
                <div class="trend-top-img" title="<?= $newsMain["sixth"]->title ;?>">
                <img src="<?=url("/storage/{$newsMain["sixth"]->image}")?>" width="330px" height="196px"  alt="<?=$newsMain["sixth"]->title?>">
                    <div class="trend-top-cap trend-top-cap2">
                    <span class="bgr" style="background-color: <?= $newsMain["sixth"]->category()->color ;?>;"><?= $newsMain["sixth"]->category()->name ;?>
                    </span>
                        <h5><a href="<?=url("/noticia/{$newsMain["sixth"]->uri}")?>" >
                                <b class="link_text"><?= $newsMain["sixth"]->title ;?></b>
                         </a></h5>
                         <p>Por: <?=$newsMain["sixth"]->admin()->fullName();?>   -   <?= date_fmt_br($newsMain["sixth"]->updated_at) ;?></p>
                    </div>
                </div>
            </div>
        </a>
        </div>
    </div>
</div>

</div>
            </div>
        </div>
    </div>
   

    <div class="weekly3-news-area pt-80 pb-130">
        <div class="container">
            <div class="weekly3-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-wrapper">
                           
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="weekly3-news-active dot-style d-flex">
                                    <?php foreach($limitNews as $news):?>
                                        <div class="weekly3-single">
                                            <div class="weekly3-img">
                                                <img src="<?=url("/storage/{$news->image}")?>" width="370px" height="230px" alt="<?=$news->title;?>">
                                            </div>
                                            <div class="weekly3-caption">
                                                <h4><a href="<?=url("/noticia/{$news->uri}")?>"><?=str_limit_words($news->title, 15)?></a></h4>
                                                <p><?=$news->admin()->fullName();?> - <?=date_fmt_back_br($news->update_at)?></p>
                                            </div>
                                        </div> 
                                    <?php endforeach;?>
              
                                    </div>
                                </div>
                            </div>
                        </div>
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
  
</main>

