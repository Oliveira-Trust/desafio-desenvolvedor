$("#taxa-boleto").mask("000,00", {reverse: true});
$("#taxa-credito").mask("000,00", {reverse: true});
$("#taxa-cond1").mask("000,00", {reverse: true});
$("#taxa-cond2").mask("000,00", {reverse: true});

$("#editar").on("click", (e) => {
    e.preventDefault;
    $("#taxa-boleto").attr("disabled", false);
    $("#taxa-credito").attr("disabled", false);
    $("#taxa-cond1").attr("disabled", false);
    $("#taxa-cond2").attr("disabled", false);
    $(".editar").hide();
    $(".salvar").show();
});

$("#taxa-boleto, #taxa-credito, #taxa-cond1, #taxa-cond2").on("change", () => {
    console.log("Algo alterou");
    $("#salvar").attr("disabled", false);
});