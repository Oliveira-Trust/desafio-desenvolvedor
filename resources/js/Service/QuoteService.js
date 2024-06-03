import axios from 'axios';

// Configuração global do Axios
axios.defaults.headers.common['Accept'] = 'application/json';

class QuoteService {
    static async getAvailableCurrencies(token, originCurrency) {
        try {
            // Definir o cabeçalho de autorização
            axios.defaults.headers.common['Authorization'] = `Bearer ${token.replace(/['"]+/g, '')}`;
            
            // Fazer a chamada para a API
            const response = await axios.get(`/api/quote/currencies/${originCurrency}`);
            const convertedJson = Object.keys(response.data.data).map(key => ({
                coin: response.data.data[key],
                abbr: key
              }));
            // Retornar os dados da resposta
            return convertedJson;
        } catch (error) {
            let errorMessage = 'Erro desconhecido na busca pelas moedas autorizadas.';
            
            // Verificar o tipo de erro e definir a mensagem apropriada
            if (error.response) {
                if (error.response.status === 404) {
                    errorMessage = error.response.data.message || "Desculpe, você não possui permissões para listar as moedas.";
                } else if (error.response.status === 403) {
                    errorMessage = error.response.data.message || "Acesso proibido.";
                } else if (error.response.status === 401) {
                    errorMessage = "Autenticação expirada. Por favor, faça login novamente.";
                } else if (error.response.status === 524) {
                    errorMessage = "A API apresentou um erro ao realizar a busca. Entre em contato com a equipe técnica.";
                }
            }
            
            // Lançar o erro com a mensagem definida
            throw new Error(errorMessage);
        }
    }

    static async getQuoteHistory(token, currentPage, perPage, sortBy) {
        try {
            const sortKey = (sortBy && sortBy.length > 0 && sortBy[0].key) || 'created_at';
            const sortOrder = (sortBy && sortBy.length > 0 && sortBy[0].order) || 'desc';
            // Definir o cabeçalho de autorização
            axios.defaults.headers.common['Authorization'] = `Bearer ${token.replace(/['"]+/g, '')}`;
            // Fazer a chamada para a API
            const response = await axios.get('/api/quote/history?page=' + currentPage + '&perPage=' + perPage + '&sortKey=' + sortKey + '&sortOrder=' + sortOrder);
            // Retornar os dados da resposta
            return response.data.data;
        } catch (error) {
            let errorMessage = error.message || 'Erro desconhecido na busca pelo histórico de cotações.';
            
            // Verificar o tipo de erro e definir a mensagem apropriada
            if (error.response) {
                if (error.response.status === 404) {
                    errorMessage = error.response.data.message || "Desculpe, você não possui permissões para visualizar o histórico.";
                } else if (error.response.status === 403) {
                    errorMessage = error.response.data.message || "Acesso proibido.";
                } else if (error.response.status === 401) {
                    errorMessage = "Autenticação expirada. Por favor, faça login novamente.";
                } else if (error.response.status === 524) {
                    errorMessage = "A API apresentou um erro ao realizar a busca. Entre em contato com a equipe técnica.";
                }
            }
            
            // Lançar o erro com a mensagem definida
            throw new Error(errorMessage);
        }
    }

    static async getTaxsConfig(token) {
        try {
            // Definir o cabeçalho de autorização
            axios.defaults.headers.common['Authorization'] = `Bearer ${token.replace(/['"]+/g, '')}`;
            // Fazer a chamada para a API
            const response = await axios.get(`/api/quote/taxes`);
            // Retornar os dados da resposta
            return response.data.data;
        } catch (error) {
            let errorMessage = 'Erro desconhecido na busca pelas taxas do usuario.';
            // Verificar o tipo de erro e definir a mensagem apropriada
            if (error.response) {
                if (error.response.status === 404) {
                    errorMessage = error.response.data.message || "Desculpe, você não possui permissões.";
                } else if (error.response.status === 403) {
                    errorMessage = error.response.data.message || "Acesso proibido.";
                } else if (error.response.status === 401) {
                    errorMessage = "Autenticação expirada. Por favor, faça login novamente.";
                } else if (error.response.status === 524) {
                    errorMessage = "A API apresentou um erro ao realizar a busca. Entre em contato com a equipe técnica.";
                }
            }
            
            // Lançar o erro com a mensagem definida
            throw new Error(errorMessage);
        }
    }

    static async saveTaxConfigs(configs) {
        try {
            this.loading = true;
            // Substitua pelo seu endpoint correto
            const response = await axios.post('/api/quote/changeTax', { configs });
            console.log(response.data.message);
            alert('Configurações salvas com sucesso!');
        } catch (error) {
            this.falha = true;
            this.msg_erro_show = error.message;
            console.error('Erro ao salvar configurações:', error);
        } finally {
            this.loading = false;
        }
    }

    static async generateQuote(token, originCurrency, destinationCurrency, amount, type) {
        try {
            // Definir o cabeçalho de autorização
            axios.defaults.headers.common['Authorization'] = `Bearer ${token.replace(/['"]+/g, '')}`;
            
            // Fazer a chamada para a API
            const response = await axios.post(`/api/quote/generate/${originCurrency}/${destinationCurrency}`, {
                    value: amount.replace('R$', '').replace('.', '').replace(',', '.').trim(),
                    type: type
                });
            return response.data;
        } catch (error) {
            let errorMessage = 'Erro desconhecido ao gerar a cotação.';
            
            // Verificar o tipo de erro e definir a mensagem apropriada
            if (error.response) {
                if (error.response.status === 404) {
                    errorMessage = error.response.data.message || "Desculpe, a cotação não está disponível.";
                } else if (error.response.status === 403) {
                    errorMessage = error.response.data.message || "Acesso proibido para gerar a cotação.";
                } else if (error.response.status === 401) {
                    errorMessage = "Autenticação expirada. Por favor, faça login novamente.";
                } else if (error.response.status === 524) {
                    errorMessage = "A API apresentou um erro ao realizar a busca. Entre em contato com a equipe técnica.";
                }
            }
            
            // Lançar o erro com a mensagem definida
            throw new Error(errorMessage);
        }
    }
}

export default QuoteService;
