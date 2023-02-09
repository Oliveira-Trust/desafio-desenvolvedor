//Mask moeda real
const maskCoin = (o, f) => {
    setTimeout(function () {
        var v = mCoin(o.value);
        if (v != o.value) {
            o.value = v;
        }
    }, 1);
}
//Regex
const mCoin = (v) => {
    var r = v.replace(/\D/g, "");

    r = (r / 100).toFixed(2) + '';
    r = r.replace(".", ",");
    r = r.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    return r;
}


/**
 * Limpa a borda de um elemento HTML
 * @param {HTMLElement} element - Elemento HTML que terá a borda limpa
 */
function clearBorder(element) {
    element.style.cssText = 'border: #dee2e6 solid 1px !important';
}