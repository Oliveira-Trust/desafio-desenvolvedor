require('./bootstrap');

document.addEventListener('click', function (event) {
    const btn = document.querySelector('#master');
    if (!event.target.matches('#master')) return;

    if(btn.checked){
        for(var i = 0; i < document.getElementsByClassName("sub_chk").length; i++){
            document.getElementsByClassName("sub_chk")[i].checked = true;
        }
    }else{
        for(var i = 0; i < document.getElementsByClassName("sub_chk").length; i++){
            document.getElementsByClassName("sub_chk")[i].checked = false;
        }
    }
});

const delet = document.querySelector('.delete_all');
delet.addEventListener('click', function (event) {
    var allVals = [];
    const sub = document.getElementsByClassName("sub_chk");
    for(let i = 0; i < sub.length; i++){
        if(sub[i].checked == true){
            allVals.push(sub[i].getAttribute("data-id"));
        }
    }
    if(allVals.length <=0)
    {
        alert("Selecione ao menos uma linha!");
    }  else {


        var check = confirm("Você tem certeza que quer deletar esse(s) registro(s)?");
        const csrf = document.getElementsByName("csrf-token")[0].getAttribute("content");
        if(check == true){

            axios.delete(delet.getAttribute("data-url"),{
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                data: {
                    ids: allVals
                }
            }).then(function (response) {
                alert(response.data.status);
                location.reload();
            });

        }
    }
});
