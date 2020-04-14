const translateStatus = status => {
    switch (status) {
      case 'PAID':
        return 'Pago'
      case 'OPEN':
        return 'Aberto'
      case 'CANCELLED':
        return 'Cancelado'
      default:
        return 'Aberto'
    }
  }
export default translateStatus;