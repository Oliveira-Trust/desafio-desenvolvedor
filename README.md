# Currency Exchanger

![Project web interface](https://raw.githubusercontent.com/cristianvuolo/desafio-desenvolvedor/cristian-vuolo-bitencourt/screenshot.png)

## Usage

```bash
docker compose up -d
```

## API
```
[POST] /api/exchange
```

### request body:
```json
{
    "source": "EUR",
    "target": "BRL", 
    "amount": 15994.50, 
    "method":"billet"
}
```

### response:
```json
{
    "source_currency": "EUR",
    "target_currency": "BRL",
    "source_amount": 15994.5,
    "method": "billet",
    "target_value": 5.2158,
    "payment_tax": 231.92,
    "exchange_tax": 159.95,
    "target_amount": 15602.63,
    "target_total": 81380.2,
    "target_prefix": "R$",
    "source_prefix": "€"
}
```

## Development methodology

Based on DRY and KISS principles.
