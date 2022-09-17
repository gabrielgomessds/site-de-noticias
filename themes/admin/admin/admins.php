<?php $v->layout("_theme")?>

            <div class="page-heading">
                <div class="page-title">
                    
                </div>
                <section class="section">

                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="row p-5">
                                <div class="col-12 col-md-6 order-md-1 order-last">
                                    <h3>Lista de Admins - Total: <?= $countAdmins ;?></h3>
                                   
                                </div>
                                <div class="col-12 col-md-6 order-md-2 order-first">
                                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                       <a href="<?=url("/admin/adicionar-admin")?>"><button class="btn btn-primary">Adicionar</button></a>    
                                    </nav>
                                </div>
                                
                            </div>
                            <div class="d-flex justify-content-center">
                            <form action="<?=url("/admin/lista-admins")?>" method="POST">
                                <div class="content_search">
                                        <input type="text" name="s" value="<?= $search; ?>" class="search_input" placeholder="Buscar admin...">
                                        <button class="icon_search"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                    <?php if (!$listAdmins) : ?>
                                        <div class="message info icon-info">Ainda não existem admins cadastrados.</div>
                                    <?php else : ?>
                                    
                                        <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Email</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($listAdmins as $admin):?>
                                                    <tr>
                                                        <td><?=$admin->first_name?> <?=$admin->last_name?></td>
                                                        <td><?=$admin->email?></td>
                                                        <td class="actions"> <a href="<?=url("/admin/atualizar-admin/{$admin->id}")?>"><i class="bi bi-pencil-fill blue_color"></i></a>  <a href="#" class="modalDelete deleteModal" id="<?=$admin->id?>"><i class="bi bi-trash-fill red_color"></i></a> </td>
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
            <h4 class="subtitulo">Tem certeza que deseja deletar esse admin?</h4>
            <p class="text-center font-bold">Essa ação não poderá ser desfeita</p>
           
            <form action="<?=url("/admin/deletar-admin")?>" method="POST">
                <fieldset class="fieldset_model">
                    <input type="hidden" name="idAdmin" class="inputID">
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
