# 🧮 Calculatrice Laravel

Une calculatrice simple construite avec Laravel 12 — mais conçue avec des standards de code avancés, une architecture propre, et une extensibilité maximale.

---

## 🚀 Fonctionnalités

-   **Opérations supportées** : addition, soustraction, multiplication, division
-   **Validation intelligente** (ex : division par zéro interdite)
-   **Historique des calculs** persisté en base de données
-   **Code découpé avec DTOs, Services, Enum, Stratégie**
-   **Interface utilisateur légère avec Blade**
-   **Respect des standards PSR-12 (anciennement PSR-2)**

---

## 📦 Stack technique

-   Laravel 12
-   PHP 8.2+
-   Eloquent ORM
-   Blade (pas de JS ou CSS avancé)
-   Enums PHP natifs
-   Architecture basée sur des services

---

# 🧮 Calculatrice Laravel

Une calculatrice simple construite avec Laravel 12 — mais conçue avec des standards de code avancés, une architecture propre, et une extensibilité maximale.

---

## 🚀 Fonctionnalités

-   **Opérations supportées** : addition, soustraction, multiplication, division
-   **Validation intelligente** (ex : division par zéro interdite)
-   **Historique des calculs** persisté en base de données
-   **Code découpé avec DTOs, Services, Enum, Stratégie**
-   **Interface utilisateur légère avec Blade**
-   **Respect des standards PSR-12 (anciennement PSR-2)**

---

## 📦 Stack technique

-   Laravel 12
-   PHP 8.2+
-   Eloquent ORM
-   Blade (pas de JS ou CSS avancé)
-   Enums PHP natifs
-   Architecture basée sur des services

---

## 📁 Architecture

```text
app/
├── Enums/ → Enum pour les types d'opérations
├── DTO/ → Objet de transfert des données (CalculatorData)
├── Services/
│   ├── CalculatorService.php → Orchestration de la logique métier
│   └── Operations/ → Stratégies pour chaque opération
│       ├── OperationInterface.php
│       ├── AddOperation.php
│       └── ...
├── Models/
│   └── CalculationHistory.php → Historique des calculs
├── Http/
│   ├── Controllers/
│   │   └── CalculatorController.php
│   └── Requests/Calculator
│       └── CalculatorRequest.php → Validation personnalisée
resources/views/
└── calculator/index.blade.php → Formulaire + affichage des résultats/historique

tests/Feature
├── CalculatorTest -> test suite
```

## ⚙️ Installation

```bash

composer install

cp .env.example .env

php artisan key:generate

php artisan test

php artisan migrate

php artisan serve
```
