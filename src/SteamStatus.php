<?php namespace Magnetion\SteamNotifier;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SteamStatus extends Command {

    protected $name = 'magnetion:SteamStatus';
    protected $description = 'Checks current steam status';


    public function fire()
    {
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
