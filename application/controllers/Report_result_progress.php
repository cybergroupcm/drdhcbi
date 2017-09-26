<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_result_progress extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->helper(array('form'));
        $this->load->library('my_mpdf');
        if (!$this->ion_auth->logged_in() || !$this->api_auth->logged_in()) {
            redirect('alert', 'refresh');
        }
    }

    public function view()
    {
        $param = ($_GET['year'] != "") ? "/year/" . $_GET['year'] : "";
        $param .= ($_GET['current_status_id'] != "") ? "/current_status_id/" . $_GET['current_status_id'] : "";
        $param .= ($_GET['partid'] != "") ? "/partid/" . $_GET['partid'] : "";
        $param .= ($_GET['province_id'] != "") ? "/province_id/" . $_GET['province_id'] : "";
        $param .= ($_GET['district_id'] != "") ? "/district_id/" . $_GET['district_id'] : "";
        $param .= ($_GET['address_id'] != "") ? "/address_id/" . $_GET['address_id'] : "";

        $yy = $this->input->get('yy', FALSE);
        $mm = $this->input->get('mm', FALSE);
        if (is_null($yy) || is_null($mm)) {
            $arr_data['yymm'] = $yymm = date('Y-m');
            $yy = date('Y');
            $mm = date('m');
        }
        else {
            $mm = sprintf("%02s", $mm);
            $arr_data['yymm'] = $yymm = "{$yy}-{$mm}";
        }

        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['progress_type'] = [
            '0' => 'ดำเนินการ',
            '1' => 'ยุติเรื่อง'
        ];
            $url = base_url("api/report/report_result_progress/type/1/year/" . ($yy - 1));
            $oneYearOld = api_call_get($url);
            $url = base_url("api/report/report_result_progress/type/1/year/" . ($yy - 2));
            $twoYearOld = api_call_get($url);
            $url = base_url("api/report/report_result_progress/type/2/year/{$yy}/month/{$mm}");
            $nowYear = api_call_get($url);


        $arr_data['result_progress'] = array(
            '1' => [
                'result' => [
                    'column1' => '3.1 เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.' . (date_thai($yymm . '-01', true, 'y') - 2)
                ],
                'result_sub' => [$twoYearOld]
            ],
            '2' => [
                'result' => [
                    'column1' => '3.2 เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.' . (date_thai($yymm . '-01', true, 'y') - 1)
                ],
                'result_sub' => [$oneYearOld]
            ],
            '3' => array(
                'result' => array(
                    'column1' => '3.3 เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.' . date_thai($yymm . '-01', true, 'y')
                ),
                'result_sub'=>$nowYear
            )
        );
        $this->libraries->report('report_result_progress/view', $arr_data);
    }
}