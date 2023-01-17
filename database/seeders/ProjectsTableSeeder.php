<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {

            $project = new Project();
            $project->name = $faker->words(1, true);
            $project->slug = Str::slug($project->name, '-');
            $project->description = $faker->paragraph();
            // $project->dev_lang = $faker->words(3,true);
            $project->framework = $faker->words(3,true);
            $project->team = $faker->firstName();
            $project->git_link = $faker->url();
            $project->diff_lvl = $faker->numberBetween(1,10);
            $project->save();
        }
    }
}
