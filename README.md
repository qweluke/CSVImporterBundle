# CSVImporterBundle
simple re-usable bundle to import CSV files

### Installation

##### Step 1: Download bundle using composer

Add this bundle to your composer.json file:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/qweluke/CSVImporterBundle"
        }
    ],
    "require": {
        "qweluke/CSVImporterBundle": "dev-master"
    }
}
```
run `composer update` to update your dependencies and install this bundle


##### Step 2: Enable the bundle in your AppKernel

   ```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Qweluke\CSVImporterBundle\QwelukeCSVImporterBundle(),
        // ...
    );
}
);
   ```
   
##### Step 3: Create your Import class
```php
<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Qweluke\CSVImporterBundle\Entity\AbstractImport;

/**
 * @ORM\Entity()
 */
class Import extends AbstractImport
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    // add any other fields you will need
}
```
   
##### Step 4: Configure bundle


Add the following configuration to your `parameters.yml`

```yaml
# app/config/parameters.yml
 
    qweluke_csvimporter_import_class: AppBundle\Entity\Import  #path to your entity
    qweluke_csvimporter_requiredfields:  # you can set which fields are required while importing. set "~" to none
      - Username
      - GivenName
      - Surname
    qweluke_csvimporter_fieldscount:  # limit file to specified columns number. If no limit, set "~".
      min: 2                          # if min is not specified, bundle will require at least 1 column
      max: 50
```

Enable symfony serializer in `config.yml`. This is a "must" for parsing CSV into array. If you don't want to use symfony serializer, you must override `ImportController::indexAction` from this bundle
```yaml
# app/config/config.yml
  framework:
      serializer: { enable_annotations: true }
```


##### Step 5: Import routing files 
```yaml
# app/config/routing.yml
 
qweluke_csv_importer:
    resource: "@QwelukeCSVImporterBundle/Resources/config/routing.xml"
    prefix:   /
```

##### Step 6: : Update your database schema
```bash
php app/console doctrine:schema:update --force
```

You can now use bundle. Go to `http://yourdomain.tdl/import-csv`!

### make it prettier ;-)
#### Importing styles
This bundle uses Twitter Bootstrap 3. You need to use it if you want to use this view.

You can import csv importer styles (only custom styles, without bootstrap) like this:
```html
<link rel="stylesheet" href="{{ asset('bundles/qwelukecsvimporter/css/style.css') }}">
```

#### Extending the view
Create `layout.html.twig` in your `app/Resources/views/QwelukeCSVImporterBundle/` directory
```html
{% extends '::base.html.twig' %}

{% block body %}
    <div class="container">

        {% for label, flashes in app.session.flashbag.all %}
            {% for flash in flashes %}
                <div class="alert alert-{{ label }}">{{ flash }}</div>
            {% endfor %}
        {% endfor %}

        <div class="page-header">
            <h1>Qweluke CSV Importer</h1>
            <p class="lead">{{ 'pageheader.text'|trans({}, 'qwelukecsvimporter') }}</p>
        </div>

        {% block qweluke_csvimporter_content %}{% endblock %}
    </div>
{% endblock %}
```
### example import file:
https://raw.githubusercontent.com/qweluke/CSVImporterBundle/master/example_file.csv

### screenshots:

![import-csv](https://github.com/qweluke/CSVImporterBundle/blob/master/1493795917982screensave.png?raw=true)
![bind-data](https://github.com/qweluke/CSVImporterBundle/blob/master/1493795962252screensave.png?raw=true)
![summary](https://github.com/qweluke/CSVImporterBundle/blob/master/1493795917983screensave.png?raw=true)
