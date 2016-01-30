<?php
use Ballen\Metar\Metar;

/**
 * Metar
 *
 * Metar is a PHP library for retrieveing weather reports (METAR infomation),
 * the library supports multiple 'METAR prodivers' including NOAA and VATSIM.
 *
 * @author Bobby Allen <ballen@bobbyallen.me>
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/bobsta63/metar
 * @link http://www.bobbyallen.me
 *
 */
class MetarTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test requesting of a valid ICAO code (does not thrown an invalid formation exception)
     */
    public function testSetValidIcao()
    {
        $metar = new Metar('EGSS');
    }

    /**
     * Tests requesting an invalid ICAO code (throws correct exception)
     */
    public function testSetInvalidIcao()
    {
        $this->setExpectedException('InvalidArgumentException', 'ICAO code does not appear to be a valid format');
        $metar = new Metar('EGSSA');
    }

    /**
     * Tests settings a valid METAR provider service (Provider class exists)
     */
    public function testSetValidProvider()
    {
        $metar = new Metar('EGSS');
        $metar->setProvider('Noaa');
    }

    /**
     * Tests setting an invalud provider service (The provider class does not exist)
     */
    public function testSetInvalidProvider()
    {
        $metar = new Metar('EGSS');
        $this->setExpectedException('InvalidArgumentException', 'The service provider your specified does not exist in the namespace \'' . Metar::SERVICES_NAMESPACE . '\'');
        $metar->setProvider('An_Invalid_Provider');
    }

    /**
     * Test requesting a METAR report using the default NOAA provider.
     */
    public function testValidNoaaMetarResponse()
    {
        $metar = new Metar('EGSS');
        $check_valid_metar = strpos($metar, 'EGSS');
        $this->assertEquals($check_valid_metar, 0);
    }

    /**
     * Test requesting a METAR report using VATSIM as the provider.
     */
    public function testValidVatsimMetarResponse()
    {
        $metar = new Metar('EGSS');
        $metar->setProvider('Vatsim');
        $check_valid_metar = strpos($metar, 'EGSS');
        $this->assertEquals($check_valid_metar, 0);
    }
}
