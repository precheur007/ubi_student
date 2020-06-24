<?php 

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FunctionalTest extends WebTestCase {

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSecure($url) {
        $client = self::createClient([], [
            'PHP_AUTH_USER' => 'test',
            'PHP_AUTH_PW'   => 'incorrect_pw',
        ]);
        $client->request('GET', $url);
        $this->assertFalse($client->getResponse()->isSuccessful());
    }

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url) {
        $client = self::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ]);
        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider() {
        yield ['/admin'];
        yield ['/admin/?entity=Student'];
        yield ['/admin/?entity=Grade'];
		yield ['/admin/?entity=Subject'];
        yield ['/admin/?entity=User'];
    }

    /**
     * @dataProvider urlApiProvider
     */
    public function testAPIisSecure($url) {
        $client = self::createClient([]);
        $client->request('GET', $url, [], [], ['HTTP_X_AUTH_TOKEN' => 'incorrect_api_key', 'HTTP_ACCEPT' => 'application/json']);
        $this->assertFalse($client->getResponse()->isSuccessful());
    }

    /**
     * @dataProvider urlApiProvider
     */
    public function testAPIWorks($url) {
        $client = self::createClient([]);
        $client->request('GET', $url, [], [], ['HTTP_X_AUTH_TOKEN' => 'test_api_key', 'HTTP_ACCEPT' => 'application/json']);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlApiProvider() {
        yield ['/api/students'];
        yield ['/api/grades'];
		yield ['/api/subjects'];
		yield ['/api/students/29/avggrades'];
    }
}