## Changelog

***2024-10-20***
- ***Added***: Consent Concept `src > front > js > addons > Consent.js`
- ***Added***: `src > front > scss > site > _buttons.scss`
- ***Added***: `src > front > scss > site > _consent.scss`
- ***Updated***: When App is render
- ***Updated***: Language files
- ***Updated***: `src > front > template > index.php`


***2024-10-19***
- ***Added***: `src > front > js > pages > DefaultPage.jsx` component


***2024-10-16***
- ***Updated***: Add acf value replacement for other acf functions instead of only `get_field()`
- ***Move***: ACF REST API replacement in `Studio Champ Gauche Core plugin` instead of `functions.php`


***2024-10-15***
- ***Added***: Button.jsx
- ***Added***: ACF datas for each route
- ***Added***: Default componentName for "post"
- ***Improve***: README.md
- ***Fixed***: Since ***2024-10-13***, styles have been loaded as inline styles, so the CSS path variable was not correct.
- ***Fixed***: Since styles was been loaded as inline styles, Loader concept can't resolve `window.loader.medias`. Fixed.


***2024-10-14***
- ***Added***: `Cache.delete()`. See `src > front > js > addons > Cache.js`
- ***Added***: Cache version from backend
- ***Added***: Cache lifetime from backend
- ***Added***: Default SEO settings access. use `defaultSEO` variable.
- ***Changed***: We have stop fetching routes, medias and settings. They are now construct from server.
- ***Changed***: How `Metas.jsx` work (React Helmet)
- ***Removed***: `window.SYSTEM` object is now construct from server. Use `SYSTEM` variable instead.
- ***Removed***: `/admin/wp-json/scg/v1/settings/` endpoint
- ***Removed***: `/admin/wp-json/scg/v1/medias/` endpoint
- ***Removed***: Demo contents
- ***Removed***: `Nav.jsx` and `Logo.jsx` component
- ***Updated***: Language files


***2024-10-13***
- ***removed***: hideForSeo Class Name
- ***Changed***: How we do SSR (experimental)... we now loading wordpress by including `wp-load.php` in the frontend. With this, we have stop calling `<head>` child elements and `<html>` atributes with cURL
- ***Changed***: We stopped loading the main.min.css file using a `<link>` element. We now include it as inline styles.
- ***Added***: When you visit the frontend admin part (not frontend React) e.g. `/admin`, you are redirect to `/admin/wp-admin`



***2024-10-11***
- ***Fixed***: Page Transition

***2024-10-05***
- ***Added***: Cache Concept
- ***Added***: File `src > front > js > addons > Cache.js`
- ***Added***: Cache on REST API endpoint
- ***Updated***: How we cache medias
- ***Updated***: Preloader Panel Demo
- ***Changed***: Stop removing `<scg-load />` elements (temporary)


***2024-10-04***
- ***Updated***: Display function. Now, you can select specific `scg-load` elements instead of loop all each time you call the function.


***2024-10-03***

- ***Added***: Server-Side Rendering for the `<head>` element
- ***Added***: Favicon management from backend
- ***Added***: Global SEO management from backend
- ***Added***: `/admin/wp-json/scg/v1/settings/` endpoint
- ***Fixed***: Robots crawler
- ***Fixed***: HTTP response code for not founded page
- ***Changed***: How Metas.jsx work (React Helmet)
- ***Changed***: We stop redirect wordpress frontend part


***2024-09-28***

- ***Changed***: Move "what's loaded" from `window.SYSTEM` to `window.loader`


***2024-09-23***

- ***Fixed***: A non-secure website cannot load because the Cache API does not exist.


***2024-09-22***

- ***Added***: Medias caching


***2024-09-21***

- ***Fixed***: When you use `window.loader.downloader.display()` you can now have multiple `<scg-load data-value="" />`
- ***Added***: Fonts background preloading
- ***Added***: Audios background preloading
- ***Changed***: Loader concept


***2024-09-14***

- ***Added***: `Wrapper.jsx` component


***2024-09-13***

- ***Added***: REST contents replacement for acf returns when you use `StudioChampGauche\Utils\Field::replace($searh, $replace)`


***2024-09-12***

- ***Deleted:*** Text.jsx Component
- ***Added:*** Medias Download Management
- ***Added:*** REST and Ajax Request starter
- ***Updated:*** Short datas returned by pages for the routes 
- ***Updated:*** Add path data to component composing the routes 
- ***Updated:*** For demo, add props to HomePage Component


***2024-09-08***

- Updated boilerplate from v3 to v4.

> [!WARNING]
> v4 is not a continuation of v3 but a breaking change with a new headless ecosystem. If you need v3, [Download here](https://archives.champgauche.studio/wordpress-boilerplate-v3.zip)