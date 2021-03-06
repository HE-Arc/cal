<?php
use Illuminate\Database\Seeder;
use App\Agenda;
use App\Task;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // clear our database ------------------------------------------
        DB::table('tasks')->delete();
        DB::table('agenda_user')->delete();
        DB::table('agendas')->delete();
        DB::table('users')->delete();
        $this->command->info('Databases cleaned !');

        $user1 = User::create(array(
            'alias'         =>  'user1',
            'email'         =>  'user1@user.com',
            'password'      =>  'user1',
        ));

        $user2 = User::create(array(
            'alias'         =>  'user2',
            'email'         =>  'user2@user.com',
            'password'      =>  'user2',
        ));
        $this->command->info('Users seeded !');

        // seed our calendars table ------------------------
        $calendar1 = Agenda::create(array(
            'title'                 =>  'Calendar1',
            'admin_id'              =>  $user1->id,
            'priority_low_color'    =>  '#FFFFFF',
            'priority_medium_color' =>  '#0000FF',
            'priority_high_color'   =>  '#FF0000',
        ));
        $calendar2 = Agenda::create(array(
            'title'                 =>  'Calendar2',
            'admin_id'              =>  $user2->id,
            'priority_low_color'    =>  '#0F0F0F',
            'priority_medium_color' =>  '#00FFFF',
            'priority_high_color'   =>  '#FFFF00',
        ));
        $this->command->info('Calendars seeded !');


        // seed our tasks table ---------------------
        $task1 = Task::create(array(
            'title'             =>  'Task1',
            'time_start'        =>  new DateTime('2016-12-07'),
            'time_end'          =>  new DateTime('2016-12-08'),
            'description'       =>  'description',
            'priority'          =>  '1',
            'location'          =>  'ici',
            'attachment_url'    =>  'aaa',
            'agenda_id'       =>  $calendar1->id,
        ));

        $task2 = Task::create(array(
            'title'             =>  'Task2',
            'time_start'        =>  new DateTime('2016-12-08'),
            'time_end'          =>  new DateTime('2016-12-09'),
            'description'       =>  'description',
            'priority'          =>  '2',
            'location'          =>  'la',
            'attachment_url'    =>  'aaa',
            'agenda_id'         =>  $calendar1->id,
        ));

        $task3 = Task::create(array(
            'title'             =>  'Task3',
            'time_start'        =>  new DateTime('2016-12-09'),
            'time_end'          =>  new DateTime('2016-12-10'),
            'description'       =>  'description',
            'priority'          =>  '2',
            'location'          =>  'a gauche',
            'attachment_url'    =>  'aaa',
            'agenda_id'         =>  $calendar2->id,
        ));
        $this->command->info('Tasks seeded !');


        // seed our users table -----------------------
        $userTest = User::create(array(
            'alias'         =>  'Test',
            'email'         =>  'test@test.com',
            'password'      =>  '123456',
        ));



        // link user to calendar
        $user1->agendas()->attach($calendar1->id, [
            'add_task'          => true,
            'edit_task'         => true,
            'delete_task'       => true,
            'edit_member'       => true,
            'edit_calendar'     => true,
            'delete_calendar'   => true,
        ]);
        $calendar2->users()->attach($user1->id, [
            'add_task'          => false,
            'edit_task'         => false,
            'delete_task'       => false,
            'edit_member'       => false,
            'edit_calendar'     => false,
            'delete_calendar'   => false,
        ]);

        $user2->agendas()->attach($calendar2->id, [
            'add_task'          => true,
            'edit_task'         => true,
            'delete_task'       => true,
            'edit_member'       => true,
            'edit_calendar'     => true,
            'delete_calendar'   => true,
        ]);


        $this->command->info('Linking done !');

        $this->command->info('Calendar app seeds finished.'); // show information in the command line after everything is run

    }
}
