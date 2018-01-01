<?php

namespace App\Tests\View;

use App\View\BBEncoder;
use PHPUnit\Framework\TestCase;

class BBEncoderTest extends TestCase
{
    /**
     * @dataProvider provideFaqExamples
     */
    public function testEncodeFaqExamples(string $source, string $expectedResult): void
    {
        $encoder = new BBEncoder();

        $this->assertSame($expectedResult, $encoder->encode($source, true));
    }

    /**
     * @dataProvider provideFaqExamples
     */
    public function testDecodeFaqExamples(string $expectedResult, string $encoded): void
    {
        $encoder = new BBEncoder();

        $this->assertSame($expectedResult, $encoder->decode($encoded));
    }

    public function provideFaqExamples(): iterable
    {
        yield 'No BB Code' => ['No BB Code', 'No BB Code'];

        yield 'url' => [
            '[url]www.totalgeek.org[/url]',
            '<!-- BBCode u1 Start --><A HREF="http://www.totalgeek.org" TARGET="_blank">www.totalgeek.org</A><!-- BBCode u1 End -->'
        ];

        yield 'url with caption' => [
            '[url=http://www.totalgeek.org]totalgeek.org[/url]',
            '<!-- BBCode u2 Start --><A HREF="http://www.totalgeek.org" TARGET="_blank">totalgeek.org</A><!-- BBCode u2 End -->'
        ];

        yield 'email' => [
            '[email]james@totalgeek.org[/email]',
            '<!-- BBCode Start --><A HREF="mailto:james@totalgeek.org">james@totalgeek.org</A><!-- BBCode End -->',
        ];

        yield 'bold and italics' => [
            "Hello, [b]James[/b]\nHello, [i]Mary[/i]",
            "Hello, <!-- BBCode Start --><B>James</B><!-- BBCode End -->\nHello, <!-- BBCode Start --><I>Mary</I><!-- BBCode End -->"
        ];

        yield 'unordered list' => [
            '[list]
[*] This is the first bulleted item.
[*] This is the second bulleted item.
[/list]',
            '<!-- BBCode ulist Start --><UL>
<!-- BBCode --><LI> This is the first bulleted item.
<!-- BBCode --><LI> This is the second bulleted item.
</UL><!-- BBCode ulist End -->',
        ];

        yield 'List with letters' => [
            '[list=A]
[*] This is the first bulleted item.
[*] This is the second bulleted item.
[/list]',
            '<!-- BBCode olist Start --><OL TYPE=A>
<!-- BBCode --><LI> This is the first bulleted item.
<!-- BBCode --><LI> This is the second bulleted item.
</OL><!-- BBCode olist End -->',
        ];

        yield 'List with numbers' => [
            '[list=1]
[*] This is the first bulleted item.
[*] This is the second bulleted item.
[/list]',
            '<!-- BBCode olist Start --><OL TYPE=1>
<!-- BBCode --><LI> This is the first bulleted item.
<!-- BBCode --><LI> This is the second bulleted item.
</OL><!-- BBCode olist End -->',
        ];

        yield 'Images' => [
            '[img]http://www.totalgeek.org/images/tline.gif[/img]',
            '<!-- BBCode Start --><IMG SRC="http://www.totalgeek.org/images/tline.gif" BORDER="0"><!-- BBCode End -->'
        ];

        yield 'Quotation' => [
            '[quote]Ask not what your country can do for you....
ask what you can do for your country.[/quote]',
            '<!-- BBCode Quote Start --><TABLE BORDER=0 ALIGN=CENTER WIDTH=85%><TR><TD><font size=-1>Quote:</font><HR></TD></TR><TR><TD><FONT SIZE=-1><BLOCKQUOTE>Ask not what your country can do for you....
ask what you can do for your country.</BLOCKQUOTE></FONT></TD></TR><TR><TD><HR></TD></TR></TABLE><!-- BBCode Quote End -->'
        ];

        yield 'Code block' => [
            '[code]#!/usr/bin/perl

print "Content-type: text/html\n\n";
print "Hello World!"; [/code]',
            '<!-- BBCode Start --><TABLE BORDER=0 ALIGN=CENTER WIDTH=85%><TR><TD><font size=-1>Code:</font><HR></TD></TR><TR><TD><FONT SIZE=-1><PRE>#!/usr/bin/perl

print "Content-type: text/html\n\n";
print "Hello World!"; </PRE></FONT></TD></TR><TR><TD><HR></TD></TR></TABLE><!-- BBCode End -->',
        ];
    }
}
