<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Task to be done

1. Do the basic user authentication process
2. Read the google sheet data and insert into the database.
3. In google sheet there is is_sync column 0 to read the data, if 1 you need to skip the data.
4. Next time if duplicate data is found from sheet you have to skip and update the duplicate flag in sheet.

## Google Sheet
https://docs.google.com/spreadsheets/d/1S_y2W_CfSFnOUOv3MMKdCAtV9chztPST5XlT8sepN78/edit?usp=sharing

## Google Sheets for Laravel Installation

- git clone this project
- composer install 
- npm install && npm run dev
- connect to the database from .env file
- php artisan key:generate
- php artisan serve

## Add .env variables

- GOOGLE_APPLICATION_NAME="Medvarsity"
- GOOGLE_CLIENT_ID="127769315959-n52331vsfrk50akmipg5ms8uf96s1uio.apps.googleusercontent.com"
- GOOGLE_CLIENT_SECRET="wG2HTZMbiELc603m0xZHioGl"

- GOOGLE_DEVELOPER_KEY="AIzaSyD6I1FUaCg9m6dA0VbrWFZ4OnPD4eiwAZo"
- GOOGLE_SERVICE_ENABLED=true
- GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION="../storage/medvarsity-203385b28f38.json"

- SPREADSHEET_ID="1S_y2W_CfSFnOUOv3MMKdCAtV9chztPST5XlT8sepN78"
- SHEET_NAME="Users"

## Steps to Test

- Go to the project url
- Register with email
- Visit /users 
- Enter spreadsheet Id and Sheetname
- Check for the message Import was successful
