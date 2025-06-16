# Woo Armazém para Classe de Envio

O plugin **Woo Armazém para Classe de Envio** permite associar a meta `meta_armazem_nome` dos produtos a classes de envio no WooCommerce. Com isso, é possível mapear diferentes armazéns para diferentes classes de envio, facilitando o controle logístico de sua loja.

## Funcionalidades

- Mapeia armazéns de produtos para classes de envio no WooCommerce.
- Adiciona uma interface de administração no WooCommerce para gerenciar o mapeamento.
- Executa um cron job diário para aplicar as associações de armazém às classes de envio dos produtos.
- Permite a execução manual do processo de associação diretamente na interface de administração.

## Instalação

1. Faça o download do plugin e descompacte o arquivo.
2. Carregue a pasta do plugin na pasta `/wp-content/plugins/` da sua instalação WordPress.
3. Ative o plugin através do painel de administração do WordPress em **Plugins** > **Plugins Instalados**.
4. Após a ativação, você encontrará a opção de configuração do plugin em **WooCommerce** > **Armazém x Envio**.

## Uso

- Ao acessar a página de administração **WooCommerce** > **Armazém x Envio**, você verá uma lista de todos os armazéns identificados nos produtos (baseado no campo `meta_armazem_nome`).
- Para cada armazém, você pode associá-lo a uma classe de envio do WooCommerce.
- O mapeamento será armazenado nas configurações e aplicado aos produtos com a respectiva associação ao armazém.
- Você pode executar o processo manualmente clicando em **Executar Agora**, ou aguardar o cron job diário que será executado automaticamente.

## Configuração de Cron Job

O plugin também configura um cron job para garantir que as associações de armazém para as classes de envio sejam aplicadas automaticamente todos os dias. Caso deseje alterar o intervalo ou desativar o cron job, é possível fazer ajustes diretamente no código.

## Contribuindo

Se você tiver sugestões, melhorias ou correções, fique à vontade para enviar um pull request ou abrir uma issue.

### Licença

Este plugin é licenciado sob a [Licença MIT](LICENSE).
