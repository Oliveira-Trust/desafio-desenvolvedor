# API Conversor de Moedas

Tarefas:
    1 - Criar Aplicação com Laravel
        1 - Aplicação deve ficar dentro do repositório, nomeado como "conversor-moedas".
        2 - Configurar conforme documentação.

    2 - Adicionar Breeze API
        1 - Adicionar StarterKit "Laravel Breeze" com pacote API.
        2 - Adicionar Front em NuxtJS.

    3 - Implementar migrations para DB:
        1 - Adicionar tabela "users"(default laravel apps).
        2 - Adicionar tabela "coins"(id, name, enabled, timestamps).
        3 - Adicionar tabela "coin_value_dates"(id, coin_id, value, date(Y-m-d)).
        4 - Adicionar tabela "conversions"(id, user_id, coin_id, value, timestamps).