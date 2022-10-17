
# Stack Docker [Symfony | PGSQL | NGINX | ADMINER


## Démarrer la stack

    docker-compose up -d
    docker-compose down 

> Les commandes Docker sont à effectuer dans le dossier **stack**

### Différents services

**Adminer :** `https://localhost:8080`

**Nginx:** `https://localhost:80`

### Fichier .spells

Ce fichier regroupe l'ensemble des commandes disponibles permettant d’interagir avec nos conteneurs.
Le fichier ***.spells*** est utilisable uniquement sur les environnements Linux.
Pour activer ces commandes : `source .spells`

**Windows** : Recopier les commandes dans un terminal et les exécuter.

Ces commandes permettent donc d'exécuter les commandes [***composer***, ***symfony***, ***php***] directement dans nos conteneurs.



