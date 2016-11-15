<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {

    public function run() {

        // Add required users and 5 other test users.
        $user_ids = array();
        $jill_id = DB::table('users')->insertGetId([
            'name' => 'Jill',
            'email' => 'jill@harvard.edu',
            'password' => Hash::make('helloworld')
        ]);
        array_push($user_ids, $jill_id);
        $jamal_id = DB::table('users')->insertGetId([
            'name' => 'Jamal',
            'email' => 'jamal@harvard.edu',
            'password' => Hash::make('helloworld')
        ]);
        array_push($user_ids, $jamal_id);
        foreach (range(1, 5) as $i) {
            $user_id = DB::table('users')->insertGetId([
                'name' => 'Test User ' . $i,
                'email' => 'test' . $i . '@test.com',
                'password' => Hash::make('test')
            ]);
            array_push($user_ids, $user_id);
        }

        // Add between 1 and 3 test projects that each test user will own.
        $project_users = array();
        foreach ($user_ids as $owner_id) {
            foreach (range(1, rand(1, 3)) as $i) {
                $project_id = DB::table('projects')->insertGetId([
                    'owner_id' => $owner_id,
                    'title' => static::generateRandomProjectTitle(),
                    'description' => static::generateRandomProjectDescription()
                ]);
                $project_users[$project_id] = array($owner_id);
                // Assign users to the project. The owner always gets added and
                // other users have a 50% chance of being assigned.
                foreach ($user_ids as $user_id) {
                    if ($user_id == $owner_id || rand(0, 99) < 50) {
                        array_push($project_users[$project_id], $user_id);
                        DB::table('project_users')->insert([
                            'project_id' => $project_id,
                            'user_id' => $user_id
                        ]);
                    }
                }
            }
        }

        // Add between 10 and 30 test tasks to each project.
        $TASK_STATUS = array('To Do', 'In Progress', 'Done');
        foreach ($project_users as $project_id => $project_users) {
            foreach (range(10, 30) as $i) {
                // Test tasks have a 75% chance of being assigned to a random user
                // that has been assigned to the project.
                $assignee_id = null;
                if (rand(0, 99) < 75) {
                    $assignee_id = $project_users[array_rand($project_users)];
                }
                DB::table('tasks')->insert([
                    'project_id' => $project_id,
                    'assignee_id' => $assignee_id,
                    'title' => static::generateRandomTaskTitle(),
                    'description' => static::generateRandomTaskDescription(),
                    'status' => $TASK_STATUS[array_rand($TASK_STATUS)]
                ]);
            }
        }
    }

    private static $FAKER;

    private static function getFaker() {
        if (static::$FAKER == null) {
            static::$FAKER = Faker\Factory::create();
        }
        return static::$FAKER;
    }

    private static $PROJECT_TITLE_DESCRIPTOR = array(
        'big', 'important', 'expensive', 'minor', 'critical', 'special',
        'brand new', 'exciting', 'urgent', 'transitional', 'support for',
        'technical support of', 'setup for', 'initial steps for');
    private static $PROJECT_TITLE_NOUN = array(
        'pitch', 'proof of concept', 'project', 'web application',
        'rebrand', 'server farm', 'compiler design', 'design project',
        'startup preparation', 'website', 'application', 'domain research');
    private static $PROJECT_TITLE_JOIN = array(
        'in collaboration with', 'in preparation for', 'for', 'with respect to',
        'before', 'related to');
    private static $PROJECT_TITLE_JOIN_NOUN = array(
        'investors', 'national conference', 'annual summit', 'important meeting',
        'sales pitch', 'next project', 'new fiscal year', 'quarterly reports');
    private static function generateRandomProjectTitle() {
        $title_elements = array();
        if (rand(0, 99) < 50) {
            array_push($title_elements, static::$PROJECT_TITLE_DESCRIPTOR[array_rand(static::$PROJECT_TITLE_DESCRIPTOR)]);
        }
        array_push($title_elements, static::$PROJECT_TITLE_NOUN[array_rand(static::$PROJECT_TITLE_NOUN)]);
        if (rand(0, 99) < 50) {
            array_push($title_elements, static::$PROJECT_TITLE_JOIN[array_rand(static::$PROJECT_TITLE_JOIN)]);
            array_push($title_elements, static::$PROJECT_TITLE_JOIN_NOUN[array_rand(static::$PROJECT_TITLE_JOIN_NOUN)]);
        }
        return ucfirst(implode(' ', $title_elements)) . '.';
    }

    private static function generateRandomProjectDescription() {
        return static::getFaker()->text(200);
    }

    private static $TASK_TITLE_VERB = array(
        'design', 'build', 'create', 'implement', 'update', 'revamp',
        'redesign', 'revisit', 'work with', 'schedule', 'meet about',
        'analyze', 'debug', 'fix');
    private static $TASK_DESCRIPTOR = array(
        'new', 'brand new', 'technical', 'front end', 'back end',
        'important', 'urgent', 'game-changing', 'best possible',
        'beautiful', 'elegant', 'streamlined', 'cost-effective');
    private static $TASK_TITLE_NOUN = array(
        'project plan', 'concept art', 'mockup', 'site map', 'copy',
        'verbage', 'website', 'web server', 'command line interface',
        'calendar event', 'meeting plan', 'route');
    private static $TASK_TITLE_JOIN = array(
        'and', 'or', 'with', 'alongisde', 'in place of');

    private static function generateRandomTaskTitle() {
        $title_elements = array();
        array_push($title_elements, static::$TASK_TITLE_VERB[array_rand(static::$TASK_TITLE_VERB)]);
        if (rand(0, 99) < 50) {
            array_push($title_elements, static::$TASK_DESCRIPTOR[array_rand(static::$TASK_DESCRIPTOR)]);
        }
        array_push($title_elements, static::$TASK_TITLE_NOUN[array_rand(static::$TASK_TITLE_NOUN)]);
        if (rand(0, 99) < 33) {
            array_push($title_elements, static::$TASK_TITLE_JOIN[array_rand(static::$TASK_TITLE_JOIN)]);
            if (rand(0, 99) < 50) {
                array_push($title_elements, static::$TASK_DESCRIPTOR[array_rand(static::$TASK_DESCRIPTOR)]);
            }
            array_push($title_elements, static::$TASK_TITLE_NOUN[array_rand(static::$TASK_TITLE_NOUN)]);
        }
        return ucfirst(implode(' ', $title_elements)) . '.';
    }

    private static function generateRandomTaskDescription() {
        return static::$FAKER->text(200);
    }
}
