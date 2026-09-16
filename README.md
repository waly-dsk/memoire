# Système de gestion du fonds documentaire
### Bibliothèque centrale de l'Université de Parakou

> Application web développée dans le cadre de mon mémoire de fin de formation en Licence Informatique de Gestion à l'Université de Parakou, au Bénin.

---

## À propos du projet

La gestion d'un fonds documentaire implique plusieurs opérations liées : référencement des documents, organisation physique des collections, consultation, gestion des abonnés, prêts, retours et suivi de l'activité de la bibliothèque.

Ce projet consiste à concevoir et développer une application web permettant d'informatiser une partie de ces processus au sein de la Bibliothèque centrale de l'Université de Parakou.

L'objectif n'était donc pas uniquement de développer une interface web, mais de **traduire un besoin métier en un système d'information structuré**, depuis la modélisation des données jusqu'à l'implémentation des fonctionnalités.

---

## Problématique

La gestion d'un fonds documentaire mobilise plusieurs informations qui doivent rester cohérentes :

- les documents disponibles ;
- leurs catégories et subdivisions ;
- leur emplacement physique ;
- leurs différents exemplaires ;
- les abonnés ;
- les agents de la bibliothèque ;
- les consultations ;
- les prêts et les retours ;
- les suggestions d'acquisition ou d'amélioration.

Le projet cherche ainsi à répondre à une question centrale :

> **Comment concevoir un système d'information permettant de centraliser et de faciliter la gestion du fonds documentaire et des principales opérations réalisées par une bibliothèque universitaire ?**

---

## Objectifs

### Objectif général

Concevoir et développer une application web permettant d'informatiser la gestion du fonds documentaire de la Bibliothèque centrale de l'Université de Parakou.

### Objectifs spécifiques

Le système permet notamment de :

- structurer et centraliser les informations relatives aux documents ;
- organiser les documents selon leur classification ;
- gérer les emplacements physiques du fonds documentaire ;
- gérer les abonnés de la bibliothèque ;
- enregistrer et suivre les prêts ;
- gérer les retours d'ouvrages ;
- conserver l'historique des prêts ;
- enregistrer les consultations ;
- rechercher des documents selon différents critères ;
- recueillir des suggestions ;
- produire des statistiques sur l'utilisation du fonds documentaire ;
- différencier les fonctionnalités accessibles aux agents et à l'administrateur.

---

# Du besoin métier au système d'information

Le projet a été abordé comme un problème de conception de système d'information.

```text
                    BESOIN MÉTIER
                         │
                         ▼
              Analyse des processus
                         │
                         ▼
              Identification des entités
                         │
                         ▼
              Modélisation des données
                         │
                         ▼
              Conception de l'application
                         │
                         ▼
                  Implémentation
                         │
                         ▼
               Tests et validation
