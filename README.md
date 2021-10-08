# Laravel web blogging demo

## About This project

This project demonstrate the blogging features like

- View All the post (Guest)
- View single post (Guest)
- Search Post (Guest)
- Sort by latest and oldest post (Guest) 
- Add new post (Author)
- Edit post (Admin)
- Delete post (Admin)
- Import posts from given url (Admin)
    - Note: Don't forget to start artisan command
        before importing posts, please use database or other queue driver
        
        php artisan queue:work

    Import format
    ```javascript
    {
        "data": [
            {
                "title": "Title",
                "description": "Description",
                "publication_date": "2021-10-06 03:00:13"
            },
            {
                ...n
            }
        ]
    }   

##How to run?
- Database name "blogging"
- php artisan migrate
- php artisan db:seed
- Default password for admin => "secret"
- Default password for author/editor => "secret"
- You can use artisan cache command to improve performance,
    - Use Redis cache driver(For production)
    - php artisan config:cache
    - php artisan route:cache
    - php artisan queue:work
- Running test
    - php artisan test

### Laravel features used in this demo
- Repository Pattern (Only in home page to list guest's posts)
    - [Reference](https://github.com/VijaySankhat/web-blogging/blob/main/app/Http/Controllers/Frontend/PostController.php#L21)

- Policy and custom policy methods, also used authorization Blade directives to check ability 
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Policies/PostPolicy.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Http/Controllers/Admin/PostController.php#L27)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/resources/views/admin/posts/layouts/list-post-item.blade.php#L25)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/resources/views/admin/posts/layouts/post-sorting.blade.php#L18)
    
- Service providers to import posts
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Services/PostImportService.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Jobs/ProcessImportPostRequest.php#L28)
    
- Laravel queued jobs
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Jobs/ProcessImportPostRequest.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Http/Controllers/Admin/PostController.php#L134)

- Scoped queries and eloquent relations
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Models/User.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Models/Post.php)

- Separate admin routes file    
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Providers/RouteServiceProvider.php#L50)

- Route model binding
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/routes/admin.php#L7) 

- Resource controller (for an admin, routes/admin.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/routes/admin.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Http/Controllers/Admin/PostController.php)
    
- Custom Form request to validate all the incoming http request
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Http/Requests/ImportRequest.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Http/Requests/PostsRequest.php)

- Custom validation Rules (We can also achieve this using middleware)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Rules/CanImport.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Http/Requests/ImportRequest.php#L16)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Rules/CanSave.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Http/Requests/PostsRequest.php#L29)

- Customized(Updated/newly added) Service provider
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Providers/AppServiceProvider.php#L34)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Providers/RouteServiceProvider.php#L50)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Providers/AuthServiceProvider.php#18)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Providers/RepositoryServiceProvider.php)

- Custom Helper
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Helpers/helper.php)

- Constants
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Constants/UserRoles.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Constants/ImportJsonKey.php)

- API Client Helper
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/app/Client/AbstractClient.php)

- Factories
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/database/factories/PostFactory.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/database/factories/RoleFactory.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/database/factories/UserFactory.php)
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/database/factories/UserRoleFactory.php)

- Laravel Blade

- Guest Views
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/resources/views/posts)   

- Admin Views
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/resources/views/admin/posts)

- Authentication Views
    - [Reference](https://github.com/VijaySankhat/web_blogging/blob/main/resources/views/auth)
              
Note: Used default authentication provided by Laravel, system have only two roles, author/admin

## License

open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
