// @flow 
import { DataGrid, GridColDef, GridValueFormatterParams } from '@mui/x-data-grid';
import * as React from 'react';

export const TableConvertedValue = (props: any) => {
    const {rows} = props;

    function getPaymentMethod(params: GridValueFormatterParams){

        if(params.value === "BANK_SLIP"){
            return "Boleto Bancário";
        }else{
            return "Cartão de Crédito";
        }
    }

    function getValueFormmatedBRL(params: GridValueFormatterParams){
        return `R$ ${Number(params.value as number).toLocaleString('pt-BR')}`
    }

    const columns: GridColDef[] = [
        { field: 'id', headerName: 'ID', width: 70, align: 'center', headerAlign: "center" },
        { field: 'originCurrency', headerName: 'Moeda de Origem', width: 150, align: 'center' },
        { field: 'convertedCurrency', headerName: 'Moeda de Destino', width: 150, align: 'center' },
        {
          field: 'originValue',
          headerName: 'Valor para Conversão',
          type: 'number',
          width: 180,
          align: 'center',
          valueFormatter: getValueFormmatedBRL
        },
        {
          field: 'paymentMethod',
          headerName: 'Forma de Pagamento',
          width: 180,
          align: 'center',
          valueFormatter: getPaymentMethod
        },
        {
          field: 'taxConversion',
          headerName: 'Taxa de Conversão',
          type: 'number',
          width: 150,
          align: 'center',
          valueFormatter: getValueFormmatedBRL
        },
        {
          field: 'convertedValue',
          headerName: 'Valor Convertido',
          type: 'number',
          width: 150,
          align: 'center'
        },
        {
          field: 'taxPaymentMethod',
          headerName: 'Taxa de Método de Pagamento',
          type: 'number',
          width: 240,
          align: 'center',
          valueFormatter: getValueFormmatedBRL
        },
        {
          field: 'taxCurrency',
          headerName: 'Taxa da Moeda',
          type: 'number',
          width: 130,
          align: 'center',
          valueFormatter: getValueFormmatedBRL
        },
        {
          field: 'updatedValue',
          headerName: 'Valor Total + Descontos',
          type: 'number',
          width: 180,
          align: 'center',
          valueFormatter: getValueFormmatedBRL
        },
      ];

    return (
        <div style={{ marginLeft: "8%", height: 400, width: '83%' }}>
            <DataGrid
                rows={rows}
                columns={columns}
                pageSize={5}
                rowsPerPageOptions={[5]}
                
            />
        </div>
    );
};