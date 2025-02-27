<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Bienvenue sur notre plateforme</title>
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .email-container {
      background-color: #ffffff;
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
      border: 1px solid #dddddd;
      padding: 20px;
    }
    .header {
      text-align: center;
      padding: 10px 0;
    }
    .header img {
      max-width: 150px;
    }
    .content {
      padding: 20px;
      color: #333333;
    }
    .content h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }
    .content p {
      line-height: 1.6;
    }
    .details {
      margin-top: 20px;
      background-color: #f9f9f9;
      padding: 15px;
      border-radius: 5px;
    }
    .details p {
      margin: 10px 0;
      font-size: 14px;
      color: #555555;
    }
    .icon {
      vertical-align: middle;
      margin-right: 8px;
      width: 18px;
      height: 18px;
    }
    .button {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 20px;
      background-color: #007BFF;
      color: #ffffff;
      text-decoration: none;
      border-radius: 5px;
    }
    .footer {
      text-align: center;
      font-size: 12px;
      color: #aaaaaa;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">
      <!-- Logo de l'ecole -->
      <img src="{{ asset('images/logo.png') }}" alt="Logo de l'ecole">
    </div>
    <div class="content">
      <h1>Bienvenue sur la plateforme de l'école ...... !</h1>
      <p>Bonjour <strong>{{ $user->name }}</strong>,</p>
      <p>Nous sommes ravis de vous accueillir parmi nous. Votre compte étudiant a été créé avec succès.</p>

      <div class="details">
        <p>
          <img src="{{ asset('images/icon-user.png') }}" alt="Icône utilisateur" class="icon">
          <strong>Nom :</strong> {{ $user->name }}
        </p>
        <p>
          <img src="{{ asset('images/icon-email.png') }}" alt="Icône email" class="icon">
          <strong>Email :</strong> {{ $user->email }}
        </p>
        <p>
          <img src="{{ asset('images/icon-password.png') }}" alt="Icône mot de passe" class="icon">
          <strong>Mot de passe :</strong> {{ $password }}
        </p>
      </div>

      <p class="mb-5">Nous vous invitons à vous connecter dès maintenant pour découvrir notre plateforme et démarrer votre parcours.</p>
      <i style="color: red;background-color: #f9f9f9; border-radius: 5px; padding: 15px"> Veuillez modifier votre mot de passe une fois connecté !</i>
      <p style="text-align: center;margin-top: 20px">
        <a href="{{ url('/') }}" class="button">Se connecter</a>
      </p>
    </div>
    <div class="footer">
      <p>&copy; {{ date('Y') }} Votre Entreprise. Tous droits réservés.</p>
    </div>
  </div>
</body>
</html>
