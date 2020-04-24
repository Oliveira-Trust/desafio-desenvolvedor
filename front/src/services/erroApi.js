

const error =(error)=>{
    if (error.message==="Request failed with status code 401") {
            alert('Faça login novamente  ')
         }else{
             alert("Descupe, houve um erro, em breve tudo estará normalizado")
         }
}

export default error 