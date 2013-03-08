<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// load base class if needed
require_once( APPPATH . 'controllers/base/AdminBase.php' );
// --

class pdf extends ApplicationBase {

    // constructor
    public function  __construct() {
        parent::__construct();
        // load
        $this->load->library('tcpdf');
    }

    // PHP PDF
    public function index() {
        // set template content
        $this->smarty->assign("template_content", "template/pdf/welcome.html");

        // output
        parent::display();

    }

    // simple pdf
    public function simple() {
        // config
        $this->tcpdf->SetPrintHeader(false);
        $this->tcpdf->SetPrintFooter(false);
        $this->tcpdf->SetDisplayMode('real');
        // add a page
        $this->tcpdf->AddPage();
        // write cell
        $this->tcpdf->Cell(0, 0, 'TEST CELL STRETCH: no stretch', 1, 1, 'C', 0, '', 0);
        $this->tcpdf->Cell(0, 0, 'TEST CELL STRETCH: scaling', 1, 1, 'C', 0, '', 1);
        $this->tcpdf->Cell(0, 0, 'TEST CELL STRETCH: force scaling', 1, 1, 'C', 0, '', 2);
        $this->tcpdf->Cell(0, 0, 'TEST CELL STRETCH: spacing', 1, 1, 'C', 0, '', 3);
        $this->tcpdf->Cell(0, 0, 'TEST CELL STRETCH: force spacing', 1, 1, 'C', 0, '', 4);
        // add a page
        $this->tcpdf->AddPage();
        // write html
        $html = '<h4>HTML Example</h4>';
        $html .= '<p>This is just an example of html code to demonstrate some supported CSS inline styles.
                <span style="font-weight: bold;">bold text</span>
                <span style="text-decoration: line-through;">line-trough</span>
                <span style="text-decoration: underline line-through;">underline and line-trough</span>
                <span style="color: rgb(0, 128, 64);">color</span>
                <span style="background-color: rgb(255, 0, 0); color: rgb(255, 255, 255);">background color</span>
                <span style="font-weight: bold;">bold</span>
                <span style="font-size: xx-small;">xx-small</span>
                <span style="font-size: x-small;">x-small</span>
                <span style="font-size: small;">small</span>
                <span style="font-size: medium;">medium</span>
                <span style="font-size: large;">large</span>
                <span style="font-size: x-large;">x-large</span>
                <span style="font-size: xx-large;">xx-large</span>
                </p>';
        $this->tcpdf->writeHTML($html, true, false, true, false, '');
        // output (D : download, I : view)
        $this->tcpdf->Output('simple.pdf', 'I');
    }

    // example bookmarks
    public function bookmarks() {
        // config
        $this->tcpdf->SetPrintHeader(false);
        $this->tcpdf->SetPrintFooter(false);
        $this->tcpdf->SetDisplayMode('real');
        // add a page
        $this->tcpdf->AddPage();
        // set a bookmark for the current position
        $this->tcpdf->Bookmark('Chapter 1', 0, 0, '', 'B', array(0,64,128));
        // print a line using Cell()
        $html = '<h4>HTML Example With Bookmarks method</h4>';
        $this->tcpdf->writeHTML($html, true, false, true, false, '');
        // add other pages and bookmarks
        $this->tcpdf->AddPage();
        $this->tcpdf->Bookmark('Paragraph 1.1', 1, 0, '', '', array(0,0,0));
        $this->tcpdf->Cell(0, 10, 'Paragraph 1.1', 0, 1, 'L');
        $this->tcpdf->AddPage();
        $this->tcpdf->Bookmark('Paragraph 1.2', 1, 0, '', '', array(0,0,0));
        $this->tcpdf->Cell(0, 10, 'Paragraph 1.2', 0, 1, 'L');
        $this->tcpdf->AddPage();
        $this->tcpdf->Bookmark('Sub-Paragraph 1.2.1', 2, 0, '', 'I', array(0,0,0));
        $this->tcpdf->Cell(0, 10, 'Sub-Paragraph 1.2.1', 0, 1, 'L');
        $this->tcpdf->AddPage();
        $this->tcpdf->Bookmark('Paragraph 1.3', 1, 0, '', '', array(0,0,0));
        $this->tcpdf->Cell(0, 10, 'Paragraph 1.3', 0, 1, 'L');
        $this->tcpdf->AddPage();
        $this->tcpdf->Bookmark('Chapter 2', 0, 0, '', 'BI', array(128,0,0));
        $this->tcpdf->Cell(0, 10, 'Chapter 2', 0, 1, 'L');
        $this->tcpdf->AddPage();
        $this->tcpdf->Bookmark('Chapter 3', 0, 0, '', 'B', array(0,64,128));
        $html = '<h4>HTML Example With Bookmarks method The Last Page</h4>';
        $this->tcpdf->writeHTML($html, true, false, true, false, '');
        // output (D : download, I : view)
        $this->tcpdf->Output('bookmarks.pdf', 'I');
    }

