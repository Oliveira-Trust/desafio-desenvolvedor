function fetchData(params = '', page = 1) {

    const urlParams = new URL(window.location.href);

    const baseUrl = `/api/arquivo/historico`;
    const url = params ? `${baseUrl}?${params}` : `${baseUrl}?page=${page}`;

    fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        }
    })
        .then(response => response.json())
        .then(data => {
            const fileList = document.getElementById('fileList');
            const pagination = document.getElementById('pagination');
            fileList.innerHTML = '';
            pagination.innerHTML = '';

            if (data.data.length > 0) {
                data.data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td class="border px-4 py-2">${item.nome_arquivo}</td>
                    <td class="border px-4 py-2">${new Date(item.created_at).toLocaleDateString()}</td>
                    <td class="border text-center px-4 py-2"><a href="/conteudo-arquivo/${item.arquivo_id}"><strong>Ver Conteúdo</strong></a></td>
                `;
                    fileList.appendChild(row);
                });
            } else {
                fileList.innerHTML = '<tr><td colspan="6" class="border px-4 py-2 text-center">Nenhum dado encontrado</td></tr>';
            }

            const paginationContainer = document.createElement('nav');
            paginationContainer.className = 'flex justify-center mt-4';

            const ul = document.createElement('ul');
            ul.className = 'flex space-x-1';

            if (data.meta.links.prev) {
                const prevItem = document.createElement('li');
                const prevLink = document.createElement('a');
                prevLink.href = '#';
                prevLink.textContent = 'Anterior';
                prevLink.className = 'px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600';
                prevLink.addEventListener('click', (event) => {
                    event.preventDefault();
                    fetchData(params, data.meta.current_page - 1);
                });
                prevItem.appendChild(prevLink);
                ul.appendChild(prevItem);
            }

            data.meta.links.forEach(link => {
                if (link.url) {
                    const pageItem = document.createElement('li');
                    const pageLink = document.createElement('a');
                    pageLink.href = '#';
                    pageLink.textContent = link.label;
                    pageLink.className = link.active ? 'px-4 py-2 text-sm font-semibold text-blue-600' : 'px-4 py-2 text-sm text-gray-600 hover:bg-gray-200';

                    pageLink.addEventListener('click', (event) => {
                        event.preventDefault();
                        const pageNumber = link.url.split('page=')[1];
                        fetchData(params, pageNumber);
                    });

                    pageItem.appendChild(pageLink);
                    ul.appendChild(pageItem);
                } else {
                    const ellipsisItem = document.createElement('li');
                    ellipsisItem.innerHTML = '<span class="px-4 py-2 text-sm text-gray-400">...</span>';
                    ul.appendChild(ellipsisItem);
                }
            });

            if (data.meta.links.next) {
                const nextItem = document.createElement('li');
                const nextLink = document.createElement('a');
                nextLink.href = '#';
                nextLink.textContent = 'Próximo';
                nextLink.className = 'px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600';
                nextLink.addEventListener('click', (event) => {
                    event.preventDefault();
                    fetchData(params, data.meta.current_page + 1);
                });
                nextItem.appendChild(nextLink);
                ul.appendChild(nextItem);
            }

            paginationContainer.appendChild(ul);
            pagination.appendChild(paginationContainer);
        })
        .catch(error => {
            console.error('Erro ao buscar os dados:', error);
        });
}

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const termo = urlParams.get('termo');
    const tipo = urlParams.get('tipo');

    const params = new URLSearchParams();
    if (termo && tipo) {
        params.append('termo', termo);
        params.append('tipo', tipo);
    }

    fetchData(params.toString());
});

document.getElementById('searchForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);
    const params = new URLSearchParams();

    formData.forEach((value, key) => {
        if (value) {
            params.append(key, value);
        }
    });

    fetchData(params.toString());
});
