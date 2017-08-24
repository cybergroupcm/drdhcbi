<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_result_progress extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->helper(array('form'));
        $this->load->library('my_mpdf');
        if ( ! $this->ion_auth->logged_in() || !$this->api_auth->logged_in())
        {
            redirect('alert', 'refresh');
        }
    }
    
    public function view()
    {
        $param = ($_GET['year'] !="")?"/year/".$_GET['year']:"";
        $param .= ($_GET['current_status_id'] !="")?"/current_status_id/".$_GET['current_status_id']:"";
        $param .= ($_GET['partid'] !="")?"/partid/".$_GET['partid']:"";
        $param .= ($_GET['province_id'] !="")?"/province_id/".$_GET['province_id']:"";
        $param .= ($_GET['district_id'] !="")?"/district_id/".$_GET['district_id']:"";
        $param .= ($_GET['address_id'] !="")?"/address_id/".$_GET['address_id']:"";

        $yymm=$_GET['yy'].'-'.$_GET['mm'];

        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['progress_type'] = array(
            '0'=>'ดำเนินการ',
            '1'=>'ยุติเรื่อง'
        );

        $arr_data['result_progress'] = array(
            '1'=>array(
                'result'=>array(
                    'column1'=>'3.1 เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.'.(date_thai($yymm.'-01', true,'y')-2)
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'เรื่องร้องเรียนงบประมาณ พ.ศ.'.(date_thai($yymm.'-01', true,'y')-2),
                        'column2'=>'203',
                        'column3'=>'410',
                        'column4'=>'0',
                        'column5'=>'143',
                        'column6'=>'30',
                        'column7'=>'17',
                        'column8'=>'803',
                        'column9'=>'0',
                        'column10'=>'0',
                        'column11'=>'0'
                    )
                )
            ),
            '2'=>array(
                'result'=>array(
                    'column1'=>'3.2 เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.'.(date_thai($yymm.'-01', true,'y')-1)
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'เรื่องร้องเรียนงบประมาณ พ.ศ.'.(date_thai($yymm.'-01', true,'y')-1),
                        'column2'=>'94',
                        'column3'=>'373',
                        'column4'=>'0',
                        'column5'=>'135',
                        'column6'=>'26',
                        'column7'=>'20',
                        'column8'=>'696',
                        'column9'=>'0',
                        'column10'=>'0',
                        'column11'=>'0'
                    )
                )
            ),
            '3'=>array(
                'result'=>array(
                    'column1'=>'3.3 เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.'.date_thai($yymm.'-01', true,'y')
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'เดือน มกราคม',
                        'column2'=>'9',
                        'column3'=>'40',
                        'column4'=>'0',
                        'column5'=>'6',
                        'column6'=>'13',
                        'column7'=>'0',
                        'column8'=>'68',
                        'column9'=>'0',
                        'column10'=>'0',
                        'column11'=>'0'
                    ) ,
                    '1'=>array(
                        'column1'=>'เดือน กุมภาพันธ์',
                        'column2'=>'53',
                        'column3'=>'62',
                        'column4'=>'0',
                        'column5'=>'22',
                        'column6'=>'0',
                        'column7'=>'2',
                        'column8'=>'139',
                        'column9'=>'0',
                        'column10'=>'0',
                        'column11'=>'0'
                    ) ,
                    '2'=>array(
                        'column1'=>'เดือน มีนาคม',
                        'column2'=>'47',
                        'column3'=>'93',
                        'column4'=>'0',
                        'column5'=>'26',
                        'column6'=>'23',
                        'column7'=>'27',
                        'column8'=>'216',
                        'column9'=>'0',
                        'column10'=>'0',
                        'column11'=>'0'
                    ) ,
                    '3'=>array(
                        'column1'=>'เดือน เมษายน',
                        'column2'=>'8',
                        'column3'=>'116',
                        'column4'=>'114',
                        'column5'=>'12',
                        'column6'=>'8',
                        'column7'=>'0',
                        'column8'=>'158',
                        'column9'=>'0',
                        'column10'=>'0',
                        'column11'=>'0'
                    ) ,
                    '4'=>array(
                        'column1'=>'เดือน พฤษภาคม ',
                        'column2'=>'26',
                        'column3'=>'105',
                        'column4'=>'1',
                        'column5'=>'14',
                        'column6'=>'8',
                        'column7'=>'9',
                        'column8'=>'163',
                        'column9'=>'0',
                        'column10'=>'0',
                        'column12'=>'0'
                    ),'5'=>array(
                        'column1'=>'เดือน มิถุนายน',
                        'column2'=>'18',
                        'column3'=>'131',
                        'column4'=>'0',
                        'column5'=>'11',
                        'column6'=>'11',
                        'column7'=>'0',
                        'column8'=>'171',
                        'column9'=>'0',
                        'column10'=>'0',
                        'column11'=>'0'
                    ) ,
                    '6'=>array(
                        'column1'=>'เดือน กรกฎาคม',
                        'column2'=>'5',
                        'column3'=>'74',
                        'column4'=>'0',
                        'column5'=>'17',
                        'column6'=>'4',
                        'column7'=>'3',
                        'column8'=>'103',
                        'column9'=>'0',
                        'column10'=>'0',
                        'column11'=>'0'
                    )
                ),
                'result_sum'=>array(
                    'column1'=>'รวม',
                    'column2'=>'203',
                    'column3'=>'410',
                    'column4'=>'0',
                    'column5'=>'143',
                    'column6'=>'30',
                    'column7'=>'17',
                    'column8'=>'803',
                    'column9'=>'0',
                    'column10'=>'0',
                    'column11'=>'0'
                )
            )
        );
        $this->libraries->report('report_result_progress/view', $arr_data);
    }
}