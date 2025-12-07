<?php  // Start PHP code

use Illuminate\Database\Migrations\Migration;  // Import Migration class
use Illuminate\Database\Schema\Blueprint;       // Import Blueprint for table structure
use Illuminate\Support\Facades\Schema;          // Import Schema for creating/dropping tables

return new class () extends Migration {  // Create an anonymous migration class

    public function up(): void   // Runs when you execute "php artisan migrate"
    {
        Schema::create('issues', function (Blueprint $table) {  // Create a table named "issues"
            $table->id();                    // Auto-increment primary key (id)
            $table->string('title');         // Column for issue title (short text)
            $table->text('description');     // Column for detailed issue description (long text)
            $table->string('image_path')->nullable();
            $table->string('status')         // Column for issue status
                  ->default('Pending');      // Default status value is "Pending"
            $table->timestamps();            // Adds created_at and updated_at timestamps
        });
    }

    public function down(): void   // Runs when you execute "php artisan migrate:rollback"
    {
        Schema::dropIfExists('issues');   // Delete the "issues" table if it exists
    }
};
