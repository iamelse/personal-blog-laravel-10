<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Home::create([
            'url' => 'https://areatopik.com/wp-content/uploads/2022/10/Kobo-Nangis.jpg',
            'image' => NULL,
            'body' => '<h1 class="text l-text-dark display-5 fw-bold">
                        I write about coding and being a <span class="text l-text-primary">full-time</span> maker.
                      </h1>
                      <p class="text l-text-p fs-5">
                        Writer, Speaker, Developer, and Co-Founder of Code.co, 
                        and AppForYou. I write about coding, startups, 
                        and my journey as a full-time maker.
                      </p>'
        ]);
        
        \App\Models\About::create([
            'body' => '<section class="col-lg-12 pb-2">
                        <h1 class="text l-text-dark display-5 fw-bold">Hi. I\'m <span class="text l-text-primary">Lana Septiana</span>🤟</h1>
                      </section>
                      <section class="col-lg-12 pb-2">
                        <h5 class="text l-text-dark fw-bold my-3">Short Bio</h5>
                        <p class="l-text-p">I\'m a software engineer with more than 10 years of experience in a variety of domains. For the past few years, I\'ve focused on highload server-side projects, distributed systems, and platform development - tinkering with infrastructure, all things containers and Cloud Native.</p>
                        <p class="l-text-p">While there isn\'t a Wikipedia page about me (sorry folks!), a media bio is available below.</p>
                      </section>
                      <section class="col-lg-12 pb-2">
                        <h5 class="text l-text-dark fw-bold my-3">Career</h5>
                        <p class="l-text-p">In my role as a Senior Software Engineer for Google Chrome, I am responsible for developing and maintaining the Chrome Web Browser.</p>
                        <p class="l-text-p">My work involves developing and testing new features, optimizing performance and security, and ensuring the browser works for users around the world. I also work closely with other Google teams to ensure Chrome is well-integrated with other Google products and services.</p>
                        <p class="l-text-p">As CTO of AppForYou, I am responsible for leading the technical team and developing the company\'s technology strategy. I work closely with the engineering team to ensure that the products and services we provide are secure.</p>
                      </section>'
        ]);        

        \App\Models\User::factory()->create([
            'name' => 'Lana Septiana',
            'username' => 'iamelse',
            'email' => 'lana.septiana2@gmail.com',
            'password' => 'password'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Tatang Basher',
            'username' => 'tatang',
            'email' => 'tatang@gmail.com',
            'password' => 'password'
        ]);

        \App\Models\PostCategory::factory()->create([
            'name' => 'Coding',
            'show_in_homepage' => 1,
            'slug' => 'coding',
        ]);

        \App\Models\SocialMedia::factory()->create([
            'name' => 'Instagram',
            'url' => 'https://www.instagram.com/iamelse_',
            'icon' => 'bx bxl-instagram',
        ]);

        \App\Models\SocialMedia::factory()->create([
            'name' => 'LinkedIn',
            'url' => 'https://www.linkedin.com/in/iamelse',
            'icon' => 'bx bxl-linkedin-square',
        ]);

        \App\Models\PostCategory::factory(20)->create();
        \App\Models\Post::factory(30)->state(function (array $attributes) {
            return [
                'user_id' => rand(1, 2),
            ];
        })->create();

        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
