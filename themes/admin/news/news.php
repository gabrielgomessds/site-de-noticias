<?php $v->layout("_theme") ?>
<div class="page-heading">
    <div class="page-title">

    </div>
    <section class="section">

        <div class="col-12 col-md-12">
            <div class="card">
                <div class="row p-5">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Lista de Noticias - Total: <?= $countNews; ?></h3>

                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <a href="<?= url('/admin/adicionar-noticia') ?>"><button class="btn btn-primary">Adicionar</button> </a>
                        </nav>
                    </div>

                </div>
                <div class="d-flex justify-content-center">
                            <form action="<?=url("/admin/noticias")?>" method="POST">
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
                            <?php if(!$listNews):?>
                                <div class="message info icon-info">Ainda não existem noticias cadastradas.</div>
                            <?php else : ?>
                                <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>Noticia</th>
                                        <th>Autor</th>
                                        <th>Categoria</th>
                                        <th>Clicks</th>
                                        <th>Nivel</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listNews as $news) : ?>
                                        <tr>
                                            <td><?= str_limit_chars($news->title, 38) ?></td>
                                            <td><?= $news->admin()->first_name . " " . $news->admin()->last_name ?></td>
                                            <td><span class="tag_categorie" style="background-color: <?= $news->category()->color; ?>;"><?= $news->category()->name; ?></span></td>
                                            <td class="text-center"><b><?= $news->views ?></b></td>
                                            <td class="text-center"><b><?= $news->position ?></b></td>
                                            <td>
                                                <?= ($news->status == 0) ? '<a href='.url('/admin/publicar-noticia/'.$news->id).'><span class="badge bg-danger">Privada</span></a>' : '<a href='.url('/admin/privar-noticia/'.$news->id).'><span class="badge bg-success">Pública</span></a>'; ?>
                                            </td>
                                            <td class="actions purple_color"><a href="<?= url("/admin/info-noticia/{$news->uri}"); ?>"><i class="bi bi-eye-fill purple_color" title="Ver mais informações"></i></a> <a href="<?= url("/admin/atualizar-noticia/{$news->id}"); ?>"><i class="bi bi-pencil-fill blue_color"></i></a> <a href="#" class="modalDelete deleteModal" id="<?=$news->id?>"><i class="bi bi-trash-fill red_color"></i></a> </td>

                                        </tr>
                                    <?php endforeach; ?>

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

<!-- MODAIS -->
<!-- DELETE NEWS  -->
<div id="modalDelete" class="modal-container ">
    <div class="modal-content modal-smaller">
        <button class="fechar">X</button>
        <h4 class="subtitulo">Tem certeza que deseja deletar essa noticia?</h4>
        <p class="text-center font-bold">Essa ação não poderá ser desfeita</p>

        <form action="<?= url("/admin/deletar-noticia") ?>" method="POST">
            <fieldset class="fieldset_model">
                <input type="hidden" name="idNews" class="inputID">
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

    deleteModal.forEach((e) => {
        e.addEventListener('click', () => {
            inputID.value = e.id
        })
    });
</script>
<?php $v->end("scripts"); ?>