
---
Rédaction de cette documentation grâce à __LARECIPE__
- [Installation de l'environnement de développement et création du premier projet.](#section-1)
- [Authentification avec rôles](#section-2)


<a name="section-1"></a>
# Installation de l'environnement de développement et création du premier projet.
- __Installation de composer__   
```https://getcomposer.org/download/```   
- __Installation d'un serveur web et base de donnée__  
Xampp dans mon cas   
```https://www.apachefriends.org/fr/download.html```  
Il est conseiller de le mettre à la racine du disque pour éviter des problèmes.

- __Pour créer un nouveau projet__ il faut, taper la commande suivante dans un terminal   
```composer create-project --prefer-dist laravel/laravel blog```  
Le dossier sera créer dans D:/xampp/laravel/blog 

- __Connecter la base de donnée__  
```php artisan make:migration create_users_table```  
créer la migration qui créera la table user dans la bdd.

- __Avoir un premier rendu visuel__  
demarrer serveur xampp --> apache + mySQL  
D:\xampp\laravel --> ```php artisan serve``` -->  
127.0.0.1:8000 est accessible (environnement de dév)

- __Créer les premières pages__
        * __les Routes__   
                Les routes sont stockés dans le fichier /routes/web.php 
        * __les Controllers__  
                Les controllers sont stockés dans les fichiers /http/controllers/*Controller.php ( * le nom du controller)
        * __les Vues__  
                Les vues sont stockés dans les fichiers /views/*.blade.php (* le nom de la vue)

- __Créer un UserTableSeeder__  
Taper la commande suivante pour créer le seeder.  
``` php artisan make:seeder UsersTableSeeder```  
```php
factory(App\User::class, 10)->create()->each(function ($user) { 
});
```  

<a name="section-2"></a>
# Authentification avec rôles.

## Ajout de rôles
- Ajout des rôles avec la librairie __Spatie__  
Lien vers la documentation Spatie: https://docs.spatie.be/laravel-permission/v3/installation-laravel/  
Télécharger le module Spatie :  
```composer require spatie/laravel-permission```  
Dans le fichier config/web.php il faut ajouter :  
```Spatie\Permission\PermissionServiceProvider::class,```  
Et pour finir il faut créer la migration avec :  
```php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"```  

## Seeder des utilisateurs avec des rôles
- Modifier le modèle user pour qu'il assigne les rôles aux users
Ajouter ```use Spatie\Permission\Traits\HasRoles;``` au modèle user (app/user.php)

- Faire un seeder qui va créer 3 rôles  
Faire la commande pour créer un seeder ```php artisan make:seeder RolesTableSeeder``` puis on complète la fonction run()  
```php
public function run()
    {
    Role::create(['name' => 'worker']);
    Role::create(['name' => 'user']);
    Role::create(['name' => 'spectateur']);
    }
```
- Modifier votre UsersTableSeeder pour qu'il créer 10/40/50 users avec respectivement les rôles tout juste créer
```php
factory(App\User::class, 10)->create()->each(function ($user) {
        $user->assignRole("user");
        $user->profile()->save(factory(App\Profile::class)->make());
    });
    factory(App\User::class, 40)->create()->each(function ($user) {
        $user->assignRole("worker");
        $user->profile()->save(factory(App\Profile::class)->make());
    });
    factory(App\User::class, 50)->create()->each(function ($user) {
        $user->assignRole("spectateur");
        $user->profile()->save(factory(App\Profile::class)->make());
    });
```
## Utiliser les Middleware
- Créer trois contrôler qui portent le nom des trois rôles que vous avez créé  
Pour créer un controller on utlise ```php artisan make:controller CONTROLLER```  
Création des 3 views et des 3 routes associés:  
        * Ajout des views dans /ressources/views/ROLE.blade.php où ROLE est le rôle du controller  
        * Les routes sont modifiables dans ressources/routes/web.php
```php
Route::group(['middleware' => ['role:viewer']], function () {
    Route::get('/viewer', 'ViewerController@index') ->name('viewer');
});

Route::group(['middleware' => ['role:worker']], function () {
  Route::get('/worker', 'WorkerController@index') ->name('worker');
});

Route::group(['middleware' => ['role:user']], function () {
  Route::get('/user', 'UserController@index') ->name('user');
});
```

## Créer un profile
- Créer un model profile avec un contrôler, une factory, une migration  
Créer la factory (database/factories/ProfileFactory.php)   
et la migration (database/migrations/create_profile_table.php)  
et le provider (http/provider/profile.php):  
``` php artisan make:model profile -a```
le "-a" permet de créer la factory et la migration associé en meme temps que le modèle

- Un user possède un profile et un profile un seul use  
Ajout dans factory 
```php
$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'lastname' => $faker->unique()->safeEmail,
        'birthday' => $faker->dateTime($max = '15/10/2001'),
        'phone' => $faker->phoneNumber,
        'address' => $faker->unique()->address,
    ];
});
```
        


