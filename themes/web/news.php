<?php $v->layout("_theme"); ?>
<main>
 
   <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
            
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" src="<?=url("/storage/{$news->image}")?>" width="800px" height="300px" alt="<?=$news->title?>">
                  </div>
                  <div class="blog_details">
                     <h2><?=$news->title;?></h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li class="font-basic"><i class="fa fa-user"></i>Por <?=$news->admin()->fullName();?></li>
                        <li class="font-basic"><i class="fa flaticon-calendar"></i> <?=date_fmt_back_br($news->updated_at)?></li>
                     </ul>
                     <p class="excert">
                        <?=$news->content;?>
                     </p>
                
                    
                  </div>
               </div>

               <div class="navigation-top">
                  <div class="d-sm-flex justify-content-between text-center">
                     <div class="social-share pt-30">
                        <div class="section-tittle">
                            <h4 class="mr-20">Compartilhe:</h4>
                            <ul>
                                <li><a href="#"><img src="<?=theme("/assets/img/news/icon-ins.png", CONF_VIEW_WEB)?>" alt=""></a></li>
                                <li><a href="#"><img src="<?=theme("/assets/img/news/icon-fb.png", CONF_VIEW_WEB)?>" alt=""></a></li>
                                <li><a href="#"><img src="<?=theme("/assets/img/news/icon-tw.png", CONF_VIEW_WEB)?>" alt=""></a></li>
                                <li><a href="#"><img src="<?=theme("/assets/img/news/icon-yo.png", CONF_VIEW_WEB)?>" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                  </div>
                  <div class="navigation-area">
                     <div class="row">
                        <div
                           class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                           <div class="thumb">
                              <a href="#">
                                 <img class="img-fluid" src="<?=theme("/assets/img/post/preview.png", CONF_VIEW_WEB)?>" alt="">
                              </a>
                           </div>
                           <div class="arrow">
                              <a href="#">
                                 <span class="lnr text-white ti-arrow-left"></span>
                              </a>
                           </div>
                           <div class="detials">
                              <p>Post anterior</p>
                              <a href="#">
                                 <h4>Space The Final Frontier</h4>
                              </a>
                           </div>
                        </div>
                        <div
                           class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                           <div class="detials">
                              <p>Proximo Post</p>
                              <a href="#">
                                 <h4>Telescopes 101</h4>
                              </a>
                           </div>
                           <div class="arrow">
                              <a href="#">
                                 <span class="lnr text-white ti-arrow-right"></span>
                              </a>
                           </div>
                           <div class="thumb">
                              <a href="#">
                                 <img class="img-fluid" src="<?=theme("/assets/img/post/next.png", CONF_VIEW_WEB)?>" alt="">
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
              
            </div>

            <?php $v->insert("_sidebar.php"); ?>

     
   </section>

   <div class="banner-area pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10">
                    <div class="banner-one">
                        <a href="<?=$adsLong->link;?>" target="_blank">
                            <img src="<?=url("/storage/{$adsLong->image}");?>" style="border-radius:8px;" height="300px" alt="<?=$adsLong->title?>">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</main>
