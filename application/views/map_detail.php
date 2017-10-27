<table>
  <tr>
    <td width="50%" style="text-align:right;">วันที่ที่ร้องทุกข์ :</td>
    <td>
    <?php
    $complain_date =($key_in_data['complain_date'] !='' && $key_in_data['complain_date'] !='0000-00-00')?date_thai($key_in_data['complain_date'], true):'';
    echo $complain_date;
    ?>
    </td>
  </tr>
  <tr>
    <td style="text-align:right;">หัวข้อเรื่องร้องทุกข์ :</td>
    <td><?php echo @$key_in_data['complain_name'];?></td>
  </tr>
  <tr>
    <td style="text-align:right;">เหตุการณ์พฤติการณ์ : </td>
    <td><?php echo @$key_in_data['complaint_detail'];?></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:right;">
      <a href="<?php echo base_url();?>complaint/view_detail/<?php echo $keyin_id;?>" target="_blank">รายละเอียด</a>
    </td>
  </tr>
</table>
<style>
  td{
    font-size: 12px;
  }
</style>
