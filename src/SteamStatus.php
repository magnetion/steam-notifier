<?php namespace Magnetion\SteamNotifier;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use DB;

class SteamStatus extends Command {

    protected $name = 'magnetion:SteamStatus';
    protected $description = 'Checks current steam status';


    public function fire()
    {
        // get last update
        $latestLog = DB::table('steam_log')->orderBy('updated', 'DESC')->first();

        if(count($latestLog) == 0) :
            // create new record for player
            DB::table('steam_log')->insert(
                ['steam_id' => env('STEAM_ID'), 'in_game' => 0, 'updated' => time()]
            );

            $currentStatus = 0;
        else :
            $currentStatus = $latestLog->in_game;
        endif;

        $client = new \GuzzleHttp\Client();
        $request = $client->createRequest('GET','http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.env('STEAM_KEY').'&steamids=' . env('STEAM_ID'));

        $response = $client->send($request);
        $responseData = json_decode($response->getBody()->getContents());
        $player = $responseData->response->players[0];
        //dd(isset($player->gameid));

        if(isset($player->gameid)) :
            // in game
            $status = 1;
            $game_id = $player->gameid;
            $game_name = $player->gameextrainfo;
        else :
            // out of game
            $status = 0;
            $game_id = null;
            $game_name = null;
        endif;

        // save latest status
        DB::table('steam_log')
            ->where('steam_id', env('STEAM_ID'))
            ->update(['in_game' => $status, 'game_id' => $game_id, 'game_name' => $game_name, 'updated' => time()]);

        dd(env('STEAM_ID'));

        $this->info('Works');
    }


    protected function getArguments()
    {
        return array(

        );
    }


    protected function getOptions()
    {
        return array(

        );
    }

}
