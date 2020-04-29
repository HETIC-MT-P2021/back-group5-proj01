# La Galeria de Papel - Back

  

## About

  

The goal of this project is to create a web app with an image gallery where you can manage your images : add, update and delete images. You will also be able to edit categories and tags to use them in filters.

The real goal of this project is to learn how to use Symfony 5 to make web app.

  

You are on the Back-end of the Project, we used Symfony to make a REST API, and MySQL as a database.

  

## Requirements

  

- You must have Docker and Docker-Compose installed on your computer

- Must have clone  the Front-Office of La Galeria de Papel

  

## Installation

  
TODO:
```bash


git clone https://github.com/HETIC-MT-P2021/back-group5-proj01.git

docker-compose build

docker-compose run 

docker-compose exec php php bin/console doctrine:schema:create
  

```

## How to use

  

Make sure to start the API before you start the Front . 
Begin by create the database : 

  php bin/console doctrine:schema:create

Configure the .env file to connect to your database .

If you don't have docker on your machine, you can run the project in local

```bash

 php -S  localhost:8001 -t public
```

You can now access the API at : http://localhost:8001

  

## Features

  

- All of CRUD for images and categories .
- You can manage your images
- You can find images by categories, tags and date.

- You can also add the tags for an image.

- An image is linked with one category, deleting the category will delete all linked images

  

## Technical Choices
Feel free to discuss with any contributor about the technical choices that were made.

You can find te technical documentation [here](https://docs.google.com/document/d/1r71o5M6YeAlaBeZXdfL-Blp9kiznD9vudYctsmzviE0/edit?usp=sharing)
  
  

## Contributing

  

See [contributing guidelines](https://github.com/HETIC-MT-P2021/front-group5-proj01/blob/master/CONTRIBUTING.md)

  

## Any Questions ?

  

If you have any questions, feel free to open an issue. Please check the open issues before submitting a new one.

  
## Authors

  [Jean-Jacques Akakpo ](https://github.com/gensjaak)
  [Tsabot](https://github.com/Tsabot)
  [myouuu](https://github.com/myouuu)

## Licence

  

The code is available under the MIT license.