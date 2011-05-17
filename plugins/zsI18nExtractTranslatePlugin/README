# zsI18nExtractTranslatePlugin

##Overview

Adds a task which extends sfI18nExtractTask (i18n:extract).  The task has all the functionality/options as its base task but instead of leaving a blank string for the target it uses the Google translation API to translate the source.

Google's translation API doesn't always give proper grammar and messes up symbols.  It is always best to double check and possibly correct your translations.

This task works with both **XLIFF** and **gettext** catalog stores.  I have not tried any others.

###Requirements:
php_curl extension

##How to Use

Install the plugin.

Use the task ``i18n:extract-translate`` the same way you would use ``i18n:extract``.  When the ``--auto-save`` options is set the catalog is created with the target string translated.

###Example 1
    php symfony i18n:extract-translate --auto-save frontend fr

The task as an additional option:  ``--force-all``.  This options forces the translation of all strings, not just the new ones.  **Caution** this will overwrite existing translations.  The ``--auto-save`` options is not needed when ``--force-all`` is enabled.

###Example 2
    php symfony i18n:extract-translate --force-all frontend fr

Refer to the documentation for ``i18n:extract`` for information on the other options and arguments.

Feel free to contact me with any bugs/suggestions.