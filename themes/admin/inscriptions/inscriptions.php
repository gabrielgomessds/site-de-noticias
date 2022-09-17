<?php $v->layout('_theme')?>

            <div class="page-heading">
                <div class="page-title">
                    
                </div>
                <section class="section">

                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="row p-5 ps-4 pb-0">
                                <div class="col-12 col-md-6 order-md-2 order-last">
                                    <h3>Inscrições - Total: <?=$countInscriptions?></h3>
                                </div>
                             </div>
                             <div class="d-flex justify-content-center">
                                <form action="<?=url("/admin/inscricoes")?>" method="POST">
                                    <div class="content_search">
                                            <input type="text" name="s" value="<?= $search; ?>" class="search_input" placeholder="Buscar inscrição...">
                                            <button class="icon_search"><i class="bi bi-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Inscrito</th>
                                                    <th>Status</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($listInscriptions as $inscription):?>
                                                    <tr>
                                                   
                                                    <td><?=$inscription->email?></td>
                                                    <td><?=date_fmt_br($inscription->created_at)?></td>
                                                    <td>
                                                        <?=($inscription->status == 1) ? '<a href="'.url("/admin/desativar-inscricao/{$inscription->id}").'" title="Desativar inscrição"><span class="badge bg-success">Ativa</span></a>' : '<a href="'.url("/admin/ativar-inscricao/{$inscription->id}").'" title="Ativar inscrição"><span class="badge bg-danger">Inativo</span></a>' ?>
                                                    </td>
                                                    <td class="actions">
                                                        <a href="#" class="modalDelete deleteModal" id="<?=$inscription->id?>"><i class="bi bi-trash-fill red_color"></i></a> 
                                                    </td>
                                                    
                                                </tr>
                                                <?php endforeach;?>
                                                
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <?=$paginator?>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>

    <!-- MODAIS -->
    <div id="modalDelete" class="modal-container ">
        <div class="modal-content modal-smaller">
            <button class="fechar">X</button>
            <h4 class="subtitulo">Tem certeza que deseja deletar essa inscrição?</h4>
            <p class="text-center font-bold">Essa ação não poderá ser desfeita</p>

            <form action="<?=url("/admin/deletar-inscricao")?>" method="POST">
                <fieldset class="fieldset_model">
                    <input type="hidden" name="idInsc" class="inputID">
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