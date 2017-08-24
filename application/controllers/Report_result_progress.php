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

    public function pdf(){
        $param = ($_GET['year'] !="")?"/year/".$_GET['year']:"";
        $param .= ($_GET['current_status_id'] !="")?"/current_status_id/".$_GET['current_status_id']:"";
        $param .= ($_GET['partid'] !="")?"/partid/".$_GET['partid']:"";
        $param .= ($_GET['province_id'] !="")?"/province_id/".$_GET['province_id']:"";
        $param .= ($_GET['district_id'] !="")?"/district_id/".$_GET['district_id']:"";
        $param .= ($_GET['address_id'] !="")?"/address_id/".$_GET['address_id']:"";

        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['progress_type'] = array(
            '0'=>'ยุติเรื่อง',
            '1'=>'อยู่ระหว่างดำเนินการของหน่วยงานที่เกี่ยวข้อง'
        );

        $arr_data['result_progress'] = array(
            '1'=>array(
                'result'=>array(
                    'column1'=>'1',
                    'column2'=>'เรื่องร้องเรียนปีงบประมาณ พ.ศ.๒๕๕๘',
                    'column3'=>'203',
                    'column4'=>'410',
                    'column5'=>'0',
                    'column6'=>'143',
                    'column7'=>'30',
                    'column8'=>'17',
                    'column9'=>'803',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'803',
                    'column14'=>'0',
                    'column15'=>'803'
                ),
                'result_sum'=>array(
                    'column1'=>'',
                    'column2'=>'รวม (1)',
                    'column3'=>'203',
                    'column4'=>'410',
                    'column5'=>'0',
                    'column6'=>'143',
                    'column7'=>'30',
                    'column8'=>'17',
                    'column9'=>'803',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'803',
                    'column14'=>'0',
                    'column15'=>'803',
                )
            ),
            '2'=>array(
                'result'=>array(
                    'column1'=>'2',
                    'column2'=>'เรื่องร้องเรียนปีงบประมาณ พ.ศ.๒๕๕๙',
                    'column3'=>'94',
                    'column4'=>'373',
                    'column5'=>'0',
                    'column6'=>'135',
                    'column7'=>'26',
                    'column8'=>'20',
                    'column9'=>'696',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'696',
                    'column14'=>'0',
                    'column15'=>'696',
                ),
                'result_sum'=>array(
                    'column1'=>'',
                    'column2'=>'รวม (2)',
                    'column3'=>'94',
                    'column4'=>'373',
                    'column5'=>'0',
                    'column6'=>'135',
                    'column7'=>'26',
                    'column8'=>'20',
                    'column9'=>'696',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'696',
                    'column14'=>'0',
                    'column15'=>'696',
                )
            ),
            '3'=>array(
                'result'=>array(
                    'column1'=>'3',
                    'column2'=>'เรื่องร้องเรียนปีงบประมาณ พ.ศ.๒๕60',
                    'column3'=>'',
                    'column4'=>'',
                    'column5'=>'',
                    'column6'=>'',
                    'column7'=>'',
                    'column8'=>'',
                    'column9'=>'',
                    'column10'=>'',
                    'column11'=>'',
                    'column12'=>'',
                    'column13'=>'',
                    'column14'=>'',
                    'column15'=>'',
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'3.1',
                        'column2'=>'เดือนตุลาคม 2559',
                        'column3'=>'9',
                        'column4'=>'40',
                        'column5'=>'0',
                        'column6'=>'6',
                        'column7'=>'13',
                        'column8'=>'0',
                        'column9'=>'68',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'68',
                        'column14'=>'0',
                        'column15'=>'68',
                    ) ,
                    '1'=>array(
                        'column1'=>'3.2',
                        'column2'=>'เดือนพฤศจิกายน 2559',
                        'column3'=>'53',
                        'column4'=>'62',
                        'column5'=>'0',
                        'column6'=>'22',
                        'column7'=>'0',
                        'column8'=>'2',
                        'column9'=>'139',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'139',
                        'column14'=>'0',
                        'column15'=>'139',
                    ) ,
                    '2'=>array(
                        'column1'=>'3.3',
                        'column2'=>'เดือนธันวาคม 2559',
                        'column3'=>'47',
                        'column4'=>'93',
                        'column5'=>'0',
                        'column6'=>'26',
                        'column7'=>'23',
                        'column8'=>'27',
                        'column9'=>'216',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'216',
                        'column14'=>'0',
                        'column15'=>'216',
                    ) ,
                    '3'=>array(
                        'column1'=>'3.4',
                        'column2'=>'เดือนมกราคม 2560',
                        'column3'=>'8',
                        'column4'=>'116',
                        'column5'=>'114',
                        'column6'=>'12',
                        'column7'=>'8',
                        'column8'=>'0',
                        'column9'=>'158',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'158',
                        'column14'=>'0',
                        'column15'=>'158',
                    ) ,
                    '4'=>array(
                        'column1'=>'3.5',
                        'column2'=>'เดือนกุมภาพันธ์ 2560',
                        'column3'=>'26',
                        'column4'=>'105',
                        'column5'=>'1',
                        'column6'=>'14',
                        'column7'=>'8',
                        'column8'=>'9',
                        'column9'=>'163',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'163',
                        'column14'=>'0',
                        'column15'=>'163',
                    ) ,
                    '5'=>array(
                        'column1'=>'3.6',
                        'column2'=>'เดือนมีนาคม 2560',
                        'column3'=>'18',
                        'column4'=>'131',
                        'column5'=>'0',
                        'column6'=>'11',
                        'column7'=>'11',
                        'column8'=>'0',
                        'column9'=>'171',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'171',
                        'column14'=>'0',
                        'column15'=>'171',
                    ) ,
                    '6'=>array(
                        'column1'=>'3.7',
                        'column2'=>'เดือนเมษายน 2560',
                        'column3'=>'5',
                        'column4'=>'74',
                        'column5'=>'0',
                        'column6'=>'17',
                        'column7'=>'4',
                        'column8'=>'3',
                        'column9'=>'103',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'103',
                        'column14'=>'0',
                        'column15'=>'103',
                    ) ,
                    '7'=>array(
                        'column1'=>'3.8',
                        'column2'=>'เดือนพฤษภาคม 2560',
                        'column3'=>'20',
                        'column4'=>'83',
                        'column5'=>'0',
                        'column6'=>'17',
                        'column7'=>'6',
                        'column8'=>'0',
                        'column9'=>'126',
                        'column10'=>'35',
                        'column11'=>'32',
                        'column12'=>'37',
                        'column13'=>'124',
                        'column14'=>'2',
                        'column15'=>'126',
                    ) ,
                    '8'=>array(
                        'column1'=>'3.9',
                        'column2'=>'เดือนมิถุนายน 2560',
                        'column3'=>'12',
                        'column4'=>'96',
                        'column5'=>'0',
                        'column6'=>'18',
                        'column7'=>'3',
                        'column8'=>'0',
                        'column9'=>'129',
                        'column10'=>'38',
                        'column11'=>'6',
                        'column12'=>'44',
                        'column13'=>'123',
                        'column14'=>'6',
                        'column15'=>'129',
                    ) ,
                    '9'=>array(
                        'column1'=>'3.10',
                        'column2'=>'เดือนกรกฎาคม 2560',
                        'column3'=>'7',
                        'column4'=>'82',
                        'column5'=>'0',
                        'column6'=>'17',
                        'column7'=>'11',
                        'column8'=>'0',
                        'column9'=>'117',
                        'column10'=>'73',
                        'column11'=>'44',
                        'column12'=>'117',
                        'column13'=>'73',
                        'column14'=>'44',
                        'column15'=>'117',
                    )
                ),
                'result_sum'=>array(
                    'column1'=>'',
                    'column2'=>'รวม (3)',
                    'column3'=>'203',
                    'column4'=>'410',
                    'column5'=>'0',
                    'column6'=>'143',
                    'column7'=>'30',
                    'column8'=>'17',
                    'column9'=>'803',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'803',
                    'column14'=>'0',
                    'column15'=>'803',
                ),
                'result_sum_all'=>array(
                    'column1'=>'',
                    'column2'=>'รวม (1) + (2) + (3)',
                    'column3'=>'203',
                    'column4'=>'410',
                    'column5'=>'0',
                    'column6'=>'143',
                    'column7'=>'30',
                    'column8'=>'17',
                    'column9'=>'803',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'803',
                    'column14'=>'0',
                    'column15'=>'803',
                )
            )
        );

        //echo '<pre>'; print_r($arr_data); echo '</pre>'; exit;
        $html=$this->load->view('report_result_progress/pdf',$arr_data, true);

        $mpdf=new mPDF('th','A4-L',0,'THSaraban',15,15,16,16,9,9, 'L');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output('example_mpdf.pdf', 'I');
        exit;
    }

    public function excel(){
        $param = ($_GET['year'] !="")?"/year/".$_GET['year']:"";
        $param .= ($_GET['current_status_id'] !="")?"/current_status_id/".$_GET['current_status_id']:"";
        $param .= ($_GET['partid'] !="")?"/partid/".$_GET['partid']:"";
        $param .= ($_GET['province_id'] !="")?"/province_id/".$_GET['province_id']:"";
        $param .= ($_GET['district_id'] !="")?"/district_id/".$_GET['district_id']:"";
        $param .= ($_GET['address_id'] !="")?"/address_id/".$_GET['address_id']:"";

        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['progress_type'] = array(
            '0'=>'ยุติเรื่อง',
            '1'=>'อยู่ระหว่างดำเนินการของหน่วยงานที่เกี่ยวข้อง'
        );

        $arr_data['result_progress'] = array(
            '1'=>array(
                'result'=>array(
                    'column1'=>'1',
                    'column2'=>'เรื่องร้องเรียนปีงบประมาณ พ.ศ.๒๕๕๘',
                    'column3'=>'203',
                    'column4'=>'410',
                    'column5'=>'0',
                    'column6'=>'143',
                    'column7'=>'30',
                    'column8'=>'17',
                    'column9'=>'803',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'803',
                    'column14'=>'0',
                    'column15'=>'803'
                ),
                'result_sum'=>array(
                    'column1'=>'',
                    'column2'=>'รวม (1)',
                    'column3'=>'203',
                    'column4'=>'410',
                    'column5'=>'0',
                    'column6'=>'143',
                    'column7'=>'30',
                    'column8'=>'17',
                    'column9'=>'803',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'803',
                    'column14'=>'0',
                    'column15'=>'803',
                )
            ),
            '2'=>array(
                'result'=>array(
                    'column1'=>'2',
                    'column2'=>'เรื่องร้องเรียนปีงบประมาณ พ.ศ.๒๕๕๙',
                    'column3'=>'94',
                    'column4'=>'373',
                    'column5'=>'0',
                    'column6'=>'135',
                    'column7'=>'26',
                    'column8'=>'20',
                    'column9'=>'696',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'696',
                    'column14'=>'0',
                    'column15'=>'696',
                ),
                'result_sum'=>array(
                    'column1'=>'',
                    'column2'=>'รวม (2)',
                    'column3'=>'94',
                    'column4'=>'373',
                    'column5'=>'0',
                    'column6'=>'135',
                    'column7'=>'26',
                    'column8'=>'20',
                    'column9'=>'696',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'696',
                    'column14'=>'0',
                    'column15'=>'696',
                )
            ),
            '3'=>array(
                'result'=>array(
                    'column1'=>'3',
                    'column2'=>'เรื่องร้องเรียนปีงบประมาณ พ.ศ.๒๕60',
                    'column3'=>'',
                    'column4'=>'',
                    'column5'=>'',
                    'column6'=>'',
                    'column7'=>'',
                    'column8'=>'',
                    'column9'=>'',
                    'column10'=>'',
                    'column11'=>'',
                    'column12'=>'',
                    'column13'=>'',
                    'column14'=>'',
                    'column15'=>'',
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'3.1',
                        'column2'=>'เดือนตุลาคม 2559',
                        'column3'=>'9',
                        'column4'=>'40',
                        'column5'=>'0',
                        'column6'=>'6',
                        'column7'=>'13',
                        'column8'=>'0',
                        'column9'=>'68',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'68',
                        'column14'=>'0',
                        'column15'=>'68',
                    ) ,
                    '1'=>array(
                        'column1'=>'3.2',
                        'column2'=>'เดือนพฤศจิกายน 2559',
                        'column3'=>'53',
                        'column4'=>'62',
                        'column5'=>'0',
                        'column6'=>'22',
                        'column7'=>'0',
                        'column8'=>'2',
                        'column9'=>'139',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'139',
                        'column14'=>'0',
                        'column15'=>'139',
                    ) ,
                    '2'=>array(
                        'column1'=>'3.3',
                        'column2'=>'เดือนธันวาคม 2559',
                        'column3'=>'47',
                        'column4'=>'93',
                        'column5'=>'0',
                        'column6'=>'26',
                        'column7'=>'23',
                        'column8'=>'27',
                        'column9'=>'216',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'216',
                        'column14'=>'0',
                        'column15'=>'216',
                    ) ,
                    '3'=>array(
                        'column1'=>'3.4',
                        'column2'=>'เดือนมกราคม 2560',
                        'column3'=>'8',
                        'column4'=>'116',
                        'column5'=>'114',
                        'column6'=>'12',
                        'column7'=>'8',
                        'column8'=>'0',
                        'column9'=>'158',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'158',
                        'column14'=>'0',
                        'column15'=>'158',
                    ) ,
                    '4'=>array(
                        'column1'=>'3.5',
                        'column2'=>'เดือนกุมภาพันธ์ 2560',
                        'column3'=>'26',
                        'column4'=>'105',
                        'column5'=>'1',
                        'column6'=>'14',
                        'column7'=>'8',
                        'column8'=>'9',
                        'column9'=>'163',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'163',
                        'column14'=>'0',
                        'column15'=>'163',
                    ) ,
                    '5'=>array(
                        'column1'=>'3.6',
                        'column2'=>'เดือนมีนาคม 2560',
                        'column3'=>'18',
                        'column4'=>'131',
                        'column5'=>'0',
                        'column6'=>'11',
                        'column7'=>'11',
                        'column8'=>'0',
                        'column9'=>'171',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'171',
                        'column14'=>'0',
                        'column15'=>'171',
                    ) ,
                    '6'=>array(
                        'column1'=>'3.7',
                        'column2'=>'เดือนเมษายน 2560',
                        'column3'=>'5',
                        'column4'=>'74',
                        'column5'=>'0',
                        'column6'=>'17',
                        'column7'=>'4',
                        'column8'=>'3',
                        'column9'=>'103',
                        'column10'=>'0',
                        'column11'=>'0',
                        'column12'=>'0',
                        'column13'=>'103',
                        'column14'=>'0',
                        'column15'=>'103',
                    ) ,
                    '7'=>array(
                        'column1'=>'3.8',
                        'column2'=>'เดือนพฤษภาคม 2560',
                        'column3'=>'20',
                        'column4'=>'83',
                        'column5'=>'0',
                        'column6'=>'17',
                        'column7'=>'6',
                        'column8'=>'0',
                        'column9'=>'126',
                        'column10'=>'35',
                        'column11'=>'32',
                        'column12'=>'37',
                        'column13'=>'124',
                        'column14'=>'2',
                        'column15'=>'126',
                    ) ,
                    '8'=>array(
                        'column1'=>'3.9',
                        'column2'=>'เดือนมิถุนายน 2560',
                        'column3'=>'12',
                        'column4'=>'96',
                        'column5'=>'0',
                        'column6'=>'18',
                        'column7'=>'3',
                        'column8'=>'0',
                        'column9'=>'129',
                        'column10'=>'38',
                        'column11'=>'6',
                        'column12'=>'44',
                        'column13'=>'123',
                        'column14'=>'6',
                        'column15'=>'129',
                    ) ,
                    '9'=>array(
                        'column1'=>'3.10',
                        'column2'=>'เดือนกรกฎาคม 2560',
                        'column3'=>'7',
                        'column4'=>'82',
                        'column5'=>'0',
                        'column6'=>'17',
                        'column7'=>'11',
                        'column8'=>'0',
                        'column9'=>'117',
                        'column10'=>'73',
                        'column11'=>'44',
                        'column12'=>'117',
                        'column13'=>'73',
                        'column14'=>'44',
                        'column15'=>'117',
                    )
                ),
                'result_sum'=>array(
                    'column1'=>'',
                    'column2'=>'รวม (3)',
                    'column3'=>'203',
                    'column4'=>'410',
                    'column5'=>'0',
                    'column6'=>'143',
                    'column7'=>'30',
                    'column8'=>'17',
                    'column9'=>'803',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'803',
                    'column14'=>'0',
                    'column15'=>'803',
                ),
                'result_sum_all'=>array(
                    'column1'=>'',
                    'column2'=>'รวม (1) + (2) + (3)',
                    'column3'=>'203',
                    'column4'=>'410',
                    'column5'=>'0',
                    'column6'=>'143',
                    'column7'=>'30',
                    'column8'=>'17',
                    'column9'=>'803',
                    'column10'=>'0',
                    'column11'=>'0',
                    'column12'=>'0',
                    'column13'=>'803',
                    'column14'=>'0',
                    'column15'=>'803',
                )
            )
        );

        $this->load->view('report_result_progress/excel',$arr_data);
    }


}