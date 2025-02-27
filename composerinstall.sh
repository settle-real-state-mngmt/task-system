#!/bin/bash

# Author: Bruno Braga <brunobraga@protonmail.com>

# Description
# Runs composer install via docker

# Usage
# from the command line
# ./utils.sh

set -e

function add_sail() {
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php84-composer:latest \
        composer install --ignore-platform-reqs
}

add_sail
