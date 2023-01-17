<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
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
        $users_id = User::select('id')->where('role', 'user')->get();
        $count = count($users_id);
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
            $project->type_id = 1;
            $project->user_id = 1;
            if($count){
                $project->user_id = $users_id[$i % $count]->id;
            }else{
                $project->user_id = null;
            }
            $project->save();
        }
    }
}
