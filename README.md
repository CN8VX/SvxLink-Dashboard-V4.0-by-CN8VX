# SvxLink Dashboard V4.0 by CN8VX

> Real-time web dashboard for SvxLink repeaters and hotspots.  
> Compatible with SvxLink v2, v3+ on Debian 12/13 and Raspberry Pi OS (Bookworm, Trixie).

![Version](https://img.shields.io/badge/version-4.0-blue)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple)
![License](https://img.shields.io/badge/license-All%20rights%20reserved-red)
![Compatibility](https://img.shields.io/badge/Raspberry%20Pi-compatible-green)
![SvxLink](https://img.shields.io/badge/SvxLink-v2%2B-orange)

<img src="https://flagcdn.com/w20/us.png" width="20"/> **[English](#english)** | <img src="https://flagcdn.com/w20/fr.png" width="20"/> **[Français](#français)**

---

## 📸 Screenshots

<img width="1425" height="1111" alt="SvxLink-Dashboard for CN8VX V4 0" src="https://github.com/user-attachments/assets/f28aaaa0-6127-4493-870d-e125aa55ddab" />

<img width="1423" height="1369" alt="Logs Viewer" src="https://github.com/user-attachments/assets/d88433d2-4cc3-4428-9fc6-e20d828d3220" />

---

<a name="english"></a>
## <img src="https://flagcdn.com/w20/us.png" width="30"/> English

## 🤔 Why this dashboard?

If you manage a SvxLink repeater or hotspot, you know that monitoring its status in real time is not always straightforward. Logs are raw, configuration is spread across multiple files, and there is no official visual interface.

**SvxLink Dashboard V4.0** solves this problem: a single web page gives you a complete, real-time view of your repeater — RF status, network activity, hardware health, Talk Groups — without ever touching the command line.

- ✅ **Zero complex configuration** — a few lines in `config.php` and you're ready in under 5 minutes
- ✅ **Real-time** — data updates automatically without reloading the page
- ✅ **Lightweight** — runs perfectly on a Raspberry Pi Zero 2W or Pi 4
- ✅ **Responsive** — usable from a smartphone in the field
- ✅ **Two themes** — dark and light mode, remembered between sessions
- ✅ **Automatic `svxlink.conf` parsing** — callsign, repeater type, active modules and TGs are extracted with no manual input

---

## ✨ Features

### 📡 Main Dashboard (`index.php`)

| Panel | What you will see |
|---|---|
| 🛜 **Frequency RX/TX** | RX frequency and offset configured manually, CTCSS tone extracted automatically from `svxlink.conf` |
| 🗼 **Repeater Status** | Live block: **LISTENING** at rest, **RX** (green) when squelch opens, **TX** (red) when the repeater is retransmitting |
| 🔓 **Active Modules** | Real-time list of all loaded SvxLink modules (EchoLink, Parrot, MetarInfo, DTMF…) |
| 🕒 **System Uptime** | Time elapsed since last system reboot, incremented second by second in the browser |
| 🌡️ **CPU Temperature** | Direct read from `/sys/class/thermal`, automatic color coding: 🟢 < 55°C · 🟡 < 70°C · 🔴 above |
| ⌚ **Clock** | Live local date and time, configurable timezone |
| 🌐 **Reflector & Talk Groups** | Repeater callsign on the reflector, default TG, monitored TGs, last active TG — updated without page reload |
| 📟 **Hardware Info** | Hostname, local IP, CPU architecture, Linux kernel, SvxLink version, CPU/RAM/Disk usage with color-coded progress bars |
| 📋 **SVXReflector Activity** | Session table: clickable callsign (QRZ.com link), TG number, TG name, duration — the active session is highlighted in red |
| 🔗 **EchoLink Node** | Displayed **only** if `ModuleEchoLink` is active: callsign, location, sysop, connected nodes in real time |

### 📋 Log Viewer (`logsvx.php`)

The log viewer transforms raw SvxLink text files into a clean, interactive table:

- **Combinable filters**: by event type (TX-START, TX-STOP, TG, WARN, LINK, UNLINK…), callsign, TG number, or date
- **Auto-refresh** every 10 seconds in Live mode on page 1, with a pause button
- **Color coding** by event type to instantly spot errors, disconnections or transmissions
- **Pagination** to browse thousands of entries without slowing down the browser
- **Clickable callsigns** — direct link to each station's QRZ.com profile

### 🔊 Talk Groups Page (`talkgroup.php`)

- Full list of your TGs with number and name
- **Instant search** by number or name
- Any change to `talkgroups.php` is visible immediately after pressing `F5` — no restart needed

### 🔗 EchoLink Log Page (`echolinksvx/`)

- Detailed history of EchoLink sessions
- Independent module, available separately from [Interface-EchoLinkSvx-Logs](https://github.com/CN8VX/Interface-EchoLinkSvx-Logs)

---

## 🧩 Requirements

| Item | Details |
|---|---|
| SvxLink | v2 or higher, installed and configured ([DMR-Maroc guide](https://www.dmr-maroc.com/repeaters_simplex_svxlink.php)) |
| Web server | Apache or Nginx |
| PHP | 7.4 or later |
| File access | Read access to SvxLink logs and config files |

**Tested hardware:**
- Raspberry Pi 3B / 4 / 5
- Raspberry Pi Zero 2W
- PC running Debian 12 / 13

> **Recommendation:** Set your system locale to `en_US.UTF-8` for accurate timestamp parsing in logs.
> ```bash
> sudo localectl set-locale LANG=en_US.UTF-8
> ```

---

## 🚀 Installation

The full installation takes less than **5 minutes**.

### Step 1 — Download the dashboard

```bash
cd /var/www
sudo rm -rf html
sudo git clone https://github.com/CN8VX/SvxLink-Dashboard-V4.0-by-CN8VX html
```

### Step 2 — Add the EchoLink Log page

```bash
cd /var/www/html
git clone https://github.com/CN8VX/echolinksvx echolinksvx
cd
```

### Step 3 — Set permissions

```bash
sudo chmod 777 -R /var/www/html
```

### Step 4 — Configure the dashboard

```bash
sudo nano /var/www/html/include/config.php
```

Settings to adjust for your installation:

| Setting | Example | Description |
|---|---|---|
| `TIMEZONE` | `Africa/Casablanca` | Your timezone ([full list](https://www.php.net/manual/en/timezones.php)) |
| `SVXLINK_CONFIG` | `/etc/svxlink/svxlink.conf` | Path to the SvxLink configuration file |
| `SVXLINK_LOG` | `/var/log/svxlink` | Path to the SvxLink log file or directory |
| `FREQ_RX` | `145.250` | RX frequency in MHz |
| `FREQ_OFFSET` | `-600` | Offset in kHz (leave empty if not applicable) |
| `DASHBOARD_SUBTITLE` | `Analog-FM Repeater` | Subtitle displayed in the header |
| `HEADER_QTH` | `Morocco, Casablanca` | QTH location string |
| `DEFAULT_THEME` | `dark` | Default theme: `dark` or `light` |
| `$SYSOP` | `CN8VX` | Sysop callsign (QRZ.com link generated automatically) |
| `$SYSOPNAME` | `Mohamed` | Sysop name displayed in the footer |

### Step 5 — Configure the EchoLink Log page

```bash
sudo nano /var/www/html/echolinksvx/include/config.php
```

### Step 6 — Open in your browser

```
http://[repeater-ip-address]
```
or
```
http://[repeater-hostname]
```

**That's it.** The dashboard automatically reads `svxlink.conf` and extracts the callsign, repeater type (Simplex/Duplex), active modules and configured Talk Groups — with no additional input required.

---

## 🔧 Adding Talk Groups

Edit the `include/talkgroups.php` file:

```php
$tgdb_array = [
    '604'    => 'TG MAROC - National',
    '6041'   => 'TG Cross Mode DMR <=> Analog',
    '60401'  => 'TG official FreeDMR Maroc',
    '604112' => 'TG EmComm Morocco',
];
```

Names appear automatically in the **TG Name** column of the activity table and on the Talk Groups page. A simple `F5` is all it takes to see the changes.

---

## 🛠️ Troubleshooting

**The dashboard shows no data**
- Check that SvxLink is running: `systemctl status svxlink`
- Verify permissions on the log and configuration files
- Confirm that the paths in `config.php` match your installation

**The EchoLink panel does not appear**
- Make sure `ModuleEchoLink` is listed under `MODULES=` in `svxlink.conf`
- Check that `/etc/svxlink/svxlink.d/ModuleEchoLink.conf` exists and is readable by the web server

**The log viewer shows nothing**
- Verify that `SVXLINK_LOG` points to the correct file or directory
- Confirm that PHP has read access: `ls -la /var/log/svxlink`
- Fix permissions if needed: `sudo chmod 644 /var/log/svxlink`

**The repeater status stays on LISTENING even when active**
- SvxLink must be writing logs to the file pointed to by `SVXLINK_LOG`
- Check with: `journalctl -u svxlink -f` and compare with the configured path

---

## 📬 Author & Support

[**CN8VX**](https://www.qrz.com/db/CN8VX) — Moroccan Amateur Radio Operator  
📧 [cn8vx.ma@gmail.com](mailto:cn8vx.ma@gmail.com)

For any bug report, feature request, or question, feel free to send an email or open a GitHub issue.

Before contacting support:
1. Check file permissions
2. Verify the syntax in `config.php`
3. Check SvxLink logs: `journalctl -u svxlink -f`
4. Test on a different browser

---

*SvxLink Dashboard V4.0 © 2026 CN8VX — All rights reserved.*  
*Any modification must retain the CN8VX designation and the corresponding version number.*

---

<a name="français"></a>
## <img src="https://flagcdn.com/w20/fr.png" width="30"/> Français

# SvxLink Dashboard V4.0 by CN8VX

> Tableau de bord web en temps réel pour répéteurs et hotspots SvxLink.  
> Compatible SvxLink v2, v3+ sous Debian 12/13 et Raspberry Pi OS (Bookworm, Trixie).

![Version](https://img.shields.io/badge/version-4.0-blue)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple)
![Licence](https://img.shields.io/badge/licence-Tous%20droits%20réservés-red)
![Compatibilité](https://img.shields.io/badge/Raspberry%20Pi-compatible-green)
![SvxLink](https://img.shields.io/badge/SvxLink-v2%2B-orange)

---

## 📸 Captures d'écran

<img width="1425" height="1111" alt="SvxLink-Dashboard for CN8VX V4 0" src="https://github.com/user-attachments/assets/f28aaaa0-6127-4493-870d-e125aa55ddab" />

<img width="1423" height="1369" alt="Logs Viewer" src="https://github.com/user-attachments/assets/d88433d2-4cc3-4428-9fc6-e20d828d3220" />

---

## 🤔 Pourquoi ce tableau de bord ?

Si vous gérez un répéteur ou hotspot SvxLink, vous savez que surveiller son état en temps réel n'est pas toujours simple. Les logs sont bruts, la configuration est dispersée dans plusieurs fichiers, et il n'existe pas d'interface visuelle officielle.

**SvxLink Dashboard V4.0** résout ce problème : une seule page web suffit pour avoir une vue complète et en temps réel de votre répéteur — état RF, activité réseau, santé matérielle, Talk Groups — sans jamais toucher à la ligne de commande.

- ✅ **Zéro configuration complexe** — quelques lignes dans `config.php` et c'est prêt en moins de 5 minutes
- ✅ **Temps réel** — les données se mettent à jour automatiquement sans recharger la page
- ✅ **Léger** — fonctionne parfaitement sur un Raspberry Pi Zero 2W ou Pi 4
- ✅ **Responsive** — utilisable depuis un smartphone sur le terrain
- ✅ **Deux thèmes** — mode sombre et mode clair, mémorisés entre les sessions
- ✅ **Lecture automatique de `svxlink.conf`** — l'indicatif, le type de répéteur, les modules et les TG sont extraits sans rien saisir manuellement

---

## ✨ Fonctionnalités détaillées

### 📡 Tableau de bord principal (`index.php`)

| Bloc | Ce que vous verrez |
|---|---|
| 🛜 **Fréquence RX/TX** | Fréquence RX et offset configurées manuellement, ton CTCSS extrait automatiquement depuis `svxlink.conf` |
| 🗼 **État du répéteur** | Bloc dynamique : **LISTENING** au repos, **RX** (vert) quand le squelch est ouvert, **TX** (rouge) quand le répéteur réémet |
| 🔓 **Modules actifs** | Liste en temps réel de tous les modules SvxLink chargés (EchoLink, Parrot, MetarInfo, DTMF…) |
| 🕒 **Uptime système** | Temps écoulé depuis le dernier redémarrage de la machine, incrémenté seconde par seconde dans le navigateur |
| 🌡️ **Température CPU** | Lecture directe de `/sys/class/thermal`, code couleur automatique : 🟢 < 55°C · 🟡 < 70°C · 🔴 au-delà |
| ⌚ **Horloge** | Date et heure locales en direct, fuseau horaire configurable |
| 🌐 **Reflecteur & Talk Groups** | Indicatif sur le reflecteur, TG par défaut, TGs surveillés, dernier TG actif — mis à jour sans rechargement |
| 📟 **Infos matériel** | Hostname, IP locale, architecture CPU, noyau Linux, version SvxLink, usage CPU/RAM/Disque avec barres de progression colorées |
| 📋 **Activité SVXReflector** | Tableau des sessions : indicatif cliquable (lien QRZ.com), numéro TG, nom du TG, durée — la session en cours est mise en évidence en rouge |
| 🔗 **Nœud EchoLink** | Affiché **uniquement** si `ModuleEchoLink` est actif : indicatif, localisation, sysop, nœuds connectés en temps réel |

### 📋 Page Logs (`logsvx.php`)

Le visionneur de logs transforme les fichiers texte bruts de SvxLink en un tableau interactif lisible en un coup d'œil :

- **Filtres combinables** : par type d'événement (TX-START, TX-STOP, TG, WARN, LINK, UNLINK…), par indicatif, par numéro de TG, par date
- **Rafraîchissement automatique** toutes les 10 secondes en mode Live sur la page 1, avec bouton pause
- **Code couleur** par type d'événement pour repérer instantanément les erreurs, déconnexions ou transmissions
- **Pagination** pour naviguer dans des milliers d'entrées sans ralentir le navigateur
- **Indicatifs cliquables** — lien direct vers la fiche QRZ.com de chaque station

### 🔊 Page Talk Groups (`talkgroup.php`)

- Liste complète de vos TG avec numéro et nom
- **Recherche instantanée** par numéro ou par nom
- Toute modification de `talkgroups.php` est visible immédiatement après un `F5` — aucun redémarrage

### 🔗 Page EchoLink Log (`echolinksvx/`)

- Historique détaillé des sessions EchoLink
- Module indépendant, téléchargeable séparément depuis [Interface-EchoLinkSvx-Logs](https://github.com/CN8VX/Interface-EchoLinkSvx-Logs)

---

## 🧩 Prérequis

| Élément | Détail |
|---|---|
| SvxLink | v2 ou supérieur, installé et configuré ([guide DMR-Maroc](https://www.dmr-maroc.com/repeaters_simplex_svxlink.php)) |
| Serveur web | Apache ou Nginx |
| PHP | 7.4 ou version ultérieure |
| Accès fichiers | Lecture sur les logs et la config SvxLink |

**Matériel testé :**
- Raspberry Pi 3B / 4 / 5
- Raspberry Pi Zero 2W
- PC sous Debian 12 / 13

> **Recommandation :** Configurez la locale système en `en_US.UTF-8` pour un parsing précis des timestamps dans les logs.
> ```bash
> sudo localectl set-locale LANG=en_US.UTF-8
> ```

---

## 🚀 Installation

L'installation complète prend moins de **5 minutes**.

### Étape 1 — Télécharger le dashboard

```bash
cd /var/www
sudo rm -rf html
sudo git clone https://github.com/CN8VX/SvxLink-Dashboard-V4.0-by-CN8VX html
```

### Étape 2 — Ajouter la page EchoLink Log

```bash
cd /var/www/html
git clone https://github.com/CN8VX/echolinksvx echolinksvx
cd
```

### Étape 3 — Définir les permissions

```bash
sudo chmod 777 -R /var/www/html
```

### Étape 4 — Configurer le dashboard

```bash
sudo nano /var/www/html/include/config.php
```

Voici les paramètres à adapter à votre installation :

| Paramètre | Exemple | Description |
|---|---|---|
| `TIMEZONE` | `Africa/Casablanca` | Fuseau horaire ([liste complète](https://www.php.net/manual/en/timezones.php)) |
| `SVXLINK_CONFIG` | `/etc/svxlink/svxlink.conf` | Chemin vers le fichier de configuration SvxLink |
| `SVXLINK_LOG` | `/var/log/svxlink` | Chemin vers le fichier ou répertoire de logs |
| `FREQ_RX` | `145.250` | Fréquence RX en MHz |
| `FREQ_OFFSET` | `-600` | Offset en kHz (laisser vide si non applicable) |
| `DASHBOARD_SUBTITLE` | `Analog-FM Repeater` | Sous-titre affiché dans l'en-tête |
| `HEADER_QTH` | `Maroc, Casablanca` | Localisation QTH |
| `DEFAULT_THEME` | `dark` | Thème par défaut : `dark` ou `light` |
| `$SYSOP` | `CN8VX` | Indicatif du SYSOP (lien QRZ.com généré automatiquement) |
| `$SYSOPNAME` | `Mohamed` | Nom du SYSOP affiché dans le footer |

### Étape 5 — Configurer la page EchoLink Log

```bash
sudo nano /var/www/html/echolinksvx/include/config.php
```

### Étape 6 — Ouvrir dans le navigateur

```
http://[adresse-ip-du-répéteur]
```
ou
```
http://[hostname-du-répéteur]
```

**C'est tout.** Le dashboard lit automatiquement `svxlink.conf` et extrait l'indicatif, le type de répéteur (Simplex/Duplex), les modules actifs et les Talk Groups configurés — sans aucune saisie supplémentaire.

---

## 🔧 Ajouter des Talk Groups

Éditez le fichier `include/talkgroups.php` :

```php
$tgdb_array = [
    '604'    => 'TG MAROC - National',
    '6041'   => 'TG Cross Mode DMR <=> Analogique',
    '60401'  => 'TG officiel FreeDMR Maroc',
    '604112' => 'TG EmComm Morocco',
];
```

Les noms apparaissent automatiquement dans la colonne **TG Name** du tableau d'activité et dans la page Talk Groups. Un simple `F5` suffit pour voir les changements.

---

## 🛠️ Dépannage

**Le tableau de bord n'affiche aucune donnée**
- Vérifiez que SvxLink est actif : `systemctl status svxlink`
- Contrôlez les permissions des fichiers de log et de configuration
- Confirmez que les chemins dans `config.php` correspondent à votre installation

**Le bloc EchoLink n'apparaît pas**
- Assurez-vous que `ModuleEchoLink` est listé dans `MODULES=` dans `svxlink.conf`
- Vérifiez que `/etc/svxlink/svxlink.d/ModuleEchoLink.conf` existe et est lisible par le serveur web

**Le visionneur de logs n'affiche rien**
- Vérifiez que `SVXLINK_LOG` pointe vers le bon fichier ou répertoire
- Confirmez que PHP a accès en lecture : `ls -la /var/log/svxlink`
- Corrigez les permissions si nécessaire : `sudo chmod 644 /var/log/svxlink`

**L'état reste sur LISTENING alors que le répéteur est actif**
- SvxLink doit écrire ses logs dans le fichier pointé par `SVXLINK_LOG`
- Vérifiez avec : `journalctl -u svxlink -f` et comparez avec le chemin configuré

---

## 📬 Auteur & Support

[**CN8VX**](https://www.qrz.com/db/CN8VX) — Radioamateur Marocain  
📧 [cn8vx.ma@gmail.com](mailto:cn8vx.ma@gmail.com)

Pour tout bug, suggestion ou question, envoyez un e-mail ou ouvrez une issue GitHub.

Avant de contacter le support :
1. Vérifiez les permissions des fichiers
2. Contrôlez la syntaxe dans `config.php`
3. Consultez les logs SvxLink : `journalctl -u svxlink -f`
4. Testez sur un autre navigateur

---

*SvxLink Dashboard V4.0 © 2026 CN8VX — Tous droits réservés.*  
*Toute modification doit obligatoirement conserver l'indicatif CN8VX ainsi que le numéro de version correspondant.*
