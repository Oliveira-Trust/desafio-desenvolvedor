export default function getCurrency (data) {
  switch (data) {
    case "USD":
      return "U$";
    case "BRL":
      return "R$";
    case "EUR":
      return "€";
  }
}