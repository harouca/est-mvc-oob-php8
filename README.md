# Docker Compose LAMP com Apache2 e PHP 8 + PHPMyAdmin
Ambiente LAMP (Linux + Apache + MySQL e PHP) para desenvolvimento de aplicações WEB rápido e simples, sem necessida de todas vez criar os arquivos, sentimos a necessidade de fazer um repositório que estivesse sempre disponível com as configurações e necessidades do que estamos acostumados a desenvolver.
À medida que fomos estudando e desenvolvendo melhor a estrutura dos projetos verificamos que havia brechas de seguranças e falhas de desenvolvimento. Diante disso, o estudo mudou para uma abordagem focada em MVC e separação de dados sensíveis aos locais públicos no provedor de hospedagem do site. Dai a necessidade de reestruturação dos projetos anteriores e adotar esse novo modelo de estudo.
O presente repositório armazena a estrutura conforme citado acima, adaptado para usar a abordagem de Programação Orientada a Objetos (POO) ou em Inglês Objetc Oriented Programming (OOP.)

## ✒️ Autores

* **Humberto Vilar Arouca** - *Trabalho Inicial e idealizador* - [Humberto Vilar Arouca](https://github.com/harouca)

## Status do Projeto
Estamos constantemente em atualização do conteúdo deste projeto. A medida que vamos estudando e conhecendo mais sobre desenvolvimento com uso de ferramentas de containêrs, versionamento e demais funcionalidades, é adicionado a este repositório. Claro, será sempre limitado ao conhecimento adquirido, sendo que com o tempo diminui, partindo pra atualização de versão mais atualizada das tecnologias aplicadas e usadas aqui.
Ficamos satisfeitos em quem quiser fazer sugestão ou participar com conteúdo que possa contribuir.

## 🔨 Funcionalidades

- `Ambiente Docker`: Pensando em desenvolvimento de um sistema que inicialmente tem objetivo de estudo. Houve a necessidade de criar um ambiente já pronto para estar disponível de forma rápida e simples. Então, basicamente basta fazer um `git clone` e subir pelo docker com o comando `docker compose up -d` com adaptações de cada um em seu local.
- `Docker`: Usar contêineres para subir um ambiente de desenvolvimento traz benefícios importantes na produtividade, qualidade, padronização do desenvolvimento, principalmente quando o projeto envolve equipes, além da melhor gestão de infraestrutura de TI.
- `PHP 8`: O uso do PHP 8 (neste momento já na versão 8.3) trouxe, em relação as versões anteriores, melhorias significativas de desempenho, segurança e legibilidade de código. Lembrando que é sempre recomendado o uso da versão mais recente. Entretanto, alguns projetos ainda requerem essa versão de uso no presente projeto. Em outro repositório mantemos a versão com `PHP 7.4` - [Clique aqui](https://github.com/harouca/mod-lamp-php74).
- `MVC`: Estrutura mais modernos adotando o ambiente MVC de sites.

## ✔️ Tecnologias utilizadas

- ``Docker`` - Plataforma como serviço para virtualização de nível de sistema operacional para entregar software em pacotes chamados contêiners.
- ``Visual Studio Code`` - Editor de Código-Fonte desenvolvido pela Microsoft que roda em Windows, Mac e Linux.
- ``PHP 7.4`` - Linguagem de programação interpretada livre, usada para desenvolvimento de aplicações dinâmicas no lado do Servidor.
- ``MySQL`` - Sistema de gerenciamento de banco de dados, que utiliza a linguagem SQL.
- ``PHPMyAdmin`` - Aplicativo web livre e de código aberto desenvolvido em PHP para administração do MySQL e MariaDB pelo navegador.

## 📁 Acesso ao projeto
Você pode acessar os arquivos do projeto clicando [aqui](https://github.com/harouca/mod-lamp-php8). Entretanto, se você está lendo esse conteúdo, provavelmente já chegou ao repositório do projeto. Usualmente torna-se necessário documentar e organizar tudo em TI - DEV pois nunca sabemos como e quando pode ser usado. Em todo caso, tudo está ai disponível.

## 📄 Licença

Este projeto está sob a licença padrão de Copyright. Significa todos os direitos do código-fonte onde ninguém poderá reproduzir, distribuir ou criar derivativos de seu trabalho, salvo sob autorização expressa.

## 🎁 Expressões de gratidão

* Conte a outras pessoas sobre este projeto 📢;
* Convide alguém da equipe para uma cerveja 🍺;
* Um agradecimento publicamente 🫂;

### Referências

- Modelo do README.md, disponível em [Armstrong Lohãns](https://gist.github.com/lohhans).
- Documentação Oficial PHP, disponível em [PHP Docs](https://www.php.net/docs.php).
- Documentação Oficial Docker, disponível em [Docker Docs](https://docs.docker.com/).
- Referências Imagem Oficial PHP, disponível em [Docker Hub PHP](https://hub.docker.com/_/php).
- Referências Imagem Oficial MySQL, disponível em [Docker Hub MySQL](https://hub.docker.com/_/mysql).
- Referências Imagem Oficial PHPMyAdmin, disponível em [Docker Hub PHPMyAdmin](https://hub.docker.com/_/phpmyadmin).