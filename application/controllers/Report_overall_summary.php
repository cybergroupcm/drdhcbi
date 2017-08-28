<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_overall_summary extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        /* Load :: Common */
        $this->load->helper(array('form'));
        $this->load->model('data/Key_in_model');
        $this->load->library('my_mpdf');
        if ( ! $this->ion_auth->logged_in() || !$this->api_auth->logged_in())
        {
            redirect('alert', 'refresh');
        }
    }

    public function index()
    {
        $arr_data['url'][0] = '';
        $arr_data['url'][1] = '';
        $arr_data['url'][2] = '';
        $this->libraries->template('report_overall_summary/index', $arr_data);
    }

    public function pdf(){
        $param = ($_GET['year'] !="")?"/year/".$_GET['year']:"";
        $param .= ($_GET['current_status_id'] !="")?"/current_status_id/".$_GET['current_status_id']:"";
        $param .= ($_GET['partid'] !="")?"/partid/".$_GET['partid']:"";
        $param .= ($_GET['province_id'] !="")?"/province_id/".$_GET['province_id']:"";
        $param .= ($_GET['district_id'] !="")?"/district_id/".$_GET['district_id']:"";
        $param .= ($_GET['address_id'] !="")?"/address_id/".$_GET['address_id']:"";

        $yymm=$_GET['yy'].'-'.$_GET['mm'];

        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        if($_GET['yy'] != ""){
            $yy = $_GET['yy'];
        }else{
            $yy = date('Y');
        }

        if($_GET['mm'] != ""){
            $mm = $_GET['mm'];
        }else{
            $mm = date('m');
        }

        $yearTh = ($yy+543);

        $arr_data['year_th'] = $yearTh;
        $arr_data['yy'] = $yy;
        $arr_data['mm'] = $mm;
        $arr_data['month_name'] = array(1=>"มกราคม",2=>"กุมภาพันธ์",3=>"มีนาคม",4=>"เมษายน",5=>"พฤษภาคม",6=>"มิถุนายน",7=>"กรกฎาคม",8=>"สิงหาคม",9=>"กันยายน",10=>"ตุลาคม",11=>"พฤศจิกายน",12=>"ธันวาคม");

        $sql = " SELECT
                        num_in_last_month,
                        num_in_now_month,
                        num_success_in_now_month,
                        num_in_last_month+num_in_now_month AS num_remain,
                        complain_type_id
                FROM
                        (
                                SELECT
                SUM( IF (((YEAR(receive_date) = '".$yy."') && ( current_status_id = 1 || current_status_id = 2 ) && (yy = '".$yy."' && mm = '".$mm."')), 1, 0 )) AS num_in_last_month,
                SUM( IF (((YEAR(receive_date) = '".$yy."') && ( current_status_id = 1 || current_status_id = 2 ) && (yy = '".$yy."' && mm = '".$mm."')), 1, 0 )) AS num_in_now_month,
                SUM( IF (((YEAR(receive_date) = '".$yy."') && ( current_status_id != 1 && current_status_id != 2 ) && (yy = '".$yy."' && mm = '".$mm."' )), 1, 0 )) AS num_success_in_now_month,
                complain_type_id
                                FROM
                                        `report_result_all`
                                WHERE
                                        budget = '".$yy."'
                                GROUP BY
                                        complain_type_id
                        ) AS t1 ";
        $data = $this->db->query($sql);
        $report_data = $data->result_array();
        $arr_data['outstanding_month'] = array('1'=>0,'7'=>0,'12'=>'0','17'=>'0','22'=>'0','26'=>'0');
        $arr_data['incoming_month'] = array('1'=>0,'7'=>0,'12'=>'0','17'=>'0','22'=>'0','26'=>'0');
        $arr_data['terminate_cumulative_month'] = array('1'=>0,'7'=>0,'12'=>'0','17'=>'0','22'=>'0','26'=>'0');
        $arr_data['remain'] = array('1'=>0,'7'=>0,'12'=>'0','17'=>'0','22'=>'0','26'=>'0');
        foreach($report_data as $key => $value){
            $arr_data['outstanding_month'][$value['complain_type_id']] = $value['num_in_last_month'];
            $arr_data['incoming_month'][$value['complain_type_id']] = $value['num_in_now_month'];
            $arr_data['terminate_month'][$value['complain_type_id']] = $value['num_success_in_now_month'];
            $arr_data['remain'][$value['complain_type_id']] = $value['num_remain'];
        }
        /*$param = ($_GET['yy'] !="")?"/yy/".$_GET['yy']:"";
        $param .= ($_GET['mm'] !="")?"/mm/".$_GET['mm']:"";

        $yymm=$_GET['yy'].'-'.$_GET['mm'];

        #1. รายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด (เรื่องใหม่)
        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['outstanding_month'] = array('1'=>'28','7'=>'36','12'=>'0','17'=>'8','22'=>'5','26'=>'4');
        $arr_data['incoming_month'] = array('1'=>'7','7'=>'82','12'=>'0','17'=>'17','22'=>'11','26'=>'0');
        $arr_data['incoming_cumulative_month'] = array('1'=>'205','7'=>'882','12'=>'15','17'=>'160','22'=>'87','26'=>'41');
        $arr_data['terminate_month'] = array('1'=>'31','7'=>'89','12'=>'0','17'=>'14','22'=>'12','26'=>'0');
        $arr_data['terminate_cumulative_month'] = array('1'=>'201','7'=>'853','12'=>'15','17'=>'149','22'=>'83','26'=>'37');
*/
        #2. รายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด (คงค้าง)

        if($_GET['yy'] != ""){
            $yy = $_GET['yy'];
        }else{
            $yy = date('Y');
        }

        if($_GET['mm'] != ""){
            $mm = $_GET['mm'];
        }else{
            $mm = date('m');
        }

        $url = base_url("api/dropdown/current_status_lists");
        $arr_data['current_status'] = api_call_get($url);

        $url = base_url()."api/report/month_report/".$_GET['year'];
        $arr_data['month_report'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status".$param;
        $arr_data['report_type'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status_max/".$_GET['year'];
        $arr_data['report_type_max'] = api_call_get($url);

        $url = base_url()."api/report/list_year/";
        $arr_data['list_year'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

        $url = base_url("api/dropdown/area_part_lists");
        $arr_data['area_part_list'] = api_call_get($url);

        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['main_data'] = array();
        $arr_year_temp = array();
        $index_main = 0;
        for($i=2;$i>0;$i--){
            $index_main++;
            $con_year_start = ($yy-$i);
            $con_year_end = ($yy-($i-1));
            $start_year = ($con_year_start+543);
            $end_year = ($con_year_end+543);
            $arr_data['main_data'][$index_main] = 'เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.'.$start_year.'  และสามารถแก้ไขปัญหาจนได้ข้อยุติ  ในปีงบประมาณ พ.ศ.'.$end_year;
            $arr_year_temp[$index_main]['year_start'] = substr($start_year,2,2);
            $arr_year_temp[$index_main]['year_end'] = substr($end_year,2,2);

            $sql = "SELECT
                        num_receive,
                        num_succes,
                        num_wait,
                        num_in_month,
                        (num_wait-num_in_year) AS num_remain,
                        complain_type_id
                    FROM
                        (
                            SELECT
                    SUM( IF (((YEAR(receive_date) = '".$con_year_start."') ), 1, 0 )) AS num_receive,
                    SUM( IF (((YEAR(receive_date) = '".$con_year_start."') && ( current_status_id != 1 && current_status_id != 2 ) && (yy = '".$con_year_end."')), 1, 0 )) AS num_succes,
                    SUM( IF (((YEAR(receive_date) = '".$con_year_start."') && ( ( ( current_status_id = 1 || current_status_id = 2 ) && (yy = '".$con_year_start."') ) || ( current_status_id != 1 && current_status_id != 2 ) && (yy > '".$con_year_end."'))), 1, 0 )) AS num_wait,
                    SUM( IF (((YEAR(receive_date) = '".$con_year_start."') && ( current_status_id != 1 && current_status_id != 2 ) && (yy = '".$yy."' && mm = '".$mm."')), 1, 0 )) AS num_in_month,
                    SUM( IF (((YEAR(receive_date) = '".$con_year_start."') && ( current_status_id != 1 && current_status_id != 2 ) && (yy = '".$yy."' && mm <= '".$mm."')), 1, 0 )) AS num_in_year,
                                complain_type_id
                            FROM
                                `report_result_all`
                            WHERE
                                YEAR (receive_date) = '".$con_year_start."'
                            GROUP BY
                                complain_type_id
                        ) AS t1";
            $data = $this->db->query($sql);
            $report_data = $data->result_array();
            foreach($report_data as $key => $value){
                $arr_data['sub_detail_report'][$index_main][1][$value['complain_type_id']] = $value['num_receive'];
                $arr_data['sub_detail_report'][$index_main][2][$value['complain_type_id']] = $value['num_succes'];
                $arr_data['sub_detail_report'][$index_main][3][$value['complain_type_id']] = $value['num_wait'];
                $arr_data['sub_detail_report'][$index_main][4][$value['complain_type_id']] = $value['num_in_month'];
                $arr_data['sub_detail_report'][$index_main][5][$value['complain_type_id']] = $value['num_remain'];
            }

        }

        $arr_title_sub = array(
            '1'=>'เรื่องเข้าทั้งหมดปี ',
            '2'=>'ดำเนินการจนได้ข้อยุติปี ',
            '3'=>'เรื่องค้างทั้งหมดปีงบ ',
            '4'=>'เรื่องยุติในเดือนนี้',
            '5'=>'คงเหลือ'
        );
        $arr_data['sub_data'] = array(
        );
        foreach($arr_year_temp as $key => $value){
            $arr_temp_sub = array();
            foreach($arr_title_sub as $key_title => $value_title){
                if($key_title == 1 || $key_title == 2 || $key_title == 3){
                    $arr_temp_sub[$key_title] = $value_title.$value['year_start'];
                }else{
                    $arr_temp_sub[$key_title] = $value_title;
                }

            }


            $arr_data['sub_data'][$key] = $arr_temp_sub;
        }

        $arr_data['data_detail']['year'] = $yy;
        $arr_data['data_detail']['month'] = $mm;
        $arr_data['data_detail']['month_name'] = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");

        /*$url = base_url("api/dropdown/current_status_lists");
        $arr_data['current_status'] = api_call_get($url);

        $url = base_url()."api/report/month_report/".$_GET['year'];
        $arr_data['month_report'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status".$param;
        $arr_data['report_type'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status_max/".$_GET['year'];
        $arr_data['report_type_max'] = api_call_get($url);

        $url = base_url()."api/report/list_year/";
        $arr_data['list_year'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

        $url = base_url("api/dropdown/area_part_lists");
        $arr_data['area_part_list'] = api_call_get($url);

        $arr_data['main_data'] = array(
            '1'=>'เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.'.(date_thai($yymm.'-01', true,'y')-2).'  และสามารถแก้ไขปัญหาจนได้ข้อยุติ  ในปีงบประมาณ พ.ศ.'.(date_thai($yymm.'-01', true,'y')-1),
            '2'=>'เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.'.(date_thai($yymm.'-01', true,'y')-1).' และสามารถแก้ไขปัญหาจนได้ข้อยุติในปีงบประมาณ พ.ศ.'.date_thai($yymm.'-01', true,'y')
        );
        $arr_data['sub_data'] = array(
            '1'=>array(
                '1'=>'เรื่องเข้าทั้งหมดปี '.(date_thai($yymm.'-01', true,'Y')-2),
                '2'=>'ดำเนินการจนได้ข้อยุติปี '.(date_thai($yymm.'-01', true,'Y')-2),
                '3'=>'เรื่องค้างทั้งหมดปีงบ '.(date_thai($yymm.'-01', true,'Y')-2),
                '4'=>'เรื่องยุติในเดือนนี้',
                '5'=>'คงเหลือ'
            ),
            '2'=>array(
                '1'=>'เรื่องเข้าทั้งหมดปี '.(date_thai($yymm.'-01', true,'Y')-1),
                '2'=>'ดำเนินการจนได้ข้อยุติปี '.(date_thai($yymm.'-01', true,'Y')-1),
                '3'=>'เรื่องค้างทั้งหมดปีงบ '.(date_thai($yymm.'-01', true,'Y')-1),
                '4'=>'เรื่องยุติในเดือนนี้',
                '5'=>'คงเหลือ'
            ));
        $arr_data['sub_detail_report'] = array(
            '1'=>array(
                '1'=>'200',
                '7'=>'30',
                '12'=>'50',
                '17'=>'10',
                '22'=>'3',
                '26'=>'300'
            ),
            '2'=>array(
                '1'=>'20',
                '7'=>'40',
                '12'=>'80',
                '17'=>'10',
                '22'=>'14',
                '26'=>'32'
            ),
            '3'=>array(
                '1'=>'45',
                '7'=>'60',
                '12'=>'98',
                '17'=>'99',
                '22'=>'12',
                '26'=>'40'
            ),
            '4'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),
            '5'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),

        );
        $arr_data['sub_detail_remain'] = array(
            '1'=>array(
                '1'=>'100',
                '7'=>'102',
                '12'=>'35',
                '17'=>'20',
                '22'=>'32',
                '26'=>'66'
            ),
            '2'=>array(
                '1'=>'12',
                '7'=>'65',
                '12'=>'32',
                '17'=>'74',
                '22'=>'75',
                '26'=>'89'
            ),
            '3'=>array(
                '1'=>'24',
                '7'=>'26',
                '12'=>'32',
                '17'=>'64',
                '22'=>'12',
                '26'=>'40'
            ),
            '4'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),
            '5'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),
        );
*/
        #3. รายงานรวมผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัดแบบรายเดือน

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

        $arr_data['user_report'] = array(
            'user_name'=>'........................................',
            'user_position'=>'........................................'
        );

        $html=$this->load->view('report_overall_summary/pdf',$arr_data, true);

        $mpdf=new mPDF('th','A4-L',0,'THSaraban',15,15,16,16,9,9, 'L');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output('example_mpdf.pdf', 'I');
        exit;
    }

    public function excel(){
        $param = ($_GET['yy'] !="")?"/yy/".$_GET['yy']:"";
        $param .= ($_GET['mm'] !="")?"/mm/".$_GET['mm']:"";

        $yymm=$_GET['yy'].'-'.$_GET['mm'];

        #1. รายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด (เรื่องใหม่)
        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['outstanding_month'] = array('1'=>'28','7'=>'36','12'=>'0','17'=>'8','22'=>'5','26'=>'4');
        $arr_data['incoming_month'] = array('1'=>'7','7'=>'82','12'=>'0','17'=>'17','22'=>'11','26'=>'0');
        $arr_data['incoming_cumulative_month'] = array('1'=>'205','7'=>'882','12'=>'15','17'=>'160','22'=>'87','26'=>'41');
        $arr_data['terminate_month'] = array('1'=>'31','7'=>'89','12'=>'0','17'=>'14','22'=>'12','26'=>'0');
        $arr_data['terminate_cumulative_month'] = array('1'=>'201','7'=>'853','12'=>'15','17'=>'149','22'=>'83','26'=>'37');

        #2. รายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด (คงค้าง)
        $url = base_url("api/dropdown/current_status_lists");
        $arr_data['current_status'] = api_call_get($url);

        $url = base_url()."api/report/month_report/".$_GET['year'];
        $arr_data['month_report'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status".$param;
        $arr_data['report_type'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status_max/".$_GET['year'];
        $arr_data['report_type_max'] = api_call_get($url);

        $url = base_url()."api/report/list_year/";
        $arr_data['list_year'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

        $url = base_url("api/dropdown/area_part_lists");
        $arr_data['area_part_list'] = api_call_get($url);

        $arr_data['main_data'] = array(
            '1'=>'เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.'.(date_thai($yymm.'-01', true,'y')-2).'  และสามารถแก้ไขปัญหาจนได้ข้อยุติ  ในปีงบประมาณ พ.ศ.'.(date_thai($yymm.'-01', true,'y')-1),
            '2'=>'เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.'.(date_thai($yymm.'-01', true,'y')-1).' และสามารถแก้ไขปัญหาจนได้ข้อยุติในปีงบประมาณ พ.ศ.'.date_thai($yymm.'-01', true,'y')
        );
        $arr_data['sub_data'] = array(
            '1'=>array(
                '1'=>'เรื่องเข้าทั้งหมดปี '.(date_thai($yymm.'-01', true,'Y')-2),
                '2'=>'ดำเนินการจนได้ข้อยุติปี '.(date_thai($yymm.'-01', true,'Y')-2),
                '3'=>'เรื่องค้างทั้งหมดปีงบ '.(date_thai($yymm.'-01', true,'Y')-2),
                '4'=>'เรื่องยุติในเดือนนี้',
                '5'=>'คงเหลือ'
            ),
            '2'=>array(
                '1'=>'เรื่องเข้าทั้งหมดปี '.(date_thai($yymm.'-01', true,'Y')-1),
                '2'=>'ดำเนินการจนได้ข้อยุติปี '.(date_thai($yymm.'-01', true,'Y')-1),
                '3'=>'เรื่องค้างทั้งหมดปีงบ '.(date_thai($yymm.'-01', true,'Y')-1),
                '4'=>'เรื่องยุติในเดือนนี้',
                '5'=>'คงเหลือ'
            ));
        $arr_data['sub_detail_report'] = array(
            '1'=>array(
                '1'=>'200',
                '7'=>'30',
                '12'=>'50',
                '17'=>'10',
                '22'=>'3',
                '26'=>'300'
            ),
            '2'=>array(
                '1'=>'20',
                '7'=>'40',
                '12'=>'80',
                '17'=>'10',
                '22'=>'14',
                '26'=>'32'
            ),
            '3'=>array(
                '1'=>'45',
                '7'=>'60',
                '12'=>'98',
                '17'=>'99',
                '22'=>'12',
                '26'=>'40'
            ),
            '4'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),
            '5'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),

        );
        $arr_data['sub_detail_remain'] = array(
            '1'=>array(
                '1'=>'100',
                '7'=>'102',
                '12'=>'35',
                '17'=>'20',
                '22'=>'32',
                '26'=>'66'
            ),
            '2'=>array(
                '1'=>'12',
                '7'=>'65',
                '12'=>'32',
                '17'=>'74',
                '22'=>'75',
                '26'=>'89'
            ),
            '3'=>array(
                '1'=>'24',
                '7'=>'26',
                '12'=>'32',
                '17'=>'64',
                '22'=>'12',
                '26'=>'40'
            ),
            '4'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),
            '5'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),
        );

        #3. รายงานรวมผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัดแบบรายเดือน

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

        $arr_data['user_report'] = array(
            'user_name'=>'........................................',
            'user_position'=>'........................................'
        );

        $this->load->view('report_overall_summary/excel',$arr_data);
    }
}
