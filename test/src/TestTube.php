<?php

namespace Williams\TestTube;

use Williams\TestTube\ActiveRequest;
use Williams\TestTube\Executor;
use Williams\TestTube\FileRetriever;
use Williams\TestTube\ResultAggregator;
use Williams\TestTube\Printer;
use Williams\TestTube\Request;

class TestTube
{

    public static function run(Request $request)
    {
        ActiveRequest::set($request);

        //Initialize Objects
        $aggregator = new ResultAggregator();
        $printer = new Printer();
        $executor = new Executor();
        $retriever = new FileRetriever();

        //Configure Objects
        $executor->sendTo($aggregator);
        $printer->retrieveFrom($aggregator);

        //Retrieve Test Files
        $files = $retriever->fromDirectoryList($request->directoryList());

        //Execute Tests
        $executor->executeFiles($files);

        //Print the results
        $printer->print();
    }

    public static function createRequest(string $root, string $testDir, array $args)
    {
        return new Request($root, $testDir, $args);
    }
}
