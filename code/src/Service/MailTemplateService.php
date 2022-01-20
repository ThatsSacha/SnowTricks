<?php

namespace App\Service;

use App\Entity\User;

class MailTemplateService {
    public function getValidateAccount(User $user): string {
        return '
        <DOCTYPE HTML>
        <html style="background-color: #eeeeee;">
            <head>
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300;400&display=swap" rel="stylesheet">
            </head>
            <body>
                <main style="background-color: white;background: white;padding:50px;border-radius:8px;font-family:\'Helvetica\';">
                    <img
                        src="https://snowtricks.sacha-cohen.fr/img/logos/logo.png"
                        alt="Snowtricks logo"
                        style="width: auto;height:auto;max-width:200px;max-height:200px;"
                    > 
                    <h1
                        style="color:#4ae3b5;font-size: 22px;font-weight: 600;font-family:\'Helvetica\';margin-top:25px;"
                    >
                        Bonjour Sacha !
                    </h1>
                    <h2
                        style="font-size: 16px;font-weight: 300;color:#171332;margin-bottom:50px;font-family:\'Helvetica\';"
                    >
                        Nous t\'envoyons ce mail afin que tu confirmes ton inscription chez SnowTricks.<br/>Cliques sur le lien ci-dessous afin de valider ton compte !
                    </h2>
                    <a href="'. $_ENV['APP_URL'] .'/user/validate-account/'. $user->getToken() .'"
                        style="border-radius: 8px;text-decoration:none;padding:20px 10px;background-color:#171332;color:white;font-size:16px;font-weight:600;min-width:200px;font-family:\'Helvetica\';text-align: center;display:inline-block;"
                    >
                       Valider mon compte
                   </a>
                </main>
            </body>
        </html>
        ';
    }

    public function getResetPassword(User $user): string {
        return '
        <DOCTYPE HTML>
        <html style="background-color: #eeeeee;">
            <head>
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300;400&display=swap" rel="stylesheet">
            </head>
            <body>
                <main style="background-color: white;background: white;padding:50px;border-radius:8px;font-family:\'Helvetica\';">
                    <img
                        src="https://snowtricks.sacha-cohen.fr/dist/img/logo.png"
                        alt="Snowtricks logo"
                        style="width: auto;height:auto;max-width:200px;max-height:200px;"
                    > 
                    <h1
                        style="color:#4ae3b5;font-size: 22px;font-weight: 600;font-family:\'Helvetica\';margin-top:25px;"
                    >
                        Bonjour Sacha !
                    </h1>
                    <h2
                        style="font-size: 16px;font-weight: 300;color:#171332;margin-bottom:50px;font-family:\'Helvetica\';"
                    >
                        Nous t\'envoyons ce mail car une demande de réinitialisation de mot de passe pour ton compte SnowTricks a été effectuée.<br/><br/>Si tu n\'es pas à l\'origine de cette demande, tu peux ignorer ce mail.<br/>Dans le cas contraire, cliques sur le lien ci-dessous !
                    </h2>
                    <a href="'. $_ENV['APP_URL'] .'/user/reset-password/'. $user->getToken() .'"
                        style="border-radius: 8px;text-decoration:none;padding:20px 10px;background-color:#171332;color:white;font-size:16px;font-weight:600;min-width:200px;font-family:\'Helvetica\';text-align: center;display:inline-block;"
                    >
                       Réinitialiser mon mot de passe
                   </a>
                </main>
            </body>
        </html>
        ';
    }
}