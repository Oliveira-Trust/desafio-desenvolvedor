export function formatPrice(data) {
  data = data.replace(/\D/g, "");
  data = data.replace(/(\d)(\d{2})$/, "$1,$2");
  data = data.replace(/(?=(\d{3})+(\D))\B/g, ".");

  return data;
};