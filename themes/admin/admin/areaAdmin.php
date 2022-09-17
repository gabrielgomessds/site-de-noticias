<?php $v->layout("_theme")?>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">                       
                     
                        <?php if (!isset($adminEdit)):?>
                            <section class="section">
                            <div class="card">
                            <div class="row p-5 ps-4 pb-0">
                                <div class="col-12 col-md-6 order-md-2 order-last">
                                    <h3>Adicionar Admin</h3>
                                </div>
                            </div>
                                <form action="<?=url("/admin/adicionar-admin")?>">
                                 
                                <div class="card-body">
                                    <div class="col-sm-6 mb-4 w-100">
                                        <div class="form-group">
                                            <label for="roundText">Nome:</label>
                                            <input type="text" id="roundText" class="form-control round input_default"
                                                placeholder="Insira o nome" name="first_name">
                                                <input type="hidden" name="action" value="create"/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="roundText">Sobrenome:</label>
                                            <input type="text" id="roundText" class="form-control round input_default"
                                                placeholder="Insira o sobrenome" name="last_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="roundText">Email:</label>
                                            <input type="email" id="roundText" class="form-control round input_default"
                                                placeholder="Insira o email" name="email">
                                        </div>

                                        <div class="form-group">
                                            <label for="roundText">Senha:</label>
                                            <input type="password" id="roundText" class="form-control round input_default"
                                                placeholder="Insira a senha" name="password">
                                        </div>
                                    </div>

                                    <div class="buttons mt-5 d-flex">
                                        <button class="btn btn-primary d-flex align-items-center">Cadastrar </button>
                                        <a href="<?=url("/admin/admins")?>" class="btn button_purple">Lista de Admins</a>
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
                                        <p>Última atualização - <?=date_fmt_br($adminEdit->updated_at)?></p>
                                    </div>
                                </div>
                                
                                <form action="<?=url("/admin/atualizar-admin/{$adminEdit->id}")?>">
                                    
                                    <div class="card-body">
                                        <div class="col-sm-6 mb-4 w-100">
                                            <div class="form-group">
                                                <label for="roundText">Nome:</label>
                                                <input type="text" id="roundText" class="form-control round input_default"
                                                    placeholder="Insira o nome" value="<?=$adminEdit->first_name?>" name="first_name">
                                                    <input type="hidden" name="action" value="update"/>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="roundText">Sobrenome:</label>
                                                <input type="text" id="roundText" value="<?=$adminEdit->last_name?>" class="form-control round input_default"
                                                    placeholder="Insira o sobrenome"  name="last_name">
                                            </div>

                                            <div class="form-group">
                                                <label for="roundText">Email:</label>
                                                <input type="email" id="roundText" value="<?=$adminEdit->email?>" class="form-control round input_default"
                                                    placeholder="Insira o email" name="email">
                                            </div>

                                            <div class="form-group">
                                                <label for="roundText">Senha:</label>
                                                <input type="password" id="roundText" class="form-control round input_default"
                                                    placeholder="Insira a senha" name="password">
                                            </div>
                                        </div>

                                        <div class="buttons mt-5 d-flex">
                                            <button class="btn btn-primary d-flex align-items-center">Atualizar </button>
                                            <a href="<?=url("/admin/admins")?>" class="btn button_purple">Lista de Admins</a>
                                        </div>
                                    </div>
                                </form>
                                
                                </div>
                            </section>
                        <?php endif;?>
                    </div>
                   
                </section>
            </div>

      
