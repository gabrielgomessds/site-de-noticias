<?php $v->layout("_theme")?>

            <div class="page-heading">
                <div class="page-title">
                    
                </div>
                <section class="section">

                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="row p-5">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3>Lista de Categorias - Total: <?=$countCategories?></h3>
                                   
                                </div>
                                <div class="col-12 col-md-6 order-md-2 order-first">
                                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                       <a href="<?=url("/admin/adicionar-categoria")?>"><button class="btn btn-primary">Adicionar</button></a>    
                                    </nav>
                                </div>
                                
                            </div>
                            <div class="d-flex justify-content-center">
                                <form action="<?=url("/admin/categorias")?>" method="POST">
                                    <div class="content_search">
                                            <input type="text" name="s" value="<?= $search; ?>" class="search_input" placeholder="Buscar categoria...">
                                            <button class="icon_search"><i class="bi bi-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                    <?php if (!$listCategories) : ?>
                                        <div class="message info icon-info">Ainda não existem categorias cadastradas.</div>
                                    <?php else : ?>
                                    
                                        <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>NOME</th>
                                                    <th>AUTOR</th>
                                                    <th>CRIADA</th>
                                                    <th>AÇÔES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($listCategories as $categorie):?>
                                                    <tr>
                                                        <td><span style="background-color: <?= $categorie->color ?>;color:white; padding: 3px 8px;font-weight: bold; border-radius: 6px;"><?=$categorie->name?></span></td>
                                                        <td><?= $categorie->admin()->first_name ?></td>
                                                        <td><?=date_fmt_br($categorie->created_at)?></td>
                                                        <td class="actions"><a href="<?=url("/admin/atualizar-categoria/{$categorie->id}")?>"><i class="bi bi-pencil-fill blue_color"></i></a> <a href="#" class="modalDelete deleteModal" id="<?=$categorie->id?>"><i class="bi bi-trash-fill red_color"></i></a></td>
                                                    </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                        <?php endif;?>
                                    </div>
                                    <?= $paginator; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>

    <!-- DELETE NEWS  -->
    <div id="modalDelete" class="modal-container ">
        <div class="modal-content modal-smaller">
            <button class="fechar">X</button>
            <h4 class="subtitulo">Tem certeza que deseja deletar essa categoria?</h4>
            <p class="text-center font-bold">Essa ação não poderá ser desfeita</p>

            <form action="<?=url("/admin/deletar-categoria")?>" method="POST">
                <fieldset class="fieldset_model">
                    <input type="hidden" name="idCategorie" class="inputID">
                    <input type="hidden" name="action" value="delete">
                    <button class="btn-question btn-no">Confirmar</button> 
                </fieldset>
            </form>

        </div>
    </div>

    <?php $v->start("scripts"); ?>
        <script type="text/javascript">
            let deleteModal = document.querySelectorAll(".deleteModal");
            let inputID = document.querySelector(".inputID");
            
            deleteModal.forEach((e)=>{
                    e.addEventListener('click', ()=>{
                        inputID.value = e.id
                    })
            });
        </script>
    <?php $v->end("scripts"); ?>
