$(document).on('click', '.callDataView', function () {
    var dataId = $(this).attr("id")
    var url_client = $(this).attr('data-url')
    if(dataId !== ""){
        var dados_client = {
            dataId: dataId
        };
        $.get(url_client+'/admin/contactAllData/'+dataId, dados_client, function(retorna){
            $("#templateDataView").html(retorna)

        })
    }
})