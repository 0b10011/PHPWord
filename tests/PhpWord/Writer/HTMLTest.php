<?php
declare(strict_types=1);
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2018 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer;

use PhpOffice\PhpWord\AbstractWebServerEmbeddedTest;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Colors\Hex;
use PhpOffice\PhpWord\Style\Lengths\Absolute;

/**
 * Test class for PhpOffice\PhpWord\Writer\HTML
 *
 * @runTestsInSeparateProcesses
 */
class HTMLTest extends AbstractWebServerEmbeddedTest
{
    /**
     * Construct
     */
    public function testConstruct()
    {
        $object = new HTML(new PhpWord());

        $this->assertInstanceOf('PhpOffice\\PhpWord\\PhpWord', $object->getPhpWord());
    }

    /**
     * Construct with null
     *
     * @expectedException \PhpOffice\PhpWord\Exception\Exception
     * @expectedExceptionMessage No PhpWord assigned.
     */
    public function testConstructWithNull()
    {
        $object = new HTML();
        $object->getPhpWord();
    }

    /**
     * Save
     */
    public function testSave()
    {
        $localImage = __DIR__ . '/../_files/images/PhpWord.png';
        $archiveImage = 'zip://' . __DIR__ . '/../_files/documents/reader.docx#word/media/image1.jpeg';
        $gdImage = self::getRemoteGifImageUrl();
        $objectSrc = __DIR__ . '/../_files/documents/sheet.xls';
        $file = __DIR__ . '/../_files/temp.html';

        $phpWord = new PhpWord();

        $docProps = $phpWord->getDocInfo();
        $docProps->setTitle(htmlspecialchars('HTML Test', ENT_COMPAT, 'UTF-8'));

        $phpWord->addTitleStyle(1, array('bold' => true));
        $phpWord->addFontStyle(
            'Font',
            array('name' => 'Verdana', 'size' => Absolute::from('pt', 11), 'color' => new Hex('FF0000'))
        );
        $phpWord->addParagraphStyle('Paragraph', array('alignment' => Jc::CENTER, 'spaceAfter' => Absolute::from('eop', 20), 'spaceBefore' => Absolute::from('eop', 20)));
        $section = $phpWord->addSection();
        $section->addBookmark('top');
        $section->addText(htmlspecialchars('Test 1', ENT_COMPAT, 'UTF-8'), 'Font', 'Paragraph');
        $section->addTextBreak();
        $section->addText(
            htmlspecialchars('Test 2', ENT_COMPAT, 'UTF-8'),
            array('name' => 'Tahoma', 'bold' => true, 'italic' => true, 'subscript' => true)
        );
        $section->addLink('https://github.com/PHPOffice/PHPWord');
        $section->addTitle(htmlspecialchars('Test', ENT_COMPAT, 'UTF-8'), 1);
        $section->addPageBreak();
        $section->addListItem(htmlspecialchars('Test', ENT_COMPAT, 'UTF-8'));
        $section->addImage($localImage);
        $section->addImage($archiveImage);
        $section->addImage($gdImage);
        $section->addObject($objectSrc);
        $section->addFootnote();
        $section->addEndnote();

        $section = $phpWord->addSection();

        $textrun = $section->addTextRun(array('alignment' => Jc::CENTER));
        $textrun->addText(htmlspecialchars('Test 3', ENT_COMPAT, 'UTF-8'));
        $textrun->addTextBreak();

        $textrun = $section->addTextRun(array('alignment' => Jc::START));
        $textrun->addText(htmlspecialchars('Text left aligned', ENT_COMPAT, 'UTF-8'));

        $textrun = $section->addTextRun(array('alignment' => Jc::BOTH));
        $textrun->addText(htmlspecialchars('Text justified', ENT_COMPAT, 'UTF-8'));

        $textrun = $section->addTextRun(array('alignment' => Jc::END));
        $textrun->addText(htmlspecialchars('Text right aligned', ENT_COMPAT, 'UTF-8'));

        $textrun = $section->addTextRun('Paragraph');
        $textrun->addLink('https://github.com/PHPOffice/PHPWord');
        $textrun->addImage($localImage);
        $textrun->addFootnote()->addText(htmlspecialchars('Footnote', ENT_COMPAT, 'UTF-8'));
        $textrun->addEndnote()->addText(htmlspecialchars('Endnote', ENT_COMPAT, 'UTF-8'));

        $section = $phpWord->addSection();

        $table = $section->addTable();
        $cell = $table->addRow()->addCell();
        $cell->addText(
            htmlspecialchars('Test 1', ENT_COMPAT, 'UTF-8'),
            array('superscript' => true, 'underline' => 'dash', 'strikethrough' => true)
        );
        $cell->addTextRun();
        $cell->addLink('https://github.com/PHPOffice/PHPWord');
        $cell->addTextBreak();
        $cell->addListItem(htmlspecialchars('Test', ENT_COMPAT, 'UTF-8'));
        $cell->addImage($localImage);
        $cell->addObject($objectSrc);
        $cell->addFootnote();
        $cell->addEndnote();
        $cell = $table->addRow()->addCell();
        $section->addLink('top', 'back to top', null, null, true);

        $writer = new HTML($phpWord);

        $writer->save($file);
        $this->assertFileExists($file);
        unlink($file);

        Settings::setOutputEscapingEnabled(true);
        $writer->save($file);
        $this->assertFileExists($file);
        unlink($file);
    }

