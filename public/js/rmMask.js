//Remove Mask moeda
export const removeMaskMoeda = (value) => {
    value = value.replace(/[^\d,]/g, "");  // remove todos os caracteres não numéricos, exceto as vírgulas
    value = value.replace(",", "");  // remove a vírgula restante
    value = (parseInt(value) / 100);

    return value;
}