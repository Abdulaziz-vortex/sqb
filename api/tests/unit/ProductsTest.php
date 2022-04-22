<?php

namespace api\tests\unit;

use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
    /*
     * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     * AS you know that writting tests, takes a little bit long time so i couldn't write test fully
     * because of time limits for this task.
     * However i just tried to write test as i can for this period of time
     * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     */

    public $responce;

    public $client;

    public $base_url;

    public int $id;

    public function setUp(): void
    {
        $this->client = new \GuzzleHttp\Client();

        $this->id = rand(1,100);

        $this->base_url = 'http://eurosoft.loc/api';
    }

    public function testIndex()
    {
        $responce = $this->client->get($this->base_url.'/products');
        $this->assertEquals(200, $responce->getStatusCode());
    }

    public function testCreate()
    {
        $data = [
            'name' => 'new product name',
            'shop' => $this->id,
            'status' => true,
            'description' => 'description here'
        ];

        $response = $this->client->post($this->base_url.'/products', [
            'json' => $data
        ]);

        $result = json_decode($response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($data['name'],$result[0]->name);

    }

    public function testUpdate()
    {
        $data = [
            'name' => 'new shop update name23asdasddsa',
            'status' => true,
            'shop' => $this->id,
            'description' => 'description here'
        ];

        $response = $this->client->put($this->base_url.'/products/'.$this->id, [
            'json' => $data
        ]);

        $result = json_decode($response->getBody());


        $this->assertEquals(200, $response->getStatusCode());
        //$this->assertEquals($data['name'],$result[0]->name);

    }

    public function testDelete(){
        $response = $this->client->delete($this->base_url.'/products/'.$this->id);

        $result = json_decode($response->getBody());

        $this->assertEquals(200, $response->getStatusCode());


        if(!isset($result->message)){
            $this->assertEquals(true,$result->status);
        }

    }
}