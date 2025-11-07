# Teste técnico com Laravel

Recentemente, vi um post no LinkedIn que apresentava um teste técnico de uma empresa para ingresso na mesma. Coincidentemente, o **Laravel 12** havia acabado de ser lançado, então decidi aceitar esse desafio.  
Detalhes do teste técnico podem ser encontrados no link a seguir:
- [Post no LinkedIn](https://www.linkedin.com/posts/d3vlopes_desafio-t%C3%A9cnico-backend-activity-7387095489164492800-3XlO?utm_source=share&utm_medium=member_desktop&rcm=ACoAADJ0Of0BFb7gjsI0n4_g2_Fia_LimiC0fUc)

Em resumo, esse teste técnico consiste na criação de um sistema de enquetes com atualização em tempo real. A única questão é que, para mim, o teste apresentava algumas ausências importantes:
- Ambiente Docker completo com containers para o Laravel, MariaDB e Nginx.
- Sistema de login para identificação dos votantes e criadores de enquetes.
- Adoção de padrões conhecidos do Laravel e boas práticas, como a criação de *services*, por exemplo.

No momento da criação deste README (07/11/2025), o sistema de login e o ambiente Docker já estão configurados, assim como o banco de dados da aplicação, criado por meio das *migrations* do Laravel.

Para rodar o projeto:
```bash
docker compose up
```

Em seguida, entre no container do PHP e execute:
```bash
php artisan migrate
```

para rodar as migrations.

A ideia, após o término deste projeto, é criar um frontend em Vue.js para o consumo dessa API e, futuramente, refazer esse mesmo teste técnico usando outros frameworks backend como Node.js, Spring, etc.

Se você chegou até aqui, não se esqueça de apoiar o projeto deixando uma estrela. Valeu, é nóis! 🤙
