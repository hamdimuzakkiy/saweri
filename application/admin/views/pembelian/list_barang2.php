<link href="<?=base_url()?>asset/bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>asset/bootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>asset/bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>asset/bootstrap/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>asset/bootstrap/dist/css/sb-admin-2.css" rel="stylesheet" type="text/css">
<link href="<?=base_url()?>asset/bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



<script type="text/javascript" src="<?=base_url()?>asset/bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asset/bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/bootstrap/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/bootstrap/dist/js/sb-admin-2.js"></script>

<style type="text/css">
	
</style>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover"  id="data">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
 
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
            
        </tbody>
    </table>
</div>

<SCRIPT TYPE="text/javascript">
	$(document).ready(function() {
    $('#data').dataTable();
} );
</SCRIPT>