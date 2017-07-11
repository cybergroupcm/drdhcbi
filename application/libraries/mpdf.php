<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) ."/mpdf/mpdf.php";
class MY_mpdf extends mPDF {
    public function __construct()
        {
            parent::__construct();
        }
}