### **📌 README.md**
```md
# 🎓 Gestion Scolaire (API LARAVEL 10)

Un système de gestion scolaire développé avec **Laravel**, permettant la gestion des étudiants, enseignants, tuteurs et administrateurs.

## 🚀 Fonctionnalités Principales
- **Gestion des utilisateurs** (Étudiants, Enseignants, Tuteurs, Admins, Super-Admins)
- **Gestion des années académiques** avec `softDeletes`
- **Attribution des rôles et permissions** avec Spatie
- **Envoi d’e-mails & notifications** lors de l'ajout d'un utilisateur
- **Système d’authentification sécurisé** avec `Hash::make()`
- **Gestion des notes et des classes**
- **Tableau de bord admin** pour superviser toutes les activités

---

## ⚡ Installation & Configuration

### 1️⃣ **Cloner le projet**
```bash
git clone https://github.com/nh-high-school.git
cd nh-high-school
```

### 2️⃣ **Installation des dépendances**
```bash
composer install
```

### 3️⃣ **Configuration de l'environnement**
Copie le fichier `.env.example` et renomme-le en `.env` :
```bash
cp .env.example .env
```
Ensuite, configure la connexion à la base de données (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

### 4️⃣ **Générer la clé d’application**
```bash
php artisan key:generate
```

### 5️⃣ **Exécuter les migrations et seeders**
```bash
php artisan migrate --seed
```

### 6️⃣ **Lancer le serveur**
```bash
php artisan serve
```
L’application sera disponible sur `http://127.0.0.1:8000`.

---

## 🔐 Gestion des Rôles et Permissions
Ce projet utilise **Spatie Laravel Permissions** pour la gestion des rôles :
- **Super-Admin** : Accès total, peut supprimer définitivement
- **Admin** : Accès total sauf suppression définitive
- **Enseignant** : Gère ses classes et les notes des élèves
- **Tuteur** : Peut voir toutes les informations de ses enfants
- **Étudiant** : Peut voir ses notes et ses informations de classe

---

## 📧 Notifications et Emails
- Lorsqu’un étudiant, un enseignant ou un tuteur est ajouté, un **email est envoyé** avec ses informations de connexion.
- Une **notification est envoyée aux admins**.

---

## 📜 API Endpoints
| **Méthode** | **Endpoint**           | **Description**                  |
|------------|------------------------|----------------------------------|
| `POST`     | `/api/login`           | Connexion                       |
| `GET`      | `/api/students`        | Liste des étudiants             |
| `POST`     | `/api/students`        | Ajouter un étudiant             |
| `PUT`      | `/api/students/{id}`   | Modifier un étudiant            |
| `DELETE`   | `/api/students/{id}`   | Supprimer un étudiant (soft)    |

---

## 🛠 Technologies Utilisées
- **Laravel 10**
- **Spatie Laravel Permissions**
- **MySQL**
- **Mailtrap** (pour les emails en dev)

---

## 🎯 Contribuer
1. **Fork** ce repo
2. Crée une nouvelle branche : `git checkout -b feature-xyz`
3. Fais tes modifications et commit : `git commit -m "Ajout de xyz"`
4. Push sur ta branche : `git push origin feature-xyz`
5. Crée une **Pull Request** 🛠️

---

## 📄 Licence
Ce projet est sous licence **MIT**.

---

## 👨‍💻 Auteur
Développé par **[Chrislain AVOCEGAN](https://github.com/RootCode2024)** 🚀.
```
