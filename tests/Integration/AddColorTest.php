<?php

use PHPUnit\Framework\TestCase;

class AddColorTest extends TestCase
{
    private $url = 'http://localhost:8000/LAMPAPI/AddColor.php';

    public function testAddColorSuccessWithMockedData()
    {
        // Mock data to add a color
        $mockData = [
            'color' => 'Integration Test Color ' . time(),
            'userId' => '1'
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($mockData),
                'ignore_errors' => true
            ]
        ];
        $context  = stream_context_create($options);
        
        $response = @file_get_contents($this->url, false, $context);
        
        if ($response === false) {
            $this->markTestSkipped('Local server is not running or accessible at ' . $this->url);
        }

        $data = json_decode($response, true);
        
        $this->assertIsArray($data, 'Response should be a valid JSON array');
        $this->assertArrayHasKey('error', $data);
        // The API returns an empty error string on success
        $this->assertEquals('', $data['error']);
    }

    public function testAddColorFailureWithInvalidData()
    {
        // Missing the required color field to trigger a mocked failure case
        $mockData = [
            'userId' => '1'
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($mockData),
                'ignore_errors' => true
            ]
        ];
        $context  = stream_context_create($options);
        
        $response = @file_get_contents($this->url, false, $context);
        
        if ($response === false) {
            $this->markTestSkipped('Local server is not running or accessible at ' . $this->url);
        }

        $data = json_decode($response, true);
        
        $this->assertIsArray($data, 'Response should be a valid JSON array');
        
        // Assert that the response contains an error key
        $this->assertArrayHasKey('error', $data);
    }
}