#!/bin/bash

sudo rm -rfv /opt/lampp/htdocs/*
sudo cp -rv ./* /opt/lampp/htdocs/
sudo cp -v ./.htaccess /opt/lampp/htdocs/
