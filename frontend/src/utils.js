export const API_URL = 'http://localhost';
export const API_USERNAME = '';
export const API_PASSWORD = '';

/*

Se você ainda não criou o usuário e senha do seu cliente a ser colocado acima, recomendo
utilizar uma chave WEP de 256-bit para o usuário e de 504-bit para a senha. Esse é um
padrão que eu vi em outras aplicações.

Exemplo:
-> Username: CfCsK2LJ9eeHYJdzvmvSADgwbiDU5S2j
-> Password: zJ;5:FpNS~idi)%{<5vV`EEw@v1Y[-uE&p8;3)m8^w.tMz5%i>~@c,t.r$j05bQ

Bons sites para gerar usuários e senhas:
-> http://www.andrewscompanies.com/tools/wep.asp
-> https://randomkeygen.com

*/

export const formatDocument = (doc = '') => {
  if (doc.length == 11) {
    return `${doc[0]}${doc[1]}${doc[2]}.${doc[3]}${doc[4]}${doc[5]}.${doc[6]}${doc[7]}${doc[8]}-${doc[9]}${doc[10]}`;
  } else if (doc.length == 14) {
    return `${doc[0]}${doc[1]}.${doc[2]}${doc[3]}${doc[4]}.${doc[5]}${doc[6]}${doc[7]}/${doc[8]}${doc[9]}${doc[10]}${doc[11]}-${doc[12]}${doc[13]}`;
  }
  return doc;
}

export const formatPhone = (num = 0) => {
  if (num.length >= 10) {
    num = `(${num.substr(0, 2)}) ${num.substr(2, num.length)}`;
  }
  return `${num.slice(0, -4)}-${num.substr(-4, 4)}`;
}

export const formatDate = (date = '') => {
  const d = date.split('-');
  return `${d[2]}/${d[1]}/${d[0]}`;
}

export const formatMoney = (num = 0) => `R$ ${parseFloat(num).toFixed(2)}`;

export const numericFilter = (str = '') => {
  return str.replace(/[^0-9]/g, '');
}

export const unformatDate = (date = '') => {
  const d = date.split('/');
  if (d.length = 3) return `${d[2]}-${d[1]}-${d[0]}`;
  return date;
}

export const GET = param => {
  let result = null, tmp = [];
  location.search
    .substr(1)
    .split("&")
    .forEach(function (item) {
      tmp = item.split("=");
      if (tmp[0] === param) result = decodeURIComponent(tmp[1]);
    });
  return result;
}