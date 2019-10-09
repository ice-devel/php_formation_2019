<?php
namespace App\Tests\Helper;

use App\Helper\Util;
use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase
{
    public function testSlugify() {
        $util = new Util();
        $clean = $util->slugify("Bonjour ! çava ?");
        $expected = "bonjour-cava";

        $this->assertEquals($expected, $clean);
    }

    public function test2Slugify() {
        $util = new Util();
        $clean = $util->slugify("coucou ! çava ?", "_");
        $expected = "coucou_cava";

        $this->assertEquals($expected, $clean);
    }
}