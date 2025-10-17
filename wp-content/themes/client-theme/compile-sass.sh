#!/bin/bash
# Compile Sass without warnings
sass --no-source-map --silence-deprecation=import --silence-deprecation=color-functions --silence-deprecation=global-builtin includes/scss/screen.scss includes/css/screen.css

