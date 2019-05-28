# Introduction

Sometimes, we need to show some tables or charts in our page but setting up the whole KoolReport, despite of ease, causes trouble and is not convenient. The `Instant` package allows us to create report or widget instantly everywhere without setting up a full report.

Beside `Instant` package can help you to export any file whether it is `html` or `php` to PDF and other formats.

# Installation

1. Download and unzip the zipped file
2. Copy `instant` folder into `koolreport\instant` folder

# Documentation

## Widget

|name|return|description|
|---|---|---|
|create(*string* $widgetClassName, *array* $widgetParams)|null|Render the widget. This static function requires `$widgetClassName` which is the name of widget you want to create and `$widgetParams` which is any parameters you want to pass to the widget|


## Examples

### Create KoolPHP Table

Below are example of how to create Table on your PHP page

```
<?php
    require_once "koolreport\autoload.php";
    use \koolreport\instant\Widget;
    use \koolreport\widgets\koolphp\Table;
?>

<html>
    <head>
        <title>Instant Table</title>
    </head>
    <body>
    <?php
    Widget::create(Table::class,array(
        "dataSource"=>array(
            array("name"=>"Peter","age"=>35),
            array("name"=>"Karl","age"=>32),
        )
    ));
    ?>
    </body>
</html>
```

As you see, you do not need to setup the whole KoolReport class and the view in order to use our `Widget`. With the `Instance` package, you can create any widgets you want.

### Create Google BarChart

```
<?php
    require_once "koolreport\autoload.php";
    use \koolreport\instant\Widget;
    use \koolreport\widgets\google\BarChart;
?>

<html>
    <head>
        <title>Instant Table</title>
    </head>
    <body>
    <?php
    Widget::create(BarChart::class,array(
        "dataSource"=>array(
            array("name"=>"Peter","age"=>35),
            array("name"=>"Karl","age"=>32),
        )
    ));
    ?>
    </body>
</html>
```

### Create PieChart

```
<?php
    require_once "koolreport\autoload.php";
    use \koolreport\instant\Widget;
    use \koolreport\widgets\google\PieChart;
?>

<html>
    <head>
        <title>Instant Table</title>
    </head>
    <body>
    <?php
    Widget::create(PieChart::class,array(
        "dataSource"=>array(
            array("browser"=>"Chrome","usage"=>44.5),
            array("browser"=>"Safari","usage"=>25.4),
            array("browser"=>"Internet Explorer","usage"=>15.5),
            array("browser"=>"Firefox","usage"=>7.4),
            array("browser"=>"Others","usage"=>7.2),
        )
    ));
    ?>
    </body>
</html>
```

## Report Settings

```
<?php
Widget::create(Table::class,array(
    "dataSource"=>array(
        array("name"=>"Peter","age"=>35),
        array("name"=>"Karl","age"=>32),        
    )
),array(
    "assets"=>array(
        "path"=>"../../assets"
        "url"=>"/assets",
    )
)
?>
```

The third parameter of `create` function is optional settings for report. There you can set the custom `assets` folder like above. This `assets` settings is necessary if browser can not access to the folder containing resources of Widget. By specifying the `path` and `url`, we let KoolReport know where to put Widget's resources and how to access those resources.

## Exporter

`Exporter` helps you to ulilize the `Export` package (if you have) to export any HTML or PHP code file to PDF and other formats.

```
<?php
require_once "koolreport/autoload.php";
use \koolreport\instant\Exporter;

Exporter::export("/full/path/to/your/file.php")
->pdf(array(
    "format"=>"A4",
    "orientation"=>"portrait"
))
->toBrowser("myfile.pdf");
```

or you can save file

```
Exporter::export("/full/path/to/your/file.php")
->pdf(array(
    "format"=>"A4",
    "orientation"=>"portrait"
))
->saveAs("myfile.pdf");
```

## SinglePage

As you may know, to start a report, we normally need 3 files: a controller class file(ex.`MyReport.php`), a view file (ex. `MyReport.view.php`) and a initiation file (`index.php`). The `SinglePage` allows us to create report in just one file, bundling all the controller, view and initiation file into one. Please view below example:

```
<?php
//Index.php
require_once "../../../koolreport/autoload.php";

use \koolreport\querybuilder\DB;
use \koolreport\widgets\koolphp\Table;

class MyReport extends \koolreport\KoolReport
{
    use \koolreport\instant\SinglePage;
    use \koolreport\clients\Bootstrap;
    function settings()
    {
        return array(
            "dataSources"=>array(
                "automaker"=>array(
                    "connectionString"=>"mysql:host=localhost;dbname=automaker",
                    "username"=>"root",
                    "password"=>"",
                    "charset"=>"utf8"
                ),
            ),
        );
    }

    function setup()
    {
        $this->src('automaker')->query(
            DB::table("customers")->select("customerNumber","customerName")
        )
        ->pipe($this->dataStore("mydata"));
    }
}

$report = new MyReport;
$report->start();
?>

<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <h1>Testing</h1>
        <?php
        Table::create(array(
            "dataSource"=>$report->dataStore('mydata')
        ));
        ?>
    </body>
</html>

<?php $report->end(); ?>
```

As you may see from above example, we only have 1 file `index.php` containing controller classes `MyReport` and the view inside the `start()` and `end()` methods of report. We declare `use \koolreport\instant\SinglePage;` inside `MyReport` to provide two important methods above.


## Support

Please use our forum if you need support, by this way other people can benefit as well. If the support request need privacy, you may send email to us at __support@koolreport.com__.