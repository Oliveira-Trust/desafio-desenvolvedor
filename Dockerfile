# ---- Base Stage ----
# Usamos uma imagem base específica e "slim" para garantir reprodutibilidade e um tamanho menor.
FROM python:3.12-slim-bullseye AS base

# Define o diretório de trabalho dentro do contêiner.
WORKDIR /app

# Define variáveis de ambiente para boas práticas com Python em contêineres.
ENV PYTHONUNBUFFERED=1
ENV PYTHONDONTWRITEBYTECODE=1

# ---- Builder Stage ----
# Esta etapa é usada para instalar as dependências.
FROM base AS builder

# Isso aproveita o cache do Docker: se o requirements.txt não mudar,
# o Docker não reinstalará tudo a cada build, tornando-o muito mais rápido.
COPY requirements.txt .

# Instala as dependências. O --no-cache-dir reduz o tamanho da imagem.
RUN pip install --no-cache-dir -r requirements.txt

# ---- Final Stage ----
# Esta é a imagem final que será executada.
FROM base AS final

# Copia as dependências já instaladas da etapa "builder".
COPY --from=builder /usr/local/lib/python3.12/site-packages /usr/local/lib/python3.12/site-packages

#Copia os executáveis
COPY --from=builder /usr/local/bin /usr/local/bin

# Copia o código da aplicação para o diretório de trabalho.
COPY . .

# Prática de segurança: Cria um usuário não-root para rodar a aplicação.
RUN addgroup --system app && adduser --system --group app
USER app

# Expõe a porta que a aplicação usará.
EXPOSE 8000

# O comando para iniciar a aplicação.
# O host 0.0.0.0 é crucial para que a porta seja acessível de fora do contêiner.
CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8000"]
