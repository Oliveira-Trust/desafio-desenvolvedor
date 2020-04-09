<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ElementsTableSeeder::class);
        $this->call(RulesTableSeeder::class);
        $this->call(PartsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
        $this->call(ChaptersTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(SubsectionsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(ParagraphsTableSeeder::class);
        $this->call(IncisesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(LinesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
    }
}