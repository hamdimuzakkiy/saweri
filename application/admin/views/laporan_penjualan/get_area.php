						
								<table class="table" cellspacing="0" width="100%">
								<?php
									$k=1;
									$i=0;
									foreach ($area->result() as $row){
										
										if($k == 1){
											echo "
													<tr>
													<td><input type='checkbox' id='nama' name='nama[$i]' value='$row->id_area' /> " . $row->area ."</td>
												";
											$k++;
										}else if($k == 2){
											echo "<td><input type='checkbox' id='nama' name='nama[$i]' value='$row->id_area' /> " . $row->area ."</td>";
											$k++;
										}else if($k == 3){
											echo "
													<td><input type='checkbox' id='nama' name='nama[$i]' value='$row->id_area' /> " . $row->area ."</td>
													</tr>
												";
											$k = 1;
										}
										$i++;
										
									}
								?>
								</table>