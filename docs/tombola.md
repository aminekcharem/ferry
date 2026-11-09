# Popup / Tombola

Le module se trouve dans **Backoffice → Popup / Tombola** (`/backoffice/tombola`), uniquement pour les administrateurs. Il est désactivé lors de l’installation.

## Mise en service

1. Appliquer les migrations : `php artisan migrate --force`.
2. Construire les assets : `npm run build`.
3. Configurer le transport email Laravel dans l’environnement du serveur.
4. Démarrer et superviser un worker : `php artisan queue:work database --tries=3 --timeout=60`.
5. Saisir le début et la fin en heure allemande et activer la campagne dans le backoffice.

Les emails utilisent volontairement la file **database**, même si une autre connexion de file est définie par défaut. Garder `DB_QUEUE_CONNECTION` vide pour que la table `jobs` et les participations utilisent la même connexion et la même transaction. Aucun email n’est envoyé dans la requête du visiteur. Après un déploiement, redémarrer les workers avec `php artisan queue:restart`.

Le backoffice indique les emails en attente, envoyés, en nouvelle tentative ou en échec. Le job effectue trois tentatives. Après correction d’une panne SMTP, les jobs définitivement échoués peuvent être relancés avec les outils Laravel (`queue:failed`, puis `queue:retry <id>`).

## Règles

- Cycle global : dix pertes, un gain de 20 %, dix pertes, un gain de 30 %, puis répétition. Le résultat est calculé sur le serveur ; les secteurs visuels ne représentent pas des probabilités égales.
- Planning : début inclus et fin exclue, fuseau `Europe/Berlin`, stockage UTC. L’heure inexistante du passage à l’heure d’été est refusée. Pour l’heure répétée à l’automne, la seconde occurrence (heure d’hiver) est utilisée.
- Les quatre coordonnées sont obligatoires. L’email est nettoyé et passé en minuscules ; le téléphone est normalisé sans espaces ni ponctuation, avec préfixes `+` et `00` équivalents. Le formulaire demande l’indicatif pays.
- Délai de 24 heures glissantes par identifiant de navigateur **ou** email **ou** téléphone. Le verrou de campagne sérialise la vérification et l’écriture, y compris pour des requêtes simultanées.
- La réinitialisation incrémente une génération de délais, garde tout l’historique et le cycle, et conserve la date et l’administrateur de l’action. Les pages déjà ouvertes doivent être rechargées pour afficher le formulaire après réinitialisation.
- Modifier les dates ou désactiver/réactiver la campagne ne remet aucun compteur à zéro.
- Aucun code promo et aucune réduction automatique sur la réservation. L’équipe retrouve le gain avec les coordonnées du participant.

## Navigateur et iframe

La popup n’est montée que sur les réservations, en anglais, français et allemand, avec ou sans `embed=1`. Elle reste dans les limites de l’iframe ; l’intégration doit laisser assez de hauteur et autoriser les scripts ainsi qu’une origine exploitable (`allow-scripts allow-same-origin` si un attribut `sandbox` est utilisé).

Les endpoints JSON `/api/tombola/status`, `/api/tombola/spin` et `/api/tombola/result` ne dépendent pas de la session Laravel ni des cookies tiers. Les actions utilisent un jeton chiffré et authentifié, lié à l’identifiant du navigateur, valable deux heures. Aucun accès interorigine supplémentaire n’est ouvert : le JavaScript embarqué appelle son propre domaine.

Le navigateur conserve son identifiant dans `localStorage`, la fermeture dans `sessionStorage`, et une requête en cours jusqu’à confirmation du résultat. Cette requête permet une reprise avec la même clé d’idempotence après interruption réseau. Si tout stockage local est interdit, un message demande son autorisation et aucun tirage n’est lancé. Un stockage partitionné par site intégrateur peut produire plusieurs identifiants ; le contrôle des coordonnées reste commun.

Il ne s’agit pas d’une identification matérielle : changement de navigateur ou effacement du stockage peuvent changer l’identifiant. Aucun fingerprint matériel n’est collecté.

## Vérifications

- PHP : `php vendor/phpunit/phpunit/phpunit`
- JavaScript : `node --test tests/Frontend/tombola.test.mjs`
- Concurrence MySQL : `php tests/Integration/tombola-concurrency.php`
- Build : `npm run build`

Le contrôle de concurrence utilise la connexion MySQL locale pour créer une base temporaire au nom aléatoire `tombola_test_<hex>`, lance plusieurs processus indépendants et supprime uniquement cette base à la fin. Il exige les droits de création et suppression de cette base ; il ne modifie pas les tables de l’application.

Vérifier visuellement les largeurs 320, 767, 768, 1023 et 1024 pixels, les trois langues, le clavier, la réduction des animations, les erreurs, les chargements et une iframe avec cookies tiers bloqués avant publication.
