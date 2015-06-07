<table width="686" border="1" cellpadding="1" cellspacing="1">
  <!--
  <tr>
    <td width="64" align="left" valign="top"><strong>Tanggal</strong></td>
    <td width="372" align="left" valign="top" colspan="3"></td>
  </tr>
  <tr>
    <td align="left" valign="top"><strong>Cabang</strong></td>
    <td align="left" valign="top" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" colspan="4">&nbsp;</td>
  </tr>
  -->
  <tr>
    <td align="left" valign="top" bgcolor="#CCCCFF"><strong>No</strong></td>
    <td align="left" valign="top" bgcolor="#CCCCFF"><strong>Nama Barang</strong></td>
    <td align="left" valign="top" bgcolor="#CCCCFF"><strong>Qty</strong></td>
  </tr>
	<?php
			$i=1;
			foreach($result->result() as $row){
	?>
			  <tr>
				<td align="left" valign="top"><?=$i++?></td>
				<td align="left" valign="top"><?=$row->nama_barang?></td>
				<td align="left" valign="top"><?=$row->qty?></td>
			  </tr>
	<?php
			}
	?>		<tr>		<td colspan="3">&nbsp; </td>	</tr>		<tr>		<td colspan="2"></td>		<td> <?php 				echo anchor('request_order/send_order/'.$row->id_request, 'Kirim',  array('class'=>'button'));				?></td>	</tr>	
</table>		