# GoCreative

A WordPress site built to practise PHP front-end development with Advanced Custom Fields (ACF) or Secure Custom Fields (SCF).

This is a practice project. It is not a production site, and the code is public so others can read it and learn from it.

## What this project covers

- Building a custom WordPress theme in PHP
- Creating page sections from ACF/SCF fields
- Using a repeater field to build pages from reusable template sections
- Writing accessible markup (WCAG 2.2 and WAI-ARIA)

## Requirements

- WordPress (latest stable release)
- PHP 8.0 or newer
- Advanced Custom Fields or Secure Custom Fields plugin
- [Local](https://localwp.com/) (recommended for running the site on your computer)
- VS Code or any Markup Editor

## What is in this repository

This repository is the `wp-content` folder of a WordPress site. WordPress core, configuration files, example content, uploads and logs are not tracked (see `.gitignore`).

```
GoCreative/
├── plugins/      Plugins used by the site
├── themes/       Custom theme and any parent theme
├── uploads/      Sample media only
├── .gitattributes
├── .gitignore
├── LICENSE
└── README.md
```

Most of the custom work is in `themes/`.

## How pages are built

Pages that use the template file `template-page.php` are made from a repeater field called `contents`. Each row in the repeater is one section of the page. Every row has:

- General settings: enable or disable the section, add extra CSS classes, and choose a header level
- A "Select Template" field that picks which section layout to show
- Shared section content: header, description and an optional image
- Fields that belong only to the chosen layout

Available section layouts:

**Soon to be added

The page header always outputs the H1.

## Accessibility

The goal is for all HTML, CSS and JavaScript to follow:

- WCAG 2.2
- WAI-ARIA 1.1
- ATAG 2.0 for the editing experience

## Known issues

- **Soon to be added

## Contributing

This is a personal practice project. Issues and suggestions are welcome.

## Licence

This project is released under the MIT License. See the [LICENSE](LICENSE) file for details.

## Author

Pixl
