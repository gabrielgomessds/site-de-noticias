<?php $v->layout('_theme')?>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <?php if(!$categorieEdit):?>
                                <section class="section">
                                <div class="card">

                                    <div class="row p-5 ps-4 pb-0">
                                        <div class="col-12 col-md-6 order-md-2 order-last">
                                        <h3>Adicionar Categoria</h3>
                                        </div>
                                    </div>
                                    <form action="<?=url('/admin/adicionar-categoria')?>" method="POST">
                                    
                                    <div class="card-body">
                                        <div class="col-sm-6 mb-4 w-100">
                                            <div class="form-group">
                                                <label for="roundText" class="pb-3">Nome da categoria:</label>
                                                <input type="text" id="roundText" name="name" class="form-control round name_categoria"
                                                    placeholder="Insira o nome da categoria">
                                                    <input type="hidden" value="<?=admin()->id?>" name="author_id">
                                                    <input type="hidden" value="create" name="action">
                                            </div>
                                            <div class="form-group">
                                                <label for="roundText">Escolha uma cor:</label><br/>
                                                <input type="color" name="color" class="form-control form-control-color color_tag" id="exampleColorInput" value="#424093" title="Choose your color">

                                            </div>
                                        </div>

                                        <div>
                                            Resultado: <span class="tag_categorie"></span>
                                        </div>

                                        <div class="buttons mt-5 d-flex">
                                            <button class="btn btn-primary d-flex align-items-center">Cadastrar</i></button>
                                            <a href="<?=url("/admin/categorias")?>" class="btn button_purple d-flex align-items-center">Lista de Categorias</a>
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
                                            <h3>Atualizar Admin</h3>
                                            <p>Última atualização - <?=date_fmt_br($categorieEdit->updated_at)?></p>
                                        </div>
                                    </div>
                                    <form action="<?=url('/admin/atualizar-categoria/'.$categorieEdit->id)?>" method="POST">
                                    
                                    <div class="card-body">
                                        <div class="col-sm-6 mb-4 w-100">
                                            <div class="form-group">
                                                <label for="roundText" class="pb-3">Nome da categoria:</label>
                                                <input type="text" id="roundText" name="name" class="form-control round name_categoria"
                                                    placeholder="Insira o nome da categoria" value="<?=$categorieEdit->name?>">
                                                    <input type="hidden" value="<?=admin()->id?>" name="author_id">
                                                    <input type="hidden" value="update" name="action">
                                            </div>
                                            <div class="form-group">
                                                <label for="roundText">Escolha uma cor:</label><br/>
                                                <input type="color" name="color" value="<?=$categorieEdit->color?>" class="form-control form-control-color color_tag" id="exampleColorInput" value="#424093" title="Choose your color">

                                            </div>
                                        </div>

                                        <div>
                                            Resultado: 
                                            <span class="tag_categorie" 
                                            style="background-color: <?=$categorieEdit->color?>;">
                                                <?= $categorieEdit->name?>
                                            </span>
                                        </div>

                                        <div class="buttons mt-5 d-flex">
                                            <button class="btn btn-primary d-flex align-items-center">Atualizar</i></button>
                                            <a href="<?=url("/admin/categorias")?>" class="btn button_purple d-flex align-items-center">Lista de Categorias</a>
                                        </div>
                                    </div>
                                </form>
                                
                                </div>
                            </section>
                        <?php endif;?>
                    </div>
                   
                </section>
            </div>

