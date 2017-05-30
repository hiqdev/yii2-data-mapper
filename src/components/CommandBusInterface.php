<?php

namespace hiapi\components;

interface CommandBusInterface
{
    public function handle($command);
}
