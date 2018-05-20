<?php
namespace App\Console\Commands;
require __DIR__ . '/../../../vendor/autoload.php';
use Ratchet\Server\IoServer;
use App\Http\Controllers\WebSocketController;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;



use Illuminate\Console\Command;



//require dirname(__DIR__) . '/vendor/autoload.php';

class WebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:init';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketController()
                )
            ),
            8090
        );
        $server->run();        
    }
}
