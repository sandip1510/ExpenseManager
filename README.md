Phase - 1
Step -1 
composer create-project --prefer-dist laravel/laravel ExpenseManager
cd ExpenseManager
php artisan serve


Step-2
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expense_manager
DB_USERNAME=root
DB_PASSWORD=yourpassword

Step-3
php artisan migrate

Step-4
php artisan make:model Expense -m

Step-5
Update Up Method - database/migrations/xxxx_xx_xx_create_expenses_table.php

public function up()
{
    Schema::create('expenses', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->decimal('amount', 10, 2);
        $table->date('date');
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

Step-6
php artisan migrate

Step-7
Create a Controller
php artisan make:controller ExpenseController --resource

Step-8
Define routes in routes/web.php

use App\Http\Controllers\ExpenseController;
Route::resource('expenses', ExpenseController::class);


Step-9
Implement CRUD in the Controller

Step-10
Add User Authentication

composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install && npm run dev


Step-11
Protect Expense Routes

Step-12
Assign Expenses to Users
 Create a Migration  - php artisan make:migration add_user_id_to_expenses_table --table=expenses

Modify the migration file (database/migrations/xxxx_xx_xx_add_user_id_to_expenses_table.php)

    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }


Step-12
Update the Expense Model

Step-13
Ensure Expenses Are Saved with the Logged-in User

Step-14
Filter Expenses by Date & Search

Step-15
Add Expense Categories
 Create a Category Model & Migration
   php artisan make:model Category -m
       Modify database/migrations/xxxx_xx_xx_create_categories_table.php
              public function up()
                {
                    Schema::create('categories', function (Blueprint $table) {
                        $table->id();
                        $table->string('name')->unique();
                        $table->timestamps();
                    });
                }


Step-16
Modify the Expense Model
  Add a relationship

Step-17
  Add a Category Dropdown in the Expense Form

Step-18
 Generate Expense Reports (CSV Export) 
  php artisan make:controller ReportController

Step-19
Improve UI with Tailwind CSS
    npm install tailwindcss
    npx tailwindcss init

Step-20
Install Laravel DataTables
    composer require yajra/laravel-datatables-oracle

Step-21
Publish the DataTables Configuration (if needed)
    php artisan vendor:publish --tag=datatables

Step-22
Create a DataTable Class
    php artisan make:datatable ExpenseDataTable



Pashe -2
Step-23
    category-wise total is accurate
        categories = Category::with('expenses')->get();