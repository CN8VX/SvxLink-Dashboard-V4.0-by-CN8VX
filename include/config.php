<?php
/**
 * ============================================================
 *  SvxLink Dashboard by CN8VX © 2026 — Configuration File
 *  Editez ce fichier selon votre installation.
 *  Edit this file according to your setup.
 * ============================================================
 */

// ============================================================
// 1. FUSEAU HORAIRE / TIMEZONE
// ============================================================

// Set the default timezone
// Définition du fuseau horaire par défaut
// You can find timezones at: https://www.php.net/manual/en/timezones.php
// Vous pouvez trouver les fuseaux horaires sur : https://www.php.net/manual/en/timezones.php
define('TIMEZONE', 'Africa/Casablanca');

// ============================================================
// 2. CHEMINS / PATHS
// ============================================================

// Configuration files for SvxLink
// Fichier de configuration SvxLink
define('SVXLINK_CONFIG', '/etc/svxlink/svxlink.conf');

// log file for SvxLink
// Fichier de log SvxLink
define('SVXLINK_LOG', '/var/log/svxlink');

// ============================================================
// 3. CONFIGURATION VISUELLE / VISUAL CONFIGURATION
// ============================================================

// Logo path / Chemin du logo
define('LOGO_PATH', 'images/logo.png');

// tile / subtitle of the dashboard
// Titre / Sous-titre du dashboard
define('DASHBOARD_SUBTITLE', 'Analog-FM Repeater');

// Call sign displayed in the header (leave empty to hide)
// QTH affiché dans le header (laisser vide pour ne pas afficher)
define('HEADER_QTH', 'country, city');

// Frequency displayed in the header (leave empty to hide)
// Fréquence RX/TX en MHz (saisie manuelle)
define('FREQ_RX', '145.250');

// Frequency offset in kHz — positive or negative (e.g., -600 or +600). Leave empty if not applicable.
// Offset en kHz — positif ou négatif (ex: -600 ou +600). Laisser '' si non applicable.
define('FREQ_OFFSET', '');

// Default theme on page load: 'dark' or 'light'
// Thème par défaut au chargement : 'dark' ou 'light'
define('DEFAULT_THEME', 'dark');

// ============================================================
// 4. INFORMATIONS SYSOP / SYSOP INFORMATION
// ============================================================

// System operator callsign
// Indicatif du SYSOP du système
$SYSOP = "Your-CALL";

// System operator name
// Nom du SYSOP
$SYSOPNAME = "Your-Name";

