<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Main renderer.
 *
 * @package     local_technicalsignal
 * @category    local
 * @author      Valery Fremaux <valery.fremaux@gmail.com>
 * @copyright   Valery Fremaux <valery.fremaux@gmail.com> (MyLearningFactory.com)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['technicalsignals:manage'] = 'Gérer la signalisation technique';

$string['pluginname'] = 'Notifications techniques d\'exploitation';

$string['configadminmessage'] = 'Message administrateur';
$string['configadminmessage_desc'] = 'Message administrateur affiché en haut d\'écran. Laisser vide pour désactiver';
$string['configadminmessagecolor'] = 'Couleur de message administrateur';
$string['configadminmessageholdtime'] = 'Temps de présentation';
$string['exploitation'] = 'Exploitation';
$string['configglobaladminmessage'] = 'Message global au réseau';
$string['configglobaladminmessage_desc'] = 'Message administrateur affiché en haut d\'écran sur TOUTES les plates-formes du réseau. Laisser vide pour désactiver';
$string['configglobaladminmessagecolor'] = 'Couleur de message réseau';
$string['configglobaladminmessageholdtime'] = 'Temps de présentation du message global';
$string['configinframessagelocation'] = 'Position du message de niveau "infra"';
$string['configinframessagelocation_desc'] = 'Si le fichier existe (UTF-8) alors son contenu sera ajouté à la notification d\'information. Il devrait être placé dans un endroit que toutes les instances locales de moodle peuvent atteindre.';
$string['inframessageprefix'] = '<b>Service d\'infrastructure</b> ';
$string['globalmessageprefix'] = '<b>Message de service global</b> (toutes plates-formes) ';
$string['hide'] = 'Cacher le message';
$string['undefinedmainhost'] = 'Aucun hôte principal ne répond au préfixe : {$a}. Vérifiez que la valeur de préfixe commence par http:// (ou https://). Elle peut être définie par le bloc Publication de cours, ou directement dans le fichier de configuration par défaut.';
$string['red'] = 'Rouge';
$string['orange'] = 'Orange';
$string['yellow'] = 'Jaune';
$string['green'] = 'Vert';
$string['blue'] = 'Bleu';
$string['remove'] = 'Effacer le signal';
$string['always'] = 'Ne pas effacer';
$string['onehour'] = 'Une heure';
$string['threehours'] = 'Trois heures';
$string['twelvehours'] = '12 heures';
$string['oneday'] = 'Un jour';
$string['threedays'] = 'Trois jours';
