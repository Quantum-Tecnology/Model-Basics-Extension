# CHANGE LOG

## V2.3.3 (09/06/2025)

# PT-BR

- Ajustado um problema pendente. @GustavoSantarosa

# EN

- Adjusted a pending issue. @GustavoSantarosa

## V2.3.2 (09/06/2025)

# PT-BR

- Finalizado um helper para cache custom, tanto para salvar quanto para remover. @GustavoSantarosa

# EN

- Completed a helper for custom cache, both for saving and removing. @GustavoSantarosa

## V2.3.1 (07/06/2025)

# PT-BR

- Criado um observer para disparar events no laravel. @GustavoSantarosa

# EN

- Created an observer to remove cache according to the observed model. @GustavoSantarosa
- Observing that there was no generic way to save custom cache in the database, a helper was created to do this generically. @GustavoSantarosa
- Started the outline of an observer that triggers notifications. @GustavoSantarosa
- Created an observer to trigger events in Laravel. @GustavoSantarosa

## V2.3.0 (07/06/2025)

# PT-BR

- Criado um observer para remover cache de acordo com a model observada. @GustavoSantarosa
- Observando que nao existia uma forma generica de salvar cache custom em database, foi criado um helper que faz isso de forma generica. @GustavoSantarosa
- Iniciado o esboço de um observer que dispara notificação. @GustavoSantarosa

# EN

- Created an observer to remove cache according to the observed model. @GustavoSantarosa
- Observing that there was no generic way to save custom cache in the database, a helper was created to do this generically. @GustavoSantarosa
- Started the outline of an observer that triggers notifications. @GustavoSantarosa

## V2.2.4 (30/05/2025)

# PT-BR

- Ajustado um problema de duplicação, quando era informado um array por params, e o mesmo array era informado no body. @GustavoSantarosa

# EN

- Adjusted a duplication issue when an array was provided in the params, and the same array was provided in the body. @GustavoSantarosa

## V2.2.3 (06/04/2025)

# PT-BR

- Ajustado uma variavel que estava ocasionando bug no delete. @GustavoSantarosa

# EN

- Adjusted a variable that was causing a bug in delete. @GustavoSantarosa

## V2.2.2 (22/03/2025)

# PT-BR

- Removido valores defaults, e ajustado as regras para update e deleting quando nulo @GustavoSantarosa

# EN

- Removed default values, and adjusted the rules for update and delete when null @GustavoSantarosa

## V2.2.1 (18/03/2025)

# PT-BR

- Acrescentado uma verficação de permissão na trait actions, caso o core do app nao o fizer @bhcosta90 in https://github.com/Quantum-Tecnology/Model-Basics-Extension/pull/1

# EN

- Added a permission check in the actions trait, in case the app core does not do it @bhcosta90 in https://github.com/Quantum-Tecnology/Model-Basics-Extension/pull/1

## V2.2.0 (18/03/2025)

# PT-BR

- Adicionado verificação de bool, parametro para ignorar params e habilitar filtros que venham da requisição @GustavoSantarosa

# EN

- Added boolean verification, parameter to ignore params, and enable filters from the request @GustavoSantarosa

## V2.1.0 (17/03/2025)

# PT-BR

- Movido a trait setSchema de seu repo para este pacote de models @GustavoSantarosa
- Criado uma trait para setar metadados na classe, para facilitar permissoes @bhcosta90

# EN

- Moved the setSchema trait from its repository to this models package @GustavoSantarosa
- Created a trait to set metadata in the class, to facilitate permissions @bhcosta90

## V2.0.6 (10/03/2025)

# PT-BR

- Acrescentado uma validação para checar se a primaryKey na trait IdSetGetChange em casos de por exemplo groupBy @GustavoSantarosa

# EN

- Added a validation to check if the primaryKey is in the IdSetGetChange trait in cases such as groupBy @GustavoSantarosa
