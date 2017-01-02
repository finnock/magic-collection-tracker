<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class mtgJsonGetSets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtgjson:getSets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all sets from a locally provided json file.';



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
     * @return mixed
     */
    public function handle()
    {
        $path = '/home/vagrant/Code/magic-collection-tracker/resources/AllSets-x.json';

        $this->info("Open '$path'...");
        $jsonFile = file_get_contents($path);

        $this->info('Decoding JSON...');
        $allJSONSets = json_decode($jsonFile, true);

        $setCount = count($allJSONSets);
        $bar = $this->output->createProgressBar($setCount);

        foreach ($allJSONSets as $JSONset){
            $JSONset['cardCount'] = count($JSONset['cards']);
            array_forget($JSONset, 'cards');
            array_forget($JSONset, 'booster');

            \App\Set::create($JSONset);

            $bar->advance();
        }

        $bar->finish();

        $this->info("Fetched $setCount sets from the JSON file.");

    }
}
