* COLORS

# COLORS — LAMP demo

## Brief description
COLORS is a small educational LAMP demonstration app that lets users add color records and search them via a minimal PHP API and a static frontend.

## Technologies used
- Apache (or another web server able to run PHP)
- PHP (7.x+)
- MySQL
- HTML, CSS, JavaScript
- Linux or Windows host (LAMP)

## High-level setup instructions
1. Create a LAMP droplet with digital ocean (or download the tools required for LAMP on any server)
2. Buy a domain and configure it so that it points to the droplet.
3. Remotely connect to the droplet.
4, Clone your git repo into /var/www/html
5. Create database and fill it with proper tables and values

## How to run and access the application
1. Start your web server.
2. Access the website via your browser

## Assumptions & limitations
- Assumes a LAMP-capable environment (PHP + web server). If no DB is configured, some API code may use in-memory or file-based storage depending on the implementation.
- Authentication in this demo may be simplistic — do not use it as-is for production.
- No automated installer or migrations are included; database schema must be created manually if required.

## Project structure (where to look)
- `COP-4331/COLORS/colors-lamp/LAMPAPI/` — PHP API endpoints (`Login.php`, `SearchColors.php`, `AddColor.php`).
- `COP-4331/COLORS/colors-lamp/public/` — static frontend (`index.html`, `color.html`, `js/code.js`, `js/md5.js`, `css/styles.css`).

## Notes & security
- Inspect the PHP files for DB credentials and validation logic before deploying publicly.
- `public/js/md5.js` shows client-side hashing used by the demo — server-side validation is required for real security.
- Test endpoints locally with Postman or curl before exposing them to the internet.
- - It can take up to 24 hours for your domain to be properly associated with the IP address of your droplet
- You may have to use a private browsing session to visit your website when your domain finally registers with the domain register

## AI usage
This documentation was developed with assistance from generative AI tools:
- **Tool**: Microsoft Copilot 1.388.0
- **Dates**: February 13, 2026
- **Scope**: Documentation for COLORS Lab write-up
- **Use**: Generated the general style of documentation and a few specific details used for this write-up.

All AI-generated text was reviewed, Final implementation reflects my understanding
of the concepts.