    public function testEscaping()
    {
        $file = __DIR__ . '/../_files/temp.html';

        $phpWord = new PhpWord();
        Settings::setOutputEscapingEnabled(true);

        $docProps = $phpWord->getDocInfo();
        $docProps->setTitle('"Test" & <hack>');

        $writer = new HTML($phpWord);

        $writer->save($file);
        $this->assertFileExists($file);
        $html = file_get_contents($file);

        $this->assertInternalType('int', strpos($html, '<title>&quot;Test&quot; &amp; &lt;hack&gt;</title>'), 'Quotes, ampersand, and tag should be escaped in title value');
        $this->assertInternalType('int', strpos($html, '<meta name="title" content="&quot;Test&quot;&#x20;&amp;&#x20;&lt;hack&gt;" />'), 'Quotes, ampersand, and tag should be escaped in attribute');

        unlink($file);
    }

    public function testTitle()
    {
        $file = __DIR__ . '/../_files/temp.html';

        $phpWord = new PhpWord();
        Settings::setOutputEscapingEnabled(true);

        $docProps = $phpWord->getDocInfo();
        $docProps->setTitle('HTML Test');

        $phpWord->addTitleStyle(1, array('bold' => true));

        $section = $phpWord->addSection();
        $section->addTitle('Some text with a fake <tag>', 0);
        $section->addTitle('Some text with a fake <tag>', 1);
        $section->addTitle('Some text with a fake <tag>', 2);
        $section->addTitle('Some text with a fake <tag>', 3);
        $section->addTitle('Some text with a fake <tag>', 4);
        $section->addTitle('Some text with a fake <tag>', 5);
        $section->addTitle('Some text with a fake <tag>', 6);
        $section->addTitle('Some text with a fake <tag>', 7);

        $writer = new HTML($phpWord);

        $writer->save($file);
        $this->assertFileExists($file);
        $html = file_get_contents($file);

        $this->assertFalse(strpos($html, '<h0'), 'Level 0 title should be converted to `<h1>` as `<h0>` does not exist');
        $this->assertInternalType('int', strpos($html, '<h1'), 'Level 1 title should be converted to `<h1>`');
        $this->assertInternalType('int', strpos($html, '<h2'), 'Level 2 title should be converted to `<h2>`');
        $this->assertInternalType('int', strpos($html, '<h3'), 'Level 3 title should be converted to `<h3>`');
        $this->assertInternalType('int', strpos($html, '<h4'), 'Level 4 title should be converted to `<h4>`');
        $this->assertInternalType('int', strpos($html, '<h5'), 'Level 5 title should be converted to `<h5>`');
        $this->assertInternalType('int', strpos($html, '<h6'), 'Level 6 title should be converted to `<h6>`');
        $this->assertFalse(strpos($html, '<h7'), 'Level 7 title should be converted to `<h6>` as `<h7>` does not exist');

        unlink($file);
    }
}
