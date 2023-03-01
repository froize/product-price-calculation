
| Services      | Installation container |
|---------------|-----------------------:|
| PHP & PHP-FPM |                    php |
| NGINX         |                  nginx |
| MySQL         |                  mysql |
| Composer      |                    php |
| Node & NPM    |                    php |
| Symfony CLI   |                    php |

---

## Installation

1. Create an `.env` file for yourself. Use `.env.template` as a template
2. Build the Docker containers : `docker-compose build`.
3. Once this is done, you can run the containers : `docker-compose up -d`.  
   At the first launch after building the containers, wait a few seconds for MySQL to launch properly.
4. Add the following line to your hosts file `127.0.0.1 symfony-test.loc`
5. Install composer and npm dependencies. Refer to "Accessing services" section to learn how to use them.
   1) Install composer packages. If you have composer installed outside of docker, run `composer install`. 
   Else use `docker-compose exec php composer install`, but be aware of possible permission issues.
   2) Install npm packages `docker-compose exec php npm install`
6. Run DB migrations `docker-compose exec php bin/console doctrine:migrations:migrate`
7. Go to https://symfony-test.loc/ and have fun.

### Potential errors and fixes during installation

If you faced some issues during installation process and managed to find a solution,
please either fix project files that led to this situation or update this section.

**Problem:** `File not found` in browser

In logs:
> [crit] 34#34: *5 stat() "/application/public/" failed (13: Permission denied),

**Solution:** Nginx need to have +x access on all directories leading to the site's root directory.
Ensure you have +x on all of the directories in the path leading to the site's root. Use `chmod +x`

---

## Accessing services

To access Composer, Node or NPM, you must enter the PHP container : `docker-compose exec php bash`. You will then be
able to do your Composer/Node/NPM commands.
You can also run it like `docker-compose exec php symfony -v`

[!] Running composer inside docker can lead to permission issues. The following approach is recommended:

* Run composer outside of the php container, as doing so would install all your dependencies owned by root within your
  vendor folder.
* Run commands straight inside of your container. You can easily open a shell as described above and do your thing from
  there.

---

## Docker-compose cheatsheet

* Start the containers by watching their logs : `docker-compose up`
* Start the containers in the background : `docker-compose up -d`
* Stop the containers : `docker-compose stop`
* Kill the containers : `docker-compose kill`
* Delete the containers : `docker-compose rm`
* Stop and delete the containers : `docker-compose down`
* Check the status of the containers : `docker-compose ps`
* Watch the container logs : `docker-compose logs`
* Making a command in a container : `docker-compose exec CONTAINER_NAME COMMAND` where `COMMAND` is your command.
  Examples :
    - Open a console in the php-fpm container : `docker-compose exec php bash`
    - Open the Symfony console : `docker-compose exec php bin/console`

___
## Code style and guidelines

### General
* Use migrations. `doctrine:schema:update` command should not be executed on prod because it can lead to data loss.

### PHP
* Strict types. All files should declare(strict_types=1), types in properties and arguments are mandatory.
