# Headless React-WordPress Boilerplate

This project is designed to help us quickly set modern web applications using React as the front-end and WordPress as the back-end that'll go on Awwwards, leveraging a Hybrid Rendering approach.


## Hybrid Rendering Approach

1. ***Server-Side Data Injection:*** Essential data, including metadata, routes, medias, styles, and scripts, are injected by the server with PHP using WordPress. This ensures that important information is available before the application is loaded in the browser.

2. ***Client-Side Rendering (CSR):*** The React application renders components on the client side, leveraging the pre-loaded data without requiring additional fetch requests. This enhances performance and improves the user experience.


## Features

- Webpack setup for optimized asset management
- SCSS/SASS support for streamlined styling
- JavaScript & CSS minification for improved load times
- Image Compression to enhance performance
- ESM format for modern JavaScript support
- App routing for seamless navigation
- Run on PHP server for compatibility with WordPress
- Hybrid Rendering for a balanced approach to data fetching
- Document head management for SEO optimization
- Smooth Page Transition for a better user experience
- Smooth Scrolling for enhanced navigation
- Loader Concept for managing loading states
- Cache Concept to improve performance
- Consent Concept


## Ready

- Integrated with React Router for dynamic routing
- Utilizing React Helmet for document head management
- Includes GSAP Premium for advanced animations
- Free Font Awesome for icon support


## Requirements

- ACF Pro License
- PHP 8.2+
- GSAP Club Membership
- NodeJS (for local only, minimum tested: v20.15.0)


## Installation Guide

