<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// load base class if needed
require_once( APPPATH . 'controllers/base/AdminBase.php' );
// --

class chart extends ApplicationBase {

    // constructor
    public function  __construct() {
        parent::__construct();
        // load
        $this->smarty->load_javascript("resource/js/fusioncharts/fusioncharts.js");
    }

    // list data
    public function index() {
        // set template content
        $this->smarty->assign("template_content", "template/chart/list.html");

        // output
        parent::display();
    }

    // data for chart
    public function  data_xml () {
        header("Content-type: text/xml");
        echo "<graph caption='Monthly Sales Summary' subcaption='For the year 2006' xAxisName='Month' yAxisMaxValue='45000' yAxisMinValue='15000' yAxisName='Sales' numberPrefix='$' decimalPrecision='0'>
                <set name='Jan' value='17400' />
                <set name='Feb' value='18100' />
                <set name='Mar' value='21800' />
                <set name='Apr' value='23800' />
                <set name='May' value='29600' />
                <set name='Jun' value='27600' />
                <set name='Jul' value='31800' />
                <set name='Aug' value='39700' />
                <set name='Sep' value='37800' />
                <set name='Oct' value='21900' />
                <set name='Nov' value='32900' />
                <set name='Dec' value='39800' />
                </graph> ";
    }
    
    public function  data_xml_Column3D () {
        header("Content-type: text/xml");
        echo "<graph caption='Monthly Unit Sales' xAxisName='Month' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>
                <set name='Jan' value='462' color='AFD8F8'/>
                <set name='Feb' value='857' color='F6BD0F'/>
                <set name='Mar' value='671' color='8BBA00'/>
                <set name='Apr' value='494' color='FF8E46'/>
                <set name='May' value='761' color='008E8E'/>
                <set name='Jun' value='960' color='D64646'/>
                <set name='Jul' value='629' color='8E468E'/>
                <set name='Aug' value='622' color='588526'/>
                <set name='Sep' value='376' color='B3AA00'/>
                <set name='Oct' value='494' color='008ED6'/>
                <set name='Nov' value='761' color='9D080D'/>
                <set name='Dec' value='960' color='A186BE'/>
            </graph>";
    }
}