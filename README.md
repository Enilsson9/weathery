Anax Weather Module (weathery)
==================================

[![Build Status](https://travis-ci.com/Enilsson9/weathery.svg?branch=master)](https://travis-ci.org/Enilsson9/weathery)
[![CircleCI](https://circleci.com/gh/Enilsson9/weathery.svg?style=svg)](https://circleci.com/gh/Enilsson9/weathery)

You can use this module, together with an Anax installation, to enable a scaffolded Weather report.


Table of content
------------------------------------

* [Install as Anax module](#Install-as-Anax-module)
* [Install using scaffold postprocessing file](#Install-using-scaffold-postprocessing-file)
* [Install and setup Anax](#Install-and-setup-Anax)
* [Dependency](#Dependency)
* [License](#License)



Install as Anax module
------------------------------------

This is how you install the module into an existing Anax installation.

Install using composer.

```
composer require edward/weathery
```


Install using scaffold postprocessing file
------------------------------------

The module supports a postprocessing installation script, to be used with Anax scaffolding. The script executes the default installation, as outlined above.

```text
bash vendor/edward/weathery/.anax/scaffold/postprocess.d/700_weathery.bash
```

The postprocessing script should be run after the `composer require` is done.



Install and setup Anax
------------------------------------

You need a Anax installation, before you can use this module. You can create a sample Anax installation, using the scaffolding utility [`anax-cli`](https://github.com/canax/anax-cli).

Scaffold a sample Anax installation `anax-site-develop` into the directory `rem`.

```
$ anax create weathery anax-site-develop
$ cd weathery
```

Point your webserver to `weathery/htdocs` and Anax should display a Home-page.



Dependency
------------------

This is a Anax module and primarly intended to be used together with the Anax framework.



License
------------------

This software carries a MIT license. See [LICENSE.txt](LICENSE.txt) for details.



```
 .  
..:  Copyright (c) 2018 Edward Nilsson (edward@nilsson.gt)
```
