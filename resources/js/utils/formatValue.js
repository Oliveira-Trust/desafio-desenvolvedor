export function formatValue(value) {
    return new Intl.NumberFormat('en-us', {
        style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2
    }).format(value);
}
