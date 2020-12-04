# A-StarWars-Website
 Tool where you register, then log in, to see the planets and star-ships of Star Wars, their details and save them in a list of favorites.
 

 
 
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Thanks again! Now go create something AMAZING! :D
***
***
***
*** To avoid retyping too much info. Do a search and replace for the following:
*** github_username, repo_name, twitter_handle, email, project_title, project_description
-->



<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->

[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]



<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/GabrielDSousa/A-StarWars-Website">
    <img src="resources/svg/rocket-24.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">A StarWars Website</h3>

  <p align="center">
    A tool where you register, then log in, to see the planets and star-ships of Star Wars, their details and save them in a list of favorites.
    <br />
    <a href="http://gentle-peak-30769.herokuapp.com">View Demo</a>
    ·
    <a href="https://github.com/GabrielDSousa/A-StarWars-Website/issues">Report Bug</a>
    ·
    <a href="https://github.com/GabrielDSousa/A-StarWars-Website/issues">Request Feature</a>
  </p>
</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary><h2 style="display: inline-block">Table of Contents</h2></summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project
Is a simple project to make a favorite list of the planets and starships of StarWars. 
The idea came from a job proposal test. Make a site to use the [SWAPI](https://swapi.dev/)
for a list of planets and starships, with details and a favorite page.  


### Built With

* [Laravel](https://laravel.com/)
* [SWAPI](https://swapi.dev/)
* [Laravel Jetstream](https://jetstream.laravel.com/1.x/introduction.html)
* [Tailwind Css](https://tailwindcss.com/)



<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

* npm
  ```sh
  npm install npm@latest -g
  ```
  
* composer
    ```sh
    php composer.phar self-update
    ```

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/GabrielDSousa/A-StarWars-Website.git
   ```
2. Install NPM packages
   ```sh
   npm install
   ```
3. Install Composer packages
      ```sh
      composer install
      ```
4. Generated public files
      ```sh
      npm run dev
      ```
5. Create an archive .env on the root of the project, based on .env.example, and run
      ```sh
      php artisan key:generate
      ```
6. Configure the .env file with your information to database, name of project, url.
    
7. After connection, use this to create and populate your database for translations.
    ```shell script
   php artisan migrate
   php artisan db:seed
    ```

<!-- USAGE EXAMPLES -->

<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.

<!-- CONTACT -->
## Contact

Gabriel Ramos de Sousa 
- Twitter - [@gabsdsousa](https://twitter.com/GabsDSousa) 
- Email - [gabrielramos.email@gmail.com](mailto:gabrielramos.email@gmail.com)

Project Link: [https://github.com/GabrielDSousa/A-StarWars-Website](https://github.com/GabrielDSousa/A-StarWars-Website)

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[license-shield]: https://img.shields.io/github/license/othneildrew/Best-README-Template.svg?style=for-the-badge
[license-url]: https://github.com/GabrielDSousa/A-StarWars-Website/blob/main/LICENSE
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://www.linkedin.com/in/gabrieldsousa/