1. Clone the repository.
2. Navigate to `constructor`.
3. Run `npm run get:wp` to install WordPress.
4. Add `.npmrc` for GSAP autentication.
5. Run `npm i` to install Node modules.
6. Duplicate `wp-config-sample.php` in `src > back` to `wp-config.php` and configure it.
8. Add your server configuration file in `src > front > template` directory. More explanations [here](https://github.com/studiochampgauche/headless-react-wordpress-boilerplate?tab=readme-ov-file#web-server-configuration).
9. Run `npm run build:front:back` or `npm run watch:front:back` for initialize setup.
10. Configure your WordPress backend `(yourdomain.com/admin)`.
11. Activate the Champ Gauche Core Theme, Champ Gauche Core Plugin, and the ACF Plugin.
12. Remove other default plugins, themes, pages, and posts.
13. Create and set your Home Page as static.
14. Update the permalink structure to anything other than the default Plain option.
15. Start working!


## Web Server Configuration

- Place your production files from `dist` directory on your web server, or set this directory as the root.
- Configure your web server to redirect all URL requests to the `index.php` file, unless the requested file or directory physically exists on the server.

For example, on Apache, we add this in the `.htaccess`:
```
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [L]
```

> [!NOTE]  
> The `dist` directory is created when you install WordPress with the `npm run get:wp` command and is populated throughout your progress.


## Frontend-Backend Interaction

- `wp-load.php` is loaded in the frontend allowing you use the WordPress ecosystem like plugins, customs fonctions, etc. inner your frontend.
- We render server-side the childrens of the `<head>` element and the attributes of its parent (the `<html>` element). React Helmet then takes over.
- We server-side data injecting routes in `src > back > theme > function.php`. After, routes are mounted in `src > front > js > App.jsx`.
- Use `SYSTEM.ajaxPath` for call the `admin-ajax.php` of WordPress. `ajaxRequests` function is ready in `src > back > theme > function.php`.
- Using `SYSTEM.restPath` will return the string `/admin/wp-json/`. `restRequests` function is ready in `src > back > theme > function.php`.
- Every page, post, custom post type, and some users (like authors) that make up your routes must be linked to a Component. This requires a field for each admin element to assign a component name, which you then map in the ecosystem.
- To map components, add them to the `componentMap` object in `src > front > js > App.jsx`.

> [!NOTE]  
> - Pages and posts already have the required field. For custom post types, go to (yourdomain.com/admin/wp-admin/admin.php?page=site-settings), select your CPT in the `Modules` tab under `Component`. For add the field like for the users, edit the `render.php` file of the Champ Gauche Core Plugin around line 1787.
> - If you have many posts and don't want to manually assign a Component Name for each, you can either create logic in `App.jsx` or in `functions.php` or use ACF hooks to auto-populate the field.
> - Use fetch for update datas composing your routes... You probably can do your checkup in `PageTransion.jsx` before rendering the new page.


## Page Transitions

- Add `data-transition="true"` to `<Link>` or `<a ...>` elements for transition, otherwise, they will be direct.
- For custom HTML elements, use class `goto` with `data-href=""`.
- If `data-href` or `href` is an anchor, include the current page path if you want stay on the current page. You don't need to do this for `to` attribute.
- When you stay on the same page, control anchor scroll behavior with `data-behavior="smooth|instant"`. Defaults: "smooth" with GSAP SmoothScroller, "instant" without.
- When you change page, you can't control the scroll behavior. The scroll behavior'll be "instant".
- Edit transition settings in `src > front > js > components > PageTransition.jsx`.

> [!WARNING]  
> - Using `mailto:`, `tel:`, other protocols that are not `http` or `https` or an attribute like `download` without `target` attribute will create a bug on click. e.g. use `target="_self"`, `target="_blank"` or other.



## Loader Concept

The loader concept initiates a preloading animation and the downloading of fonts, images, videos and audios before your app is mounted. It make sure you have your medias and the GSAP SmoothScroller ready before allowing visitors to navigate.

You'll find the preloader HTML in `src > front > template > index.php`.

You'll find the preloader SCSS in `src > front > scss > site > _preloader.scss`.

You'll find the preloader JavaScript in `src > front > js > addons > Loader.js`:

- `Loader.init()` initiates the preloader animation.
- `Loader.downloader().init()` initiates the downloading of fonts, images, videos and audios.
- `Loader.downloader().display()` replaces each target by its media.


We initiates preloading animation and downloads in `src > front > js > App.jsx`:
```
window.loader = {
    anim: Loader.init(),
    downloader: Loader.downloader(),
    isLoaded: {
        fonts: false,
        images: false,
        videos: false,
        audios: false
    }
};
window.loader.medias = window.loader.downloader.init();
```

All functions implemented with the Loader are using a `Promise`:

- `window.loader.anim.then(() => {})` allow you to know when your preloader animation is resolved
- `window.loader.medias.then(({ mediaGroups, fonts }) => {})` allow you to play with images, videos, audios and fonts when they are ready
- `window.loader.downloader.display()` allow you to display images, videos and audios when they are ready. Place your display function in a variable named `displayFunc` and use `displayFunc.then(() => {})` for call something when all medias are displayed.

> [!NOTE]
>- `Loader.init()` can complete only if `Loader.downloader().init()` is launched too. If no media needs to be fetched, still call `Loader.downloader().init(false)`.
>- Manage your medias in `src > back > theme > functions.php`. Find `wp_localize_script('scg-main', 'MEDIAS', $medias)`.
>- When you use the display function with your component, use `<scg-load data-value="YOUR_MEDIA_GROUP_KEY" />` to link the good group of medias associated.
>- Using the display function will loop all `<scg-load />` element that can be found. Use first parameter for select a specific `data-value`. Default is `scg-load`.


## Cache Concept

The Cache concept uses the Cache Service Worker API. It lets you add your endpoints (or others) to the cache, and automatically caches media you upload with the Loader concept. He doesn't manage your headers.

For activate the cache, go to your admin `(yourdomain.com/admin/wp-admin/admin.php?page=site-settings)` and click on "Extra" tab, you'll see `Cache version` and `Cache Expiration`. Version `0` will disable your cache, just add a version. 


***How it's work***

For example, put a look on what we have do for get pages before we have server-side injecting:
```
try{

    const pagesPromise = fetch(await Cache.get(SYSTEM.restPath + 'wp/v2/pages?_fields=id,title,link,acf'));


    const [callPages] = await Promise.all([pagesPromise]);

    if(!callPages.ok) throw new Error('Pages can\'t be loaded');


    Cache.put(callPages.url, callPages.clone());


    const pages = await callPages.json();

}
```


> [!NOTE]
>- Cache Concept works only on secure URLs.
>- It's ok to have `Cache.put()` even if you don't need to do it, because the function will work only if the url is not on protocol `blob:`.
>- You can use WordPress Hook like `save_post` with `update_field` of ACF for update your Cache version when a post is saved


## Consent Concept

The Consent concept provides a customizable box for your visitors, allowing them to accept or, if permitted, reject your policies.

- For activate the consent box, go to your admin `(yourdomain.com/admin/wp-admin/admin.php?page=site-settings)` and click on "Modules" tab, you'll see the `Consent` module that you can active. When you active, you'll have a new tab on this page named `Consent Box` for your settings.
- You can style this box using `SCSS` in the file located at `src/front/scss/site/_consent.scss`.
- You can manage the HTML of the box in `src > front > template > index.php`.
- Update the `action()` method in `src > front > js > addons > Consent.js` for manage what you do when a user accept or reject the box.



## Hidden Possibilities

#### Components
- Use `<Wrapper value={my_value} />` from `src > front > js > components > Wrapper.jsx` for insert HTML returns when you can't use `dangerouslySetInnerHTML`.

#### Scss/Sass/Css
- You can use `Sass` instead of `Scss` by turn your `.scss` extension to `.sass` and by removing brackets.
- Turn easly your pixel units to viewport units in your css by using:
    - `vw|svw|lvw|dvw($value, $screen_dimension: 1920px)`
    - `vh|svh|lvh|dvh($value, $screen_dimension: 1080px)`

#### PHP

Through your frontend or backend depending the case, you can use these custom PHP functions and hooks:

##### ***`scg::field($field, $id = false, $format = true, $escape = false)`***

- Call `get_field()` of ACF.
- It'll check first in `option` before the current page if you don't set an ID.

Replace your return with `str_replace()` when you use ACF PHP functions or ACF REST API:
```
add_action('acf/init', function(){

    StudioChampGauche\Utils\Field::replace([
        '{SITE_NAME}'
    ], [
        StudioChampGauche\SEO\SEO::site_name()
    ]);

});
``` 


##### ***`scg::cpt($post_type = 'post', $args = [])`***

- Call [new WP_Query()](https://developer.wordpress.org/reference/classes/wp_query/).
- You can pass the first parameter to `null` if you want pass `post_type` in `$args`

Set default parameters when you call `scg::cpt()` or `StudioChampGauche\Utils\CustomPostType::get()`:
```
StudioChampGauche\Utils\CustomPostType::default('posts_per_page', -1);
StudioChampGauche\Utils\CustomPostType::default('paged', 1);
```


##### ***`scg::source($args = [])`***

- Get URL or absolute path.

`$args` parameters:
- ***base*** Default value is `/`, equal to theme root.
- ***path*** Path to your file
- ***url*** Default value is `false` returning the absolute path. `true` if you want the url.

Set default parameters when you call `scg::source()` or `StudioChampGauche\Utils\Source::get()`:
```
StudioChampGauche\Utils\Source::default('base', '/');
StudioChampGauche\Utils\Source::default('url', true);
```


##### ***`add_filter('scg_wp_head', function($wp_heads){});`***

- Add, modify and remove metadata.

Example:
```
add_filter('scg_wp_head', function($wp_heads){
                
    /*
    * Add Open Graph article:section and article:tag on Post Type 'post'
    */
    
    if(is_singular(['post'])){
    
        $wp_heads['og_article_section'] = '<meta property="article:section" content="" />';
        
        $wp_heads['og_article_tag'] = '<meta property="article:tag" content="" />';
        
    }

    return $wp_heads;

});
```

***Existing keys***

- title
- charset
- compatible
- viewport
- description
- og_type
- og_profile_first_name
- og_profile_last_name
- og_profile_username
- og_article_published_time
- og_article_modified_time
- og_article_author
- og_url
- og_site_name
- og_title
- og_description
- og_image
- fav_ie_32x32
- fav_apple_touch_180x180
- fav_all_browsers_192x192
- fav_ms_tile_270x270


> [!NOTE]
> If you want remove an existing metadata, pass it to empty.


#### In Admin Panel

- You can clean Front End sources like wp_generator, WP Block Library, Global Styles, Classic Theme Styles, etc.
- You can change the appearance of the admin panel to have a panel containing only what you need.
- You can activate/deactivate Gutenberg
- You can activate/deactivate Editor for `post` and `page` post_type.
- You can remove default dashboard elements
- You can manage theme locations
- You can accept SVG
- You can stop create multiple resizes of an image you upload
- You can manage a global SEO and a specific SEO for each page, post_type, author and taxonomies.

> [!NOTE]  
> - Pages and posts already have the seo module. For custom post types, go to (yourdomain.com/admin/wp-admin/admin.php?page=site-settings), select your CPT in the `Modules` tab under `SEO`. For add the field like for the users, edit the `render.php` file of the Champ Gauche Core Plugin around line 1787.

## To Know

- Multisite isn't ready.
- Minification and compression works only in production mode.
- Image compression supports GIF, JPG, PNG, and SVG; WEBP support is not implemented yet.
- Image compression works only for the frontend part. If you manage your medias via backend, you need to manage it at your hands.
- On the frontend, if a media file isn’t directly imported in your main JS app files, Webpack won’t recognize or compile it. To ensure Webpack processes the file, you need to manually import it into the relevant JS file. For example, if you're using an audio file, navigate to `src > front > medias > audios` and import the file within `audios.js`.



## Admin Languages

***Default:*** French

***Translation:*** en_US, en_CA, en_GB, en_AU, en_NZ, en_ZA


## Changelog
[Here](https://github.com/studiochampgauche/headless-react-wordpress-boilerplate/blob/master/CHANGELOG.md)


## What's Next
- Maintenance mode