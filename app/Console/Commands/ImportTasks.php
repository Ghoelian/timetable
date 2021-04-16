<?php

namespace App\Console\Commands;

use App\Models\Incident;
use App\Models\TaskLog;
use Illuminate\Console\Command;

class ImportTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timetable:import-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = [
            ['date' => '2020-09-21', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Add menu item for administratoin->change user options'],
            ['date' => '2020-09-21', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Add proper exception handling'],
            ['date' => '2020-09-21', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Add update succesful notification to postUserForwarderOptions'],
            ['date' => '2020-09-21', 'incident' => 'INC000000225176', 'time' => '3:00', 'description' => 'Refactored editUserForwarderOptions'],

            ['date' => '2020-09-22', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Fix going to edit user optoins from shipment details not passing userId'],
            ['date' => '2020-09-22', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Fix layout to be more consistent with other similar forms'],
            ['date' => '2020-09-22', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Change editUserForwarderOptions to use POST instead of GET'],
            ['date' => '2020-09-22', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Fix editUserForwarderOptions to show user options when none exist yet'],
            ['date' => '2020-09-22', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Make initial screen design'],
            ['date' => '2020-09-22', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Add option to change user type'],
            ['date' => '2020-09-22', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Add observer to user data'],

            ['date' => '2020-09-23', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Update screen design to add username search'],
            ['date' => '2020-09-23', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Fix observers and trans table migration'],
            ['date' => '2020-09-23', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Fix this stupid spreadsheet'],
            ['date' => '2020-09-23', 'incident' => 'INC000000225176', 'time' => '4:00', 'description' => 'Refactor some code'],

            ['date' => '2020-09-24', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Deploy to test server'],
            ['date' => '2020-09-24', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Make initial screen design'],
            ['date' => '2020-09-24', 'incident' => 'INC000000225176', 'time' => '6:00', 'description' => 'Start working on language view view'],

            ['date' => '2020-09-25', 'incident' => 'INC000000225176', 'time' => '5:00', 'description' => 'Export to spreadsheet function added'],
            ['date' => '2020-09-25', 'incident' => 'INC000000225176', 'time' => '3:00', 'description' => 'Working on filter function'],

            ['date' => '2020-09-28', 'incident' => 'INC000000225176', 'time' => '3:00', 'description' => 'Fixing checkbox'],
            ['date' => '2020-09-28', 'incident' => 'INC000000225176', 'time' => '3:30', 'description' => 'Finishing view translations page'],
            ['date' => '2020-09-28', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],

            ['date' => '2020-09-29', 'incident' => 'INC000000225176', 'time' => '8:00', 'description' => 'Did not write anything down here.'],

            ['date' => '2020-09-30', 'incident' => 'INC000000225176', 'time' => '8:00', 'description' => 'Did not write anything down here'],

            ['date' => '2020-10-01', 'incident' => 'INC000000225176', 'time' => '8:00', 'description' => 'Did not write anything down here'],

            ['date' => '2020-10-02', 'incident' => 'INC000000225176', 'time' => '8:00', 'description' => 'Did not write anything down here'],

            ['date' => '2020-10-05', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Code of conduct course'],
            ['date' => '2020-10-05', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Fixing PSR-4 errors'],
            ['date' => '2020-10-05', 'incident' => 'INC000000225176', 'time' => '4:30', 'description' => 'Making translations overview only show translations from current module'],
            ['date' => '2020-10-05', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],

            ['date' => '2020-10-06', 'incident' => 'INC000000225176', 'time' => '3:00', 'description' => 'Fixing navbar buttons'],
            ['date' => '2020-10-06', 'incident' => 'INC000000225176', 'time' => '5:00', 'description' => 'Trying to get uploading to work'],

            ['date' => '2020-10-07', 'incident' => 'INC000000225176', 'time' => '8:00', 'description' => 'Putting new translations from xlsx file in database'],

            ['date' => '2020-10-08', 'incident' => 'INC000000225176', 'time' => '6:00', 'description' => 'Putting new translations from xlsx file in database'],
            ['date' => '2020-10-08', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Trying to get Excel to not trim off spaces in translations'],

            ['date' => '2020-10-09', 'incident' => 'INC000000225176', 'time' => '3:30', 'description' => 'Clean up code for push'],
            ['date' => '2020-10-09', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Evaluation probational period'],
            ['date' => '2020-10-09', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Fixing broken commit to tfs'],
            ['date' => '2020-10-09', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2020-10-12', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Make weekly presentation'],
            ['date' => '2020-10-12', 'incident' => 'INC000000225176', 'time' => '5:30', 'description' => 'Making translations overview show English as original text instead of the header key'],
            ['date' => '2020-10-12', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],
            ['date' => '2020-10-12', 'incident' => 'INC000000225176', 'time' => '0:30', 'description' => 'Check and commit today\'s work'],

            ['date' => '2020-10-13', 'incident' => 'INC000000225176', 'time' => '4:00', 'description' => 'Fix slow writing for refreshing languages'],
            ['date' => '2020-10-13', 'incident' => 'INC000000225176', 'time' => '0:30', 'description' => 'Fix permissions seeder'],
            ['date' => '2020-10-13', 'incident' => 'INC000000225176', 'time' => '3:30', 'description' => 'Add arguments to refresh command to allow refreshing one module or language'],

            ['date' => '2020-10-14', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Fix upload button styling when disabled'],
            ['date' => '2020-10-14', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Switch from FastExcel to Spout in download function'],
            ['date' => '2020-10-14', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Switch from FastExcel to Spout in upload function'],
            ['date' => '2020-10-14', 'incident' => 'INC000000225176', 'time' => '3:00', 'description' => 'Start fixing adding new translations where none existed yet'],

            ['date' => '2020-10-15', 'incident' => 'INC000000225176', 'time' => '3:00', 'description' => 'Fix adding new translations'],
            ['date' => '2020-10-15', 'incident' => 'INC000000225176', 'time' => '4:00', 'description' => 'Make translations editable from overview'],
            ['date' => '2020-10-15', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Some small improvements/bugfixes to translations package'],

            ['date' => '2020-10-16', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Create trans_head tran table'],
            ['date' => '2020-10-16', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Create observers for tran table'],
            ['date' => '2020-10-16', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Create seeder for trans_head_tran table'],
            ['date' => '2020-10-16', 'incident' => 'INC000000225176', 'time' => '3:00', 'description' => 'Move caching logic out of Refresh.php, into Head.php'],
            ['date' => '2020-10-16', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Weekly administration'],

            ['date' => '2020-10-19', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Show modal on click on edit button for individual translations'],
            ['date' => '2020-10-19', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly meeting'],
            ['date' => '2020-10-19', 'incident' => 'INC000000225176', 'time' => '1:30', 'description' => 'Finish showing modal to edit individual translations'],
            ['date' => '2020-10-19', 'incident' => 'INC000000225176', 'time' => '0:30', 'description' => 'Fix trans_head_tran seeder'],
            ['date' => '2020-10-19', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Code review'],
            ['date' => '2020-10-19', 'incident' => 'INC000000225176', 'time' => '2:00', 'description' => 'Fixin some bugs and stuff'],

            ['date' => '2020-10-20', 'incident' => 'INC000000225176', 'time' => '3:30', 'description' => 'Fixin some bugs and stuff'],
            ['date' => '2020-10-20', 'incident' => 'INC000000225176', 'time' => '4:30', 'description' => 'Refactoring translations queries into one function'],

            ['date' => '2020-10-21', 'incident' => 'INC000000225176', 'time' => '1:30', 'description' => 'Code review'],
            ['date' => '2020-10-21', 'incident' => 'INC000000225176', 'time' => '6:30', 'description' => 'Some more small fixes, translations package should be ready for deployment now'],

            ['date' => '2020-10-22', 'incident' => 'INC000000225176', 'time' => '3:00', 'description' => 'Finalise everything for merge into dev'],
            ['date' => '2020-10-22', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Meeting with Gijs'],
            ['date' => '2020-10-22', 'incident' => 'INC000000223753', 'time' => '2:00', 'description' => 'Make screen designs'],
            ['date' => '2020-10-22', 'incident' => 'INC000000223753', 'time' => '2:00', 'description' => 'Start making role users overview'],

            ['date' => '2020-10-23', 'incident' => 'INC000000223753', 'time' => '5:00', 'description' => 'Making role users overview page'],
            ['date' => '2020-10-23', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],
            ['date' => '2020-10-23', 'incident' => 'INC000000223753', 'time' => '2:00', 'description' => 'Start creating view to search for a specific user'],

            ['date' => '2020-10-26', 'incident' => 'INC000000223753', 'time' => '2:30', 'description' => 'Creating view to search for a specific user'],
            ['date' => '2020-10-26', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly  meeting'],
            ['date' => '2020-10-26', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Attempt to fix PSR-4 errors again'],
            ['date' => '2020-10-26', 'incident' => 'INC000000223753', 'time' => '1:00', 'description' => 'Finish view to search for a specific user by email or username'],
            ['date' => '2020-10-26', 'incident' => 'INC000000223753', 'time' => '1:00', 'description' => 'Start work on edit use roles page'],
            ['date' => '2020-10-26', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Trying to fix AV with Renko'],

            ['date' => '2020-10-27', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Trying to fix AV with Dennis this time'],
            ['date' => '2020-10-27', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Actually succesfully fix PSR-4 errors this time'],
            ['date' => '2020-10-27', 'incident' => 'INC000000223753', 'time' => '1:30', 'description' => 'Finish edit user roles page'],
            ['date' => '2020-10-27', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Code review'],
            ['date' => '2020-10-27', 'incident' => 'INC000000223753', 'time' => '3:00', 'description' => 'Misc fixes'],

            ['date' => '2020-10-28', 'incident' => 'INC000000223753', 'time' => '3:30', 'description' => 'Misc fixes'],
            ['date' => '2020-10-28', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Code review'],
            ['date' => '2020-10-28', 'incident' => 'INC000000223753', 'time' => '3:30', 'description' => 'Start work on team-related pages'],

            ['date' => '2020-10-29', 'incident' => 'INC000000223753', 'time' => '2:00', 'description' => 'Make search users page for teams'],
            ['date' => '2020-10-29', 'incident' => 'INC000000223753', 'time' => '2:30', 'description' => 'Make edit teams page'],
            ['date' => '2020-10-29', 'incident' => 'INC000000223753', 'time' => '2:00', 'description' => 'Make tran table and observer for user_profile table'],
            ['date' => '2020-10-29', 'incident' => 'INC000000223753', 'time' => '1:30', 'description' => 'Finish edit part of edit teams page'],

            ['date' => '2020-10-30', 'incident' => 'INC000000223753', 'time' => '8:00', 'description' => 'Trying to get creating new teams to work'],

            ['date' => '2020-11-02', 'incident' => 'INC000000223753', 'time' => '6:00', 'description' => 'Finish creating new teams'],
            ['date' => '2020-11-02', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Weekly meeting'],

            ['date' => '2020-11-03', 'incident' => 'INC000000188538', 'time' => '4:30', 'description' => 'Fixing form getting reset on submit in action log creating'],
            ['date' => '2020-11-03', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Meeting with Gijs'],
            ['date' => '2020-11-03', 'incident' => 'INC000000223753', 'time' => '1:30', 'description' => 'Misc fixes'],

            ['date' => '2020-11-04', 'incident' => 'INC000000188538', 'time' => '1:30', 'description' => ''],
            ['date' => '2020-11-04', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Meeting with Casper and Gijs'],
            ['date' => '2020-11-04', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Meeting with Gijs'],
            ['date' => '2020-11-04', 'incident' => 'INC000000204462', 'time' => '3:30', 'description' => 'Making database design'],
            ['date' => '2020-11-04', 'incident' => 'INC000000204462', 'time' => '1:00', 'description' => 'Making screen designs'],

            ['date' => '2020-11-05', 'incident' => 'INC000000204462', 'time' => '2:30', 'description' => 'Making screen designs'],
            ['date' => '2020-11-05', 'incident' => 'INC000000225176', 'time' => '5:30', 'description' => 'Small fixes in translations package'],

            ['date' => '2020-11-06', 'incident' => 'INC000000225176', 'time' => '2:30', 'description' => 'Some more small fixes in translations package'],
            ['date' => '2020-11-06', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Meeting with Dennis about inventory system'],
            ['date' => '2020-11-06', 'incident' => 'INC000000204462', 'time' => '2:00', 'description' => 'Updating screen designs'],
            ['date' => '2020-11-06', 'incident' => 'INC000000225176', 'time' => '1:00', 'description' => 'Some more small fixes in translations package'],
            ['date' => '2020-11-06', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Weekly administration'],
            ['date' => '2020-11-06', 'incident' => 'INC000000204462', 'time' => '1:30', 'description' => 'Updating database design'],

            ['date' => '2020-11-09', 'incident' => 'INC000000204462', 'time' => '5:30', 'description' => 'Making database migrations for data and tran tables'],
            ['date' => '2020-11-09', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],
            ['date' => '2020-11-09', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Fixing audio with Renko'],

            ['date' => '2020-11-10', 'incident' => 'INC000000204462', 'time' => '4:30', 'description' => 'Made some improvements to the migrations'],
            ['date' => '2020-11-10', 'incident' => 'INC000000204462', 'time' => '3:30', 'description' => 'Getting Alice to work, and started working on views.'],

            ['date' => '2020-11-11', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Filling out evaluation form'],
            ['date' => '2020-11-11', 'incident' => 'INC000000204462', 'time' => '4:00', 'description' => 'Making seeders and models for inventory'],
            ['date' => '2020-11-11', 'incident' => 'INC000000204462', 'time' => '3:00', 'description' => 'Making view for spreadsheet upload'],

            ['date' => '2020-11-12', 'incident' => 'TAS000000058244', 'time' => '3:30', 'description' => 'Fix action log form resetting'],
            ['date' => '2020-11-12', 'incident' => 'INC000000223753', 'time' => '4:30', 'description' => 'Misc fixes in teams edit page'],

            ['date' => '2020-11-13', 'incident' => 'INC000000223753', 'time' => '4:00', 'description' => 'More misc fixes to teams stuff'],
            ['date' => '2020-11-13', 'incident' => 'INC000000204462', 'time' => '3:30', 'description' => 'Making controllers for spreadsheet upload'],
            ['date' => '2020-11-13', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Weekly administration'],

            ['date' => '2020-11-16', 'incident' => 'INC000000204462', 'time' => '6:00', 'description' => 'Making controllers for spreadsheet upload'],
            ['date' => '2020-11-16', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],

            ['date' => '2020-11-17', 'incident' => 'INC000000204462', 'time' => '2:30', 'description' => 'Making notebooks view for inventory system'],
            ['date' => '2020-11-17', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Code review with Gijs'],
            ['date' => '2020-11-17', 'incident' => 'INC000000204462', 'time' => '4:30', 'description' => 'Making notebooks view for inventory system, also getting the relations correct'],

            ['date' => '2020-11-18', 'incident' => 'INC000000204462', 'time' => '3:30', 'description' => 'Making views for phones, printers, montiors etc'],
            ['date' => '2020-11-18', 'incident' => 'INC000000204462', 'time' => '4:30', 'description' => 'Adding button to mark item as scrapped'],

            ['date' => '2020-11-19', 'incident' => 'INC000000223753', 'time' => '3:00', 'description' => 'Some more misc fixes for teams pages'],
            ['date' => '2020-11-19', 'incident' => 'INC000000223753', 'time' => '5:00', 'description' => 'Now manuallly filtering out countries with weird names like Korea, (North K.)'],

            ['date' => '2020-11-20', 'incident' => 'INC000000227442', 'time' => '1:00', 'description' => 'Trying to figure out how these pre-alerts work'],
            ['date' => '2020-11-20', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Code review with Gijs'],
            ['date' => '2020-11-20', 'incident' => 'INC000000223753', 'time' => '0:30', 'description' => 'Last few fixes for team pages'],
            ['date' => '2020-11-20', 'incident' => 'TAS000000058244', 'time' => '0:30', 'description' => 'Deploy to test server'],
            ['date' => '2020-11-20', 'incident' => 'INC000000227442', 'time' => '4:30', 'description' => 'Trying to fix the pre-alerts now so that it fits on the page'],
            ['date' => '2020-11-20', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2020-11-23', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Made presentation for weekly meeting'],
            ['date' => '2020-11-23', 'incident' => 'INC000000223753', 'time' => '0:30', 'description' => 'Couple more small fixes for teams pages, should be ready for deployment now'],
            ['date' => '2020-11-23', 'incident' => 'INC000000204462', 'time' => '4:30', 'description' => 'Made some small improvements to views'],
            ['date' => '2020-11-23', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],
            ['date' => '2020-11-23', 'incident' => 'INC000000204462', 'time' => '0:30', 'description' => 'Working on spreadsheet upload'],

            ['date' => '2020-11-24', 'incident' => 'TAS000000058244', 'time' => '2:00', 'description' => 'Implemented temporary fix for action log form resetting, but most likely not solid enough for production'],
            ['date' => '2020-11-24', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Progress update meeting with Dennis'],
            ['date' => '2020-11-24', 'incident' => 'INC000000204462', 'time' => '5:30', 'description' => 'Continuing work on spreadsheet import'],

            ['date' => '2020-11-25', 'incident' => 'INC000000204462', 'time' => '7:30', 'description' => 'Mostly finished importing notebooks, everything else should be mostly copy-paste'],

            ['date' => '2020-11-26', 'incident' => 'TAS000000058244', 'time' => '8:00', 'description' => 'Still trying to fix that action log thing, turns out it\'s much more intricate than I expected'],

            ['date' => '2020-11-27', 'incident' => 'TAS000000058244', 'time' => '6:00', 'description' => 'Still trying to fix that action log thing, it\'s mostly fixed now, just one minor issue to figure out'],
            ['date' => '2020-11-27', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2020-11-30', 'incident' => 'INC000000204462', 'time' => '6:00', 'description' => 'Continued working on spreadsheet imports'],
            ['date' => '2020-11-30', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],

            ['date' => '2020-12-01', 'incident' => 'INC000000204462', 'time' => '1:30', 'description' => 'Adding indexes to database'],
            ['date' => '2020-12-01', 'incident' => 'INC000000204462', 'time' => '6:00', 'description' => 'Finishing up spreadsheet import'],

            ['date' => '2020-12-02', 'incident' => 'INC000000204462', 'time' => '6:30', 'description' => 'Finished spreadsheet import'],
            ['date' => '2020-12-02', 'incident' => 'INC000000204462', 'time' => '1:30', 'description' => 'Started working on "local" search'],

            ['date' => '2020-12-03', 'incident' => 'TAS000000058244', 'time' => '1:30', 'description' => 'Actually fixed the action log thing now'],
            ['date' => '2020-12-03', 'incident' => 'INC000000204462', 'time' => '6:00', 'description' => 'Finished local search, except scrapped'],

            ['date' => '2020-12-04', 'incident' => 'TAS000000058244', 'time' => '1:00', 'description' => 'Deployed to production'],
            ['date' => '2020-12-04', 'incident' => 'TAS000000060270', 'time' => '3:00', 'description' => 'Moved the part that automatically closed RMA units to its own function'],
            ['date' => '2020-12-04', 'incident' => 'TAS000000060270', 'time' => '2:30', 'description' => 'Added a close button and checkboxes to mark multiple RMA units as closed at once'],
            ['date' => '2020-12-04', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2020-12-07', 'incident' => 'INC000000204462', 'time' => '5:30', 'description' => 'Created view for adding one item, working on inserting it into the database'],
            ['date' => '2020-12-07', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],
            ['date' => '2020-12-07', 'incident' => 'INC000000204462', 'time' => '0:30', 'description' => 'Working on inserting item into database'],

            ['date' => '2020-12-08', 'incident' => 'INC000000204462', 'time' => '6:00', 'description' => 'Refactoring spreadsheet import, so I can use the same function to add new items'],
            ['date' => '2020-12-08', 'incident' => 'INC000000204462', 'time' => '1:30', 'description' => 'Finishing up adding item'],

            ['date' => '2020-12-09', 'incident' => 'INC000000204462', 'time' => '4:00', 'description' => 'Finished item add page'],
            ['date' => '2020-12-09', 'incident' => 'INC000000204462', 'time' => '3:30', 'description' => 'Start working on security scan page'],

            ['date' => '2020-12-10', 'incident' => 'TAS000000060270', 'time' => '1:00', 'description' => 'Finished fixing alice buffer system'],
            ['date' => '2020-12-10', 'incident' => 'INC000000204462', 'time' => '1:00', 'description' => 'Added some missing columns to phones and printers'],
            ['date' => '2020-12-10', 'incident' => 'INC000000204462', 'time' => '5:30', 'description' => 'Continue working on security scan page'],

            ['date' => '2020-12-11', 'incident' => 'INC000000204462', 'time' => '6:00', 'description' => 'Finished security scan page'],
            ['date' => '2020-12-11', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],
            ['date' => '2020-12-11', 'incident' => 'INC000000204462', 'time' => '0:30', 'description' => 'Adding missing columns to the views for phones and printers'],

            ['date' => '2020-12-14', 'incident' => 'INC000000204462', 'time' => '5:30', 'description' => 'Refactor notebooks storage tables'],
            ['date' => '2020-12-14', 'incident' => 'INC000000204462', 'time' => '2:00', 'description' => 'Create observers for all tables'],

            ['date' => '2020-12-15', 'incident' => 'INC000000204462', 'time' => '7:30', 'description' => 'Start working on edit item page'],

            ['date' => '2020-12-16', 'incident' => 'INC000000204462', 'time' => '3:00', 'description' => 'Still making edit item page'],
            ['date' => '2020-12-16', 'incident' => 'INC000000204462', 'time' => '2:00', 'description' => 'Refactored addItem function, got rid of most duplicate code'],
            ['date' => '2020-12-16', 'incident' => 'INC000000204462', 'time' => '2:00', 'description' => 'Trying to fix timeout issue with spreadsheet upload'],
            ['date' => '2020-12-16', 'incident' => 'INC000000204462', 'time' => '1:00', 'description' => 'Meeting with Renko'],

            ['date' => '2020-12-17', 'incident' => 'INC000000204462', 'time' => '8:30', 'description' => 'Attempting to speed up spreadsheet import'],

            ['date' => '2020-12-18', 'incident' => 'INC000000227442', 'time' => '4:30', 'description' => 'Fixing pre-alerts overflowing off-screen'],
            ['date' => '2020-12-18', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'The asus way course thing'],
            ['date' => '2020-12-18', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2020-12-21', 'incident' => 'INC000000204462', 'time' => '5:30', 'description' => 'Still trying to speed up importing spreadsheet'],
            ['date' => '2020-12-21', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'The asus way course thing'],
            ['date' => '2020-12-21', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],
            ['date' => '2020-12-21', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'The asus way course thing'],

            ['date' => '2020-12-22', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'The asus way course thing'],
            ['date' => '2020-12-22', 'incident' => 'INC000000204462', 'time' => '5:30', 'description' => 'Finish up everything for test, import speed hasn\'t been fixed yet, postponing for later'],
            ['date' => '2020-12-22', 'incident' => 'INC000000204462', 'time' => '0:30', 'description' => 'Commit changes'],

            ['date' => '2020-12-23', 'incident' => 'INC000000204462', 'time' => '8:00', 'description' => 'Idk man'],

            ['date' => '2020-12-24', 'incident' => 'INC000000227442', 'time' => '4:30', 'description' => 'Fixed pre-alerts overflowing off-screen'],
            ['date' => '2020-12-24', 'incident' => 'INC000000204462', 'time' => '1:00', 'description' => 'Small fix for inventory system'],
            ['date' => '2020-12-24', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],
            ['date' => '2020-12-24', 'incident' => 'INC000000227442', 'time' => '0:30', 'description' => 'Deploy fix to production'],

            ['date' => '2020-12-28', 'incident' => 'INC000000204462', 'time' => '0:30', 'description' => 'Add date added column to overviews'],
            ['date' => '2020-12-28', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Deleting unused branches'],
            ['date' => '2020-12-28', 'incident' => 'INC000000204462', 'time' => '3:00', 'description' => 'Add ITSM column to add item/overview pages'],
            ['date' => '2020-12-28', 'incident' => 'INC000000204462', 'time' => '1:00', 'description' => 'Add post request validation'],
            ['date' => '2020-12-28', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Weekly meeting'],

            ['date' => '2020-12-29', 'incident' => 'INC000000204462', 'time' => '1:00', 'description' => 'Finish up request validation'],
            ['date' => '2020-12-29', 'incident' => 'INC000000204462', 'time' => '6:30', 'description' => 'Start adding scrap reason'],
            ['date' => '2020-12-29', 'incident' => 'INC000000204462', 'time' => '0:30', 'description' => 'Some small fixes for inventory system'],

            ['date' => '2020-12-30', 'incident' => 'INC000000204462', 'time' => '3:00', 'description' => 'Some more small fixes'],
            ['date' => '2020-12-30', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Fixing permissions issue on test server'],
            ['date' => '2020-12-30', 'incident' => 'INC000000204462', 'time' => '3:00', 'description' => 'Fix edit/scrap buttons on search result page, and fix edit button on scrap page'],

            ['date' => '2020-12-31', 'incident' => 'INC000000246441', 'time' => '0:30', 'description' => 'Change TAT calculation from KEYIN-CLOSE to KEYIN-WAIT'],
            ['date' => '2020-12-31', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2021-01-04', 'incident' => 'INC000000204462', 'time' => '7:30', 'description' => 'Idk man'],

            ['date' => '2021-01-05', 'incident' => 'INC000000241395', 'time' => '1:00', 'description' => 'Upgrade ALICE to Laravel 6'],
            ['date' => '2021-01-05', 'incident' => 'INC000000204462', 'time' => '3:00', 'description' => 'Allow undoing scrap item'],
            ['date' => '2021-01-05', 'incident' => 'INC000000204462', 'time' => '3:30', 'description' => 'Allow searching by user, department, model, and name on scan item page'],

            ['date' => '2021-01-06', 'incident' => 'Miscellaneous', 'time' => '3:00', 'description' => 'Attempt fixing pre-alerts not showing up on one laptop'],
            ['date' => '2021-01-06', 'incident' => 'INC000000204462', 'time' => '4:00', 'description' => 'Allow searching by username, still working on searching by user first/last name'],

            ['date' => '2021-01-07', 'incident' => 'INC000000241040', 'time' => '0:30', 'description' => 'Focus serial no and search bar on page load'],
            ['date' => '2021-01-07', 'incident' => 'INC000000241395', 'time' => '1:00', 'description' => 'Deploying laravel 6 upgrade to test'],
            ['date' => '2021-01-07', 'incident' => 'INC000000237807', 'time' => '4:00', 'description' => 'Trying to fix print-out on wait parts page'],
            ['date' => '2021-01-07', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Meeting with Renko, Casper and Gijs'],

            ['date' => '2021-01-08', 'incident' => 'INC000000237807', 'time' => '4:00', 'description' => 'Still trying to fix print-out stuff'],
            ['date' => '2021-01-08', 'incident' => 'INC000000188090', 'time' => '2:30', 'description' => 'Start adding visual quality check'],
            ['date' => '2021-01-08', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2021-01-11', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Pick up working keyboard'],
            ['date' => '2021-01-11', 'incident' => 'INC000000204462', 'time' => '5:30', 'description' => 'Allow scanning by username'],
            ['date' => '2021-01-11', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Weekly meeting'],

            ['date' => '2021-01-12', 'incident' => 'INC000000204462', 'time' => '2:30', 'description' => 'Refactoring controllers'],
            ['date' => '2021-01-12', 'incident' => 'INC000000241395', 'time' => '1:00', 'description' => 'Making function test list for Martijn Booij'],
            ['date' => '2021-01-12', 'incident' => 'INC000000241395', 'time' => '1:00', 'description' => 'Fixed some bugs'],
            ['date' => '2021-01-12', 'incident' => 'INC000000204462', 'time' => '3:00', 'description' => 'Making edit history page'],

            ['date' => '2021-01-13', 'incident' => 'INC000000204462', 'time' => '3:30', 'description' => 'Finish edit history page'],
            ['date' => '2021-01-13', 'incident' => 'INC000000204462', 'time' => '1:00', 'description' => 'Couple small fixes'],
            ['date' => '2021-01-13', 'incident' => 'INC000000248653', 'time' => '3:00', 'description' => 'Start adding scrap reason'],

            ['date' => '2021-01-14', 'incident' => 'INC000000241395', 'time' => '1:00', 'description' => 'Gathering some test results'],
            ['date' => '2021-01-14', 'incident' => 'INC000000241913', 'time' => '4:00', 'description' => 'Adding create unit page'],
            ['date' => '2021-01-14', 'incident' => 'INC000000241395', 'time' => '1:30', 'description' => 'Couple more small fixes for laravel 6 upgrade'],
            ['date' => '2021-01-14', 'incident' => 'INC000000241913', 'time' => '1:00', 'description' => 'Trying to fix permissions for that thing'],

            ['date' => '2021-01-15', 'incident' => 'INC000000241913', 'time' => '2:00', 'description' => 'Finally actually fixed permissions for create unit feature'],
            ['date' => '2021-01-15', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Meeting with Michiel'],
            ['date' => '2021-01-15', 'incident' => 'INC000000241913', 'time' => '0:15', 'description' => 'Autofocus on serialnumber, make default in_ach option yes'],
            ['date' => '2021-01-15', 'incident' => 'INC000000242356', 'time' => '3:00', 'description' => 'Start adding kbo status to final test'],
            ['date' => '2021-01-15', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2021-01-18', 'incident' => 'INC000000204462', 'time' => '2:30', 'description' => 'Making upload spreadsheet a command instead of a page'],
            ['date' => '2021-01-18', 'incident' => 'INC000000204462', 'time' => '0:30', 'description' => 'Add serial number to scan result, and allow searching by model'],
            ['date' => '2021-01-18', 'incident' => 'INC000000204462', 'time' => '0:30', 'description' => 'Fix scrap not triggering observer'],
            ['date' => '2021-01-18', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Deploying support lara fixes to production'],
            ['date' => '2021-01-18', 'incident' => 'INC000000204462', 'time' => '1:00', 'description' => 'Start adding batch add item'],
            ['date' => '2021-01-18', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],
            ['date' => '2021-01-18', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Deploying inventory system to production'],

            ['date' => '2021-01-19', 'incident' => 'INC000000204462', 'time' => '6:30', 'description' => 'Major database redesign'],
            ['date' => '2021-01-19', 'incident' => 'INC000000204462', 'time' => '1:30', 'description' => 'Deploying that stuff to test'],

            ['date' => '2021-01-20', 'incident' => 'INC000000204462', 'time' => '4:00', 'description' => 'Adding batch add'],
            ['date' => '2021-01-20', 'incident' => 'INC000000204462', 'time' => '0:30', 'description' => 'Meeting with Dennis'],
            ['date' => '2021-01-20', 'incident' => 'INC000000204462', 'time' => '3:00', 'description' => 'Made scan page do wildcard search for users, move edit history to edit page'],

            ['date' => '2021-01-21', 'incident' => 'Miscellaneous', 'time' => '0:15', 'description' => 'Fixing network with Renko'],
            ['date' => '2021-01-21', 'incident' => 'INC000000242356', 'time' => '1:00', 'description' => 'Continue adding KBO stuff to final test thing'],
            ['date' => '2021-01-21', 'incident' => 'INC000000242356', 'time' => '0:30', 'description' => 'Meeting with Michiel'],
            ['date' => '2021-01-21', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Trying to fix LDAP connection, fixed itself'],
            ['date' => '2021-01-21', 'incident' => 'INC000000242356', 'time' => '2:15', 'description' => 'Continue adding KBO stuff to final test thing'],
            ['date' => '2021-01-21', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Setting up Hyper-V with Bert'],
            ['date' => '2021-01-21', 'incident' => 'INC000000242356', 'time' => '2:00', 'description' => 'Continue adding KBO stuff to final test thing'],

            ['date' => '2021-01-22', 'incident' => 'INC000000242356', 'time' => '1:30', 'description' => 'Continue adding KBO stuff to final test thing'],
            ['date' => '2021-01-22', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Meeting with Dennis and Michiel'],
            ['date' => '2021-01-22', 'incident' => 'INC000000242356', 'time' => '2:00', 'description' => 'Continue adding KBO stuff to final test thing'],
            ['date' => '2021-01-22', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],
            ['date' => '2021-01-22', 'incident' => 'INC000000242356', 'time' => '1:00', 'description' => 'Show popup if part is back to customer'],

            ['date' => '2021-01-25', 'incident' => 'INC000000204462', 'time' => '1:45', 'description' => 'Several bugfixes'],
            ['date' => '2021-01-25', 'incident' => 'INC000000251775', 'time' => '0:15', 'description' => 'Changed product type for a thing'],
            ['date' => '2021-01-25', 'incident' => 'INC000000204462', 'time' => '2:00', 'description' => 'Deploying inventory system to production'],
            ['date' => '2021-01-25', 'incident' => 'INC000000204462', 'time' => '2:00', 'description' => 'Several bugfixes'],
            ['date' => '2021-01-25', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Weekly meeting'],

            ['date' => '2021-01-26', 'incident' => 'INC000000204462', 'time' => '3:00', 'description' => 'Fixed timezone issues, finished checking user departments'],
            ['date' => '2021-01-26', 'incident' => 'INC000000248653', 'time' => '5:00', 'description' => 'Adding rtw reason'],

            ['date' => '2021-01-27', 'incident' => 'INC000000248653', 'time' => '7:30', 'description' => 'Adding rtw reason'],
            ['date' => '2021-01-27', 'incident' => 'INC000000248653', 'time' => '0:30', 'description' => 'Fixing edit button'],

            ['date' => '2021-01-28', 'incident' => 'INC000000242356', 'time' => '8:00', 'description' => 'Show KBO status when RMA and serial no have been filled, still working on the popup'],

            ['date' => '2021-01-29', 'incident' => 'INC000000242356', 'time' => '2:30', 'description' => 'Show popup when KBO request type is different than RMA request type'],
            ['date' => '2021-01-29', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Monthly progress meeting'],
            ['date' => '2021-01-29', 'incident' => 'INC000000242356', 'time' => '1:00', 'description' => 'Continuing showing popup'],
            ['date' => '2021-01-29', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Meeting with Gijs, testing MIS functions for Laravel 6 upgrade'],
            ['date' => '2021-01-29', 'incident' => 'INC000000242356', 'time' => '0:30', 'description' => 'Continuing showing popup'],
            ['date' => '2021-01-29', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2021-02-01', 'incident' => 'INC000000242356', 'time' => '0:30', 'description' => 'Deploying to test'],
            ['date' => '2021-02-01', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Fix search page'],
            ['date' => '2021-02-01', 'incident' => 'INC000000248653', 'time' => '4:30', 'description' => 'Only allow department managers to reassign items to users within their department'],
            ['date' => '2021-02-01', 'incident' => 'Miscellaneous', 'time' => '2:20', 'description' => 'Weekly meeting'],

            ['date' => '2021-02-02', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Made a quick hotfix for the edit button not working on search and rtw page'],
            ['date' => '2021-02-02', 'incident' => 'INC000000248653', 'time' => '7:00', 'description' => 'Only allow department managers to reassign items to users within their department'],

            ['date' => '2021-02-03', 'incident' => 'INC000000248653', 'time' => '3:30', 'description' => 'Redo manager logic stuff, because phpStorm rolled back all my changes'],
            ['date' => '2021-02-03', 'incident' => 'INC000000248653', 'time' => '0:30', 'description' => 'Hotfix for import function'],
            ['date' => '2021-02-03', 'incident' => 'INC000000248653', 'time' => '1:45', 'description' => 'Deploying that fix to test'],
            ['date' => '2021-02-03', 'incident' => 'INC000000248653', 'time' => '2:15', 'description' => 'Continuing manager stuff'],

            ['date' => '2021-02-04', 'incident' => 'INC000000241395', 'time' => '4:00', 'description' => 'Fixed the last few (found) issues for Laravel upgrade'],
            ['date' => '2021-02-04', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Fixing VM'],
            ['date' => '2021-02-04', 'incident' => 'Miscellaneous', 'time' => '3:00', 'description' => 'Meeting with Gijs about some old systems and stuff'],

            ['date' => '2021-02-05', 'incident' => 'INC000000188090', 'time' => '6:00', 'description' => 'Adding visual quality to key part check'],
            ['date' => '2021-02-05', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Meeting with Michiel'],
            ['date' => '2021-02-05', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2021-02-08', 'incident' => 'INC000000248653', 'time' => '1:30', 'description' => 'Adding desk phones'],
            ['date' => '2021-02-08', 'incident' => 'INC000000241395', 'time' => '1:00', 'description' => 'Deployed to production, ran into some issues, turns out Laravel 6 *needs* php >7.3'],
            ['date' => '2021-02-08', 'incident' => 'INC000000248653', 'time' => '1:30', 'description' => 'Adding desk phones'],
            ['date' => '2021-02-08', 'incident' => 'INC000000258443', 'time' => '1:00', 'description' => 'Fixed some compact errors'],
            ['date' => '2021-02-08', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Preparing some stuff for meeting with Gideon'],
            ['date' => '2021-02-08', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly meeting'],
            ['date' => '2021-02-08', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Adding desk phones'],

            ['date' => '2021-02-09', 'incident' => 'INC000000248653', 'time' => '0:30', 'description' => 'Still adding desk phones to import and add functions and stuff'],
            ['date' => '2021-02-09', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Meeting with Gideon'],
            ['date' => '2021-02-09', 'incident' => 'INC000000248653', 'time' => '5:30', 'description' => 'Still adding desk phones to import and add functions and stuff'],
            ['date' => '2021-02-09', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Switching to VS Code'],

            ['date' => '2021-02-10', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Fixing some merge conflicts'],
            ['date' => '2021-02-10', 'incident' => 'INC000000248653', 'time' => '5:00', 'description' => 'Continue adding manager features'],
            ['date' => '2021-02-10', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Start making approval queue'],

            ['date' => '2021-02-11', 'incident' => 'INC000000258757', 'time' => '3:00', 'description' => 'Fix submit button on final test page (most of that time is fixing my local repo tho)'],
            ['date' => '2021-02-11', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Fix pallet request index page'],
            ['date' => '2021-02-11', 'incident' => 'INC000000188090', 'time' => '4:00', 'description' => 'Adding visual quality to key part check. Need to work out with Casper how to change the SQL reports'],

            ['date' => '2021-02-12', 'incident' => 'INC000000188090', 'time' => '1:00', 'description' => 'Deploy to test'],
            ['date' => '2021-02-12', 'incident' => 'INC000000251737', 'time' => '6:00', 'description' => 'Trying to figure out where this thing gets its data and stuff'],
            ['date' => '2021-02-12', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2021-02-15', 'incident' => 'INC000000248653', 'time' => '5:30', 'description' => 'Adding approval/confirmation queue'],
            ['date' => '2021-02-15', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Meeting with Gideon'],
            ['date' => '2021-02-15', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Weekly meeting'],

            ['date' => '2021-02-16', 'incident' => 'INC000000248653', 'time' => '6:00', 'description' => 'Adding approval/confirmation queue'],
            ['date' => '2021-02-16', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Creating separate reassign page for managers'],

            ['date' => '2021-02-17', 'incident' => 'INC000000248653', 'time' => '8:00', 'description' => 'Mostly finish reassign stuff, just need to send the emails still'],

            ['date' => '2021-02-18', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Quick fix for keypart visual quality check issue'],
            ['date' => '2021-02-18', 'incident' => 'INC000000259970', 'time' => '1:00', 'description' => 'Trying to figure out why Alice is slow'],
            ['date' => '2021-02-18', 'incident' => 'INC000000246785', 'time' => '2:00', 'description' => 'Focus RMA No after submit on action log page'],
            ['date' => '2021-02-18', 'incident' => 'INC000000259970', 'time' => '1:00', 'description' => 'Checking Alice loading times again'],
            ['date' => '2021-02-18', 'incident' => 'INC000000259970', 'time' => '2:45', 'description' => 'Meeting with Renko and Gijs'],

            ['date' => '2021-02-19', 'incident' => 'INC000000259970', 'time' => '2:30', 'description' => 'Rolling back to before laravel upgrade and testing again'],
            ['date' => '2021-02-19', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly progress meeting'],
            ['date' => '2021-02-19', 'incident' => 'INC000000259970', 'time' => '0:30', 'description' => 'Writing out conclusions and sending an email to Richard'],
            ['date' => '2021-02-19', 'incident' => 'INC000000241889', 'time' => '1:00', 'description' => 'Add input to manually change box number on wait parts list'],
            ['date' => '2021-02-19', 'incident' => 'INC000000253167', 'time' => '1:00', 'description' => 'Start working on adding a missing keyparts overview'],
            ['date' => '2021-02-19', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],
            ['date' => '2021-02-19', 'incident' => 'INC000000253167', 'time' => '1:00', 'description' => 'Still working on adding a missing keyparts overview'],

            ['date' => '2021-02-22', 'incident' => 'INC000000248653', 'time' => '6:00', 'description' => 'Preparing for initial inventory import'],
            ['date' => '2021-02-22', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Weekly presentation'],

            ['date' => '2021-02-23', 'incident' => 'INC000000248653', 'time' => '3:00', 'description' => 'Some more small fixes after importing everything on production'],
            ['date' => '2021-02-23', 'incident' => 'INC000000248653', 'time' => '5:00', 'description' => 'Continue working on approval/confirmation queue'],

            ['date' => '2021-02-24', 'incident' => 'INC000000248653', 'time' => '4:00', 'description' => 'Now sending email when a reassign has been approved/confirmed'],
            ['date' => '2021-02-24', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Created command that checks for unconfirmed items, and sends reminders to users'],
            ['date' => '2021-02-24', 'incident' => 'INC000000248653', 'time' => '0:30', 'description' => 'Show warning when editing or reassigning an item that has a pending reassign'],
            ['date' => '2021-02-24', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Send email on deny, with deny reason'],

            ['date' => '2021-02-25', 'incident' => 'INC000000253167', 'time' => '4:30', 'description' => 'Trying to figure out how to get these missing keyparts'],
            ['date' => '2021-02-25', 'incident' => 'INC000000257624', 'time' => '0:15', 'description' => 'Autofocus unit serial field'],
            ['date' => '2021-02-25', 'incident' => 'INC000000253167', 'time' => '3:15', 'description' => 'Still trying to figure out how to get these missing keyparts'],

            ['date' => '2021-02-26', 'incident' => 'INC000000253167', 'time' => '2:30', 'description' => 'Having some issues firing the right events here'],
            ['date' => '2021-02-26', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly inventory meeting / monthly progress meeting'],
            ['date' => '2021-02-26', 'incident' => 'INC000000253167', 'time' => '4:30', 'description' => 'Still having some issues'],

            ['date' => '2021-03-01', 'incident' => 'INC000000248653', 'time' => '5:00', 'description' => 'Mark row in overview if user is inactive, need to synchronise with AD still'],
            ['date' => '2021-03-01', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'If user is manager, only show department\'s items. If not, only show user\'s items'],
            ['date' => '2021-03-01', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Send reminders in one email, instead of multiple'],

            ['date' => '2021-03-02', 'incident' => 'INC000000248653', 'time' => '6:00', 'description' => 'Add allowed out column to items'],
            ['date' => '2021-03-02', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly meeting'],

            ['date' => '2021-03-03', 'incident' => 'INC000000248653', 'time' => '6:00', 'description' => 'Querying HQ database to check if users exist, and matching alice to that'],
            ['date' => '2021-03-03', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Finish adding allowed out toggling and stuff'],

            ['date' => '2021-03-04', 'incident' => 'INC000000259503', 'time' => '4:00', 'description' => 'Add some columns and rtc count to final test create page'],
            ['date' => '2021-03-04', 'incident' => 'INC000000259247', 'time' => '4:00', 'description' => 'Trying to figure out how to do this'],

            ['date' => '2021-03-05', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Small fix on add item page'],
            ['date' => '2021-03-05', 'incident' => 'INC000000259247', 'time' => '1:30', 'description' => 'Still trying to figure out how to do this'],
            ['date' => '2021-03-05', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly progress meeting'],
            ['date' => '2021-03-05', 'incident' => 'INC000000248653', 'time' => '0:15', 'description' => 'Another small fix'],
            ['date' => '2021-03-05', 'incident' => 'Miscellaneous', 'time' => '0:45', 'description' => 'Deploying pending tickets to production'],
            ['date' => '2021-03-05', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Another one'],
            ['date' => '2021-03-05', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2021-03-08', 'incident' => 'INC000000248653', 'time' => '4:00', 'description' => 'Trying to also mark users that don\'t exist in hq db as inactive, having a bit of trouble with this though'],
            ['date' => '2021-03-08', 'incident' => 'INC000000248653', 'time' => '4:00', 'description' => 'Started adding features to the security scan page'],

            ['date' => '2021-03-09', 'incident' => 'Miscellaneous', 'time' => '6:00', 'description' => 'Waited for new laptop to finish copying files'],
            ['date' => '2021-03-09', 'incident' => 'Miscellaneous', 'time' => '3:00', 'description' => 'Weekly meeting'],

            ['date' => '2021-03-10', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Setting everything back up'],
            ['date' => '2021-03-10', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Meeting with Gideon'],
            ['date' => '2021-03-10', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Meeting with Michiel'],
            ['date' => '2021-03-10', 'incident' => 'Miscellaneous', 'time' => '3:30', 'description' => 'Importing DB\'s'],
            ['date' => '2021-03-10', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Fixing a few things with IIS'],
            ['date' => '2021-03-10', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Re-importing ach_system db, as it didn\'t work correctly the first time'],

            ['date' => '2021-03-11', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Trying to figure out why it\'s still not working'],
            ['date' => '2021-03-11', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Importing ach_system again,  this time without foreign key checks'],
            ['date' => '2021-03-11', 'incident' => 'Miscellaneous', 'time' => '4:30', 'description' => 'Importing everything again, this time it finally worked'],
            ['date' => '2021-03-11', 'incident' => 'INC000000263896', 'time' => '1:00', 'description' => 'Catch all shipping numbers that begin with 2LNL7825GD+'],

            ['date' => '2021-03-12', 'incident' => 'INC000000259247', 'time' => '5:00', 'description' => 'Creating RTW page'],
            ['date' => '2021-03-12', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Short meeting with Michiel'],
            ['date' => '2021-03-12', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],
            ['date' => '2021-03-12', 'incident' => 'INC000000263896', 'time' => '0:30', 'description' => 'Deploying to production'],
            ['date' => '2021-03-12', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Trying to fix Hyper-V'],

            ['date' => '2021-03-15', 'incident' => 'INC000000248653', 'time' => '4:30', 'description' => 'Continue working on security scan page'],
            ['date' => '2021-03-15', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Add indexes to tables'],
            ['date' => '2021-03-15', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Fixing Better ITSM'],
            ['date' => '2021-03-15', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Weekly meeting'],

            ['date' => '2021-03-16', 'incident' => 'INC000000248653', 'time' => '5:00', 'description' => 'Continue working on security scan page'],
            ['date' => '2021-03-16', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Fixing some more things in Even Better ITSM'],
            ['date' => '2021-03-16', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Continue working on security scan page'],

            ['date' => '2021-03-17', 'incident' => 'INC000000248653', 'time' => '4:00', 'description' => 'Done with scan page for now, need more info'],
            ['date' => '2021-03-17', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Convert all JS to >ES6, since we officially don\'t support IE anymore'],
            ['date' => '2021-03-17', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Fix some stuff in reassign logic'],
            ['date' => '2021-03-17', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'More misc fixes'],

            ['date' => '2021-03-18', 'incident' => 'INC000000253167', 'time' => '4:00', 'description' => 'Add missing keyparts to final test page'],
            ['date' => '2021-03-18', 'incident' => 'INC000000259970', 'time' => '4:00', 'description' => 'Testing indexes and stuff'],

            ['date' => '2021-03-19', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Fixing Hyper-V with Bert'],
            ['date' => '2021-03-19', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Short meeting with Michiel'],
            ['date' => '2021-03-19', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Weekly inventory meeting'],
            ['date' => '2021-03-19', 'incident' => 'INC000000253167', 'time' => '3:00', 'description' => 'Fix table, and make it a bit more readable'],
            ['date' => '2021-03-19', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2021-03-22', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Replace spinner gifs with Bootstrap CSS spinners'],
            ['date' => '2021-03-22', 'incident' => 'INC000000248653', 'time' => '0:30', 'description' => 'Make username a wildcard search'],
            ['date' => '2021-03-22', 'incident' => 'INC000000248653', 'time' => '0:30', 'description' => 'Show BitLocker on manager overview'],
            ['date' => '2021-03-22', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Sort overviews by department->username->item name'],
            ['date' => '2021-03-22', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Show "local" search results in overview page, instead of a separate page'],
            ['date' => '2021-03-22', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Try to fix tran entries being created when nothing changed'],
            ['date' => '2021-03-22', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Weekly programming meeting'],

            ['date' => '2021-03-23', 'incident' => 'INC000000248653', 'time' => '1:30', 'description' => 'Fix updates posting to tran if nothing changed'],
            ['date' => '2021-03-23', 'incident' => 'INC000000248653', 'time' => '1:30', 'description' => 'Try to read QR code results correctly'],
            ['date' => '2021-03-23', 'incident' => 'Miscellaneous', 'time' => '0:45', 'description' => 'Meeting with Gideon'],
            ['date' => '2021-03-23', 'incident' => 'INC000000248653', 'time' => '2:15', 'description' => 'Fixed some stuff on scan page, now parsing QR code contents correctly'],
            ['date' => '2021-03-23', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Start working on quarterly inventory check thingy'],

            ['date' => '2021-03-24', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Finish quarterly inventory thing'],
            ['date' => '2021-03-24', 'incident' => 'INC000000248653', 'time' => '4:00', 'description' => 'Various small bug fixes'],
            ['date' => '2021-03-24', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Added page for admins to see which items are pending confirmation, and where they can also set them to confirmed'],
            ['date' => '2021-03-24', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Add repair and rma number columns'],

            ['date' => '2021-03-25', 'incident' => 'INC000000259970', 'time' => '0:30', 'description' => 'Deploy support indexes to test, and test if they improve performance'],
            ['date' => '2021-03-25', 'incident' => 'INC000000259975', 'time' => '3:30', 'description' => 'Fix mp3 files being loaded on every page'],
            ['date' => '2021-03-25', 'incident' => 'INC000000248653', 'time' => '4:00', 'description' => 'Fixed some issues I accidentally found'],

            ['date' => '2021-03-26', 'incident' => 'INC000000259247', 'time' => '1:30', 'description' => 'Gathering the info I need to do this stuff'],
            ['date' => '2021-03-26', 'incident' => 'Miscellaneous', 'time' => '2:30', 'description' => 'Weekly inventory meeting'],
            ['date' => '2021-03-26', 'incident' => 'INC000000259247', 'time' => '2:30', 'description' => ''],
            ['date' => '2021-03-26', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],
            ['date' => '2021-03-26', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Short meeting with Gideon and Michiel'],

            ['date' => '2021-03-29', 'incident' => 'INC000000248653', 'time' => '5:00', 'description' => 'Adding download spreadsheet function'],
            ['date' => '2021-03-29', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly programming meeting'],
            ['date' => '2021-03-29', 'incident' => 'INC000000248653', 'time' => '1:30', 'description' => 'Finishing up download function'],

            ['date' => '2021-03-30', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Start adding scan log'],
            ['date' => '2021-03-30', 'incident' => 'Miscellaneous', 'time' => '0:40', 'description' => 'Meeting with Gideon'],
            ['date' => '2021-03-30', 'incident' => 'INC000000248653', 'time' => '2:20', 'description' => 'Finish adding scan log'],
            ['date' => '2021-03-30', 'incident' => 'INC000000248653', 'time' => '3:00', 'description' => 'Start adding quarterly inventory report'],

            ['date' => '2021-03-31', 'incident' => 'INC000000248653', 'time' => '0:30', 'description' => 'Fix overview page breaking if a user with the manager role doesn\'t manage any departments'],
            ['date' => '2021-03-31', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Meeting with Michiel'],
            ['date' => '2021-03-31', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Catch errors when submitting nonexistent users/departments on reassign page'],
            ['date' => '2021-03-31', 'incident' => 'INC000000248653', 'time' => '1:00', 'description' => 'Allow editing MIS supplies'],
            ['date' => '2021-03-31', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Meeting with Michiel'],
            ['date' => '2021-03-31', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Meeting with Michiel and Zjelko'],
            ['date' => '2021-03-31', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'Refactoring item edit page (also doing some regex)'],

            ['date' => '2021-04-01', 'incident' => 'INC000000259247', 'time' => '6:00', 'description' => 'Add RTW status page'],
            ['date' => '2021-04-01', 'incident' => 'INC000000263870', 'time' => '1:00', 'description' => 'Added kbo status to rtc page'],
            ['date' => '2021-04-01', 'incident' => 'INC000000266642', 'time' => '1:00', 'description' => 'Add pallet location to hamburgers met korting export'],

            ['date' => '2021-04-02', 'incident' => 'INC000000248653', 'time' => '1:30', 'description' => 'Finish refactoring item edit page'],
            ['date' => '2021-04-02', 'incident' => 'INC000000248653', 'time' => '4:30', 'description' => 'Refactoring add item page'],
            ['date' => '2021-04-02', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],

            ['date' => '2021-04-06', 'incident' => 'INC000000248653', 'time' => '5:30', 'description' => 'Finish refactoring add item page'],
            ['date' => '2021-04-06', 'incident' => 'INC000000248653', 'time' => '0:30', 'description' => 'Deploying all that to test'],
            ['date' => '2021-04-06', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'Weekly programming meeting'],
            ['date' => '2021-04-06', 'incident' => 'INC000000248653', 'time' => '0:30', 'description' => 'Fixed a small bug on add item page'],

            ['date' => '2021-04-07', 'incident' => 'INC000000248653', 'time' => '1:30', 'description' => 'Updating phpDocs'],
            ['date' => '2021-04-07', 'incident' => 'INC000000248653', 'time' => '3:00', 'description' => 'Add request validation to all requests'],
            ['date' => '2021-04-07', 'incident' => 'INC000000248653', 'time' => '3:30', 'description' => 'Couple more small bug fixes'],

            ['date' => '2021-04-08', 'incident' => 'INC000000248653', 'time' => '2:00', 'description' => 'More bug fixing'],
            ['date' => '2021-04-08', 'incident' => 'Miscellaneous', 'time' => '3:00', 'description' => 'Meeting with Dennis and Michiel'],
            ['date' => '2021-04-08', 'incident' => 'Miscellaneous', 'time' => '1:30', 'description' => 'IDC test meeting'],
            ['date' => '2021-04-08', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Meeting with Gideon'],

            ['date' => '2021-04-09', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Deployed some tickets to production'],
            ['date' => '2021-04-09', 'incident' => 'INC000000270118', 'time' => '2:45', 'description' => 'Try to add badge option to alice navbar'],
            ['date' => '2021-04-09', 'incident' => 'Miscellaneous', 'time' => '1:00', 'description' => 'Weekly administration'],
            ['date' => '2021-04-09', 'incident' => 'Miscellaneous', 'time' => '1:15', 'description' => 'Fix styling on RTC page'],

            ['date' => '2021-04-12', 'incident' => 'INC000000270118', 'time' => '1:30', 'description' => 'Try to add badge option to alice navbar'],
            ['date' => '2021-04-12', 'incident' => 'Miscellaneous', 'time' => '1:45', 'description' => 'Inventory test meeting'],
            ['date' => '2021-04-12', 'incident' => 'INC000000248653', 'time' => '0:30', 'description' => 'Fixed the few bugs we found'],
            ['date' => '2021-04-12', 'incident' => 'INC000000270118', 'time' => '1:15', 'description' => 'Added badges to alice navbar'],
            ['date' => '2021-04-12', 'incident' => 'INC000000270118', 'time' => '1:00', 'description' => 'Implementing that in invenotry system and deploying it'],
            ['date' => '2021-04-12', 'incident' => 'Miscellaneous', 'time' => '2:00', 'description' => 'Weekly programming meeting'],

            ['date' => '2021-04-13', 'incident' => 'INC000000259247', 'time' => '3:00', 'description' => 'Added serial number field, so we only need to get the RMA unit from our DB'],
            ['date' => '2021-04-13', 'incident' => 'Miscellaneous', 'time' => '0:30', 'description' => 'Meeting with Gideon'],
            ['date' => '2021-04-13', 'incident' => 'INC000000259247', 'time' => '2:30', 'description' => 'Store the KBO results in the session, so it persists across reloads'],
            ['date' => '2021-04-13', 'incident' => 'INC000000270414', 'time' => '2:00', 'description' => 'Try to fix styling on RTC page'],

            ['date' => '2021-04-14', 'incident' => 'INC000000270414', 'time' => '0:30', 'description' => 'Deploy to test'],
            ['date' => '2021-04-14', 'incident' => 'INC000000269414', 'time' => '4:00', 'description' => 'Improve alice user management stuff'],
            ['date' => '2021-04-14', 'incident' => 'INC000000270414', 'time' => '1:00', 'description' => 'Fixed a few issues'],
            ['date' => '2021-04-14', 'incident' => 'INC000000269414', 'time' => '2:30', 'description' => 'Improve alice user management stuff'],

            ['date' => '2021-04-15', 'incident' => 'INC000000269414', 'time' => '3:00', 'description' => 'Add users overview to team edit page'],
            ['date' => '2021-04-15', 'incident' => 'INC000000269414', 'time' => '2:00', 'description' => 'Fix some input classes on the same page'],
            ['date' => '2021-04-15', 'incident' => 'INC000000269414', 'time' => '3:00', 'description' => 'Trying to figure out how to sync users from AD to alice']
        ];

        foreach ($tasks as $task)
        {
            $taskLog = new TaskLog();
            $incident = Incident::query()
                ->where('incident_number', $task['incident'])
                ->first();

            $timeRegex = '/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/m';

            preg_match($timeRegex, $task['time'], $timeArr);

            $timeMinutes = ((int) $timeArr[1] * 60) + (int) $timeArr[2];

            $taskLog->created_at = $task['date'];
            $taskLog->incident_id = $incident->id;
            $taskLog->time_spent = $timeMinutes;
            $taskLog->description = $task['description'];

            $taskLog->save();
        }
    }
}
