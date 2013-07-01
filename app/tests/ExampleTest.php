<?php

class ExampleTest extends TestCase {

	/**
	 * 基本的な機能テストのサンプル
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());

		$this->assertCount(1, $crawler->filter('h1:contains("Hello World!")'));
	}

}