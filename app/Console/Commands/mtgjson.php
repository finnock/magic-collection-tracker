<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use League\Flysystem\Exception;


/**
 * @param $Array
 * @param $subKey
 * @return mixed
 */
function array_pushDown(&$array, $subKey, $pushKey)
{
    $original = &$array;

    if(!isset($original[$subKey]))
        $original[$subKey] = array();

    if(isset($original[$pushKey])){
        $original[$subKey] = array_add($original[$subKey], $pushKey, $original[$pushKey]);
        array_forget($original, $pushKey);
    }

    return $original;
}

function array_rename(&$array, $oldName, $newName){
    $original = &$array;

    if(isset($original[$oldName])) {
        $original[$newName] = $original[$oldName];
        array_forget($original, $oldName);
    }

    return $original;
}

class mtgjson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtgjson:getCards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch cards from a given set using a locally provided json file.';

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

        $this->info("Truncating 'cards' table...");
        DB::table('cards')->truncate();

        $setCount = count($allJSONSets);
        $this->info("Starting to fetch cards from $setCount editions...");
        $bar = $this->output->createProgressBar($setCount);

        foreach ($allJSONSets as $JSONSet){
            $JSONCardSet = $JSONSet['cards'];
            //$JSONCardSet = $allJSONSets['SOK']['cards']; //$JSONSet['cards'];

            foreach ($JSONCardSet as $JSONCard){

                $JSONCard['setCode'] = $JSONSet['code'];
                //$JSONCard['setCode'] = 'SOK'; //$JSONSet['code'];

                array_pushDown($JSONCard, 'meta', 'names'        );
                array_pushDown($JSONCard, 'meta', 'colors'       );
                array_pushDown($JSONCard, 'meta', 'colorIdentity');
                array_pushDown($JSONCard, 'meta', 'supertypes'   );
                array_pushDown($JSONCard, 'meta', 'types'        );
                array_pushDown($JSONCard, 'meta', 'subtypes'     );
                array_pushDown($JSONCard, 'meta', 'variations'   );
                array_pushDown($JSONCard, 'meta', 'hand'         );
                array_pushDown($JSONCard, 'meta', 'life'         );
                array_pushDown($JSONCard, 'meta', 'reserved'     );
                array_pushDown($JSONCard, 'meta', 'releaseDate'  );
                array_pushDown($JSONCard, 'meta', 'starter'      );
                array_pushDown($JSONCard, 'meta', 'loyalty'      );
                array_pushDown($JSONCard, 'meta', 'watermark'    );
                array_pushDown($JSONCard, 'meta', 'border'       );
                array_pushDown($JSONCard, 'meta', 'rulings'      );
                array_pushDown($JSONCard, 'meta', 'printings'    );
                array_pushDown($JSONCard, 'meta', 'legalities'   );

                array_rename($JSONCard, 'cmc', 'convertedManaCost');
                array_rename($JSONCard, 'multiverseid', 'multiverseID');

                array_forget($JSONCard, 'foreignNames');
                array_forget($JSONCard, 'originalText');
                array_forget($JSONCard, 'originalType');
                array_forget($JSONCard, 'source');

                $JSONCard['meta'] = json_encode($JSONCard['meta']);
                /*try{
                    \App\Card::create($JSONCard);
                }
                catch (\PDOException $exception){
                    array_forget($JSONSet, 'cards');
                    dd(['card' => $JSONCard, 'set' => $JSONSet]);
                }*/
            }

            $bar->advance();
        }
        $this->info('');
        $bar->finish();

        $this->info("Fetched $setCount sets from the JSON file.");
    }
}
