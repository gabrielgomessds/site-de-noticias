/* Janelas Modais */
  function iniciaModal(modalID){
    const modal = document.getElementById(modalID);
    if(modal){
        modal.classList.add('mostrar');
        modal.addEventListener('click',(e)=>{
        if(e.target.id == modalID || e.target.className == 'fechar' || e.target.className == 'link-button-modal' || e.target.className == 'btn-question btn-no' || e.target.className == 'btn-question btn-yes' || e.target.id == 'btn-vincular' ){
            modal.classList.remove('mostrar');
        }
    });
    }
    
}

const modalView = document.querySelectorAll('.modalView');
modalView.forEach((e) => {
    e.addEventListener('click', function(botao) {
    var contentID = botao.target.id;
    iniciaModal("modalView", contentID);
});
})


const modalDelete = document.querySelectorAll('.modalDelete');
modalDelete.forEach((e) => {
    e.addEventListener('click', function(botao) {
    var contentID = botao.target.id;
    iniciaModal("modalDelete", contentID);
});

})


const viewCategories = document.querySelectorAll('.viewCategories');
viewCategories.forEach((e) => {
    e.addEventListener('click', function(botao) {
    var contentID = botao.target.id;
    iniciaModal("viewCategories", contentID);
});
})

/* TAGS  de CATEGORIAS*/

let tag = document.querySelector('.tag_categorie');
let nameCategoria = document.querySelector('.name_categoria');
let colorTag = document.querySelector('.color_tag');

if(nameCategoria){
    nameCategoria.addEventListener('keyup', ()=>{
        tag.innerHTML = nameCategoria.value
    });
    
    colorTag.addEventListener('change', ()=>{
        tag.style.backgroundColor = colorTag.value
    })
}
