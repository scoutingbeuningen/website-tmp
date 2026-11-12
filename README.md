# Scouting Beuningen '76 – Temporary website

A static one-page website, hosted on GitHub Pages at https://scoutingbeuningen.nl. The site content itself is in Dutch.

## Files
- `index.html` – the entire website (HTML and CSS)
- `CNAME` – the custom domain for GitHub Pages (`scoutingbeuningen.nl`)
- `.nojekyll` – makes GitHub Pages serve the files as they are, without a Jekyll build
- `assets/` – logo and photos (`hero.jpg`, one photo per age group, `blokhut.jpg`)

Only use photos the group has the rights to publish.

## Contact details
The contact details are in `index.html`, in the section with `id="contact"`:
- Aanmelden (sign-ups) → aanmelden@scoutingbeuningen.nl
- Verhuur (rental) → verhuur@scoutingbeuningen.nl
- Overige vragen (other questions) → info@scoutingbeuningen.nl
- Bezoekadres (visiting address) → Reekstraat 13A, 6551 DR Weurt, with a Google Maps link
- Volg ons (follow us) → Facebook and Instagram

The "Meer informatie aanvragen" button in the rental section opens an email to verhuur@.

## Publishing with GitHub Pages
1. Push the changes to the `main` branch.
2. In the repository, go to **Settings → Pages**.
3. Under **Source**, choose "Deploy from a branch", branch `main`, folder `/ (root)`.
4. Under **Custom domain**, enter `scoutingbeuningen.nl` (it is also in the `CNAME` file).
5. Turn on **Enforce HTTPS** once GitHub has issued the certificate. This can take up to 24 hours.

Every push to `main` republishes the site automatically.

## Viewing locally
Open `index.html` in a browser, or run this in the repository folder:

```sh
python3 -m http.server
```

and go to http://localhost:8000.
