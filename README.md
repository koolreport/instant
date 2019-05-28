# Introduction

Sometimes, we need to show some tables or charts in our page but setting up the whole KoolReport, despite of ease, causes trouble and is not convenient. The `Instant` package allows us to create report or widget instantly everywhere without setting up a full report.

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
        "data"=>array(
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
        "data"=>array(
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
        "data"=>array(
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

## Support

Please use our forum if you need support, by this way other people can benefit as well. If the support request need privacy, you may send email to us at __support@koolreport.com__.