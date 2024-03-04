<div align="center">

# Aicoll

</div>

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#installation">Installation</a></li>
    <li><a href="#Login">Login</a></li>
  </ol>
</details>




## Installation

the order to run the application, you must do the following:

1. Clone the repository with 

```sh
git clone https://github.com/DanielaRuizA/Aicoll.git
```

2. CD for change the directory 

```sh
cd Aicoll
```

3. [Install PHP dependencies](https://getcomposer.org/doc/01-basic-usage.md):

```sh
composer install
```

4. [Install npm dependencies](https://docs.npmjs.com/cli/v8/commands/npm-install):

```sh
npm install
```

5. Create the .env

```sh
cp .env.example .env
```

6. Generate Key 

```sh
php artisan key:generate
```

7. Run the database migrations 

```sh
php artisan migrate --seed
```

8. Run the pho dev server

```sh
php artisan serve
```

## Login
> For use this app use this credentials in the login
>
>>- **Username:** aicoll@admin.com
>>- **Password:** password