<?php $v->layout("_theme");?>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <?php if(!$newsEdit):?>
                                <section class="section">
                                <div class="card">
                                <div class="row p-5 ps-4 pb-0">
                                    <div class="col-12 col-md-6 order-md-2 order-last">
                                        <h3>Adicionar Noticia</h3>
                                    </div>
                                </div>

                                    <form action="<?=url('/admin/adicionar-noticia')?>" method="POST" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="col-sm-6 mb-4 w-100">
                                            <div class="form-group">
                                                <label for="roundText">Titulo da noticia:</label>
                                                <input type="text" id="roundText" class="form-control round input_default"
                                                    placeholder="Insira o titulo da noticia" required name="title">
                                                    <input type="hidden" value="create" name="action">
                                                    <input type="hidden" value="<?=admin()->id?>" name="author_id">
                                            </div>
                                        </div>


                                        <div class="col-md-6 mb-4 w-100">
                                            <label for="roundText">Escolha a categoria da noticia:</label>
                                        
                                            <div class="form-group">
                                                <select class="choices form-select input_default" name="category_id">
                                                    <option value="">Escolher categoria...</option>
                                                    <?php foreach($listCategories as $category):?>
                                                        <option value="<?=$category->id?>"><?=$category->name?></option>
                                                    <?php endforeach;?> 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4 w-100 mt-4">
                                            <label for="roundText">Nivel de importancia:</label>
                                            <fieldset class="form-group">
                                                <select class="form-select input_default" id="basicSelect" name="position">
                                                    <option>Escolha o nivel</option>
                                                    <option value="1">1 - Primeira noticia a aparecer</option>
                                                    <option value="2">2 - Segunda mais importante</option>
                                                    <option value="3">3 - Terceira mais importante</option>
                                                    <option value="4">4 - Inferior principal</option>
                                                    <option value="5">5 - Inferior segunda principal</option>
                                                    <option value="6">6 - Inferior terceira principal</option>
                                                    <option value="0">0 - Noticia Comum</option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6 mb-4 w-100">
                                            <label for="roundText">Capa da notícia:</label>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="mb-3">
                                                        <input type="file" name="image" class="form-control" id="formFile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4 w-100">
                                            <label for="roundText">Insira a noticia:</label>

                                            <textarea id="summernote" class="textarea" required name="content">

                                            </textarea>
                                                
                                        </div>
                                        
                                        <div class="buttons mt-3 mb-5 d-flex">
                                            <button class="btn btn-primary d-flex align-items-center">Continuar <i class="bi bi-arrow-right ms-2"></i></button>
                                            <a href="<?=url("/admin/noticias")?>" class="btn button_purple d-flex align-items-center">Lista de Categorias</a>

                                        </div>
                                    </div>
                                </form>
                                
                                </div>
                            </section>
                        
                        <?php else:?>
                                <section class="section">
                                <div class="card">
                                <div class="row p-5 ps-4 pb-0">
                                    <div class="col-12 col-md-6 order-md-2 order-last">
                                        <h3>Atualizar Noticia</h3>
                                        <p>Última atualização - <?=date_fmt_br($newsEdit->updated_at)?></p>

                                    </div>
                                </div>

                                    <form action="<?=url('/admin/atualizar-noticia/'.$newsEdit->id)?>" method="POST" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        <div class="col-sm-6 mb-4 w-100">
                                            <div class="form-group">
                                                <label for="roundText">Titulo da noticia:</label>
                                                <input type="text" value="<?= $newsEdit->title ;?>" id="roundText" class="form-control round input_default"
                                                    placeholder="Insira o titulo da noticia" required name="title">
                                                    <input type="hidden" value="update" name="action">                                            </div>
                                        </div>


                                        <div class="col-md-6 mb-4 w-100">
                                            <label for="roundText">Escolha a categoria da noticia:</label>
                                        
                                            <div class="form-group">
                                                <select class="choices form-select input_default" name="category_id">
                                                    <option value="">Escolher categoria...</option>
                                                    <?php foreach($listCategories as $category):?>
                                                        <option value="<?=$category->id?>" <?=($newsEdit->category_id == $category->id) ? 'selected' : ''?>><?=$category->name?></option>
                                                    <?php endforeach;?> 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4 w-100 mt-4">
                                            <label for="roundText">Nivel de importancia:</label>
                                            <fieldset class="form-group">
                                                <select class="form-select input_default" id="basicSelect" name="position">
                                                    <option>Escolha o nivel</option>
                                                    <option value="1" <?=($newsEdit->position == 1) ? 'selected' : ''?> >1 - Primeira noticia a aparecer</option>
                                                    <option value="2" <?=($newsEdit->position == 2) ? 'selected' : ''?> >2 - Segunda mais importante</option>
                                                    <option value="3" <?=($newsEdit->position == 3) ? 'selected' : ''?> >3 - Terceira mais importante</option>
                                                    <option value="4" <?=($newsEdit->position == 4) ? 'selected' : ''?> >4 - Inferior principal</option>
                                                    <option value="5" <?=($newsEdit->position == 5) ? 'selected' : ''?> >5 - Inferior segunda principal</option>
                                                    <option value="6" <?=($newsEdit->position == 6) ? 'selected' : ''?> >6 - Inferior terceira principal</option>
                                                    <option value="0" <?=($newsEdit->position == 0) ? 'selected' : ''?> >0 - Noticia Comum</option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6 mb-4 w-100">
                                            <label for="roundText">Capa da notícia:</label>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="mb-3">
                                                        <input type="file" name="image" class="form-control" id="formFile">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4 w-100">
                                            <label for="roundText">Insira a noticia:</label>

                                            <textarea id="summernote" required name="content">
                                                <?= $newsEdit->content; ?>
                                            </textarea>
                                                
                                        </div>
                                        
                                        <div class="buttons mt-3 mb-5 d-flex">
                                            <button class="btn btn-primary d-flex align-items-center">Continuar <i class="bi bi-arrow-right ms-2"></i></button>
                                            <a href="<?=url("/admin/noticias")?>" class="btn button_purple d-flex align-items-center">Lista de Categorias</a>

                                        </div>
                                    </div>
                                </form>
                                
                                </div>
                            </section>
                        <?php endif;?>
                
                    </div>
                   
                </section>
            </div>
