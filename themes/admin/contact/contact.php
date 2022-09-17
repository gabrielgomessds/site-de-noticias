<?php $v->layout("_theme") ?>

<div class="page-heading">
    <div class="page-title">

    </div>
    <section class="section">

        <div class="col-12 col-md-12">
            <div class="card">
                <div class="row p-5">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Lista de Contatos - Total: <?= $countContacts; ?></h3>

                    </div>

                </div>

                <div class="d-flex justify-content-center">
                    <form action="<?=url("/admin/contatos")?>" method="POST">
                        <div class="content_search">
                                <input type="text" name="s" value="<?= $search; ?>" class="search_input" placeholder="Buscar contato...">
                                <button class="icon_search"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <div class="table-responsive">
                            <?php if (!$listContacts) : ?>
                                <div class="message info icon-info">Ainda não existem contatos cadastrados.</div>
                            <?php else : ?>
                                <table class="table table-lg text-center">
                                    <thead>
                                        <tr>
                                            <th>Assunto</th>
                                            <th>Mensagem</th>
                                            <th>Status</th>
                                            <th>Data</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listContacts as $contact) : ?>
                                            <tr>
                                                <td><?= str_limit_words($contact->subject, 5); ?></td>
                                                <td><?= str_limit_words($contact->content, 7); ?></td>
                                                <td>
                                                    <?= ($contact->status == 0) ? '<span class="badge bg-danger">Não Vista</span>' : (($contact->status == 1) ? '<span class="badge bg-warning">Em Analise</span>' : '<span class="badge bg-success">Finalizado</span>') ?>
                                                </td>
                                                <td><?= date_fmt_br($contact->created_at) ?></td>
                                                <td class="actions"><a href="#" class="modalView callDataView" id="<?= $contact->id ?>" data-url="<?= url() ?>"><i class="bi bi-eye-fill purple_color"></i></a> <a href="#" class="modalDelete deleteModal" id="<?=$contact->id?>"><i class="bi bi-trash-fill red_color"></i></a> </td>
                                            </tr>
                                        <?php endforeach; ?>


                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                        <?=$paginator;?>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- MODAIS -->

<div id="modalView" class="modal-container ">
    <div class="modal-content modal-large " id="templateDataView">

    </div>

</div>

<!-- DELETE NEWS  -->
   <!-- DELETE NEWS  -->
    <div id="modalDelete" class="modal-container ">
        <div class="modal-content modal-smaller">
            <button class="fechar">X</button>
            <h4 class="subtitulo">Tem certeza que deseja deletar essa propaganda?</h4>
            <p class="text-center font-bold">Essa ação não poderá ser desfeita</p>
           
            <form action="<?=url("/admin/deletar-contato")?>" method="POST">
                <fieldset class="fieldset_model">
                    <input type="hidden" name="idContact" class="inputID">
                    <input type="hidden" name="action" value="delete">
                    <button class="btn-question btn-no">Confirmar</button> 
                </fieldset>
            </form>

        </div>
    </div>



<?php $v->start('scripts'); ?>
<script src="<?= theme("/assets/js/dataView.js", CONF_VIEW_ADMIN); ?>"></script>

<script type="text/javascript">
            let deleteModal = document.querySelectorAll(".deleteModal");
            let inputID = document.querySelector(".inputID");
            
            deleteModal.forEach((e)=>{
                    e.addEventListener('click', ()=>{
                        inputID.value = e.id
                    })
            });
        </script>

<?php $v->end('scripts'); ?>