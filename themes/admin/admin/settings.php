<?php $v->layout("_theme")?>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">                   
                        <section class="section">
                            <div class="card">
                            <div class="row p-5 ps-4 pb-0">
                                <div class="col-12 col-md-6 order-md-2 order-last">
                                    <h3>Configurações da Conta</h3>
                                </div>
                            </div>

                            <form action="<?=url("/admin/atualizar-admin/".admin()->id)?>" method="POST"> 
                                <div class="card-body">
                                    <div class="col-sm-6 mb-4 w-100">
                                        <div class="form-group">
                                            <label for="roundText">Nome:</label>
                                            <input type="text" id="roundText" class="form-control round input_default"
                                                placeholder="Insira o nome" name="first_name" value="<?=admin()->first_name?>">
                                                <input type="hidden" name="action" value="update">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="roundText">Sobrenome:</label>
                                            <input type="text" id="roundText" name="last_name" class="form-control round input_default"
                                                placeholder="Insira o sobrenome" value="<?=admin()->last_name?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="roundText">Email:</label>
                                            <input type="email" id="roundText" name="email" class="form-control round input_default"
                                                placeholder="Insira o email" value="<?=admin()->email?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="roundText">Senha:</label>
                                            <input type="password" id="roundText" name="password" class="form-control round input_default"
                                                placeholder="Insira a senha">
                                        </div>
                                    </div>

                                    <div class="buttons mt-5">
                                        <button class="btn btn-primary d-flex align-items-center">Atualizar </button>
                                    </div>
                                </div>
                            </form>
                            
                            </div>
                        </section>
                    </div>
                   
                </section>
            </div>

      