    // example with css
    public function css() {
        // config
        $this->tcpdf->SetPrintHeader(false);
        $this->tcpdf->SetPrintFooter(false);
        $this->tcpdf->SetDisplayMode('real');
        // add a page
        $this->tcpdf->AddPage();
        // define some HTML content with style
        $html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	h1 {
		color: navy;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 12pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
		background-color: #ffffee;
	}
	td.second {
		border: 2px dashed green;
	}
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
</style>

<h1 class="title">Example of <i style="color:#990000">XHTML + CSS</i></h1>

<p class="first">Example of paragraph with class selector. <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras eget velit nulla, eu sagittis elit. Nunc ac arcu est, in lobortis tellus. Praesent condimentum rhoncus sodales. In hac habitasse platea dictumst. Proin porta eros pharetra enim tincidunt dignissim nec vel dolor. Cras sapien elit, ornare ac dignissim eu, ultricies ac eros. Maecenas augue magna, ultrices a congue in, mollis eu nulla. Nunc venenatis massa at est eleifend faucibus. Vivamus sed risus lectus, nec interdum nunc.</span></p>

<p id="second">Example of paragraph with ID selector. <span>Fusce et felis vitae diam lobortis sollicitudin. Aenean tincidunt accumsan nisi, id vehicula quam laoreet elementum. Phasellus egestas interdum erat, et viverra ipsum ultricies ac. Praesent sagittis augue at augue volutpat eleifend. Cras nec orci neque. Mauris bibendum posuere blandit. Donec feugiat mollis dui sit amet pellentesque. Sed a enim justo. Donec tincidunt, nisl eget elementum aliquam, odio ipsum ultrices quam, eu porttitor ligula urna at lorem. Donec varius, eros et convallis laoreet, ligula tellus consequat felis, ut ornare metus tellus sodales velit. Duis sed diam ante. Ut rutrum malesuada massa, vitae consectetur ipsum rhoncus sed. Suspendisse potenti. Pellentesque a congue massa.</span></p>

<div class="test">example of DIV with border and fill.<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus.</div>

<br />

<table class="first" cellpadding="4" cellspacing="6">
 <tr>
  <td width="30" align="center"><b>No.</b></td>
  <td width="140" align="center" bgcolor="#FFFF00"><b>XXXX</b></td>
  <td width="140" align="center"><b>XXXX</b></td>
  <td width="80" align="center"> <b>XXXX</b></td>
  <td width="80" align="center"><b>XXXX</b></td>
  <td width="45" align="center"><b>XXXX</b></td>
 </tr>
 <tr>
  <td width="30" align="center">1.</td>
  <td width="140" rowspan="6" class="second">XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX</td>
  <td width="140">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td width="80">XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="30" align="center" rowspan="3">2.</td>
  <td width="140" rowspan="3">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="80">XXXX<br />XXXX<br />XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="80" rowspan="2" >XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="30" align="center">3.</td>
  <td width="140">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr bgcolor="#FFFF80">
  <td width="30" align="center">4.</td>
  <td width="140" bgcolor="#00CC00" color="#FFFF00">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
</table>
EOF;

        // output the HTML content
        $this->tcpdf->writeHTML($html, true, false, true, false, '');
        // output (D : download, I : view)
        $this->tcpdf->Output('css.pdf', 'I');
    }
}