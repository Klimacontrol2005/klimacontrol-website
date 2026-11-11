# Klimacontrol website

Statische site met PHP-formulieren, draaiend op Apache + PHP 8.3.

## Deployen op Railway

1. Repo op GitHub zetten:

   ```
   git init
   git add .
   git commit -m "Klimacontrol website"
   git branch -M main
   git remote add origin git@github.com:<jouw-account>/klimacontrol-website.git
   git push -u origin main
   ```

2. Railway → **New Project** → **Deploy from GitHub repo** → deze repo kiezen.
   Railway ziet de `Dockerfile` en bouwt die automatisch. Geen extra instellingen nodig.

3. Railway → **Variables** → de waarden uit `.env.example` invullen
   (SMTP-gegevens van Combell). Zonder deze variabelen vertrekken er geen mails.

4. Railway → **Settings → Networking → Generate Domain** voor een test-URL,
   of **Custom Domain** voor www.klimacontrol.eu.

## Waarom een Dockerfile en geen Nixpacks

Railway's PHP-detectie gaat uit van Composer/Laravel. Deze site is platte HTML
met twee PHP-scripts, dus een eigen Dockerfile is eenvoudiger en voorspelbaarder.

## Mail

`mail()` werkt niet op Railway — er draait geen lokale mailserver. De Dockerfile
installeert daarom `msmtp` en zet `sendmail_path` door naar Combell's SMTP.
De PHP-bestanden zelf hoefden niet aangepast.

## Nog open

- Lege pagina's: koeltechniek, airco, warmtepomp, ventilatie, zonnepanelen,
  thuisbatterij, faq, vacatures.
- Ontbrekende afbeeldingen: merklogo's (mhi, daikin, lg, tosot, aiko, jasolar)
  en pv-plat / pv-schuin. Nu tijdelijk vervangen.
- `offerte.html` bevat dode code (airco-configurator) en twee keer id="homeBtn".
