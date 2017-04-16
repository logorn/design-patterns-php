<?php

/**
 * Exemple du design pattern "Adapter".
 *
 * Ce design pattern permet d’adapter l’interface d’un objet sans modifier l’objet en lui même.
 *
 * Le but est de faire en sorte que si un jour on a à changer de librairie, qu'on ai juste l'adaptateur à changer
 * sans rien avoir à modifier dans l'application.
 */

require_once 'Mailing/Adapters/AdapterInterface.php';
require_once 'Mailing/MailersLibraries/SwiftMailer.php';
require_once 'Mailing/Adapters/SwiftMailerAdapter.php';
require_once 'Mailing/MailersLibraries/PHPMailer.php';
require_once 'Mailing/Adapters/PHPMailerAdapter.php';

use Mailing\MailersLibraries\SwiftMailer;
use Mailing\Adapters\SwiftMailerAdapter;
use Mailing\MailersLibraries\PHPMailer;
use Mailing\Adapters\PHPMailerAdapter;


/**
 * Exemple avec SwiftMailer
 */
$swiftMailer = new SwiftMailer();

$mailer = new SwiftMailerAdapter($swiftMailer);

if ($mailer->send()) {
    echo $mailer->getConfirmmation().'<hr>';
} else {
    echo $mailer->getError().'<hr>';
}


/**
 * Par exemple, si un jour on veut utiliser la librairie PHPMailer à la place de SwiftMailer,
 * on a juste à changer l'adapter et à lui passer en paramètredu constructeur l'instance de PHPMailer.
 * Et on aurra rtien d'autre à modifier dans toute notre application.
 */
$phpMailer = new PHPMailer();

$mailer2 = new PHPMailerAdapter($phpMailer);

if ($mailer2->send()) {
    echo $mailer2->getConfirmmation().'<hr>';
} else {
    echo $mailer2->getError().'<hr>';
}


/**
 * Et si un jour on souhaitera utiliser encore une autre librairie,
 * il suffira de lui créer un adapter qui implémentera l'AdapterInterface,
 * et de ensuite instancier cette adapter en lui passant en paramètre du constructeur l'instance de la librairie.
 */