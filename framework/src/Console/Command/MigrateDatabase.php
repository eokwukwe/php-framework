<?php

namespace EOkwukwe\Framework\Console\Command;

class MigrateDatabase implements CommandInterface
{
    public string $name = 'database:migrations:migrate';

    public function execute(array $params = []): int
    {
        dd($params);
        echo 'Executing MigrateDatabase command' . PHP_EOL;

        return 0;
    }
}
