[LARAVEL__BADGE]: https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white
[JAVASCRIPT__BADGE]: https://img.shields.io/badge/Javascript-000?style=for-the-badge&logo=javascript
[HTML5__BADGE]: https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white
[CSS3__BADGE]: https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white
[PROJECT__BADGE]: https://img.shields.io/badge/📱Visit_this_project-000?style=for-the-badge&logo=project
[PROJECT__URL]: https://sjceducacional.byissa.tech

<h1 align="center" style="font-weight: bold;">🏫 SJC Educacional — School Management System</h1>

![Preview do site](https://sjceducacional.byissa.tech/site/images/preview.png)

![Laravel][LARAVEL__BADGE] ![JavaScript][JAVASCRIPT__BADGE] ![HTML5][HTML5__BADGE] ![CSS3][CSS3__BADGE]

<p align="center">
  <a href="#about">About</a> •
  <a href="#features">Features</a> •
  <a href="#started">Getting Started</a> •
  <a href="#routes">App Routes</a>
</p>

<h2 id="about">📌 About</h2>

<p>
SJC Educacional is a school management platform developed to support municipalities in organizing their public education system. It can also be adapted for private institutions. With modules covering administrative management, student records, class diaries, transportation, library, inventory and school calendar, the system offers a complete and scalable solution for school operations.
</p>

<p>
Developed using Laravel and Blade, the system ensures modularity, flexibility, and maintainability. It includes dynamic filtering, permission control, document storage, calendar events, reporting tools, and more. Designed for usability and reliability, SJC Educacional promotes transparency, organization, and efficiency in educational management.
</p>

[![project][PROJECT__BADGE]][PROJECT__URL]

<h2 id="features">✨ Features</h2>

<ul>
  <li>Role-based user management with hierarchical access levels</li>
  <li>Multi-institution support (public and private)</li>
  <li>Professional, student, class, and school year management</li>
  <li>Class assignment, transfers, re-enrollment, and attendance control</li>
  <li>Curriculum planning, grading, and content tracking with BNCC and local standards</li>
  <li>School transportation system with vehicles, routes, and drivers</li>
  <li>Integrated library management: books, users, loans and returns</li>
  <li>Inventory and supply tracking through warehouse and requisition modules</li>
  <li>Interactive academic calendar with color-coded tasks and categories</li>
  <li>Dynamic reports with export options and performance visualizations</li>
  <li>Responsive layout optimized for all screen sizes</li>
</ul>

<h2 id="started">🚀 Getting Started</h2>

<h3>Prerequisites</h3>

- PHP 8.1+
- Composer
- MySQL 5.7+

<h3>Steps</h3>

```bash
# Clone the repository
git clone https://github.com/issagomesdev/sjc-educacional.git

# Access the project folder
cd sjc-educacional

# Install dependencies
composer install

# Copy the .env file
cp .env.example .env

# Generate the app key
php artisan key:generate

# Import the database
# Go to the "database/db" folder and import the "db.sql" file into your database.

# Configure your .env variables

# Link storage
php artisan storage:link

# Run the server
php artisan serve

# Access the system and login with:
# Email: admin@admin.com
# Password: password

```

<h2 id="routes">📍 Application Routes</h2>

Below is the full list of application routes, organized by module.

---

### 1. Secretary Management

| Route                                       | Description                                              |
|--------------------------------------------|----------------------------------------------------------|
| <kbd>/admin/roles</kbd>                    | Manage user roles and permissions                        |
| <kbd>/admin/types</kbd>                    | Configure user access types                              |
| <kbd>/admin/users</kbd>                    | Register and manage system users                         |
| <kbd>/admin/teams</kbd>                    | Manage educational institutions                          |
| <kbd>/admin/team-types</kbd>               | Define and manage institution types                      |
| <kbd>/admin/profissionais</kbd>            | Register and manage education professionals              |
| <kbd>/admin/tipo-de-profissionals</kbd>    | Manage professional categories                           |
| <kbd>/admin/instalars</kbd>                | Assign professionals to institutions                     |
| <kbd>/admin/deslocars</kbd>                | Transfer professionals between institutions              |
| <kbd>/admin/materia</kbd>                  | Manage school subjects                                   |
| <kbd>/admin/abrir-e-encerrar-ano-letivos</kbd> | Open or close academic years                         |
| <kbd>/admin/user-alerts</kbd>              | Create and manage announcements/alerts                   |
| <kbd>/admin/audit-logs</kbd>               | System activity audit log                                |

---

### 2. School Management

| Route                                 | Description                                             |
|--------------------------------------|---------------------------------------------------------|
| <kbd>/admin/cadastros</kbd>          | Student registration and data management                |
| <kbd>/admin/turmas</kbd>             | Manage class groups                                     |
| <kbd>/admin/vagas</kbd>              | Define available seats per class                        |
| <kbd>/admin/enturmacao</kbd>         | Assign students to classes                              |
| <kbd>/admin/transferencia</kbd>      | Manage student transfers                                |
| <kbd>/admin/rematriculas</kbd>       | Process student reenrollments                           |
| <kbd>/admin/dispensas</kbd>          | Manage class/discipline exemptions                      |
| <kbd>/admin/semaulas</kbd>           | Register suspension of school activities                |
| <kbd>/admin/documentos</kbd>         | Upload and manage institutional documents               |

---

### 3. Class Diary

| Route                                           | Description                                              |
|------------------------------------------------|----------------------------------------------------------|
| <kbd>/admin/presenca-eletivas</kbd>            | Record and view student attendance                       |
| <kbd>/admin/nota</kbd>                         | Input and manage student grades                          |
| <kbd>/admin/bnccs</kbd>                        | Manage BNCC-based learning objectives                    |
| <kbd>/admin/curriculo-de-pernambucos</kbd>     | Manage Pernambuco state curriculum content               |
| <kbd>/admin/planejamento-bimestrals</kbd>      | Register bimonthly class plans                           |
| <kbd>/admin/aulas/propostas</kbd>              | Submit and evaluate lesson proposals                     |
| <kbd>/admin/banco-de-aulas</kbd>               | Approved lessons bank                                    |
| <kbd>/admin/quadro-de-horarios</kbd>           | Manage weekly class schedules                            |
| <kbd>/admin/boletins</kbd>                     | Generate student report cards                            |

---

### 4. School Transportation

| Route                                  | Description                                           |
|---------------------------------------|-------------------------------------------------------|
| <kbd>/admin/cadastrarveiculos</kbd>   | Register and manage school transport vehicles         |
| <kbd>/admin/cadastrar-motorista</kbd> | Register and manage drivers                           |
| <kbd>/admin/rota</kbd>                | Configure transport routes                            |

---

### 5. Library

| Route                                           | Description                                           |
|------------------------------------------------|-------------------------------------------------------|
| <kbd>/admin/cadastrar-bibliotecas</kbd>        | Manage library branches                               |
| <kbd>/admin/cadastrar-livros</kbd>             | Register library books                                |
| <kbd>/admin/usuarios-da-bibliotecas</kbd>      | Register library users                                |
| <kbd>/admin/emprestimos-e-devolucos</kbd>      | Manage book loans and returns                         |

---

### 6. Warehouse (Inventory)

| Route                                           | Description                                           |
|------------------------------------------------|-------------------------------------------------------|
| <kbd>/admin/fornecedores</kbd>                 | Register product suppliers                            |
| <kbd>/admin/requisitantes</kbd>                | Register requisitioners                               |
| <kbd>/admin/estoques</kbd>                     | Manage inventory warehouses                           |
| <kbd>/admin/categorias-de-produtos</kbd>       | Define product categories                             |
| <kbd>/admin/produtos</kbd>                     | Register and manage products                          |
| <kbd>/admin/entrada-no-estoques</kbd>          | Register product entries                              |
| <kbd>/admin/saida-no-estoques</kbd>            | Register product outputs                              |
| <kbd>/admin/requisicos</kbd>                   | Manage product requisitions                           |
| <kbd>/admin/pedidos-de-compras</kbd>           | Manage purchase orders                                |

---

### 7. Calendar

| Route                                | Description                                           |
|-------------------------------------|-------------------------------------------------------|
| <kbd>/admin/tasks-calendars</kbd>   | Interactive calendar with events                     |
| <kbd>/task-statuses</kbd>           | Define task progress statuses                        |
| <kbd>/admin/task-tags</kbd>         | Define calendar categories                           |
| <kbd>/admin/tasks</kbd>             | Manage and schedule calendar events                  |

---

### 8. Reports

| Route                                                         | Description                                             |
|--------------------------------------------------------------|---------------------------------------------------------|
| <kbd>/admin/reports/usuários</kbd>                           | Report of registered users                              |
| <kbd>/admin/reports/teams</kbd>                              | Report of registered institutions                       |
| <kbd>/admin/reports/profissionais</kbd>                      | Report of professionals                                 |
| <kbd>/admin/reports/estudantes</kbd>                         | Report of students                                      |
| <kbd>/admin/reports/turmas</kbd>                             | Report of class groups                                  |
| <kbd>/admin/reports/desempenho</kbd>                         | Student academic performance                            |
| <kbd>/admin/relatorios-da-bibliotecas/livros</kbd>           | Library book reports                                    |
| <kbd>/admin/relatorios-da-bibliotecas/users</kbd>            | Library users reports                                   |
| <kbd>/admin/relatorios-da-bibliotecas/empréstimos</kbd>      | Book loan reports                                       |
| <kbd>/admin/relatorios-do-almoxarifados/fornecedores</kbd>   | Supplier reports                                        |
| <kbd>/admin/relatorios-do-almoxarifados/requisitantes</kbd>  | Requisitioner reports                                   |
| <kbd>/admin/relatorios-do-almoxarifados/estoques</kbd>       | Inventory reports                                       |
| <kbd>/admin/relatorios-do-almoxarifados/produtos</kbd>       | Product reports                                         |
| <kbd>/admin/relatorios-do-almoxarifados/entrada-no-estoques</kbd> | Stock entry reports                               |
| <kbd>/admin/relatorios-do-almoxarifados/saida-no-estoques</kbd>  | Stock output reports                              |
| <kbd>/admin/relatorios-do-almoxarifados/requisicoes</kbd>    | Requisition reports                                     |
| <kbd>/admin/relatorios-do-almoxarifados/pedidos-de-compras</kbd> | Purchase order reports                           |
