    <html>
    <head>
    <title>By AJAX</title>
    <script type="text/javascript">
    function delete_row ( target ) {
    do {
    if ( target.nodeName.toUpperCase() == 'TR' ) {
    target.parentNode.removeChild(target);
    break;
    }
    } while ( target = target.parentNode );
    }
    function add_row ( table ) {
    if( typeof document.getElementById == 'undefined' ||
    typeof document.createElement == 'undefined' ) {
    return; // Only DOM browsers
    }
    var table = document.getElementById(table) ;
    var pos = 0;
    var authors = [];
    for ( var i = 0; i < table.rows.length; i ++ ) {
    var row = table.rows.item(i);
    if ( /author/.test( row.className ) ) {
    authors.push(row);
    pos ++;
    }
    }
    var tr = document.createElement('tr');
    tr.setAttribute('class','author');
    var td1 = document.createElement('td');
    var label = document.createTextNode('Author Name: ')
    //td1.appendChild(label);
    
    var td2 = document.createElement('td');
    var field = document.createElement('input');
    var field2 = document.createElement('select');

    field.setAttribute('name','authorName[' + pos + ']');
    field.setAttribute('id','authorName_' + pos );
    field.setAttribute('type','text');
    field.setAttribute('size','60');
	
	field2.setAttribute('name','to_akunid[' + pos +']');
	field2.setAttribute('id','to_akunid_' + pos);
		var x=document.getElementById("to_akunid_0");
		var option=document.createElement("option");
		option.text="Kiwi";
		
		  field2.add("asdas",null);
		  field2.add("fgfdgdf",null);

	

	
    //field.setAttribute('value',pos); // testing purposes
    //td1.appendChild(field2);
	//$('#to_akunid_0').clone().attr({'id':'to_akunid_' + pos, 'name':'to_akunid[' + pos +']'}).appendTo('#td1');
	//$('#to_akunid_0').clone().attr({'id':'to_akunid_' + pos, 'name':'to_akunid[' + pos +']'}).appendChild('field2');
	

    td1.appendChild(field2);
    td2.appendChild(field);
    tr.appendChild(td1);
    tr.appendChild(td2);

    	
    var td3 = document.createElement('td');
    var button = document.createElement('input');
    button.setAttribute('onclick','delete_row(this)');
    button.setAttribute('value','Delete');
    button.setAttribute('type','button');
    td3.appendChild(button);
    tr.appendChild(td3);
    var next_node = authors[pos -1];
    while ( next_node = next_node.nextSibling ) {
    if ( next_node.nodeName.toUpperCase() == 'TR' ) {
    break;
    }
    }
    if ( table.tBodies.length ) {
    if ( next_node ) {
    table.tBodies[0].insertBefore( tr, next_node );
    } else {
    table.tBodies[0].appendChild( tr );
    }
    } else {
    if ( table.tBodies.length ) {
    table.insertBefore( tr, next_node );
    } else {
    table.appendChild( tr );
    }
    }
    }
    </script>
    </head>
    <body>
	<section class="grid_12">
		<div class="block-border">
		<?php

			$attributes = array('name' => 'form1', 'id' => 'form1', 'class'=>'block-content form');

			echo form_open('mutasi_kas/get_form_data', $attributes);

		?>
				<table class="table" border="1" cellspacing="0" width="100%" id="tblView">
					<p class="colx2-left">
						<label for="complex-en-url">Akun Debet (Kode Kas) :</label>
						<span class="relative">
							<select name="from_akunid" id="from_akunid"class="seperempat-width">
								<?php
									$query = $this->db->get('master_akun');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->AKUNID.'">'.$row->NAKUN.'</option>';
										}
									}
								?>
							</select>
						</span>
					</p>
					<p class="colx2-right">
						<label for="complex-en-url">Nominal Kas :</label>
						<span class="relative">
							<input type="text" name="jumlah_debet" id="jumlah_debet" value="<?=set_value('jumlah_debet')?>" readonly="true" class="duapertiga-width">
						</span>
					</p>
					<thead>
						<tr>
							<th rowspan="2" scope="col">Akun Kredit (Kode Kas)</th>
							<th rowspan="2" scope="col">Nama Akun</th>
							<th rowspan="2" scope="col">Jumlah Nominal</th>
						</tr>
					</thead>
					<tbody>
					<tr class="author">
						<td>
							<select name="to_akunid[0]" id="to_akunid_0" class="seperempat-width">
								<?php
									$query = $this->db->get('master_akun');
									if($query->num_rows() > 0)
									{
										foreach($query->result() as $row)
										{
											echo '<option value="'.$row->AKUNID.'">'.$row->NAKUN.'</option>';
										}
									}
								?>
							</select>
						</td>
						<td><input name="authorName[0]" type="text" id="authorName_0" size="60"></td>
						<td>
							<input type="text" name="jumlah_kredit" value="">
							<input name="cmdAddMore" type="button" id="cmdAddMore" value="Add" onClick="add_row('tblView')" />
						</td>
					</tr>
					<tr id="tes"><td id="td1"><td id="td2"><td id="td3"></tr>
					</tbody>
					
				</table>
		</div>
	</section>
    </form>
</body>
</html>