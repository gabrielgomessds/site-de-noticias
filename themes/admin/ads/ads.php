<?php $v->layout("_theme")?>

            <div class="page-heading">
                <div class="page-title">
                    
                </div>
                <section class="section">

                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="row p-5">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3>Lista de Propagandas - Total: <?=$countAds?></h3>
                                   
                                </div>
                                <div class="col-12 col-md-6 order-md-2 order-first">
                                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                       <a href="<?=url("/admin/adicionar-propaganda")?>"><button class="btn btn-primary">Adicionar</button></a>    
                                    </nav>
                                </div>
                                
                            </div>
                            <div class="d-flex justify-content-center">
                                <form action="<?=url("/admin/propagandas")?>" method="POST">
                                    <div class="content_search">
                                            <input type="text" name="s" value="<?= $search; ?>" class="search_input" placeholder="Buscar categoria...">
                                            <button class="icon_search"><i class="bi bi-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <?php if(!$listAds):?>
                                            <div class="message info icon-info">Ainda não existem propagandas cadastradas.</div>
                                        <?php else:?>
                                            <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Email</th>
                                                    <th>Imagem</th>
                    
                                                    <th>Status</th>
                                                    <th>Criado</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($listAds as $ads):?>
                                                    <tr>
                                                        <td><?=$ads->name?></td>
                                                        <td><?=$ads->email?></td>
                                                        <td>
                                                            <a href="<?=url("/storage/{$ads->image}")?>" target="_blank"><button class="btn button_purple" title="Ver imagem"><i class="bi bi-image"></i> </button></a>
                                                            <a href="<?=$ads->link?>" target="_blank"><button class="btn btn-primary" title="Página onde será redirecionado"><i class="bi bi-grid-1x2-fill"></i> </button></a>
                                                        </td>

                                                        
                                                        <td>
                                                            <?= ($ads->status == 0) ? '<a href='.url('/admin/publicar-propaganda/'.$ads->id).'><span class="badge bg-danger">Inativa</span></a>' : '<a href='.url('/admin/privar-propaganda/'.$ads->id).'><span class="badge bg-success">Ativa</span></a>'; ?>
                                                        </td>
                                                        <td><?=date_fmt_br($ads->created_at)?></td>
                                                        <td class="actions"><a href="<?=url("/admin/atualizar-propaganda/{$ads->id}")?>"><i class="bi bi-pencil-fill blue_color"></i></a>  <a href="#" class="modalDelete deleteModal" id="<?=$ads->id?>"><i class="bi bi-trash-fill red_color"></i></a> </td>
                                                        
                                                    </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table>
                                        <?php endif;?>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>

    <!-- MODAIS -->
    <!-- DELETE NEWS  -->
    <div id="modalDelete" class="modal-container ">
        <div class="modal-content modal-smaller">
            <button class="fechar">X</button>
            <h4 class="subtitulo">Tem certeza que deseja deletar essa propaganda?</h4>
            <p class="text-center font-bold">Essa ação não poderá ser desfeita</p>
           
            <form action="<?=url("/admin/deletar-propaganda")?>" method="POST">
                <fieldset class="fieldset_model">
                    <input type="hidden" name="idAds" class="inputID">
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