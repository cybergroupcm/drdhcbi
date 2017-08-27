<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_overall_summary extends CI_Controller {

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

    public function index()
    {
        $arr_data['url'][0] = '';
        $arr_data['url'][1] = '';
        $arr_data['url'][2] = '';
        $this->libraries->template('report_overall_summary/index', $arr_data);
    }

    public function pdf(){
        $param = ($_GET['yy'] !="")?"/yy/".$_GET['yy']:"";
        $param .= ($_GET['mm'] !="")?"/mm/".$_GET['mm']:"";

        $yymm=$_GET['yy'].'-'.$_GET['mm'];

        #1. ��§ҹ�š�ô��Թ�ҹ��䢻ѭ������ͧ��ͧ���¹�ͧ�ٹ���ç�����ѧ��Ѵ (����ͧ����)
        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['outstanding_month'] = array('1'=>'28','7'=>'36','12'=>'0','17'=>'8','22'=>'5','26'=>'4');
        $arr_data['incoming_month'] = array('1'=>'7','7'=>'82','12'=>'0','17'=>'17','22'=>'11','26'=>'0');
        $arr_data['incoming_cumulative_month'] = array('1'=>'205','7'=>'882','12'=>'15','17'=>'160','22'=>'87','26'=>'41');
        $arr_data['terminate_month'] = array('1'=>'31','7'=>'89','12'=>'0','17'=>'14','22'=>'12','26'=>'0');
        $arr_data['terminate_cumulative_month'] = array('1'=>'201','7'=>'853','12'=>'15','17'=>'149','22'=>'83','26'=>'37');

        #2. ��§ҹ�š�ô��Թ�ҹ��䢻ѭ������ͧ��ͧ���¹�ͧ�ٹ���ç�����ѧ��Ѵ (����ҧ)
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
            '1'=>'����ͧ��ͧ���¹����ҧ���Թ�������ͻէ�����ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-2).'  �������ö��䢻ѭ�Ҩ������ص�  㹻է�����ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-1),
            '2'=>'����ͧ��ͧ���¹����ҧ���Թ�������ͻէ�����ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-1).' �������ö��䢻ѭ�Ҩ������ص�㹻է�����ҳ �.�.'.date_thai($yymm.'-01', true,'y')
        );
        $arr_data['sub_data'] = array(
            '1'=>array(
                '1'=>'����ͧ��ҷ������� '.(date_thai($yymm.'-01', true,'Y')-2),
                '2'=>'���Թ��è������صԻ� '.(date_thai($yymm.'-01', true,'Y')-2),
                '3'=>'����ͧ��ҧ�������է� '.(date_thai($yymm.'-01', true,'Y')-2),
                '4'=>'����ͧ�ص����͹���',
                '5'=>'�������'
            ),
            '2'=>array(
                '1'=>'����ͧ��ҷ������� '.(date_thai($yymm.'-01', true,'Y')-1),
                '2'=>'���Թ��è������صԻ� '.(date_thai($yymm.'-01', true,'Y')-1),
                '3'=>'����ͧ��ҧ�������է� '.(date_thai($yymm.'-01', true,'Y')-1),
                '4'=>'����ͧ�ص����͹���',
                '5'=>'�������'
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

        #3. ��§ҹ����š�ô��Թ�ҹ��䢻ѭ������ͧ��ͧ���¹�ͧ�ٹ���ç�����ѧ��ѴẺ�����͹

        $arr_data['progress_type'] = array(
            '0'=>'���Թ���',
            '1'=>'�ص�����ͧ'
        );

        $arr_data['result_progress'] = array(
            '1'=>array(
                'result'=>array(
                    'column1'=>'3.1 ����ͧ��ͧ���¹����ҧ���Թ�������ͻէ�����ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-2)
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'����ͧ��ͧ���¹������ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-2),
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
                    'column1'=>'3.2 ����ͧ��ͧ���¹����ҧ���Թ�������ͻէ�����ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-1)
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'����ͧ��ͧ���¹������ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-1),
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
                    'column1'=>'3.3 ����ͧ��ͧ���¹����ҧ���Թ�������ͻէ�����ҳ �.�.'.date_thai($yymm.'-01', true,'y')
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'��͹ ���Ҥ�',
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
                        'column1'=>'��͹ ����Ҿѹ��',
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
                        'column1'=>'��͹ �չҤ�',
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
                        'column1'=>'��͹ ����¹',
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
                        'column1'=>'��͹ ����Ҥ� ',
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
                        'column1'=>'��͹ �Զع�¹',
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
                        'column1'=>'��͹ �á�Ҥ�',
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
                    'column1'=>'���',
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

        #1. ��§ҹ�š�ô��Թ�ҹ��䢻ѭ������ͧ��ͧ���¹�ͧ�ٹ���ç�����ѧ��Ѵ (����ͧ����)
        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['outstanding_month'] = array('1'=>'28','7'=>'36','12'=>'0','17'=>'8','22'=>'5','26'=>'4');
        $arr_data['incoming_month'] = array('1'=>'7','7'=>'82','12'=>'0','17'=>'17','22'=>'11','26'=>'0');
        $arr_data['incoming_cumulative_month'] = array('1'=>'205','7'=>'882','12'=>'15','17'=>'160','22'=>'87','26'=>'41');
        $arr_data['terminate_month'] = array('1'=>'31','7'=>'89','12'=>'0','17'=>'14','22'=>'12','26'=>'0');
        $arr_data['terminate_cumulative_month'] = array('1'=>'201','7'=>'853','12'=>'15','17'=>'149','22'=>'83','26'=>'37');

        #2. ��§ҹ�š�ô��Թ�ҹ��䢻ѭ������ͧ��ͧ���¹�ͧ�ٹ���ç�����ѧ��Ѵ (����ҧ)
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
            '1'=>'����ͧ��ͧ���¹����ҧ���Թ�������ͻէ�����ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-2).'  �������ö��䢻ѭ�Ҩ������ص�  㹻է�����ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-1),
            '2'=>'����ͧ��ͧ���¹����ҧ���Թ�������ͻէ�����ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-1).' �������ö��䢻ѭ�Ҩ������ص�㹻է�����ҳ �.�.'.date_thai($yymm.'-01', true,'y')
        );
        $arr_data['sub_data'] = array(
            '1'=>array(
                '1'=>'����ͧ��ҷ������� '.(date_thai($yymm.'-01', true,'Y')-2),
                '2'=>'���Թ��è������صԻ� '.(date_thai($yymm.'-01', true,'Y')-2),
                '3'=>'����ͧ��ҧ�������է� '.(date_thai($yymm.'-01', true,'Y')-2),
                '4'=>'����ͧ�ص����͹���',
                '5'=>'�������'
            ),
            '2'=>array(
                '1'=>'����ͧ��ҷ������� '.(date_thai($yymm.'-01', true,'Y')-1),
                '2'=>'���Թ��è������صԻ� '.(date_thai($yymm.'-01', true,'Y')-1),
                '3'=>'����ͧ��ҧ�������է� '.(date_thai($yymm.'-01', true,'Y')-1),
                '4'=>'����ͧ�ص����͹���',
                '5'=>'�������'
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

        #3. ��§ҹ����š�ô��Թ�ҹ��䢻ѭ������ͧ��ͧ���¹�ͧ�ٹ���ç�����ѧ��ѴẺ�����͹

        $arr_data['progress_type'] = array(
            '0'=>'���Թ���',
            '1'=>'�ص�����ͧ'
        );

        $arr_data['result_progress'] = array(
            '1'=>array(
                'result'=>array(
                    'column1'=>'3.1 ����ͧ��ͧ���¹����ҧ���Թ�������ͻէ�����ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-2)
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'����ͧ��ͧ���¹������ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-2),
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
                    'column1'=>'3.2 ����ͧ��ͧ���¹����ҧ���Թ�������ͻէ�����ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-1)
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'����ͧ��ͧ���¹������ҳ �.�.'.(date_thai($yymm.'-01', true,'y')-1),
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
                    'column1'=>'3.3 ����ͧ��ͧ���¹����ҧ���Թ�������ͻէ�����ҳ �.�.'.date_thai($yymm.'-01', true,'y')
                ),
                'result_sub'=>array(
                    '0'=>array(
                        'column1'=>'��͹ ���Ҥ�',
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
                        'column1'=>'��͹ ����Ҿѹ��',
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
                        'column1'=>'��͹ �չҤ�',
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
                        'column1'=>'��͹ ����¹',
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
                        'column1'=>'��͹ ����Ҥ� ',
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
                        'column1'=>'��͹ �Զع�¹',
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
                        'column1'=>'��͹ �á�Ҥ�',
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
                    'column1'=>'���',
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

        $this->load->view('report_overall_summary/excel',$arr_data);
    }
}
