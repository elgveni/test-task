<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Accounts / authentication',
            ],
            [
                'name' => 'Activity view',
            ],
            [
                'name' => 'Administration',
            ],
            [
                'name' => 'Attachments',
            ],
            [
                'name' => 'Calendar',
            ],
            [
                'name' => 'Code cleanup/refactoring',
            ],
            [
                'name' => 'Core Plugins',
            ],
            [
                'name' => 'Custom fields',
            ],
            [
                'name' => 'Database',
            ],
            [
                'name' => 'Documentation',
            ],
            [
                'name' => 'Documents',
            ],
            [
                'name' => 'Email notifications',
            ],
            [
                'name' => 'Email receiving',
            ],
            [
                'name' => 'Feeds',
            ],
            [
                'name' => 'Files',
            ],
            [
                'name' => 'Filters',
            ],
            [
                'name' => 'Forums',
            ],
            [
                'name' => 'Gantt',
            ],
            [
                'name' => 'Gems support',
            ],
            [
                'name' => 'Groups',
            ],
            [
                'name' => 'Hook requests',
            ],
            [
                'name' => 'I18n',
            ],
            [
                'name' => 'Importers',
            ],
            [
                'name' => 'Issues',
            ],
            [
                'name' => 'Issues filter',
            ],
            [
                'name' => 'Issues list',
            ],
            [
                'name' => 'Issues permissions',
            ],
            [
                'name' => 'Issues planning',
            ],
            [
                'name' => 'Issues workflow',
            ],
            [
                'name' => 'LDAP',
            ],
            [
                'name' => 'My page',
            ],
            [
                'name' => 'News',
            ],
            [
                'name' => 'OpenID',
            ],
            [
                'name' => 'PDF export',
            ],
            [
                'name' => 'Performance',
            ],
            [
                'name' => 'Permissions and roles',
            ],
            [
                'name' => 'Plugin API',
            ],
            [
                'name' => 'Plugin Request',
            ],
            [
                'name' => 'Project settings',
            ],
            [
                'name' => 'Projects',
            ],
            [
                'name' => 'Rails support',
            ],
            [
                'name' => 'REST API',
            ],
            [
                'name' => 'Roadmap',
            ],
            [
                'name' => 'Ruby support',
            ],
            [
                'name' => 'SCM',
            ],
            [
                'name' => 'SCM extra',
            ],
            [
                'name' => 'Search engine',
            ],
            [
                'name' => 'Security',
            ],
            [
                'name' => 'SEO',
            ],
            [
                'name' => 'Text formatting',
            ],
            [
                'name' => 'Themes',
            ],
            [
                'name' => 'Third-party libraries',
            ],
            [
                'name' => 'Time tracking',
            ],
            [
                'name' => 'Translations',
            ],
            [
                'name' => 'UI',
            ],
            [
                'name' => 'UI - Responsive',
            ],
            [
                'name' => 'Website (redmine.org)',
            ],
            [
                'name' => 'Wiki',
            ],
        ]);
    }
}
