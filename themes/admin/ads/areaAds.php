<?php $v->layout("_theme")?>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                      <?php if(!$adsEdit):?>
                        <section class="section">
                            <div class="card">
                            <div class="row p-5 ps-4 pb-0">
                                <div class="col-12 col-md-6 order-md-2 order-last">
                                    <h3>Adicionar Propaganda</h3>
                                </div>
                            </div>
                                <form action="<?=url("/admin/adicionar-propaganda")?>" method="POST" enctype="multipart/form-data">
                                 
                                <div class="card-body">
                                    <div class="col-sm-6 mb-4 w-100">
                                        <div class="form-group">
                                            <label for="roundText">Nome da marca:</label>
                                            <input type="text" id="roundText" class="form-control round input_default"
                                                placeholder="Insira o nome da marca" name="name">
                                                <input type="hidden" name="action" value="create">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-4 w-100">
                                        <div class="form-group">
                                            <label for="roundText">E-mail da marca:</label>
                                            <input type="email" id="roundText" class="form-control round input_default"
                                                placeholder="Insira o email da marca" name="email">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-4 w-100">
                                        <div class="form-group">
                                            <label for="roundText">Proprietário da marca:</label>
                                            <input type="text" name="owner" id="roundText" class="form-control round input_default"
                                                placeholder="Insira o nome do proprietário da marca">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 w-100">
                                        <label for="roundText">Escolha a imagem:</label>
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

                                    <div class="col-md-6 mb-4 w-100 mt-4">
                                        <label for="roundText">Tipo de propaganda:</label>
                                        <fieldset class="form-group">
                                            <select class="form-select input_default" name="type" id="basicSelect">
                                                <option>Escolha o tipo de propaganda</option>
                                                <option value="Curta">1 - Curta</option>
                                                <option value="Longa">2 - Longa</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-sm-6 mb-4 w-100">
                                        <div class="form-group">
                                            <label for="roundText">Redirecionar para:</label>
                                            <input type="text" name="link" id="roundText" class="form-control round input_default"
                                                placeholder="Insira para onde será redirecionado ao clicar">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 w-100 mt-4">
                                        <label for="roundText">Status:</label>
                                        <fieldset class="form-group">
                                            <select name="status" class="form-select input_default" id="basicSelect">
                                                <option value="1">Ativo</option>
                                                <option value="0">Inativo</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="buttons mt-5 d-flex">
                                        <button class="btn btn-primary d-flex align-items-center">Cadastrar</button>
                                        <a href="<?=url("/admin/propagandas")?>" class="btn button_purple">Lista de Admins</a>

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
                                    <h3>Atualizar Propaganda</h3>
                                    <p>Última atualização - <?=date_fmt_br($adsEdit->updated_at)?></p>
                                </div>
                                
                            </div>

                                <form action="<?=url("/admin/atualizar-propaganda/{$adsEdit->id}")?>" method="POST" enctype="multipart/form-data">
                                 
                                <div class="card-body">
                                    <div class="col-sm-6 mb-4 w-100">
                                        <div class="form-group">
                                            <label for="roundText">Nome da marca:</label>
                                            <input type="text" id="roundText" class="form-control round input_default"
                                                placeholder="Insira o nome da marca" value="<?=$adsEdit->name?>" name="name">
                                                <input type="hidden" name="action" value="update">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-4 w-100">
                                        <div class="form-group">
                                            <label for="roundText">E-mail da marca:</label>
                                            <input type="email" id="roundText" value="<?=$adsEdit->email?>" class="form-control round input_default"
                                                placeholder="Insira o email da marca" name="email">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-4 w-100">
                                        <div class="form-group">
                                            <label for="roundText">Proprietário da marca:</label>
                                            <input type="text" name="owner" value="<?=$adsEdit->owner?>" id="roundText" class="form-control round input_default"
                                                placeholder="Insira o nome do proprietário da marca">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 w-100">
                                        <label for="roundText">Escolha a imagem:</label>
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

                                    <div class="col-md-6 mb-4 w-100 mt-4">
                                        <label for="roundText">Tipo de propaganda:</label>
                                        <fieldset class="form-group">
                                            <select class="form-select input_default" name="type" id="basicSelect">
                                                <option>Escolha o tipo de propaganda</option>
                                                <option value="Curta" <?=($adsEdit->type == 'Curta') ? 'selected' : ''?>>1 - Curta</option>
                                                <option value="Longa" <?=($adsEdit->type == 'Longa') ? 'selected' : ''?>>2 - Longa</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-sm-6 mb-4 w-100">
                                        <div class="form-group">
                                            <label for="roundText">Redirecionar para:</label>
                                            <input type="text" name="link" value="<?=$adsEdit->link?>" id="roundText" class="form-control round input_default"
                                                placeholder="Insira para onde será redirecionado ao clicar">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 w-100 mt-4">
                                        <label for="roundText">Status:</label>
                                        <fieldset class="form-group">
                                            <select name="status" class="form-select input_default" id="basicSelect">
                                                <option value="1" <?=($adsEdit->status == 'Ativo') ? 'selected' : ''?>>Ativo</option>
                                                <option value="0" <?=($adsEdit->status == 'Inativo') ? 'selected' : ''?>>Inativo</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="buttons mt-5 d-flex">
                                        <button class="btn btn-primary d-flex align-items-center">Atualizar</button>
                                        <a href="<?=url("/admin/propagandas")?>" class="btn button_purple">Lista de Propagandas</a>
                                    </div>
                                </div>
                            </form>
                            
                            </div>
                        </section>
                    <?php endif;?>
                    </div>
                   
                </section>
            </div>
