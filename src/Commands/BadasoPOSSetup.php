<?php

namespace Uasoft\Badaso\Module\POS\Commands;

use Illuminate\Console\Command;

class BadasoPOSSetup extends Command
{
    private $force;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'badaso-POS:setup {--force=false}';

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
        try {
            $this->force = $this->option('force');
            if ($this->force == null || $this->force == 'true') {
                $this->force = true;
            } else {
                $this->force = false;
            }

            $this->publishConfig();
            $this->updateWebpackMix();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function publishConfig()
    {
        $params = [
            '--tag' => 'badaso-POS-setup',
            '--force' => $this->force,
        ];
        $this->call('vendor:publish', $params);
    }

    protected function updateWebpackMix()
    {
        // mix
        $mix_file = base_path('webpack.mix.js');
        $search = 'Badaso-Pos';

        if ($this->checkExist($mix_file, $search)) {
            $data = <<<'EOT'

                // Badaso-Pos
                mix.js(
                    "packages/badaso/POS-module/src/resources/js-pos/app.js",
                    "public/js/badaso-pos.js"
                ).vue();
            EOT;

            $this->file->append($mix_file, $data);
        }

        $this->info('webpack.mix.js updated');
    }
}
