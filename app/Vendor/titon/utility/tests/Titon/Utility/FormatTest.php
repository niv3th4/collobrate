<?php
/**
 * @copyright   2010-2013, The Titon Project
 * @license     http://opensource.org/licenses/bsd-license.php
 * @link        http://titon.io
 */

namespace Titon\Utility;

use Titon\Test\TestCase;
use Titon\Utility\Format;

/**
 * Test class for Titon\Utility\Format.
 */
class FormatTest extends TestCase {

    /**
     * Test that atom() formats a timestamp to an Atom feed format.
     */
    public function testAtom() {
        $time = mktime(16, 35, 0, 2, 26, 1988);

        $this->assertEquals('1988-02-26T16:35:00+00:00', Format::atom($time));
    }

    /**
     * Test that date() formats a timestamp to a date.
     */
    public function testDate() {
        $time = mktime(16, 35, 0, 2, 26, 1988);

        $this->assertEquals('1988-02-26', Format::date($time));
        $this->assertEquals('02/26/1988', Format::date($time, '%m/%d/%Y'));
    }

    /**
     * Test that datetime() formats a timestamp to a date and time.
     */
    public function testDatetime() {
        $time = mktime(16, 35, 0, 2, 26, 1988);

        $this->assertEquals('1988-02-26 16:35:00', Format::datetime($time));
        $this->assertEquals('02/26/1988 04:35PM', Format::datetime($time, '%m/%d/%Y %I:%M%p'));
    }

    /**
     * Test that format() creates strings and masks with the passed number.
     */
    public function testFormat() {
        $this->assertEquals('(123) 456', Format::format(1234567890, '(###) ###'));
        $this->assertEquals('(123) 456-7890', Format::format(1234567890, '(###) ###-####'));
        $this->assertEquals('(123) 456-####', Format::format(123456, '(###) ###-####'));

        $this->assertEquals('123.456', Format::format(1234567890, '###.###'));
        $this->assertEquals('123.456.7890', Format::format(1234567890, '###.###.####'));
        $this->assertEquals('123.456.####', Format::format(123456, '###.###.####'));

        // credit card
        $this->assertEquals('3772-3483-0461-4543', Format::format('3772348304614543', '####-####-####-####'));

        // credit card with mask
        $this->assertEquals('****-****-****-4543', Format::format('3772348304614543', '****-****-****-####'));

        // longer number
        $this->assertEquals('3772-3483-0461-4543', Format::format('377234830461454313', '####-####-####-####'));
    }

    /**
     * Test that http() formats a timestamp to an HTTP format.
     */
    public function testHttp() {
        $time = mktime(16, 35, 0, 2, 26, 1988);

        $this->assertEquals('Fri, 26 Feb 1988 16:35:00 GMT', Format::http($time));
    }

    /**
     * Test that phone() formats a number to a phone number.
     */
    public function testPhone() {
        $formats = array(
            7 => '###-####',
            10 => '(###) ###-####',
            11 => '# (###) ###-####'
        );

        $this->assertEquals('666-1337', Format::phone(6661337, $formats));
        $this->assertEquals('(888) 666-1337', Format::phone('8886661337', $formats));
        $this->assertEquals('1 (888) 666-1337', Format::phone('+1 8886661337', $formats));
    }

    /**
     * Test that relativeTime() returns a timestamp in seconds ago/in.
     */
    public function testRelativeTime() {
        $time = mktime(16, 35, 0, 2, 26, 2012);

        // Current
        $this->assertEquals('just now', Format::relativeTime(strtotime('+0 seconds', $time), array('time' => $time)));
        $this->assertEquals('just now', Format::relativeTime($time, array('time' => $time)));
        $this->assertEquals('in 2 hours', Format::relativeTime(strtotime('+2 hours', $time), array('time' => $time)));
        $this->assertEquals('in 45 minutes', Format::relativeTime(strtotime('+45 minutes', $time), array('time' => $time)));

        // Past
        $this->assertEquals('45 seconds ago', Format::relativeTime(strtotime('-45 seconds', $time), array('time' => $time)));
        $this->assertEquals('2 weeks, 2 days ago', Format::relativeTime(strtotime('-16 days', $time), array('time' => $time)));
        $this->assertEquals('8 months ago', Format::relativeTime(strtotime('-33 weeks', $time), array('time' => $time)));
        $this->assertEquals('6 months, 4 days ago', Format::relativeTime(strtotime('-6 months', $time), array('time' => $time)));
        $this->assertEquals('2 years, 2 months ago', Format::relativeTime(strtotime('-799 days', $time), array('time' => $time)));

        // Future
        $this->assertEquals('in 45 seconds', Format::relativeTime(strtotime('+45 seconds', $time), array('time' => $time)));
        $this->assertEquals('in 2 weeks, 2 days', Format::relativeTime(strtotime('+16 days', $time), array('time' => $time)));
        $this->assertEquals('in 8 months', Format::relativeTime(strtotime('+33 weeks', $time), array('time' => $time)));
        $this->assertEquals('in 6 months, 2 days', Format::relativeTime(strtotime('+6 months', $time), array('time' => $time)));
        $this->assertEquals('in 2 years, 2 months', Format::relativeTime(strtotime('+799 days', $time), array('time' => $time)));

        // Large depth
        $this->assertEquals('1 year, 1 month, 4 days ago', Format::relativeTime(strtotime('-399 days', $time), array('time' => $time, 'depth' => 5)));
        $this->assertEquals('1 year, 3 months ago', Format::relativeTime(strtotime('-444 days', $time), array('time' => $time, 'depth' => 5)));
        $this->assertEquals('3 years ago', Format::relativeTime(strtotime('-999 days', $time), array('time' => $time, 'depth' => 5)));
        $this->assertEquals('3 years, 5 months ago', Format::relativeTime(strtotime('-1235 days', $time), array('time' => $time, 'depth' => 5)));
        $this->assertEquals('2 years, 2 months, 1 week, 2 days ago', Format::relativeTime(strtotime('-799 days', $time), array('time' => $time, 'depth' => 5)));

        // Non-verbose
        $this->assertEquals('2y, 2m, 1w, 2d ago', Format::relativeTime(strtotime('-799 days', $time), array('time' => $time, 'depth' => 5, 'verbose' => false)));
        $this->assertEquals('in 2y, 2m, 1w, 2d', Format::relativeTime(strtotime('+799 days', $time), array('time' => $time, 'depth' => 5, 'verbose' => false)));
    }

    /**
     * Test that rss() formats a timestamp to an RSS feed format.
     */
    public function testRss() {
        $time = mktime(16, 35, 0, 2, 26, 1988);

        $this->assertEquals('Fri, 26 Feb 1988 16:35:00 +0000', Format::rss($time));
    }

    /**
     * Test that ssn() formats a number to a social security number.
     */
    public function testSsn() {
        $this->assertEquals('998-29-3841', Format::ssn('998293841', '###-##-####'));
    }

    /**
     * Test that time() formats a timestamp to time.
     */
    public function testTime() {
        $time = mktime(16, 35, 0, 2, 26, 1988);

        $this->assertEquals('16:35:00', Format::time($time));
        $this->assertEquals('04:35PM', Format::time($time, '%I:%M%p'));
    }

}