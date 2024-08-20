<?php
declare(strict_types=1);

namespace tests\App\Reader;

use App\Reader\XmlFileReader;
use PHPUnit\Framework\TestCase;

class XmlFileReaderTest extends TestCase
{
	private XmlFileReader $reader;

	protected function setUp(): void
	{
		$this->reader = new XmlFileReader(__DIR__ . '/data.xml');
	}

	public function testReader(): void
	{
		$data = $this->reader->read();

		$this->assertEquals(4, $data->getWorld()->getSize());
		$this->assertEquals(10, $data->getWorld()->getIterations());

		$this->assertEquals(2, $data->getOrganisms()[0]->getX());
		$this->assertEquals(0, $data->getOrganisms()[0]->getY());

		$this->assertEquals(0, $data->getOrganisms()[1]->getX());
		$this->assertEquals(1, $data->getOrganisms()[1]->getY());

		$this->assertEquals(3, $data->getOrganisms()[2]->getX());
		$this->assertEquals(1, $data->getOrganisms()[2]->getY());

		$this->assertEquals(0, $data->getOrganisms()[3]->getX());
		$this->assertEquals(2, $data->getOrganisms()[3]->getY());

		$this->assertEquals(3, $data->getOrganisms()[4]->getX());
		$this->assertEquals(2, $data->getOrganisms()[4]->getY());

		$this->assertEquals(1, $data->getOrganisms()[5]->getX());
		$this->assertEquals(3, $data->getOrganisms()[5]->getY());
	}
}