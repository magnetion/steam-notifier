<?php namespace Magnetion\SteamNotifier;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SteamStatus extends Command {

    protected $name = 'magnetion:SteamStatus';
    protected $description = 'Checks current steam status';


    public function fire()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->createRequest('GET','http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=A94F94888F3D761B40F5B9613E381FE7&steamids=76561197960435530');

        $response = $client->send($request);
        dd($response->getBody()->getContents());

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
