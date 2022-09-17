<div class="col-lg-4 mt-5">
               <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget search_widget">
                     <form action="#">
                        <div class="form-group">
                           <div class="input-group mb-3">
                              <input type="text" name="s" class="form-control" placeholder='Buscar noticias'
                                 onfocus="this.placeholder = ''" onblur="this.placeholder = 'Buscar noticias'">
                              <div class="input-group-append">
                                 <button class="btns" type="button"><i class="ti-search"></i></button>
                              </div>
                           </div>
                        </div>
                        <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                           type="submit">Pesquisar</button>
                     </form>
                  </aside>

                 
                     <aside class="single_sidebar_widget">
                          
                          <div class="news-poster d-none d-lg-block">
                           <a href="<?=$adsShort->link;?>" target="_blank">
                              <img src="<?=url("/storage/{$adsShort->image}");?>" style="border-radius: 8px;" alt="<?=$adsShort->title;?>">
                           </a>
                          </div>
                 </aside>
                  
                 
                  <aside class="single_sidebar_widget popular_post_widget">
                     <h3 class="widget_title">Mais acessadas</h3>
                     <?php foreach($mostVisitedNews as $news):?>
                        <div class="media post_item">
                        <img src="<?=url("/storage/{$news->image}");?>" alt="<?=$news->title?>" width="100px" height="80px">
                        <div class="media-body">
                           <a href="<?=url("/noticia/$news->uri")?>">
                              <h3><?=str_limit_words($news->title, 5)?></h3>
                           </a>
                           <p><?=$news->admin()->fullName();?>  |  <?=date_fmt_back_br($news->updated_at);?></p>
                        </div>
                     </div>
                     <?php endforeach;?>
                   
                  </aside>
               
                  <aside class="single_sidebar_widget newsletter_widget">
                     <h4 class="widget_title">Receber noticias</h4>
                     <form action="<?=url("/inscricao/inscrever_se");?>" method="POST">
                        <div class="form-group">
                           <input type="email" name="email" class="form-control"  placeholder='Enter email' required>
                        </div>
                        <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                           type="submit">Inscrever-se</button>
                     </form>
                  </aside>
               </div>
            </div>
         </div>
      </div>