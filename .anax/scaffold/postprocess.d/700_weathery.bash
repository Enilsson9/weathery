#!/usr/bin/env bash
#
# edward/weathery
#
# Integrate the REM server onto an existing anax installation.
#

#copy config
rsync -av vendor/edward/weathery/config/* config/
#copy view
rsync -av vendor/edward/weathery/view/anax/v2/* view/anax/v2/
#copy src
rsync -av vendor/edward/weathery/src/* src/
#copy test
rsync -av vendor/edward/weathery/test/* test/
