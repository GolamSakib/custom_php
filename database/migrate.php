<?php
namespace Database;
require_once __DIR__ . '/../vendor/autoload.php';

class MigrationRunner
{
    public function run($direction = 'up')
    {
        $migrationFiles = [];

        if (isset($argv[2])) {
            $migrationFiles[] = __DIR__ . '/migrations/' . $argv[2] . '.php';
        } else {
            $migrationFiles = glob(__DIR__ . '/migrations/*.php');
        }

        foreach ($migrationFiles as $file) {
            require_once $file;
            $className = 'Database\\Migrations\\' . basename($file, '.php');
            $migration = new $className();

            if (method_exists($migration, $direction)) {
                $migration->{$direction}();
                echo "Migration {$className} {$direction} executed successfully.\n";
            } else {
                echo "Migration {$className} does not have a {$direction} method.\n";
            }
        }
    }
}

// Run the migrations
$runner = new MigrationRunner();
$runner->run($argv[1] ?? 'up');
