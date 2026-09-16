# Informatisation de la gestion du fonds documentaire

Projet de mémoire de fin de formation réalisé en Licence Informatique de Gestion.

## Objectif

Concevoir une application web permettant d'informatiser la gestion du fonds documentaire d'une bibliothèque universitaire.

L'application couvre notamment la gestion des documents, des exemplaires, des abonnés, des agents et des opérations de prêt.

## Fonctionnalités

* Gestion des documents
* Gestion des exemplaires
* Gestion des abonnés
* Gestion des agents
* Recherche de documents
* Gestion des prêts et retours
* Gestion des consultations
* Gestion des suggestions
* Authentification et gestion des accès
* Consultation de statistiques

## Technologies

* PHP
* Laravel
* MySQL
* Blade
* JavaScript
* HTML / CSS

Le projet utilise Laravel avec une architecture MVC et une base de données relationnelle. Le dépôt utilise actuellement Laravel 10 et PHP 8.1 ou supérieur.

## Installation

### Prérequis

* PHP >= 8.1
* Composer
* Node.js
* MySQL

### Installation

```bash
git clone https://github.com/waly-dsk/memoire.git
cd memoire

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Configurer ensuite la connexion à la base de données dans `.env`.

```bash
php artisan migrate
```

Lancer l'application :

```bash
php artisan serve
```

Pour compiler les assets :

```bash
npm run dev
```

Les scripts frontend utilisent Vite.

## Contexte

Ce projet a été réalisé dans le cadre de mon mémoire de fin de formation en Licence Informatique de Gestion.

Il m'a permis de mettre en pratique l'analyse d'un besoin, la conception d'un système d'information, la modélisation des données et le développement d'une application web.

## Auteur

**Davo Kpinde Sèwlannou Wilfried**

[GitHub](https://github.com/waly-dsk)
