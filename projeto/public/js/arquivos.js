let currentPage = 1;
const perPage = 15;

document.addEventListener('DOMContentLoaded', async () => {
    await loadFiles(currentPage);
});

async function loadFiles(page) {
    try {
        const response = await fetch(`/api/arquivo/lista?page=${page}`);

        if (!response.ok) {
            console.error('Erro ao buscar arquivos:', response.statusText);
            return;
        }

        const result = await response.json();
        const files = result.data;
        const fileList = document.getElementById('fileList');
        const pagination = document.getElementById('pagination');
        fileList.innerHTML = ''; // Limpa resultados anteriores
        pagination.innerHTML = ''; // Limpa links de paginação anteriores

        // Preenche a tabela com os arquivos
        files.forEach(file => {
            console.log(file)
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="border px-4 py-2">${file.nome}</td>
                <td class="border px-4 py-2">${new Date(file.created_at).toLocaleDateString()}</td>
                <td class="border px-4 py-2"><a href="/conteudo-arquivo/${file.id}">Clique aqui</a></td>
            `;
            fileList.appendChild(row);
        });

        // Cria os links de paginação
        createPagination(result);
    } catch (error) {
        console.error('Erro ao carregar arquivos:', error);
    }
}

function createPagination(result) {
    const pagination = document.getElementById('pagination');

    // Link para a página anterior
    if (result.prev_page_url) {
        const prevButton = document.createElement('a');
        prevButton.href = "#";
        prevButton.innerHTML = "&laquo; Previous";
        prevButton.className = "text-blue-500 hover:underline mr-2";
        prevButton.addEventListener('click', () => {
            currentPage--;
            loadFiles(currentPage);
        });
        pagination.appendChild(prevButton);
    }

    // Links para as páginas
    result.links.forEach(link => {
        if (link.url) {
            const pageButton = document.createElement('a');
            pageButton.href = "#";
            pageButton.innerHTML = link.label;
            pageButton.className = `text-blue-500 hover:underline mx-1 ${link.active ? 'font-bold' : ''}`;
            pageButton.addEventListener('click', () => {
                currentPage = parseInt(link.label);
                loadFiles(currentPage);
            });
            pagination.appendChild(pageButton);
        } else if (link.label === "Next &raquo;") {
            const nextButton = document.createElement('a');
            nextButton.href = "#";
            nextButton.innerHTML = link.label;
            nextButton.className = "text-blue-500 hover:underline ml-2";
            nextButton.addEventListener('click', () => {
                currentPage++;
                loadFiles(currentPage);
            });
            pagination.appendChild(nextButton);
        }
    });
}
